<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPointsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->integer('point_value')->default(25);
            $table->integer('hold_point')->default(0);
            $table->string('reference')->nullable();
            $table->boolean('approved_buyer')->default(false);
            $table->string('phone_number')->nullable();
            $table->foreignId('reference_id')->nullable()->constrained('users');
            $table->boolean('confirmed')->default('false');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}
