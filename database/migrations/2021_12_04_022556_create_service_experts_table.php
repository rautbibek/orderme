<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceExpertsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_experts', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('slug')->nullable();
            $table->string('image')->nullable();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->string('province')->nullable();
            $table->string('city')->nullable();
            $table->string('ratings')->default(0);
            $table->string('email')->nullable();
            $table->integer('rate')->nullable();
            $table->boolean('available')->nullable();
            $table->boolean('active')->nullable();
            $table->boolean('featured')->nullable();
            $table->boolean('approved')->default(false);
            $table->text('description')->nullable();
            $table->jsonb('config')->nullable();
            $table->dateTime('expires')->nullable();
            $table->text('plan')->nullable();
            $table->foreignId('user_id')->nullable()->constrained('users');
            $table->foreignId('service_id')->constrained('services');

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
        Schema::dropIfExists('service_experts');
    }
}
