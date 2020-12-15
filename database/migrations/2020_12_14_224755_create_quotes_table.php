<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuotesTable extends Migration
{
    public function up()
    {
        Schema::create('quotes', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('character_id');
            $table->unsignedBigInteger('episode_id');

            $table->mediumText('quote');

            $table->timestamps();

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
        Schema::dropIfExists('quotes');
    }
}
