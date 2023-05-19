<?php
// ====A+P+P+K+E+Y====
namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;


class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->type == 'datatable'){
            $data = Customer::all();

            return datatables()->of($data)
                ->addColumn('action', function ($data) {
                    return '<a href="#" data-url="'.route('customer.update', $data->id).'" class="btn new-btn-edit edit-action" onclick="showEdit()">'.trans('default.action.edit').'</a>
                            <a href="#" data-url="'.route('customer.destroy', $data->id).'" class="btn new-btn-delete delete-action">'.trans('default.action.delete').'</a>';
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
                ->editColumn('phone', function($data){
                    return $data->phone;
                })
                ->addColumn('status', function($data){
                    if($data->status == 1){
                        return '<div class="badge badge-pill" style="background:#00EC86; color:white;">'.trans('default.new.active').'</div>';
                    } else {
                        return '<div class="badge badge-pill" style="background:#FF5D5D; color:white;">'.trans('default.new.inactive').'</div>';
                    }
                })
                ->rawColumns(['action', 'image', 'name', 'email',  'status'])
                ->make(true);
        }

        return view('pages.customer.index');
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
        // return $request->hasFile('image') ? ['asdsad' => 'cvxvcx'] : ['cc' => 'vv'];
        $validator = Validator::make($request->all(), [
            'email' => 'unique:customers,email',
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
            $customer = ([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => Hash::make($request->password),
                'status' => 1,
                'id_area' => 0
            ]);

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = 'img_profile_user_'.date('Ymd').'_'.date('His').'.'.$image->getClientOriginalExtension();
                // return response(['image_name' => $imageName]);
                //Store to storage laravel
                // $image->storeAs('public/image/user', $imageName);
                request()->image->move(public_path('/storage/image/user/'), $imageName);

                $customer['image'] = '/storage/image/user/'.$imageName;
            }

            Customer::create($customer);

            return response()
                ->json([
                    'error' => false,
                    'message' => trans('default.alert.success.create')
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
        $data = Customer::find($id);

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
        $data = Customer::find($id);
        if($data->email !== $request->email){
            $validator = Validator::make($request->all(), [
                'email' => 'unique:customers,email',
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
            $customer = ([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'status' => $request->status
            ]);

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = 'img_profile_user_'.date('Ymd').'_'.date('His').'.'.$image->getClientOriginalExtension();

                //Store to storage laravel
                // $image->storeAs('public/image/user', $imageName);
                request()->image->move(public_path('/storage/image/user/'), $imageName);

                $customer['image'] = '/storage/image/user/'.$imageName;
            }

            if ($request->password != 'undefined') {
                $customer['password'] = Hash::make($request->password);
            }else{
                unset($customer['password']);
            }

            Customer::where('id', $id)->update($customer);

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
            Customer::find($id)->delete();

            return response()
                ->json([
                    'error' => false,
                    'message' => trans('default.alert.success.delete')
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
     * Config export all type
     *
     * @param Request $request
     * @return mixed
     */
    public function export(Request $request)
    {
        $data = Customer::all();
        view()->share('data', $data);
        return view('pages.customer.print');
    }
}
