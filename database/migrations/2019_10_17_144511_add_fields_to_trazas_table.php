<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsToTrazasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('trazas', function (Blueprint $table) {
            $table->unsignedBigInteger('certificate_id')->nullable()->after('number');
            $table->string('type')->after('certificate_id')->nullable();
            $table->string('user')->after('type')->nullable();
            $table->string('division')->after('user')->nullable();
            $table->string('sector')->after('division')->nullable();
            $table->string('tag')->after('sector')->nullable();
            $table->string('validation')->after('tag')->nullable();
            $table->boolean('signature')->after('validation')->nullable();
            $table->string('auth_level')->after('signature')->nullable();
            $table->json('files')->after('auth_level')->nullable();
            $table->string('uuid')->after('files')->nullable();

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
        Schema::table('trazas', function (Blueprint $table) {
            //
        });
    }
}
