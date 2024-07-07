<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
class MigrateChauffeursToUsersC3 extends Migration
{
    public function up()
    {
        // Retrieve chauffeur data from the 'chauffeurs' table
        $chauffeurs = DB::table('chauffeurs')->where("id","=" ,62)->get();
// Open a new text file to store usernames and passwords
$file = fopen('chauffeurs_passwords_3.txt', 'w');
        // Loop through each chauffeur and create a corresponding user
        foreach ($chauffeurs as $key => $chauffeur) {
            $randomPassword = Str::random(8);
           $email= $this->generateUniqueEmail($chauffeur->fr_name.$key);
            // Hash the random password
            $hashedPassword = Hash::make($randomPassword);
            $username =  $this->generateUniqueUsername($chauffeur->name);
            DB::table('users')->insert([
                'username' => $username, // You may need a function to generate a unique username
                'firstname' => '', // Add first name if available
                'lastname' => '', // Add last name if available
                'email' => $email, // You may need a function to generate a unique email
                'password' => $hashedPassword, // Set a default password
                'is_' => 8, // Assign appropriate role (e.g., 'maintainer') based on your requirements
                'matricule' => $chauffeur->matricule, 
                'address' => '', // Add address if available
                'city' => '', // Add city if available
                'country' => '', // Add country if available
                'postal' => '', // Add postal code if available
                'about' => '', // Add about information if available
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            fwrite($file, "Username: {$username}, email: {$email}, Password: {$randomPassword}\n");

        }
        fclose($file);
    }
    public function generateUniqueUsername($name)
{
    // Generate a unique username based on the chauffeur's name or other criteria
    return strtolower(str_replace(' ', '_', $name));
}

public function generateUniqueEmail($name)
{
    // Generate a unique email address based on the chauffeur's name or other criteria
    return strtolower(str_replace(' ', '', $name)) . '@gmail.com';
}
    public function down()
    {
        // Remove the data if rollback is needed
        DB::table('users')->whereIn('is_', [8])->delete();
    }
}
