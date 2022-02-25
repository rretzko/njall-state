<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProgramlistsTable extends Migration
{
    public function up()
    {
        Schema::create('programlists', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('order_by');
            $table->boolean('opener')->default(0);
            $table->boolean('closer')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
