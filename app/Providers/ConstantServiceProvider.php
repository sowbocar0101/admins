<?php
// ====A+P+P+K+E+Y====
namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ConstantServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        require_once app_path().'/Helpers/Constant.php';
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
