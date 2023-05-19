<?php
// ====A+P+P+K+E+Y====
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Driver extends Authenticatable implements JWTSubject
{
    use SoftDeletes;
    protected $table = 'drivers';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'status',
        'order_status',
        'vehicle_category_id',
        'plate_number',
        'car_model',
        'firebase_uid',
        'fcm_token',
        'api_token',
        'api_token_expired',
        'position',
        'bearing',
        'image',
    ];

    protected $casts = [
        'order_status' => 'string'
    ];

    protected $hidden = [
        'password','api_token','api_token_expired'
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function vehicle_categorie()
    {
        return $this->belongsTo('App\Models\VehicleCategory', 'vehicle_category_id');
    }
}
