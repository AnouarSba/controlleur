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
        Schema::create('admin_pointages', function (Blueprint $table) {
            $table->id();
            $table->integer('emp_id')->length(3)->nullable();
           // $table->integer('is_')->nullable()->default(0); //1:admin - 2:control - 3:csp - 4:cs - 5:maint - 6:administration - 7:receveurs - 8:chauffeurs
            $table->integer('emp_status_id')->length(2)->nullable();

            $table->date('date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin_pointages');
    }
};
