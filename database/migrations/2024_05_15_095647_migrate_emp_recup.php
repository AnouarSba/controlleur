<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Holiday;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('emp_recups', function (Blueprint $table) {
            $table->id();

        $table->date('date');
        $table->integer('holiday_id')->length(2)->nullable();
        $table->integer('event_id')->length(2)->nullable();
        $table->integer('emp_status_id')->length(2)->nullable();
        $table->boolean('sign')->nullable();
        $table->integer('emp_id')->length(2)->nullable();

        $table->timestamps();
    });
        
    }
            
    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('emp_recups');
        
    }
};
