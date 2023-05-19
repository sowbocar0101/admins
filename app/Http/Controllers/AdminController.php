<?php
// ====A+P+P+K+E+Y====
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;


class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->type == 'datatable'){
            $data = User::all();

            return datatables()->of($data)
                ->addColumn('action', function ($data) {
                    return '<a href="#" data-url="'.route('admin.update', $data->id).'" class="btn new-btn-edit edit-action" onclick="showEdit()">'.trans('default.action.edit').'</a>
                            <a href="#" data-url="'.route('admin.destroy', $data->id).'" class="btn new-btn-delete delete-action">'.trans('default.action.delete').'</a>';
                })
                ->addColumn('name', function($data){
                    return $data->name;
                })
                ->addColumn('username', function($data){
                    return $data->username;
                })
                ->addColumn('status', function($data){
                    if($data->status == 1){
                        return '<div class="badge badge-success badge-pill">'.trans('default.text.yes').'</div>';
                    } else {
                        return '<div class="badge badge-danger badge-pill">'.trans('default.text.no').'</div>';
                    }
                })
                ->rawColumns(['action', 'name', 'username', 'status'])
                ->make(true);
        }

        return view('pages.admin.index');
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
            User::create([
                'name' => $request->name,
                'username' => $request->username,
                'password' => bcrypt($request->password)
            ]);

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
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($lang, $id)
    {
        $data = User::find($id);

        if(!$data){
            return response()->json([
                'error' => true,
                'message' => 'Data tidak ditemukan'
            ]);
        }

        return response()->json([
            'id' => $data->id,
            'name' => $data->name,
            'username' => $data->username
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
            $admin = ([
                'name' => $request->name,
                'username' => $request->username,
            ]);

            if($request->password != null || $request->password != ''){
                $admin['password'] =  bcrypt($request->password);
            }

            User::where('id', $id)->update($admin);

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
            User::where('id', $id)->delete();

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
        $data = User::all();
        view()->share('data', $data);
        return view('pages.admin.print');
    }
}
