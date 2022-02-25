<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToParticipantsTable extends Migration
{
    public function up()
    {
        Schema::table('participants', function (Blueprint $table) {
            $table->unsignedBigInteger('instrumentation_id')->nullable();
            $table->foreign('instrumentation_id', 'instrumentation_fk_5797699')->references('id')->on('instrumentations');
            $table->unsignedBigInteger('school_id')->nullable();
            $table->foreign('school_id', 'school_fk_5797700')->references('id')->on('schools');
        });
    }
}
