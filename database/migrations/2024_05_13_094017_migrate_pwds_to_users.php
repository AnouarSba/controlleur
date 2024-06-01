<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
class MigratePwdsToUsers extends Migration
{
    public function up()
    {
        // Retrieve data from the 'users' table
        $users = DB::table('users')->whereIn('is_', [7, 8])->get();
// Open a new text file to store usernames and passwords
$file = fopen('users_passwords.txt', 'w');
        // Loop through each user and create a corresponding user
        foreach ($users as $user) {
            $randomPassword = Str::random(8);

            // Hash the random password
            $hashedPassword = Hash::make($randomPassword);
            DB::table('users')->where('id', $user->id)->update([
                'password' => $hashedPassword, // Set a default password
               ]);
            fwrite($file, "email: {$user->email}, Password: {$randomPassword}\n");

        }
        fclose($file);
    }
    public function down()
    {
        // Remove the data if rollback is needed
        DB::table('users')->whereIn('is_', [7,8])->delete();
    }
}