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
        Schema::create('demande_events', function (Blueprint $table) {
            $table->id();
            
            $table->integer('emp_id')->length(3)->nullable();
            $table->integer('event_id')->length(2)->nullable();

            $table->date('date')->nullable();
            $table->boolean('valide')->default(0);
            $table->boolean('nbr_jr')->nullable()->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('demand_events');
    }
};
