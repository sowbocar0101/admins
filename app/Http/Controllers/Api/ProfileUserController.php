<?php
// ====A+P+P+K+E+Y====
namespace App\Http\Controllers\Api;

use App\Models\Customer;
use App\Mail\ResetPasswordEmail;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileUserController extends Controller
{
    protected $email;

    public function __construct()
    {
        $this->email = new ResetPasswordEmail();
    }

    public function updateEmail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|unique:customers,email',
        ],[
            'email.required' => IS_REQUIRED,
            'email.unique' => IS_UNIQUE,
        ]);

        if($validator->fails()){
            return response()->json([
                'success' => 0,
                'message' => $validator->messages()->first(),
            ],422);
        }

        Auth::user()->update([
            'email' => $request->email,
        ]);

        return response()->json([
            'success' => 1,
            'message' => 'OK',
        ],200);
    }

    public function resetPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
        ],[
            'email.required' => IS_REQUIRED,
        ]);

        if($validator->fails()){
            return response()->json([
                'success' => 0,
                'message' => $validator->messages()->first(),
            ],422);
        }

        $user = Customer::where('email', $request->email)->first();

        if(!$user){
            return response()->json([
                'success' => 0,
                'message' => 'Email is not registered',
            ],422);
        }else{
            $string = STR::random(6);
            $password = strtoupper($string);
            $user->update([
                'password' => Hash::make($password)
            ]);
            $this->email->resetPassword($user->email,$password);
            return response()->json([
                'success' => 1,
                'message' =>'OK',
            ],200);
        }
    }

    public function updatePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'old_password'                      => 'required',
            'password'                          => 'required|confirmed',
            'password_confirmation'             => 'required'
        ],[
            'old_password.required'             => IS_REQUIRED,
            'password.required'                 => IS_REQUIRED,
            'password_confirmation.required'    => IS_REQUIRED,
            'password.confirmed'                => IS_CONFIRMED,
        ]);

        if($validator->fails()){
            return response()->json([
                'success' => 0,
                'message' => $validator->messages()->first(),
            ],422);
        }

        if(Hash::check($request->old_password, Auth::user()->password)){
            Customer::find(Auth::user()->id)->update([
                'password' => Hash::make($request->password)
            ]);
            return response()->json([
                'success' => 1,
                'message' => 'OK',
            ],200);
        }else{
            return response()->json([
                'success' => 0,
                'message' => "4",
            ],422);
        }
    }
}
