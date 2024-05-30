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
        Schema::create('holidays', function (Blueprint $table) {
            $table->increments('id');

        $table->string('name')->nullable();
        $table->timestamps();
    });
        
            
                        
    Holiday::create( [
        'id'=>'1',
        'name'=>'رأس السنة الميلادية'
        ] );
        
        
                    
        Holiday::create( [
        'id'=>'2',
        'name'=>'رأس السنة الأمازيغية'
        ] );
        
        
                    
        Holiday::create( [
        'id'=>'3',
        'name'=>'عيد العمال'
        ] );
        
        
                    
        Holiday::create( [
        'id'=>'4',
        'name'=>'عيد الاستقلال'
        ] );
        
        
                    
        Holiday::create( [
        'id'=>'5',
        'name'=>'أول نوفمبر'
        ] );
        
        
                    
        Holiday::create( [
        'id'=>'6',
        'name'=>'محرم'
        ] );
        
        
                    
        Holiday::create( [
        'id'=>'7',
        'name'=>'عاشوراء'
        ] );
        
        
                    
        Holiday::create( [
        'id'=>'8',
        'name'=>'المولد النبوي الشريف'
        ] );

                 
        Holiday::create( [
            'id'=>'9',
            'name'=>'عيد الفطر'
            ] );
            
            
                        
            Holiday::create( [
            'id'=>'10',
            'name'=>'عيد الأضحى'
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
