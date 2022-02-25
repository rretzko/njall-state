<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArtistArtisttypePivotTable extends Migration
{
    public function up()
    {
        Schema::create('artist_artisttype', function (Blueprint $table) {
            $table->unsignedBigInteger('artist_id');
            $table->foreign('artist_id', 'artist_id_fk_5797623')->references('id')->on('artists')->onDelete('cascade');
            $table->unsignedBigInteger('artisttype_id');
            $table->foreign('artisttype_id', 'artisttype_id_fk_5797623')->references('id')->on('artisttypes')->onDelete('cascade');
        });
    }
}
