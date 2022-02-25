<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArtisttypesTable extends Migration
{
    public function up()
    {
        Schema::create('artisttypes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('descr')->unique();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
