<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->bigInteger('category_id')->unsigned()->nullable();
            $table->foreign('category_id')->references('id')->on('categories');
            $table->integer('product_type_id')->unsigned()->nullable();
            $table->foreign('product_type_id')->references('id')->on('product_types');
            $table->string('short_description');
            $table->string('description');
            $table->boolean('cart_system');
            $table->boolean('inventory_track');
            $table->jsonb('features')->nullable();
            $table->jsonb('options')->nullable();
            $table->jsonb('image')->nullable();
            
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
        Schema::dropIfExists('products');
    }
}
