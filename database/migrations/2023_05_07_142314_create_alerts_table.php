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
        Schema::create('alerts', function (Blueprint $table) {
                $table->increments('id');

            $table->integer('user_id')->length(2);
            $table->integer('alert_type')->length(1);
            $table->integer('bus_id')->length(2)->nullable();
            $table->integer('ligne_id')->length(2)->nullable();
            $table->integer('arret_id')->length(2)->nullable();
            $table->text('alert');
            $table->date('alert_date');
            $table->integer('status');
            $table->text('proces');
            
            $table->string('lat')->nullable();
            $table->string('lang')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alerts');
    }
};