<?php
// ====A+P+P+K+E+Y====
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Driver;
use App\Models\VehicleCategory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;


class DriverController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->type == 'datatable'){
            $data = Driver::latest()->get();

            return datatables()->of($data)
                ->addColumn('action', function ($data) {
                    return '<a href="#" data-url="'.route('driver.update', $data->id).'" class="btn new-btn-edit edit-action" onclick="showEdit()">'.trans('default.new.button.edit').'</a>
                            <a href="#" data-url="'.route('driver.destroy', $data->id).'" class="btn new-btn-delete delete-action">'.trans('default.new.button.delete').'</a>';
                })
                ->addColumn('image', function($data){
                    if($data->image != null){
                        return '
                    <a href="'.asset($data->image).'" data-rel="lightcase">
                        <img src="'.asset($data->image).'" alt="" class="table-img-square">
                    </a>';
                    } else {
                        return '-';
                    }
                })
                ->addColumn('name', function($data){
                    return $data->name;
                })
                ->addColumn('email', function($data){
                    return $data->email;
                })
                ->addColumn('phone', function($data){
                    return $data->phone;
                })
                ->addColumn('updated_at', function($data){
                    return date('Y-m-d', strtotime($data->updated_at));
                })
                ->addColumn('status', function($data){
                    if($data->status == 1){
                        return '<div class="badge badge-pill" style="background:#00EC86; color:white;">'.trans('default.new.active').'</div>';
                    } else {
                        return '<div class="badge badge-pill" style="background:#FF5D5D; color:white;">'.trans('default.new.inactive').'</div>';
                    }
                })
                ->rawColumns(['action', 'image', 'name', 'email', 'phone', 'status'])
                ->make(true);
        }

        return view('pages.driver.index', [
            'category' => VehicleCategory::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'unique:drivers,email',
            'password' => 'min:8'
        ],[
            'password.min' => Lang::get('validation.min.numeric'),
        ]);

        if($validator->fails()){
            return response()->json([
                'error' => true,
                'message' => $validator->errors()->first()
            ]);
        }

        try {
            $user = ([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => Hash::make($request->password),
                'status' => 1,
                'plate_number' => $request->plate_number,
                'vehicle_category_id' => $request->vehicle_category_id,
                'car_model' => $request->car_model,
                'firebase_uid' => '-',
                'position' => '-'
            ]);

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = 'img_profile_driver_'.date('Ymd').'_'.date('His').'.'.$image->getClientOriginalExtension();

                //Store to storage laravel
                // $image->storeAs('public/image/driver', $imageName);
                request()->image->move(public_path('/storage/image/driver/'), $imageName);

                $user['image'] = '/storage/image/driver/'.$imageName;
            }

            Driver::create($user);

            return response()
                ->json([
                    'error' => false,
                    'message' => trans('default.alert.success.create')
                ]);
        } catch (\Exception $e) {
            Log::info($e->getMessage());
            return response()
                ->json([
                    'error' => true,
                    'message' => "{$e->getMessage()}"
                ]);
        }
        catch (\Throwable $e) {
            Log::info($e->getMessage());
            return response()
                ->json([
                    'error' => true,
                    'message' => "{$e->getMessage()}"
                ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($lang, $id)
    {
        $data = Driver::find($id);

        if(!$data){
            return response()->json([
                'error' => true,
                'message' => 'Data tidak ditemukan'
            ]);
        }

        return response()->json([
            'name' => $data->name,
            'email' => $data->email,
            'phone' => $data->phone,
            'status' => $data->status,
            'plate_number' => $data->plate_number,
            'vehicle_category_id' => $data->vehicle_category_id,
            'car_model' => $data->car_model,
            'image' => $data->image,
            'id' => $data->id
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $lang, $id)
    {
        $driver = Driver::find($id);
        if($driver->email !== $request->email){
            $validator = Validator::make($request->all(), [
                'email' => 'unique:drivers,email',
            ]);

            if($validator->fails()){
                return response()->json([
                    'error' => true,
                    'message' => $validator->errors()->first()
                ]);
            }
        }

        if($request->password){
            $validator = Validator::make($request->all(), [
                'password' => 'min:8'
            ],[
                'password.min' => Lang::get('validation.min.numeric'),
            ]);

            if($validator->fails()){
                return response()->json([
                    'error' => true,
                    'message' => $validator->errors()->first()
                ]);
            }
        }

        try {
            $user = ([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'status' => $request->status,
                'plate_number' => $request->plate_number,
                'vehicle_category_id' => $request->vehicle_category_id,
                'car_model' => $request->car_model,
            ]);

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = 'img_profile_driver_'.date('Ymd').'_'.date('His').'.'.$image->getClientOriginalExtension();

                //Store to storage laravel
                // $image->storeAs('public/image/driver', $imageName);
                request()->image->move(public_path('/storage/image/driver/'), $imageName);

                $user['image'] = '/storage/image/driver/'.$imageName;
            }

            if ($request->password != 'undefined') {
                $user['password'] = Hash::make($request->password);
            }else{
                unset($user['password']);
            }

            Driver::find($id)->update($user);

            return response()
                ->json([
                    'error' => false,
                    'message' => trans('default.alert.success.update')
                ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()
                ->json([
                    'error' => true,
                    'message' => "Error on line {$e->getLine()}. Message:<br><br>{$e->getMessage()}"
                ]);
        } catch (\Throwable $e) {
            Log::error($e->getMessage());
            return response()
                ->json([
                    'error' => true,
                    'message' => "Error on line {$e->getLine()}. Message:<br><br>{$e->getMessage()}"
                ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($lang, $id)
    {
        try {
            Driver::find($id)->delete();

            return response()
                ->json([
                    'error' => false,
                    'message' => trans('default.alert.success.delete')
                ]);
        } catch (\Exception $e) {
            return response()
                ->json([
                    'error' => true,
                    'message' => "Error on line {$e->getLine()}. Message:<br><br>{$e->getMessage()}"
                ]);
        } catch (\Throwable $e) {
            return response()
                ->json([
                    'error' => true,
                    'message' => "Error on line {$e->getLine()}. Message:<br><br>{$e->getMessage()}"
                ]);
        }
    }

    /**
     * Show all position driver by google maps
     *
     * @param Request $request
     * @return mixed
     */
    public function track(Request $request)
    {
        $km = 10; //distance radius
        $pickup_location    = [36.062623, 136.217301];
        $drivers            = Driver::where('position', '!=', NULL)->where('position','!=','')->Where('position', '!=', '-')->where('fcm_token', '!=', NULL)->where('order_status', 1)->inRandomOrder()->get();
        $list_driver        = [];



        foreach($drivers as $driver)
        {
            $driver_location    = explode(',', $driver->position);
            $pickup_lat         = $pickup_location[0];
            $pickup_long        = $pickup_location[1];
            $driver_lat         = $driver_location[0];
            $driver_long        = $driver_location[1];
            $decimals           = 1;

            $degrees            = rad2deg(acos((sin(deg2rad($pickup_lat))*sin(deg2rad($driver_lat))) + (cos(deg2rad($pickup_lat))*cos(deg2rad($driver_lat))*cos(deg2rad($pickup_long-$driver_long)))));
            $distance           = $degrees * 111.13384;
            $distance              = round($distance, $decimals);
            $driver->distance      = ceil($distance);

                $list_driver[] = $driver;
        }

        if (count($list_driver) > 0) {
            $id = null;
            $check_distance = $list_driver[0]['distance'];

            foreach ($list_driver as $dr) {
                if ($dr['distance'] < $check_distance) {
                    $check_distance = $dr['distance'];
                    $default_map = explode(',', $dr['position']);
                }
            }
        } else {
            $default_map = $pickup_location;
        }
        return view('pages.driver.tracking', ['default_map' => $default_map ?? $pickup_location]);
    }

    public function getListDriver()
    {
        $data = Driver::where('status', '1')->where('position','!=','')->select('image', 'name', 'plate_number', 'car_model', 'position')->get();

        foreach($data as $item){
            $item->position = explode(",",$item->position);
        }
        return response()->json($data, 200);
    }

    /**
     * Config export all type
     *
     * @param Request $request
     * @return mixed
     */
    public function export(Request $request)
    {
        $data = Driver::all();
        view()->share('data', $data);
        return view('pages.driver.print');
    }
}
