<?php
// ====A+P+P+K+E+Y====
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Driver;
use App\Models\Order;
use App\Models\VehicleCategory;

class DashboardController extends Controller
{
    /**
     * Show Dashboard
     *
     * @return mixed
     */
    public function index()
    {
        $user = User::count();
        $driver = Driver::count();
        $typeTaxi = VehicleCategory::count();
        $order = Order::with(['driver', 'customer'])->latest()->take(5)->get();

        return view('pages.dashboard.index', [
            'driver' => $driver,
            'user' => $user,
            'category' => 2,
            'order' => $order,
            'typeTaxi' => $typeTaxi
        ]);
    }
}
