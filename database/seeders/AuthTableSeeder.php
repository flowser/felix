<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\Traits\TruncateTable;
use Database\Seeders\Traits\DisableForeignKeys;
use Database\Seeders\Auth\User\TeamsTableSeeder;
use Database\Seeders\Auth\User\UsersTableSeeder;
use Database\Seeders\Auth\Company\SeosTableSeeder;
use Database\Seeders\Auth\User\ClientsTableSeeder;
use Database\Seeders\Auth\User\ExpertsTableSeeder;
use Database\Seeders\Auth\User\ProfilesTableSeeder;
use Database\Seeders\Auth\Company\AboutsTableSeeder;
use Database\Seeders\Auth\Location\WardsTableSeeder;
use Database\Seeders\Auth\Payment\OrdersTableSeeder;
use Database\Seeders\Auth\Challenge\TasksTableSeeder;
use Database\Seeders\Auth\Company\SlidersTableSeeder;
use Database\Seeders\Auth\Company\ProjectsTableSeeder;
use Database\Seeders\Auth\Company\ServicesTableSeeder;
use Database\Seeders\Auth\Payment\InvoicesTableSeeder;
use Database\Seeders\Auth\Report\DownloadsTableSeeder;
use Database\Seeders\Auth\Attribute\GendersTableSeeder;
use Database\Seeders\Auth\Company\CompaniesTableSeeder;
use Database\Seeders\Auth\Location\CountiesTableSeeder;
use Database\Seeders\Auth\Company\IndustriesTableSeeder;
use Database\Seeders\Auth\Location\CountriesTableSeeder;
use Database\Seeders\Auth\Challenge\ProcessesTableSeeder;
use Database\Seeders\Auth\Challenge\ChallengesTableSeeder;
use Database\Seeders\Auth\Challenge\QuotationsTableSeeder;
use Database\Seeders\Auth\Location\PostalcodesTableSeeder;
use Database\Seeders\Auth\Challenge\HandingoversTableSeeder;
use Database\Seeders\Auth\Payment\PaymentmethodsTableSeeder;
use Database\Seeders\Auth\Challenge\sub\QcontrolsTableSeeder;
use Database\Seeders\Auth\Location\ConstituenciesTableSeeder;
use Database\Seeders\Auth\Challenge\DemonstrationsTableSeeder;
use Database\Seeders\Auth\PermissionRole\UserRolesTableSeeder;
use Database\Seeders\Auth\Challenge\sub\AttachmentsTableSeeder;
use Database\Seeders\Auth\Company\QualityassuarancesTableSeeder;
use Database\Seeders\Auth\Challenge\ChallengeprocessesTableSeeder;
use Database\Seeders\Auth\PermissionRole\PermissionRolesTableSeeder;
use Database\Seeders\Auth\Challenge\sub\ApplianceRequestsTableSeeder;
use Database\Seeders\Auth\Challenge\sub\QuotationservicesTableSeeder;

class AuthTableSeeder extends Seeder
{
    use DisableForeignKeys, TruncateTable;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->disableForeignKeys();

        // Reset cached roles and permissions
        app()['cache']->forget('spatie.permission.cache');

        $this->truncateMultiple([
            config('permission.table_names.model_has_permissions'),
            config('permission.table_names.model_has_roles'),
            config('permission.table_names.role_has_permissions'),
            config('permission.table_names.permissions'),
            config('permission.table_names.roles'),
            'users',

        ]);

        $this->call(PermissionRolesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->enableForeignKeys();
    }
}
