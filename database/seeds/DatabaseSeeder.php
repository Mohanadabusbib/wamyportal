<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([

            /* UsersTableSeeder::class, */
            DepartmentTableSeeder::class,
            SectionTableSeeder::class,
            RolesTableSeeder::class,
            PermissionsTableSeeder::class,
            PermissionstypesTableSeeder::class,
            permissionsroleTableSeeder::class,
            ManufacturersTableSeeder::class,
            HardwareTableSeeder::class,
            InventoryTypesTableSeeder::class,
        ]);

    }
}
