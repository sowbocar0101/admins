<?php
// ====A+P+P+K+E+Y====
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableDrivers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('drivers', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone', 20)->nullable();
            $table->string('password');
            $table->boolean('status')->default(0);
            $table->boolean('order_status')->default(0);
            $table->unsignedBigInteger('vehicle_category_id')->constrained('vehicle_categories');
            $table->string('plate_number', 10)->default(0);
            $table->string('car_model')->nullable();
            $table->string('firebase_uid')->nullable();
            $table->string('fcm_token')->nullable();
            $table->text('api_token')->nullable();
            $table->dateTime('api_token_expired')->nullable();
            $table->string('position')->nullable();
            $table->string('bearing')->nullable();
            $table->string('image')->nullable();
            $table->timestamps();

            $table->softDeletes();

            $table->foreign('vehicle_category_id')->references('id')->on('vehicle_categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('drivers');
    }
}
