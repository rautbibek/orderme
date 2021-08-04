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
            $table->integer('admin_id')->unsigned();
            $table->foreign('admin_id')->references('id')->on('admins');
            $table->bigInteger('category_id')->unsigned()->nullable();
            $table->foreign('category_id')->references('id')->on('categories');
            $table->integer('product_type_id')->unsigned()->nullable();
            $table->foreign('product_type_id')->references('id')->on('product_types');
            $table->text('short_description');
            $table->text('description');
            $table->boolean('cart_system');
            $table->boolean('inventory_track')->default(false);
            $table->jsonb('config')->nullable();
            $table->jsonb('options')->nullable();
            $table->jsonb('image')->nullable();
            $table->boolean('active')->default(false);
            $table->boolean('featured')->default(false);
            $table->boolean('out_of_stock')->default(false);
            $table->text('meta_tag_title')->nullable();
            $table->text('meta_tag_description')->nullable();
            $table->string('meta_tag_keyword')->nullable();

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
