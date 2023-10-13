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
        Schema::create('coffres', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->length(2);
            $table->integer('emp_id')->length(2);
            $table->integer('ligne_id')->length(2);
            $table->integer('t20')->length(3)->default(0);
            $table->integer('t25')->length(3)->default(0);
            $table->integer('t30')->length(3)->default(0);
            $table->float('money', 8,2)->default(0);
            $table->float('ts', 8,2)->default(0);
            $table->float('caisse', 8,2)->default(0);
            $table->time('time');
            $table->date('c_date');
            $table->text('rq');
            $table->text('quest')->nullable();

             $table->integer('inf')->length(1);
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
        Schema::dropIfExists('coffres');
    }
};