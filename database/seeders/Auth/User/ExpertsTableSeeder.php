<?php

namespace Database\Seeders\Auth\User;

use App\Models\User\Expert;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ExpertsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //1
        Expert::create([
            'user_id' =>'1',
            'active'  => true,
        ]);
    }
}

