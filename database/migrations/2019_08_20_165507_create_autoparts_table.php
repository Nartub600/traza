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
            $table->unsignedInteger('certificate_id')->nullable();
            $table->unsignedInteger('product_id');
            $table->string('name');
            $table->string('description');
            $table->string('brand');
            $table->string('model');
            $table->string('origin');
            $table->json('pictures')->nullable();
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
        Schema::dropIfExists('autoparts');
    }
}
