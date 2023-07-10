<?php

namespace Database\Seeders\Auth\User;

use App\Models\User\Team;
use Illuminate\Database\Seeder;

class TeamsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //1
        Team::create([
            'occupation' =>'Ceo/Director',
            'facebook'   =>'https://www.facebook.com/savvytexmarines',
            'instagram'  =>'https://www.instagram.com/savvytexmarines',
            'twitter'    =>'https://twitter.com/MarinesLtd',
            'linkedin'   =>'https://www.linkedin.com/company/savvytex-marines-limited',
            'pinterest'  =>'https://www.pinterest.com/savvytexmarinesltd',
            'active'     => true,
            'user_id'    =>'1',
            'company_id' =>'1',
         ]);
        Team::create([
            'occupation' =>'Marketing Director',
            'facebook'   =>'https://www.facebook.com/savvytexmarines',
            'instagram'  =>'https://www.instagram.com/savvytexmarines',
            'twitter'    =>'https://twitter.com/MarinesLtd',
            'linkedin'   =>'https://www.linkedin.com/company/savvytex-marines-limited',
            'pinterest'  =>'https://www.pinterest.com/savvytexmarinesltd',
            'active'     => true,
            'user_id'    =>'2',
            'company_id' =>'1',
         ]);
    }
}

