<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activities', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->text('description');
            $table->float('lat')->default(0);
            $table->float('lng')->default(0);
            $table->date('start');
            $table->string('status')->default('on going');
            $table->unsignedInteger('budget');
            $table->string('image');
            $table->unsignedBigInteger('concern')->default(0);
            $table->unsignedBigInteger('sponsor_id');
            $table->timestamps();

            $table->index('sponsor_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('activities');
    }
}
