<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStreamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('streams', function (Blueprint $table) {
            $table->increments('stream_id');
            $table->integer('twitch_stream_id');
            $table->char('channel_id', 50);
            $table->string('game', 255);
            $table->string('service', 255)->default('twitch');
            $table->integer('viewer_count')->default(0);
            $table->boolean('is_current')->default(0);
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
        Schema::dropIfExists('streams');
    }
}
