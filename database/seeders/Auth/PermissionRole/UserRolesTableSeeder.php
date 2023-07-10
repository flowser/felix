<?php
namespace Database\Seeders\Auth\PermissionRole;

use App\Models\User\User;
use Illuminate\Database\Seeder;


class UserRolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $user1 = User::find(1)->assignRole('Superadmin');
        $user1->givePermissionTo(
            [
                'View',
                'Create',
                'Edit',
                'Delete',
                'Disable'
            ]
        );

        $user2 =User::find(2)->assignRole('Admin');
        $user2->givePermissionTo(
            [
                'View',
                'Edit',
                'Disable'
            ]
        );
    }
}
