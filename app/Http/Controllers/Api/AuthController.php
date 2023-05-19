<?php
// ====A+P+P+K+E+Y====
namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Driver;
use App\Models\VehicleCategory;
use Tymon\JWTAuth\Exceptions\JWTException;
use Config;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    /**
     * Login by api
     *
     * @param Request $request
     * @return Response json
     */

    public function login(Request $request)
    {
        $data = Customer::where('email', $request->email)->first();
        if(!$data){
            return response()->json([
                'success' => 0,
                'message' => 'Unable to login'
            ]);
        }

        if(Hash::check($request->password, $data->password)){
            $data->id = (string)$data->id;
            $data->first_order = (string)$data->first_order;
            $token = JWTAuth::fromUser($data);

            if($data->status == 'Non Aktif'){
                return response()->json([
                    'success' => 0,
                    'message' => 'Acoount suspended'
                ]);
            } else {
                if($request->fcm_token){
                    $data->update([
                        'fcm_token' => $request->fcm_token,
                    ]);
                }

                return response()->json([
                    'user' => $data,
                    'token' => $token
                ], 200);
            }
        }else{
            return response()->json([
                'success' => 0,
                'message' => 'Unable to login'
            ]);
        }
    }

    /**
     * Login as a driver
     *
     * @param Request $request
     * @return mixed
     */
    public function loginDriver(Request $request)
    {
        $data = Driver::where('email', $request->email)->first();
        if(!$data){
            return response()->json([
                'success' => 0,
                'message' => 'Unable to login'
            ]);
        }

        if(Hash::check($request->password, $data->password)){
            $data->id = (integer)$data->id;
            $data->vehicle_category_id = (string)$data->vehicle_category_id;
            $token = JWTAuth::fromUser($data);

            if($data->status == DRIVER_INACTIVE){
                return response()->json([
                    'success' => 0,
                    'message' => 'Account suspended'
                ]);
            } else {
                $data->update([
                    'fcm_token' => $request->fcm_token ? $request->fcm_token : $data->fcm_token,
                    'firebase_uid' => $request->firebase_uid ?? '',
                    'api_token' => $token,
                    'api_token_expired' => \Carbon\Carbon::now()->addMonth(1)->format('Y-m-d H:i:s')
                ]);

                return response()->json([
                    'user' => $data,
                    'token' => $token
                ], 200);
            }
        }else{
            return response()->json([
                'success' => 0,
                'message' => 'Unable to login'
            ]);
        }
    }

    /**
     * Register as a user
     *
     * @param Request $request
     * @return mixed
     */
    public function register(Request $request)
    {
        // return request()->all();
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:100',
            'email' => 'required|unique:customers,email|max:100',
            'phone' => 'required|max:20',
            'password' => 'required|min:6',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ],[
            'name.required' => 0,
            'email.required' => 0,
            'phone.required' => 0,
            'password.required' => 0,
            'email.unique' => 1,
            'image.image' => 2,
        ]);

        if($validator->fails()){
            // return $validator->messages();
            return response()->json([
                'success' => 0,
                'message' => $validator->messages()->first(),
            ],422);
        }

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'status' => CUSTOMER_ACTIVE,
            'password' => Hash::make($request->password),
        ];

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time().'-'.Str::random(50).'.'.$image->getClientOriginalExtension();
            request()->image->move(public_path('/storage/image/user/'), $imageName);
            $data['image'] = '/storage/image/user/'.$imageName;
        }

        $token = DB::transaction(function () use($data) {
            $user = Customer::create($data);
            $token = JWTAuth::fromUser($user);

            return $token;
        }, 5);

        return response()->json([
            'success' => 1,
            'message' => 'Register success',
            'token' => $token
        ], 200);
    }

    /**
     * Register driver
     *
     * @param Request $request
     * @return Response json
     */
    public function registerDriver(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:100',
            'email' => 'required|unique:drivers,email|max:100',
            'phone' => 'required|max:20',
            'password' => 'required|min:6|max:255',
            'plate_number' => 'required|max:20',
            'car_model' => 'required|max:100',
            'vehicle_category_id' => 'required|exists:vehicle_categories,id',
            'driver_photo' => 'image|mimes:jpeg,png,jpg,gif|max:2048',

        ],[
            'name.required' => 'The :attribute field is required',
            'email.required' => 'The :attribute field is required',
            'phone.required' => 'The :attribute field is required',
            'password.required' => 'The :attribute field is required',
            'email.unique' => 'The :attribute has already been taken',
            'image.image' => 'file must be an image',
        ]);

        if($validator->fails()){
            return response()->json([
                'message' => $validator->errors()
            ],422);
        }

        $driver = ([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'plate_number' => $request->plate_number,
            'vehicle_category_id' => $request->vehicle_category_id,
            'status' => DRIVER_ACTIVE,
            'car_model' => $request->car_model,
            'firebase_uid' => $request->firebase_uid ?? '',
            'fcm_token' => $request->fcm_token ?? NULL,
            'image' => '',
            'api_token_expired' => \Carbon\Carbon::now()->addMonth(1)->format('Y-m-d H:i:s'),
        ]);

        if ($request->hasFile('driver_photo')) {
            $image = $request->file('driver_photo');
            $imageName = time().'-'.Str::random(50).'.'.$image->getClientOriginalExtension();
            request()->driver_photo->move(public_path('/storage/image/driver/'), $imageName);
            $driver['image'] = '/storage/image/driver/'.$imageName;
        }

        $data = Driver::create($driver);
        $token = JWTAuth::fromUser($data);
        $data->update([
            'api_token' => $token
        ]);

        $data->refresh();

        return response()->json([
            'success' => 1,
            'message' => 'Register success',
            'token' => $data->api_token
        ], 200);
    }

    /**
     * Get user profile
     *
     * @param Request $request
     * @return Response
     */
    public function userProfile()
    {
        $user = Auth::user()->only('id', 'name', 'email', 'phone', 'status', 'image');

        return response()->json([
            'success' => 1,
            'user' => $user
        ], 200);
    }

    /**
     * get Driver profile
     *
     * @param Request $request
     * @return Response
     */
    public function driverProfile(Request $request)
    {
        $item = Auth::user();

        $data = array(
            'id' => (string)$item->id,
            'name' => $item->name,
            'email' => $item->email,
            'phone' => $item->phone,
            'plate_number' => $item->plate_number,
            'car_model' => $item->car_model,
            'status' => $item->status,
            'order_status' => $item->order_status,
            'image' => $item->image,
            'vehicle_category' => VehicleCategory::find($item->vehicle_category_id) ?? []
        );

        return response()->json([
            'success' => 1,
            'driver' => $data
        ], 200);
    }

    /**
     * Save user profile update
     *
     * @param Request $request
     * @return Response
     */
    public function updateProfile(Request $request)
    {
        $user = [
            'name' => $request->name,
            'phone' => $request->phone,
        ];

        if($request->password != null || $request->password != ''){
            $user['password'] = Hash::make($request->password);
        }

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time().'-'.Str::random(50).'.'.$image->getClientOriginalExtension();
            request()->image->move(public_path('/storage/image/user/'), $imageName);
            $user['image'] = '/storage/image/user/'.$imageName;
        }

        Auth::user()->update($user);

        return response()->json([
            'success' => 1,
            'message' => 'Profile updated successfully'
        ], 200);
    }

    /**
     * Save driver profile update
     *
     * @param Request $request
     * @return Response
     */
    public function updateDriverProfile(Request $request)
    {
        $item = Auth::user();

        if(!$item){
            return response()->json([
                'message' => 'Token is invalid'
            ], 422);
        }

        if($item->api_token_expired < date('Y-m-d H:i:s')){
            return response()->json([
                'message' => 'Token has expired'
            ], 404);
        }

        $user = ([
            'name' => $request->name,
            'phone' => $request->phone,
            'plate_number' => $request->plate_number,
            'vehicle_category_id' => $request->vehicle_category_id,
            'car_model' => $request->car_model
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = 'img_profile_driver_'.date('Ymd').'_'.date('His').'.'.$image->getClientOriginalExtension();
            request()->image->move(public_path('/storage/image/driver/'), $imageName);

            $user['image'] = '/storage/image/driver/'.$imageName;
        }

        $item->update($user);

        return response()->json([
            'success' => 1,
            'message' => 'Profile updated successfully'
        ], 200);
    }

    /**
     * Send Reset Password
     *
     * @param Request $request
     * @return Response
     */
    public function resetPassword(Request $request)
    {
        if($request->type == 'user'){
            $user = Customer::where('email', $request->email);

            if($user->count() > 0){
                $newPassword = Str::random(8);

                $data = [
                    'content' => "Your password : {$newPassword}",
                    'new_password' => $newPassword
                ];

                // Uncomment this to send email
                // Mail::send('mail.universal', $data, function ($message) use($request) {
                //     $message->from('mail_from@host', 'Admin');
                //     $message->to($request->email, 'Member');
                //     $message->subject("Reset Password");
                // });

                $user->update([
                    'password' => bcrypt($newPassword)
                ]);

                return response()->json([
                    'success' => true,
                    'message' => 'check your email'
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'email not found'
                ], 200);
            }
        } elseif($request->type == 'driver'){
            $driver = Driver::where('email', $request->email);

            if($driver->count() > 0){
                $newPassword = Str::random(8);

                $data = [
                    'content' => "Your new password : {$newPassword}",
                    'new_password' => $newPassword
                ];

                // Uncomment this to send email
                // Mail::send('mail.universal', $data, function ($message) use($request) {
                //     $message->from('mail_from@host', 'Admin');
                //     $message->to($request->email, 'Member');
                //     $message->subject("Reset Password");
                // });

                $driver->update([
                    'password' => bcrypt($newPassword)
                ]);

                return response()->json([
                    'success' => true,
                    'message' => 'check your email'
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'email not found'
                ], 200);
            }
        }
    }

    public function getDriverProfile(Request $request)
    {
        if(Driver::find($request->id)){
            return response()->json([
                'success' => 1,
                'message' => Driver::find($request->id)->only('name', 'phone', 'car_model', 'plate_number')
            ], 200);
        }else{
            return response()->json([
                'success' => 0,
                'message' => 'driver not found'
            ], 200);
        }
    }
}
