<?php
// ====A+P+P+K+E+Y====
namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Concerns\InteractsWithInput;

class TestingController extends Controller
{
    public function index()
    {
        $token = Str::random(60);
        return response()->json([
            'token' => hash('sha256', $token),
        ]);
    }

    public function result()
    {

    }
}
