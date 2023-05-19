<?php
// ====A+P+P+K+E+Y====
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderSetting extends Model
{
    protected $table = 'order_settings';

    protected $fillable = [
        'discount',
        'min_discount',
        'night_service'
    ];
}
