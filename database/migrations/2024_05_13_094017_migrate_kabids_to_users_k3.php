<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
class MigrateKabidsToUsersK3 extends Migration
{
    public function up()
    {
        // Retrieve kabid data from the 'kabids' table
        $kabids = DB::table('kabids')->where("id","=",82)->get();
// Open a new text file to store usernames and passwords
$file = fopen('kabids_passwords_3.txt', 'w');
        // Loop through each kabid and create a corresponding user
        foreach ($kabids as $kabid) {
            $randomPassword = Str::random(8);

            // Hash the random password
            $hashedPassword = Hash::make($randomPassword);
            $username = $this->generateUniqueUsername($kabid->name);
            DB::table('users')->insert([
                'username' => $username, // You may need a function to generate a unique username
                'firstname' => '', // Add first name if available
                'lastname' => '', // Add last name if available
                'email' => $kabid->email, // You may need a function to generate a unique email
                'password' => $hashedPassword, // Set a default password
                'is_' => 7, // Assign appropriate role (e.g., 'maintainer') based on your requirements
                'matricule' => $kabid->matricule, 
                'address' => '', // Add address if available
                'city' => '', // Add city if available
                'country' => '', // Add country if available
                'postal' => '', // Add postal code if available
                'about' => '', // Add about information if available
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            fwrite($file, "Username: {$username}, Password: {$randomPassword}\n");

        }
        fclose($file);
    }
    public function generateUniqueUsername($name)
{
    // Generate a unique username based on the kabid's name or other criteria
    return strtolower(str_replace(' ', '_', $name));
}

public function generateUniqueEmail($name)
{
    // Generate a unique email address based on the kabid's name or other criteria
    return strtolower(str_replace(' ', '', $name)) . '@gmail.com';
}
    public function down()
    {
        // Remove the data if rollback is needed
        DB::table('users')->whereIn('is_', [7])->delete();
    }
}