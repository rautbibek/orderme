<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cart_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained("users")->cascadeOnUpdate()->nullOnDelete();
            $table->foreignId('order_id')->nullable()->constrained("orders")->cascadeOnUpdate()->nullOnDelete();
            $table->foreignId('variant_id')->nullable()->constrained("variants")->cascadeOnUpdate()->nullOnDelete();
            $table->integer('quantity');
            $table->integer('unit_price');
            $table->integer('unit_total');
            $table->integer('adjustment_total')->default(0);
            $table->integer('total');
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
        Schema::dropIfExists('cart_items');
    }
}
