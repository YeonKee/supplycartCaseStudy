<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('order__products', function (Blueprint $table) {
            $table->increments('order_prod_id');
            $table->integer('order_id')->unsigned();
            $table->integer('prod_id')->unsigned();
            $table->integer('quantity');
            $table->double('total_price', 10, 2);
            $table->timestamps();

            // Define foreign key
            $table->foreign('order_id')->references('order_id')->on('orders');
            $table->foreign('prod_id')->references('prod_id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order__products');
    }
};
