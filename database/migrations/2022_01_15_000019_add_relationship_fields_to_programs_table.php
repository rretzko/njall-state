<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToProgramsTable extends Migration
{
    public function up()
    {
        Schema::table('programs', function (Blueprint $table) {
            $table->unsignedBigInteger('event_id')->nullable();
            $table->foreign('event_id', 'event_fk_5797774')->references('id')->on('events');
        });
    }
}
