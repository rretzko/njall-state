<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConductorsTable extends Migration
{
    public function up()
    {
        Schema::create('conductors', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->unique();
            $table->string('first',60);
            $table->string('last',60);
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
