<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsToLcmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lcms', function (Blueprint $table) {
            $table->unsignedBigInteger('traza_id')->after('user_id')->nullable();
            $table->string('cape')->nullable()->after('version');

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
        Schema::table('lcms', function (Blueprint $table) {
            //
        });
    }
}
