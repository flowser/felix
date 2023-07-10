<?php


namespace database\seeders;


use Illuminate\Database\Seeder;
use Database\Seeders\AuthTableSeeder;
use Illuminate\Database\Eloquent\Model;
use Database\Seeders\Traits\TruncateTable;

class DatabaseSeeder extends Seeder
{
    use TruncateTable;

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

            $this->call(AuthTableSeeder::class);

        Model::reguard();
    }
}
