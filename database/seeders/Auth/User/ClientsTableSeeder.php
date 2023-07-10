<?php

namespace Database\Seeders\Auth\User;

use App\Models\User\Client;
use Illuminate\Database\Seeder;

class ClientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //1
        Client::create([
            'user_id'    =>'3',
            'company_id' =>null,
        ]);
    }
}

