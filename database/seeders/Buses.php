<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Bus;

class Buses extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Bus::create( [
            'id'=>1,
            'name'=>'A01',
            'type'=>'bus',
            'status'=>'ca marche',
            'imei'=>NULL,
            'ligne_id'=>9,
            'deleted_at'=>NULL,
            'created_at'=>'2022-10-15 21:14:25',
            'updated_at'=>'2023-03-05 05:58:45'
            ] );
                        
            Bus::create( [
            'id'=>2,
            'name'=>'A02',
            'type'=>'bus',
            'status'=>'ca marche',
            'imei'=>'',
            'ligne_id'=>10,
            'deleted_at'=>NULL,
            'created_at'=>'2022-10-15 21:14:36',
            'updated_at'=>'2023-03-05 05:59:06'
            ] );
                        
            Bus::create( [
            'id'=>3,
            'name'=>'A03',
            'type'=>'bus',
            'status'=>'ca marche',
            'imei'=>'',
            'ligne_id'=>4,
            'deleted_at'=>NULL,
            'created_at'=>'2022-10-15 21:14:46',
            'updated_at'=>'2023-03-05 05:59:16'
            ] );
                        
            Bus::create( [
            'id'=>4,
            'name'=>'A04',
            'type'=>'bus',
            'status'=>'ca marche',
            'imei'=>'',
            'ligne_id'=>6,
            'deleted_at'=>NULL,
            'created_at'=>'2022-10-15 21:14:54',
            'updated_at'=>'2023-03-05 05:59:32'
            ] );
                        
            Bus::create( [
            'id'=>5,
            'name'=>'A05',
            'type'=>'bus',
            'status'=>'ca marche',
            'imei'=>'',
            'ligne_id'=>4,
            'deleted_at'=>NULL,
            'created_at'=>'2022-10-15 21:14:59',
            'updated_at'=>'2023-03-07 07:31:41'
            ] );
                        
            Bus::create( [
            'id'=>6,
            'name'=>'A06',
            'type'=>'bus',
            'status'=>'ca marche',
            'imei'=>'',
            'ligne_id'=>3,
            'deleted_at'=>NULL,
            'created_at'=>'2022-10-15 21:15:06',
            'updated_at'=>'2023-03-05 05:59:55'
            ] );
                        
            Bus::create( [
            'id'=>7,
            'name'=>'A07',
            'type'=>'bus',
            'status'=>'ca marche',
            'imei'=>'',
            'ligne_id'=>4,
            'deleted_at'=>NULL,
            'created_at'=>'2022-10-15 21:15:12',
            'updated_at'=>'2023-03-05 12:08:21'
            ] );
                        
            Bus::create( [
            'id'=>8,
            'name'=>'A08',
            'type'=>'bus',
            'status'=>'ca marche',
            'imei'=>'',
            'ligne_id'=>5,
            'deleted_at'=>NULL,
            'created_at'=>'2022-10-15 21:15:19',
            'updated_at'=>'2023-03-05 06:00:32'
            ] );
                        
            Bus::create( [
            'id'=>9,
            'name'=>'A09',
            'type'=>'bus',
            'status'=>'ca marche',
            'imei'=>'',
            'ligne_id'=>6,
            'deleted_at'=>NULL,
            'created_at'=>'2022-10-15 21:15:26',
            'updated_at'=>'2023-03-05 06:00:41'
            ] );
                        
            Bus::create( [
            'id'=>10,
            'name'=>'A10',
            'type'=>'bus',
            'status'=>'ca marche',
            'imei'=>'',
            'ligne_id'=>6,
            'deleted_at'=>NULL,
            'created_at'=>'2022-10-15 21:15:34',
            'updated_at'=>'2023-03-07 07:29:53'
            ] );
                        
            Bus::create( [
            'id'=>11,
            'name'=>'A11',
            'type'=>'bus',
            'status'=>'ca marche',
            'imei'=>'',
            'ligne_id'=>6,
            'deleted_at'=>NULL,
            'created_at'=>'2022-10-15 21:15:40',
            'updated_at'=>'2023-03-05 06:01:07'
            ] );
                        
            Bus::create( [
            'id'=>12,
            'name'=>'A12',
            'type'=>'bus',
            'status'=>'ca marche',
            'imei'=>'',
            'ligne_id'=>7,
            'deleted_at'=>NULL,
            'created_at'=>'2022-10-15 21:15:47',
            'updated_at'=>'2023-03-07 07:30:23'
            ] );
                        
            Bus::create( [
            'id'=>13,
            'name'=>'A13',
            'type'=>'bus',
            'status'=>'ca marche',
            'imei'=>'',
            'ligne_id'=>5,
            'deleted_at'=>NULL,
            'created_at'=>'2022-10-15 21:15:54',
            'updated_at'=>'2023-03-05 06:01:23'
            ] );
                        
            Bus::create( [
            'id'=>14,
            'name'=>'A14',
            'type'=>'bus',
            'status'=>'ca marche',
            'imei'=>'',
            'ligne_id'=>7,
            'deleted_at'=>NULL,
            'created_at'=>'2022-10-15 21:16:01',
            'updated_at'=>'2023-03-09 07:23:49'
            ] );
                        
            Bus::create( [
            'id'=>15,
            'name'=>'A15',
            'type'=>'bus',
            'status'=>'ca marche',
            'imei'=>'',
            'ligne_id'=>5,
            'deleted_at'=>NULL,
            'created_at'=>'2022-10-15 21:16:09',
            'updated_at'=>'2023-03-07 06:11:17'
            ] );
                        
            Bus::create( [
            'id'=>16,
            'name'=>'A16',
            'type'=>'bus',
            'status'=>'ca marche',
            'imei'=>'',
            'ligne_id'=>9,
            'deleted_at'=>NULL,
            'created_at'=>'2022-10-15 21:16:16',
            'updated_at'=>'2023-03-08 09:27:03'
            ] );
                        
            Bus::create( [
            'id'=>17,
            'name'=>'A17',
            'type'=>'bus',
            'status'=>'ca marche',
            'imei'=>'',
            'ligne_id'=>3,
            'deleted_at'=>NULL,
            'created_at'=>'2022-10-15 21:16:23',
            'updated_at'=>'2023-03-05 06:01:51'
            ] );
                        
            Bus::create( [
            'id'=>18,
            'name'=>'A18',
            'type'=>'bus',
            'status'=>'ca marche',
            'imei'=>'',
            'ligne_id'=>6,
            'deleted_at'=>NULL,
            'created_at'=>'2022-10-15 21:16:29',
            'updated_at'=>'2023-03-05 06:13:39'
            ] );
                        
            Bus::create( [
            'id'=>19,
            'name'=>'A19',
            'type'=>'bus',
            'status'=>'ca marche',
            'imei'=>'',
            'ligne_id'=>9,
            'deleted_at'=>NULL,
            'created_at'=>'2022-10-15 21:16:35',
            'updated_at'=>'2023-03-05 06:01:59'
            ] );
                        
            Bus::create( [
            'id'=>20,
            'name'=>'A20',
            'type'=>'bus',
            'status'=>'ca marche',
            'imei'=>'',
            'ligne_id'=>9,
            'deleted_at'=>NULL,
            'created_at'=>'2022-10-15 21:16:43',
            'updated_at'=>'2023-03-05 06:02:09'
            ] );
                        
            Bus::create( [
            'id'=>21,
            'name'=>'A21',
            'type'=>'bus',
            'status'=>'ca marche',
            'imei'=>'',
            'ligne_id'=>5,
            'deleted_at'=>NULL,
            'created_at'=>'2022-10-15 21:16:51',
            'updated_at'=>'2023-03-07 06:24:21'
            ] );
                        
            Bus::create( [
            'id'=>22,
            'name'=>'A22',
            'type'=>'bus',
            'status'=>'ca marche',
            'imei'=>'',
            'ligne_id'=>8,
            'deleted_at'=>NULL,
            'created_at'=>'2022-10-15 21:16:58',
            'updated_at'=>'2023-03-07 07:31:15'
            ] );
                        
            Bus::create( [
            'id'=>23,
            'name'=>'A23',
            'type'=>'bus',
            'status'=>'ca marche',
            'imei'=>'',
            'ligne_id'=>8,
            'deleted_at'=>NULL,
            'created_at'=>'2022-10-15 21:17:17',
            'updated_at'=>'2023-03-05 06:02:42'
            ] );
                        
            Bus::create( [
            'id'=>24,
            'name'=>'A24',
            'type'=>'bus',
            'status'=>'ca marche',
            'imei'=>'',
            'ligne_id'=>10,
            'deleted_at'=>NULL,
            'created_at'=>'2022-10-15 21:17:22',
            'updated_at'=>'2023-03-05 17:43:43'
            ] );
                        
            Bus::create( [
            'id'=>25,
            'name'=>'A25',
            'type'=>'bus',
            'status'=>'ca marche',
            'imei'=>'',
            'ligne_id'=>7,
            'deleted_at'=>NULL,
            'created_at'=>'2022-10-15 21:17:29',
            'updated_at'=>'2023-03-07 06:28:41'
            ] );
                        
            Bus::create( [
            'id'=>26,
            'name'=>'A26',
            'type'=>'bus',
            'status'=>'ca marche',
            'imei'=>'',
            'ligne_id'=>10,
            'deleted_at'=>NULL,
            'created_at'=>'2022-10-15 21:17:35',
            'updated_at'=>'2023-03-07 06:40:59'
            ] );
                        
            Bus::create( [
            'id'=>27,
            'name'=>'A27',
            'type'=>'bus',
            'status'=>'ca marche',
            'imei'=>'',
            'ligne_id'=>10,
            'deleted_at'=>NULL,
            'created_at'=>'2022-10-15 21:17:41',
            'updated_at'=>'2023-03-09 06:12:54'
            ] );
                        
            Bus::create( [
            'id'=>28,
            'name'=>'A28',
            'type'=>'bus',
            'status'=>'ca marche',
            'imei'=>'',
            'ligne_id'=>7,
            'deleted_at'=>NULL,
            'created_at'=>'2022-10-15 21:17:47',
            'updated_at'=>'2023-03-06 06:08:24'
            ] );
                        
            Bus::create( [
            'id'=>29,
            'name'=>'A29',
            'type'=>'bus',
            'status'=>'ca marche',
            'imei'=>'',
            'ligne_id'=>7,
            'deleted_at'=>NULL,
            'created_at'=>'2022-10-15 21:17:52',
            'updated_at'=>'2023-03-10 11:12:48'
            ] );
                        
            Bus::create( [
            'id'=>30,
            'name'=>'A30',
            'type'=>'bus',
            'status'=>'ca marche',
            'imei'=>'',
            'ligne_id'=>8,
            'deleted_at'=>NULL,
            'created_at'=>'2022-10-15 21:17:59',
            'updated_at'=>'2023-03-05 06:03:55'
            ] );
    }
}
