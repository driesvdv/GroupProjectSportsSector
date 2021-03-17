<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSportSessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sport_sessions', function (Blueprint $table) {
            $table->id();
            $table->datetime('start_time');
            $table->datetime('end_time');
            $table->foreignId('group_id')->constrained();
            $table->foreignId('absent_session_id')->constrained();
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
        Schema::dropIfExists('sport_sessions');
    }
}
