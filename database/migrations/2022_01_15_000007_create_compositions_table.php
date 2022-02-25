<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompositionsTable extends Migration
{
    public function up()
    {
        Schema::create('compositions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('subtitle')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
