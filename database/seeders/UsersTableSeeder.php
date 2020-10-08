<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $user = User::where('email', 'garz090289@gmail.com')->first();

        if (!$user){
            User::create([
            'name' => 'Gary Yu',
            'email' => 'garz090289@gmail.com',
            'role' => 'admin',
            'password' => Hash::make('123123123')
            ]);
        }
    }
}
