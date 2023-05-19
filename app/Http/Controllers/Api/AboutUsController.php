<?php
// ====A+P+P+K+E+Y====
namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AboutUs;

class AboutUsController extends Controller
{
    public function index()
    {
        return response()->json([
            'success' => 1,
            'message' => AboutUs::first(['text'])
        ], 200);
    }
}
