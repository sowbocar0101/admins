<?php

use App\Http\Controllers\Api\AboutUsController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\DriverController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\OtherController;
use App\Http\Controllers\Api\ProfileDriverController;
use App\Http\Controllers\Api\ProfileUserController;
use App\Http\Controllers\Api\TestingController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::group(['prefix' => 'webservice', 'namespace' => 'Api'], function(){

    Route::post('login', [AuthController::class, 'login']);
    Route::post('logindriver', [AuthController::class, 'loginDriver']);
    Route::post('user_register', [AuthController::class, 'register']);
    Route::post('driver_register', [AuthController::class, 'registerDriver']);
    Route::post('reset-password-user', [AuthController::class, 'resetPassword']);
    Route::post('reset-password-driver', [AuthController::class, 'resetPassword']);

    Route::group(['middleware' => ['assign.guard:customer', 'jwt.verify']], function () {
        Route::post('send_order', [OrderController::class, 'store']);
        Route::post('updateStatus', [OrderController::class, 'update']);

        Route::get('user_profile', [AuthController::class, 'userProfile']);
        Route::get('driver-profile', [AuthController::class, 'getDriverProfile']);
        Route::post('edit_profile_user', [AuthController::class, 'updateProfile']);
        Route::post('update-email-user', [ProfileUserController::class, 'updateEmail']);
        Route::post('update-password-user', [AuthController::class, 'updatePassword']);

        Route::get('history_order_user', [OrderController::class, 'userHistory']);
        Route::get('order', [OrderController::class, 'index']);
        Route::get('order-status-user/{id}', [OrderController::class, 'checkStatusByUser']);

        Route::get('driver_location', [DriverController::class, 'location']);
        Route::get('price-check', [DriverController::class, 'priceCheck']);
        Route::get('getAllDriverLocation', [DriverController::class, 'indexLocation']);

        // Route::get('getOnlineStatus/{id}', 'OtherController@onlineStatus');
    });

    Route::group(['prefix' => 'driver', 'middleware' => ['assign.guard:driver', 'jwt.verify']], function(){
        Route::get('profile', [AuthController::class, 'driverProfile']);
        Route::get('list-order', [OrderController::class, 'listOrderDriver']);
        Route::get('order-status', [OrderController::class, 'getOrderStatusDriver']);
        Route::get('customer-by-id', [DriverController::class, 'getCustomerById']);
        Route::get('order', [OrderController::class, 'driverHistory']);

        Route::post('update-coordinate', [ProfileDriverController::class, 'updateCoordinate']);
        Route::post('update-profile', [AuthController::class, 'updateDriverProfile']);
        Route::post('update-status', [OrderController::class, 'updateDriver']);
        Route::post('update-email', [ProfileDriverController::class, 'updateEmail']);
        Route::post('set-status', [DriverController::class, 'setStatus']);
        Route::post('update-password', [ProfileDriverController::class, 'updatePassword']);

        Route::get('getOnlineStatus', [OtherController::class, 'onlineStatus']);
    });

    Route::get('total-price-order', [OrderController::class, 'getTotalPriceOrder']);
    Route::get('getOrder', [OrderController::class, 'show']);
    Route::get('priceCategory', [OtherController::class, 'priceCategory']);
    Route::get('currency', [OtherController::class, 'currency']);
    Route::get('about-us', [AboutUsController::class, 'index']);
    Route::get('distance/{pickup}', [OrderController::class, 'getDistanceAndPushNotif']);
});

Route::get('testing', [TestingController::class, 'index']);

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
