<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsToAutopartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('autoparts', function (Blueprint $table) {
            $table->unsignedBigInteger('traza_id')->after('ncm_id')->nullable();

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
        Schema::table('autoparts', function (Blueprint $table) {
            //
        });
    }
}
