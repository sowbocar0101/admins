<?php
// ====A+P+P+K+E+Y====
namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Driver;
use App\Models\VehicleCategory;
use Illuminate\Support\Facades\Auth;

class OtherController extends Controller
{
    /**
     * Return Google Setting
     *
     * @return Response
     */
    public function googleSetting()
    {
        $path = public_path() . "/google-services.json"; // ie: /var/www/laravel/app/storage/json/filename.json

        $json = json_decode(file_get_contents($path), true);

        return response()->json($json, 200);
    }

    /**
     * Get Online Status Driver and user
     *
     * @param Request $request
     * @return Response
     */
    public function onlineStatus(Request $request)
    {
        $driver = Auth::user();

        return response()->json([
            'status' => $driver->status
        ]);

        // return $request->all();
        // if($request->type == 'driver'){
        //     $driver = Driver::find($id);

        //     if(!$driver){
        //         return response()->json([
        //             'status' => 'Driver Not Found'
        //         ], 200);
        //     }

        //     return response()->json([
        //         'status' => $driver->status
        //     ]);
        // }elseif ($request->type == 'user'){
        //     $driver = Customer::find($id);

        //     if(!$driver){
        //         return response()->json([
        //             'status' => 'Customer Not Found'
        //         ], 200);
        //     }

        //     return response()->json([
        //         'status' => $driver->status
        //     ]);
        // }
    }

    /**
     * Rteurn all price Category
     *
     * @return Response
     */
    public function priceCategory()
    {
        $result = [];

        foreach(VehicleCategory::latest()->get() as $item){
            $data = [
                'id' => json_decode($item->id),
                'category' => $item->category,
                'price_km' => json_decode($item->price_km),
                'min_km' => json_decode($item->min_km),
                'min_price' => json_decode($item->min_price),
                'seat' => json_decode($item->seat),
                'extra_km' => json_decode($item->extra_km)
            ];

            $result[] = $data;
        }

        return response()->json([
            'success' => true,
            'data' => $result
        ]);
    }

    public function currency()
    {
        return response()->json([
            'data' => CURRENCY
        ], 200);
    }
}
