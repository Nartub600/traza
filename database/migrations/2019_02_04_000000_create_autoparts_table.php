<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAutopartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('autoparts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('certificate_id')->nullable();
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('ncm_id');
            $table->unsignedBigInteger('traza_id')->nullable();
            $table->string('description');
            $table->string('manufacturer');
            $table->string('importer')->nullable();
            $table->string('business_name');
            $table->string('part_number')->nullable();
            $table->string('brand');
            $table->string('model');
            $table->string('origin', 100);
            $table->string('size');
            $table->string('formulation')->nullable();
            $table->string('application')->nullable();
            $table->string('license', 25)->nullable();
            $table->date('certified_at')->nullable();
            $table->string('chas')->nullable();
            $table->json('pictures');
            $table->timestamps();

            $table->foreign('certificate_id')->references('id')->on('certificates');
            $table->foreign('product_id')->references('id')->on('products');
            $table->foreign('ncm_id')->references('id')->on('ncm');
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
        Schema::dropIfExists('autoparts');
    }
}
