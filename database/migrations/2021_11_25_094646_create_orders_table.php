<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
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
            $table->string('uuid');
            $table->string('state')->nullable();
            $table->string('payment_state')->nullable();
            $table->string('shipping_state')->nullable();
            $table->string('checkout_state')->nullable();
            $table->integer('items_total')->default(0);
            $table->integer('total')->default(0);
            $table->integer('adjustment_total')->default(0);
            $table->foreignId('user_id')->nullable()->constrained("users")->cascadeOnUpdate()->nullOnDelete();
            $table->foreignId('customer_address_id')->nullable()->constrained("customer_addresses")->cascadeOnUpdate()->nullOnDelete();
            $table->timestamps();
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
