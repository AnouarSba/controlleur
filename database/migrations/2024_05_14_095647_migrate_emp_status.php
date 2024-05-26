<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Emp_status;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('emp_statuses', function (Blueprint $table) {
            $table->increments('id');

        $table->string('name')->nullable();
        $table->timestamps();
    });
        
            
                        
    Emp_status::create( [
        'id'=>'1',
        'name'=>'R'
        ] );
        
        
                    
        Emp_status::create( [
        'id'=>'2',
        'name'=>'A'
        ] );
        
        
                    
        Emp_status::create( [
        'id'=>'3',
        'name'=>'MP'
        ] );
        
        
                    
        Emp_status::create( [
        'id'=>'4',
        'name'=>'CM'
        ] );
        
        
                    
        Emp_status::create( [
        'id'=>'',
        'name'=>'CG'
        ] );
        
        
                    
        Emp_status::create( [
        'id'=>'6',
        'name'=>'DC'
        ] );
        
        
                    
        Emp_status::create( [
        'id'=>'7',
        'name'=>'S.S'
        ] );
        
        
                    
        Emp_status::create( [
        'id'=>'8',
        'name'=>'P'
        ] );

                 
        Emp_status::create( [
            'id'=>'9',
            'name'=>'RJ'
            ] );
            
            
                        
            Emp_status::create( [
            'id'=>'10',
            'name'=>'SHM'
            ] );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
        
    }
};
