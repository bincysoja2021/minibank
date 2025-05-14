<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name'         => "Bincy",
            'user_type'    =>"Admin",
            'email'        => 'bincysoja2017@gmail.com',
            'contact_num'  => "7558874902",
            'password'     => Hash::make('12345678')
        ]);

        DB::table('users')->insert([
            'name'         => "unni",
            'user_type'    =>"Customer",
            'email'        => 'unni@gmail.com',
            'contact_num'  => "7588874902",
            'password'     => Hash::make('12345678')
        ]);

    }
}
