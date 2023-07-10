<?php

namespace Database\Seeders\Auth\User;

use App\Models\User\User;
use Illuminate\Database\Seeder;
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
        //1
        User::create([
            'first_name'        => 'Eng. Felix',
            'last_name'         => 'Nyachio',
            'email'             => 'felixnyachio@savvytexmarines.co.ke',
            'password'          => Hash::make('flx4life'),
            'confirmation_code' => md5(uniqid(mt_rand(), true)),
            'confirmed'         => true,
        ]); //2
        User::create([
            'first_name'        => 'Lister',
            'last_name'         => 'Nyabando',
            'email'             => 'klister@savvytexmarines.co.ke',
            'password'          => Hash::make('flx4life'),
            'confirmation_code' => md5(uniqid(mt_rand(), true)),
            'confirmed'         => true,
        ]); //6
        User::create([
            'first_name'        => 'Client',
            'last_name'         => 'Client',
            'email'             => 'client@savvytexmarines.co.ke',
            'password'          => Hash::make('flx4life'),
            'confirmation_code' => md5(uniqid(mt_rand(), true)),
            'confirmed'         => true,
        ]); //6
    }
}

