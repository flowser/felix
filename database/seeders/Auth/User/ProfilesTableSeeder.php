<?php

namespace Database\Seeders\Auth\User;

use App\Models\User\Profile;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ProfilesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //1
        Profile::create([
            'photo'            =>'felix.jpg',
            'active'           =>true,
            'phone'            =>'0714192492',
            'residence'        =>'Umoja 2',
            'address'          =>'Tena Estate',
            'user_id'          =>'1',
            'gender_id'        =>'1',
            'country_id'       =>'1',
            'county_id'        =>'47',
            'constituency_id'  =>'3',
            'ward_id'          =>'4',
         ]);
        Profile::create([
            'photo'            =>'lister.jpg',
            'active'           =>true,
            'phone'            =>'0714192409',
            'residence'        =>'Umoja 2',
            'address'          =>'Tena Estate',
            'user_id'          =>'2',
            'gender_id'        =>'2',
            'country_id'       =>'1',
            'county_id'        =>'47',
            'constituency_id'  =>'3',
            'ward_id'          =>'4',
         ]);
        Profile::create([
            'photo'            =>'client.jpg',
            'active'           =>true,
            'phone'            =>'0714192432',
            'residence'        =>'Umoja 2',
            'address'          =>'Tena Estate',
            'user_id'          =>'3',
            'gender_id'        =>'2',
            'country_id'       =>'1',
            'county_id'        =>'47',
            'constituency_id'  =>'3',
            'ward_id'          =>'4',
         ]);
    }
}

