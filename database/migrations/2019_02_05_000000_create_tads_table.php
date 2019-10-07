<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tads', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('certificate_id')->nullable();
            $table->string('name');
            $table->string('code');
            $table->string('user');
            $table->string('division');
            $table->string('sector');
            $table->string('tag');
            $table->boolean('paid');
            $table->string('validation');
            $table->boolean('signature');
            $table->string('auth_level');
            $table->json('autoparts');
            $table->json('documents');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('certificate_id')->references('id')->on('certificates');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tads');
    }
}
