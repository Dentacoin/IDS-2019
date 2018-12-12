<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserExpressionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_expressions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('job');
            $table->string('location');
            $table->text('text');
            $table->unsignedInteger('media_id')->nullable();
            $table->integer('order_id');
            $table->tinyInteger('featured')->default('0');
            $table->tinyInteger('desktop_visible')->default('1');
            $table->tinyInteger('mobile_visible');
            $table->timestamps();
        });

        Schema::table('user_expressions', function (Blueprint $table) {
            $table->foreign('media_id')->references('id')->on('media')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_expressions');
    }
}
