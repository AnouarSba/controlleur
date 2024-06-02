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
        Schema::create('emp_in_holidays', function (Blueprint $table) {
            $table->increments('id');

        $table->date('date');
        $table->json('emps')->nullable();
        $table->foreignId('holiday_id')->references('id')->on('holidays');
            
        $table->timestamps();
    });
        
    }
            
    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('emp_in_holidays');
        
    }
};
