<?php

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
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
        for($id = 1; $id <= 10; $id++){
            DB::table('users')->insert([
                'id'       => $id,
                'name'     => 'user'.$id,
                'email'    => $id.$id.$id.$id.'@email',
                'password' => Hash::make('pass'.$id.$id.$id.$id),
                
            ]);
        }   
    }
}
