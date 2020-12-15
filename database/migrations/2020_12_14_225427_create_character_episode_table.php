<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCharacterEpisodeTable extends Migration
{
    public function up()
    {
        Schema::create('character_episode', function (Blueprint $table) {
            $table->unsignedBigInteger('character_id');
            $table->unsignedBigInteger('episode_id');

            $table->primary(['character_id', 'episode_id']);

            $table->foreign('character_id')
                ->on('characters')
                ->references('id');

            $table->foreign('episode_id')
                ->on('episodes')
                ->references('id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('character_episode');
    }
}
