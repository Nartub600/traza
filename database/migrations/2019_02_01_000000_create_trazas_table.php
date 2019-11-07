<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrazasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trazas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('number');
            $table->string('type');
            $table->string('user');
            $table->string('division');
            $table->string('sector');
            $table->string('tag');
            $table->string('validation');
            $table->boolean('signature');
            $table->string('auth_level');
            $table->json('files');
            $table->string('uuid');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trazas');
    }
}
