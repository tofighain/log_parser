<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedTinyInteger('service_id');
            $table->unsignedTinyInteger('method_id');
            $table->unsignedBigInteger('end_point_id');
            $table->unsignedTinyInteger('protocol_id');
            $table->dateTime('output_date_time');
            $table->unsignedSmallInteger('status_code');
            $table->timestamps();

            $table->foreign('service_id')->references('id')->on('services')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('method_id')->references('id')->on('methodes')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('end_point_id')->references('id')->on('end_points')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('protocol_id')->references('id')->on('protocols')->onUpdate('cascade')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('logs');
    }
};
