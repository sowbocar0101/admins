<?php
// ====A+P+P+K+E+Y====
namespace App\Http\Controllers\Api;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Driver;
use App\Models\VehicleCategory;
use Illuminate\Support\Facades\Auth;

class DriverController extends Controller
{
    /**
     * get All Driver location
     *
     * @return Response
     */
    public function indexLocation()
    {
        $driver = Driver::where('status', DRIVER_ACTIVE);

        if($driver->count() == 0){
            return response()->json([
                'success' => 0,
                'message' => 'record not found'
            ], 200);
        } else {
            $data = array();
            foreach ($driver->get() as $item) {
                $data[] = array(
                    'id' => (string)$item->id,
                    'latLong' => (string)$item->position,
                    'bearing' => json_decode($item->bearing)
                );
            }
            return response()->json($data, 200);
        }
    }

    /**
     * get Driver location
     *
     * @param Request $_REQUEST
     * @return Response
     */
    public function location(Request $request)
    {
        if(!is_null($request)){
            $driver = Driver::find($request->id);

            if(!$driver){
                return response()->json([
                    'success' => 0,
                    'message' => 'record not found'
                ], 200);
            } else {
                return response()->json([
                    'id' => (string)$driver->id,
                    'latLong' => (string)$driver->position,
                    'bearing' => json_decode($driver->bearing)
                ], 200);
            }
        } else {
            return response()->json([
                'success' => 0,
                'message' => 'request cannot be empty'
            ], 200);
        }
    }

    /**
     * Price check to order
     *
     * @param Request $request
     * @return Response
     */
    public function priceCheck(Request $request)
    {
        if(!is_null($request)){
            $price = VehicleCategory::find($request->vehicle_category_id);

            if($price->count() == 0){
                return response()->json([
                    'success' => 0,
                    'message' => 'record not found'
                ], 200);
            } else {
                return response()->json([
                    'price_km' => (string)$price->price_km,
                    'minimal_price' => (string)$price->minimal_price,
                    'minimal_km' => (string)$price->minimal_km
                ], 200);
            }
        } else {
            return response()->json([
                'success' => 0,
                'message' => 'request cannot be empty'
            ], 200);
        }
    }

    public function setStatus(Request $request)
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

        $item->update(['order_status' => $request->status]);

        return response()->json([
            'success' => 1,
        ], 200);
    }

    public function getCustomerById(Request $request)
    {
        $customer = Customer::find($request->id)->only('name', 'email', 'phone', 'image');

        if($customer){
            return response()->json([
                'success' => 1,
                'data' => $customer
            ], 200);
        }else{
            return response()->json([
                'success' => 0,
                'data' => null
            ], 200);
        }
    }
}
