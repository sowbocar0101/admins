<?php
// ====A+P+P+K+E+Y====
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AboutUs;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Log;

class AboutUsController extends Controller
{
    public function index()
    {
        $item = AboutUs::first();
        return view('pages.about-us.index', compact('item'));
    }

    public function edit()
    {
        $item = AboutUs::first();
        return view('pages.about-us.edit', compact('item'));
    }

    public function update(Request $request)
    {
        try{
            if(AboutUs::count() < 1){
                AboutUs::create([
                    'text' => $request->text
                ]);
            }else{
                AboutUs::first()->update([
                    'text' => $request->text
                ]);
            }
        }catch(Exception $e){
            Log::info($e->getMessage());
            return redirect()->back()->with('error', 'Unable to update about us');
        }
        return redirect()->route('about-us.index')->with('alert', Lang::get('default.alert.success.update'));
    }
}
