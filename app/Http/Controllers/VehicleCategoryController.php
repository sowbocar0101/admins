<?php
// ====A+P+P+K+E+Y====
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VehicleCategory;
use App\Models\Order;
use App\Models\OrderSetting;
use Illuminate\Support\Facades\Log;

class VehicleCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->type == 'datatable'){
            $data = VehicleCategory::all();

            return datatables()->of($data)
                ->addColumn('action', function ($data) {
                    return '<a href="#" data-url="'.route('price-setting.update', $data->id).'" class="btn new-btn-edit edit-action" onclick="showEdit()">'.trans('default.action.edit').'</a>';
                            // <a href="#" data-url="'.route('price-setting.destroy', $data->id).'" class="btn new-btn-delete delete-action">'.trans('default.action.delete').'</a>';
                })
                ->addColumn('name', function ($data) {
                    return $data->category;
                })
                ->addColumn('min', function ($data) {
                    if(substr($data->min_km,-2) == '00'){
                        return ceil($data->min_km)." meter";
                    }
                    return $data->min_km." meter";
                    // return $data->min_km."m";
                })
                ->addColumn('min-price', function ($data) {
                    return CURRENCY.number_format($data->min_price);
                })
                ->addColumn('extra_km', function ($data) {
                    return $data->extra_km."km";
                    // return $data->extra_km."m";
                })
                ->addColumn('price', function ($data) {
                    return CURRENCY.number_format($data->price_km);
                })
                ->addColumn('seat', function ($data) {
                    return $data->seat;
                })
                ->addColumn('distance', function ($data) {
                    if(substr($data->distance,-2) == '00'){
                        return ceil($data->distance)." meter";
                    }
                    return $data->distance." meter";
                    // return $data->min_km."m";
                })
                ->rawColumns(['action', 'harga_tambahan', 'name', 'price', 'min', 'min-price', 'seat', 'distance'])
                ->make(true);
        }

        return view('pages.price-setting.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            // VehicleCategory::create([
            //     'category' => $request->name,
            //     'price_km' => $request->price,
            //     'distance' => $request->distance,
            //     'min_km' => $request->min,
            //     'min_price' => $request->min_price,
            //     'seat' => $request->seat,
            // ]);

            return response()
                ->json([
                    'error' => false,
                    'message' => trans('default.alert.success.create')
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
        $data = VehicleCategory::find($id);

        if(!$data){
            return response()->json([
                'error' => true,
                'message' => 'Data tidak ditemukan'
            ]);
        }

        return response()->json([
            'id' => $data->id,
            'name' => $data->category,
            'price' => $data->price_km,
            'distance' => $data->distance,
            'min' => $data->min_km,
            'min_price' => $data->min_price,
            'seat' => $data->seat,
            'extra_km' => $data->extra_km
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
        try {
            VehicleCategory::where('id', $id)->update([
                'category' => $request->name,
                'price_km' => $request->price,
                'distance' => $request->distance,
                'min_km' => $request->min,
                'min_price' => $request->min_price,
                'seat' => $request->seat,
                'extra_km' => $request->extra_km
            ]);

            return response()
                ->json([
                    'error' => false,
                    'message' => trans('default.alert.success.update')
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($lang, $id)
    {
        try {
            // if(Order::where('vehicle_category_id', $id)->count() > 0){
            //     return response()
            //         ->json([
            //             'error' => false,
            //             'message' => trans('default.alert.failed.data-usage')
            //         ]);
            // } else {
            //     VehicleCategory::where('id', $id)->delete();
            // }

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

    public function setting()
    {
        $data = OrderSetting::first();
        return response()->json($data, 200);
    }

    public function settingUpdate(Request $request)
    {
        try{
            $data = [
                'discount' => $request->discount,
                'min_discount' => $request->min_discount,
                'night_service' => $request->night_service,
            ];

            if(OrderSetting::count() < 1){
                OrderSetting::create($data);
            }else{
                $order_setting = OrderSetting::first();
                $order_setting->update($data);
            }
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
}
