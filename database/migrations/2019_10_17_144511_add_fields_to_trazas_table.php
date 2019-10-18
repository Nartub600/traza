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
            $table->string('type')->after('certificate_id');
            $table->string('user')->after('type');
            $table->string('division')->after('user');
            $table->string('sector')->after('division');
            $table->string('tag')->after('sector');
            $table->string('validation')->after('tag');
            $table->boolean('signature')->after('validation');
            $table->string('auth_level')->after('signature');
            $table->json('files')->after('auth_level');
            $table->string('uuid')->after('files');

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
