<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('moves', function (Blueprint $table) {
                $table->increments('id');

            $table->integer('user_id')->length(2);
            $table->integer('bus_id')->length(2);
            $table->integer('ligne_id')->length(2);
            $table->integer('station_id')->length(2)->nullable();
            $table->integer('service')->length(1);
            $table->integer('status')->length(1);
            $table->integer('gstatus')->length(1);
            $table->integer('chauffeur_id')->length(2)->nullable();
            $table->integer('kabid_id')->length(2)->nullable();
            $table->timestamp('timing')->nullable(); 


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('moves');
    }
};