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
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('order_id'); 
            $table->integer('user_id')->unsigned();
            $table->string('status', 10);
            $table->string('payment_method', 30)->nullable();
            $table->string('delivery_address', 100)->nullable();
            $table->timestamps();
            
            // Define foreign key
            $table->foreign('user_id')->references('user_id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
