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
            $table->unsignedBigInteger('family_id'); // 01
            $table->unsignedBigInteger('product_id'); // 02
            $table->unsignedBigInteger('ncm_id'); // 03
            $table->string('description'); // 11
            $table->string('manufacturer'); // 04
            $table->string('importer'); // 05
            $table->string('business_name'); // 06
            $table->string('part_number'); // 07
            $table->string('brand'); // 08
            $table->string('model'); // 09
            $table->string('origin', 100); // 10
            $table->string('size'); // 12
            $table->string('formulation'); // 13
            $table->string('application'); // 14
            $table->string('license', 25); // 16
            $table->date('certified_at'); // 15
            $table->timestamps();

            $table->foreign('certificate_id')->references('id')->on('certificates');
            $table->foreign('family_id')->references('id')->on('products');
            $table->foreign('product_id')->references('id')->on('products');
            $table->foreign('ncm_id')->references('id')->on('ncm');
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
