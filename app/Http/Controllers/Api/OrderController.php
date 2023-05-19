<?php
// ====A+P+P+K+E+Y====
namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Utils\Notification AS FCM;
use App\Models\Order;
use App\Models\Driver;
use App\Models\Customer;
use App\Models\OrderSetting;
use App\Models\VehicleCategory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Show all order
     *
     * @return Response
     */

    protected $fcm;

    public function __construct()
    {
        $this->fcm = new FCM();
    }

    public function index()
    {
        $order = new Order();

        if($order->count() == 0){
            return response()->json([
                'success' => 0,
                'message' => 'record not found'
            ], 200);
        } else {
            $data = array();
            foreach($order->all() as $item){
                $customer = Customer::find($item->customer_id);
                // $driver = Driver::find($item->driver_id);
                $data[] = array(
                    'id' => (string)$item->id_order,
                    'driver_id' => (string)$item->driver_id,
                    'start_coordinate' => $item->start_coordinate,
                    'end_coordinate' => $item->end_coordinate,
                    'start_address' => $item->start_address,
                    'end_address' => $item->end_address,
                    'distance' => (string)$item->distance,
                    'total' => (string)$item->total,
                    'order_time' => $item->order_time,
                    'status' => (string)$item->status,
                    'name' => $customer->name ?? '-',
                    'phone' => $customer->phone ?? '-',
                    'email' => $customer->email ?? '-',
                    'vehicle_category_id' => $item->vehicle_category_id
                );
            }
            return response()->json([
                'success' => 1,
                'order' => $data
            ], 200);
        }
    }

    /**
     * Send order to Driver
     */
    public function store(Request $request)
    {

        $fcm = new FCM();
        if(!is_null($request)){
            // return $order;

            $data = Order::create([
                'customer_id' => Auth::user()->id,
                'vehicle_category_id' => $request->vehicle_category_id,
                'start_coordinate' => $request->start_coordinate,
                'end_coordinate' => $request->end_coordinate,
                'start_address' => $request->start_address,
                'end_address' => $request->end_address,
                'distance' => $request->distance,
                'total' => $request->total,
                'order_time' => date('Y-m-d H:i:s'),
                'one_way' => 0,
                'driver_id' => null,
                'payment_method' => $request->payment_method,
                'status' => IS_PENDING
            ]);

            $this->fcm->newSendTopics(
                '/topics/'.$request->vehicle_category_id.'-new-order',
                'New Order',
                'Starting point： ' . $request->start_address . "\r\n \r\n" . 'Destination： ' . $request->end_address,
                $data->id);

            // $this->getDistanceAndPushNotif($data);

            return response()->json([
                'success' => 1,
                'id' => json_decode($data->id),
                'message' => 'Data inserted and already notified'
            ], 200);
        } else {
            return response()->json([
                'success' => 0,
                'message' => 'request cannot be empty'
            ], 200);
        }
    }

    /**
     * Update status order
     *
     * @param Request $request
     * @return Response
     */
    public function update(Request $request)
    {
        if(!is_null($request)){
            $order = Order::find($request->id);

            if(!$order){
                return response()->json([
                    'success' => 0,
                    'message' => 'Order not found'
                ], 200);
            }

            $order->update(['status' => $request->status ]);

            return response()->json([
                'success' => 1,
                'message' => "Order status updated to : {$request->status}"
            ], 200);
        } else {
            return response()->json([
                'success' => 0,
                'message' => 'request cannot be empty'
            ], 200);
        }
    }

    /**
     * Update driver status
     *
     * @param Request $request
     * @return mixed
     */
    public function updateDriver(Request $request)
    {
        $item = Auth::user();
        $order = Order::find($request->id);

        if(!$order){
            return response()->json([
                'success' => 0,
                'message' => IS_ORDER_NOT_FOUND
            ], 200);
        } else {
            $customer = Customer::find($order->customer_id);

            if($order->status == IS_CANCEL){
                return response()->json([
                    'success' => 0,
                    'message' => IS_ORDER_CANCEL
                ], 200);
            }else{
                //NEW
                if($request->status == IS_DEPARTURE_TO_CUSTOMER && $order->status == $request->status-1){
                    if($customer->fcm_token){
                        $this->fcm->newSend($customer->fcm_token, 'Id Order '.$order->id, 'the driver is heading towards : '.$order->start_address, $order->id);
                    }
                }elseif($request->status == IS_ARRIVAL_AT_CUSTOMER && $order->status == $request->status-1){
                    if($customer->fcm_token){
                        $this->fcm->newSend($customer->fcm_token, 'Id Order '.$order->id, 'the driver is arrived at : '.$order->start_address, $order->id);
                    }
                }elseif($request->status == IS_DEPARTURE_TO_DESTINATION && $order->status == $request->status-1){
                    if($customer->fcm_token){
                        $this->fcm->newSend($customer->fcm_token, 'Id Order '.$order->id, 'on the way to destination : '.$order->end_address, $order->id);
                    }
                }elseif($request->status == IS_ARRIVAL_AT_DESTINATION && $order->status == $request->status-1){
                    if($customer->fcm_token){
                        $this->fcm->newSend($customer->fcm_token, 'Id Order '.$order->id, 'arrived at destination : '.$order->end_address, $order->id);
                    }
                }elseif($request->status == IS_COMPLETE && $order->status == $request->status-1){
                    if($customer->fcm_token){
                        $this->fcm->newSend($customer->fcm_token, 'You have completed your order, Id Order '.$order->id, ' Starting point : ' . $order->start_address . "\r\n \r\n" . 'Destination : ' . $order->end_address, $order->id);
                    }
                }

                $order->update([
                    'status' => $request->status,
                    'driver_id' => $item->id,
                ]);

                return response()->json([
                    'success' => 1,
                    'message' => "Order status updated to : {$request->status}"
                ], 200);
            }
        }
    }

    /**
     * Order history by user
     *
     * @param Request $request
     * @return mixed
     */
    public function userHistory(Request $request)
    {
        $order = Order::where('customer_id', Auth::user()->id)->latest()->get();

        if($order->count() == 0){
            return response()->json([
                'success' => 0,
                'message' => 'record not found'
            ], 200);
        } else {
            $data = array();
            foreach($order as $item){
                $taxi_type = (string)$order->first()->vehicle_category_id;
                $timestamp = ((string)$item->order_time);
                $driver = Driver::find($item->driver_id);
                $category = [];
                $category = VehicleCategory::find($taxi_type);

                array_push($data, array(
                    'id' => (string)$item->id_order,
                    'driver_id' => (string)$item->driver_id,
                    'start_coordinate' => $item->start_coordinate,
                    'end_coordinate' => $item->end_coordinate,
                    'start_address' => $item->start_address,
                    'end_address' => $item->end_address,
                    'distance' => (string)$item->distance,
                    'total' => (string)$item->total,
                    'order_time' => $item->order_time,
                    'status' => $item->status,
                    'time_school' => (string)$item->time_school,
                    'time_after_school' => (string)$item->time_after_school,
                    'payment_method' => (string)$item->payment_method,
                    'taxi_type' => $taxi_type,
                    'timestamp'  => (string) strtotime($timestamp),
                    // price setting
                    'category' => $category
                ));
            }

            return response()->json([
                'success' => 1,
                'history_order' => $data
            ], 200);
        }
    }

    /**
     * Show all driver order history
     *
     * @param Request $request
     * @return mixed
     */
    public function listOrderDriver(Request $request){
        $item = Auth::user();
        $result = Order::whereNull('driver_id')->latest()->get();
        foreach ($result as $value){
            $value->customer = Customer::find($value->customer_id)->name;
        }

        if($result->count() == 0){
            return response()->json([
                'success' => 0,
                'message' => 'record not found'
            ], 404);
        }else{
            return response()->json([
                'success' => 1,
                'message' => $result
            ], 200);
        }
    }

    public function driverHistory(Request $request)
    {
        $driver = Auth::user();
        $order = Order::where('driver_id', $driver->id)->latest()->get();

        if($order->count() == 0){
            return response()->json([
                'success' => 0,
                'message' => 'record not found'
            ], 200);
        } else {
            $data = array();
            foreach($order as $item){
                $customer = Customer::find($item->customer_id);
                $timestamp = ((string)$item->order_time);
                array_push($data, array(
                    'id' => (string)$item->id,
                    'driver_id' => (string)$item->driver_id,
                    'start_coordinate' => $item->start_coordinate,
                    'end_coordinate' => $item->end_coordinate,
                    'start_address' => $item->start_address,
                    'end_address' => $item->end_address,
                    'distance' => (string)$item->distance,
                    'total' => $item->total,
                    'order_time' => $item->order_time,
                    'status' => (string)$item->status,
                    'name' => $customer->name ?? '-',
                    'phone' => $customer->phone ?? '-',
                    'name' => $driver->name ?? '-',
                    'phone' => $driver->phone,
                    'email' => $customer->email ?? '-',
                    'payment_method' => json_decode($item->payment_method),
                    'taxi_type' => json_decode($item->vehicle_category_id),
                    'timestamp' => (string)strtotime($timestamp),
                    'vehicle_category' => VehicleCategory::find($driver->vehicle_category_id) ?? []
                ));
            }

            return response()->json([
                'success' => 1,
                'history_order' => $data
            ], 200);
        }
    }

    /**
     * Show detail order
     *
     * @param Request $request
     * @return Response
     */
    public function show(Request $request)
    {
        if(!is_null($request)){
            $order = Order::find($request->id);

            if(!$order){
                return response()->json([
                    'success' => 0,
                    'message' => 'record not found'
                ], 200);
            } else {
                $result = [
                    'id' => $order->id,
                    'driver_id' => $order->driver_id,
                    'customer_id' => $order->customer_id,
                    'total' => $order->total,
                    'start_coordinate' => (string) $order->start_coordinate,
                    'end_coordinate' => (string) $order->end_coordinate,
                    'start_address' => (string) $order->start_address,
                    'end_address' => (string) $order->end_address,
                    'distance' => (string) $order->distance,
                ];

                return response()->json([
                    'success' => 1,
                    'order' => $result
                ], 200);
            }
        } else {
            return response()->json([
                'success' => 0,
                'message' => 'request cannot be empty'
            ], 200);
        }
    }

    public function checkStatusByUser($id){
        $result = Order::where('customer_id', Auth::user()->id)->where('id', $id)->first();
        if($result){
            return response()->json([
                'status' => json_decode($result->status)
            ], 200);
        }else{
            return response()->json([
                'status' => null
            ], 200);
        }
    }

    public function getOrderStatusDriver(Request $request)
    {
        $driver = Auth::user();

        if(!$driver){
            return response()->json([
                'message' => 'Token is invalid'
            ], 422);
        }

        if($driver->api_token_expired < date('Y-m-d H:i:s')){
            return response()->json([
                'message' => 'Token has expired'
            ], 404);
        }

        $order = Order::find($request->id);

        if($order){
            return response()->json([
                'success' => 1,
                'data' => (string)$order->status
            ], 200);
        }else{
            return response()->json([
                'success' => 0,
                'data' => 'Order Not Found'
            ], 404);
        }
    }

    public function getDistanceAndPushNotif($data)
    {
        $km = 10; //distance radius
        $pickup_location    = explode(',',$data->start_coordinate);
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

            if($distance < $km) {
                $list_driver[] = $driver;
            }
        }

        foreach ($list_driver as $item){
            $this->fcm->newSendOrder(
                $item->fcm_token,
                'New order!',
                'Starting point: ' . $data->start_coordinate . "\r\n \r\n" . 'Destination: ' . $data->end_coordinate,
                $data->id);
        }
    }

    public function getTotalPriceOrder(Request $request)
    {
        $setting = OrderSetting::first();
        $category = VehicleCategory::find($request->vehicle_category_id);

        if(!$category){
            return response()->json([
                'success' => 0,
                'message' => 'Vehicle Category Not Found'
            ], 200);
        }

        if(!$setting){
            return response()->json([
                'success' => 0,
                'message' => 'Order Setting Not Found'
            ], 200);
        }

        $min_m = $category->min_km; //default Meter
        $distance = $category->distance; //default km, distance ini digunakan setelah request distance dari mobile > distance minimal. harga di akumulatif berdasarkan distance ini

        if($request->distance > $min_m){
            $dis_diff = $request->distance - $min_m; //pertama cari selisih distance
            $harga = $category->price_km;
            $x = 1;
            if($dis_diff > $distance){ //lalu selisih distance tersebut di cari kelipatan jaraknya dengan kondisi selisih distance harus lebih besar dari distance
                do {
                    $n = $x++;
                    $dis_multiply = $distance * $n;
                    $price_multiply = $harga * $n;
                } while ($dis_diff > $dis_multiply);
            }else{
                $price_multiply = $harga * $x;
            }
            $grand_total = $price_multiply + $category->min_price; //lalu kelipatan harga tersebut ditambah harga minimal
        }else{
            $grand_total = $category->min_price;
        }

        // jika ada service malam
        if($request->night_service == true){
            $night_service = $category->night_service/100*$grand_total;
            $grand_total = $grand_total+$night_service;
        }

        // jika ada discount
        if($grand_total > $setting->min_discount){
            $grand_total_discount = $setting->discount/100*$grand_total;
            $grand_total = $grand_total-$grand_total_discount;
        }

        $grand_total = ceil($grand_total); //pembulatan

        //membulatkan grand total ke angka 0
        // $grand_total = substr($grand_total, 0, -1) . '0';

        //membulatkan dengan 5 sebagai patokan ke angka 0
        if (substr($grand_total, -1) <= 5)
        {
            $grand_total = substr($grand_total, 0, -1) . 0;
        }else{
            $final = substr($grand_total, 0, -1) . 0;
            $grand_total = $final + 10;
        };

        return response()->json([
            'success' => 1,
            'message' => json_decode($grand_total)
        ], 200);
    }
}
