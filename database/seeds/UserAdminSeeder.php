<?php

use Illuminate\Database\Seeder;

class UserAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'user' => 'admin',
            'password' => bcrypt('admin'),
            'dni' => '00000000',
            'nombres' => 'admin',
            'apellidos' => 'admin',
            'tipo' => 'admin',
        ]);
    }
}
