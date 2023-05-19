<?php
// ====A+P+P+K+E+Y====
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutUs extends Model
{
    protected $table = 'abouts';
    protected $fillable = [
        'text',
        'image'
    ];
}
