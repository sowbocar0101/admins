<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TinyUploadController;
use App\Http\Controllers\VehicleCategoryController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('/admin/en/login');
});

Route::get('/login', function () {
    return redirect('/admin/en/login');
});

Route::middleware(['auth'])->group(function () {
    Route::post('tiny-image-upload', [TinyUploadController::class, 'uploadImage']);
});

Route::group(['prefix' => 'admin'], function () {

    Route::get('/', function () {
        if (isset($_COOKIE['selected_lang'])) {
            return redirect("/{$_COOKIE['selected_lang']}/dashboard");
        } else {
            return redirect('/jp/dashboard');
        }
    });

    //Handle get image from storage
    Route::get('/storage/image/{directory}/{filename}', function ($directory, $filename) {
        // Add folder path here instead of storing in the database.
        $path = storage_path('app/public/image/' . $directory . '/' . $filename);

        if (!File::exists($path)) {
            abort(404);
        }

        $file = File::get($path);
        $type = File::mimeType($path);

        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);

        return $response;
    });

    Route::group(['prefix' => '{locale}'], function () {
        //Handle swith language
        Route::get('switch={lang}', function ($locale, $lang) {
            try{
                $previous_url = url()->previous();
                $previous_lang = Session::get('selected_lang');
                $new_url = str_replace('/'.$previous_lang.'/', '/'.$lang.'/', $previous_url);

                Session::put('selected_lang', $lang);
                setcookie('selected_lang', $lang, time() + (86400 * 30));
                return redirect($new_url);
            }catch(Exception $e){
                Log::error($e->getMessage());
                Log::error($e->getTraceAsString());

                return redirect(url()->previous());
            }
        });

        Auth::routes();

        Route::middleware(['auth'])->group(function () {
            Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

            Route::resource('admin', AdminController::class);

            Route::get('order', [OrderController::class, 'index'])->name('order.index');
            Route::get('order/{id}', [OrderController::class, 'find']);

            Route::resource('customer', CustomerController::class);

            Route::resource('driver', DriverController::class);
            Route::get('track-driver', [DriverController::class, 'track'])->name('driver.track');
            Route::get('list-track-driver', [DriverController::class, 'getListDriver'])->name('driver.track.list');

            Route::resource('price-setting', VehicleCategoryController::class);
            Route::get('setting', [VehicleCategoryController::class, 'setting'])->name('setting');
            Route::post('setting/update', [VehicleCategoryController::class, 'settingupdate'])->name('setting.update');

            Route::get('profile', [ProfileController::class, 'index'])->name('profile.index');
            Route::post('profile', [ProfileController::class, 'store'])->name('profile.store');

            Route::get('about-us', [AboutUsController::class, 'index'])->name('about-us.index');
            Route::post('about-us/update', [AboutUsController::class, 'update'])->name('about-us.update');

            //Export
            Route::get('export/admin', [AdminController::class, 'export'])->name('admin.export');
            Route::get('export/order', [OrderController::class, 'export'])->name('order.export');
            Route::get('export/driver', [DriverController::class, 'export'])->name('driver.export');
            Route::get('export/customer', [CustomerController::class, 'export'])->name('customer.export');
        });
    });
});

// Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
