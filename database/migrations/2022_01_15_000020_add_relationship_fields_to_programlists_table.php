<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToProgramlistsTable extends Migration
{
    public function up()
    {
        Schema::table('programlists', function (Blueprint $table) {
            $table->unsignedBigInteger('composition_id')->nullable();
            $table->foreign('composition_id', 'composition_fk_5797779')->references('id')->on('compositions');
        });
    }
}
