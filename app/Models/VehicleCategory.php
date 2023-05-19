<?php
// ====A+P+P+K+E+Y====
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VehicleCategory extends Model
{
    use SoftDeletes;
    protected $table = 'vehicle_categories';

    protected $fillable = [
        'category',
        'price_km',
        'distance',
        'min_km',
        'min_price',
        'extra_km',
        'seat',
    ];
}
