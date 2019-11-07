<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLcmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lcms', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('traza_id')->nullable();
            $table->string('type');
            $table->string('defeats')->nullable();
            $table->string('number');
            $table->string('issued_at')->nullable();
            $table->string('business_name');
            $table->string('address');
            $table->string('cuit');
            $table->string('country');
            $table->string('manufacturing_place')->nullable();
            $table->string('commercial_name');
            $table->string('brand');
            $table->string('model');
            $table->string('category');
            $table->text('version');
            $table->string('cape')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('traza_id')->references('id')->on('trazas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lcms');
    }
}
