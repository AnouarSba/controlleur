<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Event;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('events', function (Blueprint $table) {
            $table->increments('id');

        $table->string('name')->nullable();
        $table->timestamps();
    });
        
            
                        
    Event::create( [
        'id'=>'1',
        'name'=>'اختتان'
        ] );
        
        
                    
        Event::create( [
        'id'=>'2',
        'name'=>'ازدياد مولود'
        ] );
        
        
                    
        Event::create( [
        'id'=>'3',
        'name'=>'وفاة'
        ] );
        
        
                    
        Event::create( [
        'id'=>'4',
        'name'=>'زواج'
        ] );
        
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('holidays');
        
    }
};
