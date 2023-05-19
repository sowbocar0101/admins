<?php
// ====A+P+P+K+E+Y====
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;

class ProfileController extends Controller
{
    /**
     * Get Data Profile
     *
     * @return mixed
     */
    public function index()
    {
        $data = Auth::user();

        if(!$data){
            abort(404);
        }

        return view('pages.profile', [
            'data' => $data
        ]);
    }

    /**
     * Save new data
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        if($request->password){
            $this->validate($request, [
                'password' => 'min:8'
            ],[
                'password.min' => Lang::get('validation.min.numeric'),
            ]);
        }

        try {
            $admin = ([
                'name' => $request->name,
                'username' => $request->username,
            ]);

            if($request->password != null || $request->password != ''){
                $admin['password'] =  bcrypt($request->password);
            }

            Auth::user()->update($admin);
            Session::put('name', $request->name);
            Session::put('username', $request->username);

            return redirect()->back()
                            ->with('success', trans('default.alert.success.update'));
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
}
