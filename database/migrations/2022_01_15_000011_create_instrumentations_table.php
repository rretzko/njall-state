<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstrumentationsTable extends Migration
{
    public function up()
    {
        Schema::create('instrumentations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('descr');
            $table->string('abbr');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
