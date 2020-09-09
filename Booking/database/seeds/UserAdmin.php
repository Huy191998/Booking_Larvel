<?php

use Illuminate\Database\Seeder;
use App\User;
class UserAdmin extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'=>'quangadmin',
            'Isdelete'=>0,
            'Role'=>1,
            'email'=>'admin@gmail.com',
            'password'=>Hash::make('123456'),
            'provider'=>'',
            'provider_id'=>''

        ]);
        User::create([
            'name'=>'huyadmin',
            'Isdelete'=>0,
            'Role'=>1,
            'email'=>'admin@gmail.com',
            'password'=>Hash::make('123456'),
            'provider'=>'',
            'provider_id'=>''

        ]);
    }
}
//php artisan db:seed --class=UserAdmin
