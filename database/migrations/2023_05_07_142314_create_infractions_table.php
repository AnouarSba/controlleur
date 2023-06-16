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
        Schema::create('infractions', function (Blueprint $table) {
                $table->increments('id');

            $table->integer('user_id')->length(2);
            $table->integer('emp_type')->length(1);
            $table->integer('emp_id')->length(2);
            $table->integer('bus_id')->length(2);
            $table->integer('ligne_id')->length(2);
            $table->integer('arret_id')->length(2);
            $table->integer('infra_id')->length(2);
            $table->date('infra_date');
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
        Schema::dropIfExists('infractions');
    }
};