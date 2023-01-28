<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
        Schema::create('methodes', function (Blueprint $table) {
            $table->tinyIncrements('id');
            $table->string('slug', 10)->unique();
        });
        DB::table('methodes')->insert(
            [
                ['slug' => 'POST'],
                ['slug' => 'GET'],
                ['slug' => 'PUT'],
                ['slug' => 'PATCH'],
                ['slug' => 'DELETE'],
            ]
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('methodes');
    }
};
