<?php
// ====A+P+P+K+E+Y====
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Exports\OrderExport;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    /**
     * Show all order data
     *
     * @param Request $request
     * @return mixed
     */
    public function index(Request $request)
    {
        if(request()->type == 'datatable'){
            $data = Order::with(['driver', 'customer'])->latest()->get();
            return datatables()->of($data)
                ->addColumn('user', function($data){
                    return $data->customer != null ? $data->customer->name : '-';
                })
                ->addColumn('from', function($data){
                    return $data->start_address;
                })
                ->addColumn('destination', function($data){
                    return $data->end_address;
                })
                ->addColumn('distance', function($data){
                    return substr($data->distance,0,3)."km";
                })
                ->addColumn('total', function($data){
                    return CURRENCY.number_format($data->total);
                })
                ->addColumn('date', function($data){
                    if(Lang::locale() == 'jp'){
                        return date('Y年 m月d日', strtotime($data->order_time));
                    }else{
                        return $data->order_time;
                    }
                })
                ->addColumn('detail', function($data){
                    return '<button class="btn new-btn-edit" onclick="detailOrder('."'".$data->id."'".')">'.Lang::get('default.new.button.detail').'</button>';
                })
                ->rawColumns(['action', 'name', 'username', 'status', 'detail'])
                ->make(true);
        }
        $currency = CURRENCY;
        return view('pages.order.index', compact('currency'));
    }

    public function find($lang, $id)
    {
        $data = Order::where('id', $id)->with(['driver', 'customer'])->first();
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
        $data = Order::orderBy('order_time', 'DESC')->paginate(100);
        view()->share('data', $data);
        return view('pages.order.print');
    }
}
