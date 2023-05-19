<?php
// ====A+P+P+K+E+Y====
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableOrders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('driver_id')->nullable();
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('vehicle_category_id');
            $table->string('start_coordinate')->nullable();
            $table->string('end_coordinate')->nullable();
            $table->string('start_address')->nullable();
            $table->string('end_address')->nullable();
            $table->float('distance')->default(0);
            $table->boolean('one_way')->default(0);
            $table->dateTime('order_time')->nullable();
            $table->boolean('payment_method')->default(0);
            $table->boolean('status')->default(0);
            $table->float('total')->default(0);
            $table->timestamps();

            $table->foreign('driver_id')->references('id')->on('drivers');
            $table->foreign('customer_id')->references('id')->on('customers');
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
        Schema::dropIfExists('orders');
    }
}
