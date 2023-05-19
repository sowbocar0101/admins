<?php
// ====A+P+P+K+E+Y====
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';

    protected $fillable = [
        'driver_id',
        'customer_id',
        'vehicle_category_id',
        'start_coordinate',
        'end_coordinate',
        'start_address',
        'end_address',
        'distance',
        'one_way',
        'order_time',
        'payment_method',
        'status',
        'total',
    ];

    public function driver()
    {
        return $this->belongsTo('App\Models\Driver', 'driver_id')->withTrashed();
    }

    public function customer()
    {
        return $this->belongsTo('App\Models\Customer', 'customer_id')->withTrashed();
    }
}
