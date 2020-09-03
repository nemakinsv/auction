<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\User::firstOrNew(['email' => 'admin@admin.ru'],
            [
                'name'     => 'Админ',
                'password' => bcrypt('adminpass123'),
                'flag_is_admin'  => 1,
            ]
        )->save();


    }
}
