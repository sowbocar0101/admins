<?php
// ====A+P+P+K+E+Y====
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableVehicleCategories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicle_categories', function (Blueprint $table) {
            $table->id();
            $table->string('category')->nullable();
            $table->integer('price_km')->default(0);
            $table->integer('distance')->default(0);
            $table->integer('min_km')->default(0);
            $table->integer('min_price')->default(0);
            $table->integer('extra_km')->default(0);
            $table->integer('seat')->default(0);
            $table->timestamps();

            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vehicle_categories');
    }
}
