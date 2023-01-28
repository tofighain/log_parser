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
        Schema::create('end_points', function (Blueprint $table) {
            $table->id();
            $table->text('uri')->unique();
        });
        DB::table('end_points')->insert(
            [
                ['uri' => '/orders'],
                ['uri' => '/invoices']
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
        Schema::dropIfExists('end_points');
    }
};
