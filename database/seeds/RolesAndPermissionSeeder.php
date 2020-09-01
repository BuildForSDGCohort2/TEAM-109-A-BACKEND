<?php

use Illuminate\Database\Seeder;
use App\Enums\Roles;
use App\Enums\Permissions;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class RolesAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();


        //loops through to create roles table
        foreach(Roles::getKeys() as $role){
            Role::findOrCreate($role);
        }


        //Loops through to create Permissions table
        foreach(Permissions::getKeys() as $permission){
            Permission::findOrCreate($permission);
        }

        //get each role name from the Role Model
        $superAdmin = Role::findByName(Roles::SUPER_ADMIN);
        $admin = Role::findByName(Roles::ADMIN);
        $farmer = Role::findByName(Roles::FARMER);
        $storage = Role::findByName(Roles::STORAGE);
        $processor = Role::findByName(Roles::PROCESSOR);



        //assign Permission to role
        $superAdmin->syncPermissions(Permissions::getSuperAdminPermissions());
        $admin->syncPermissions(Permissions::getAdminPermissions());
        $farmer->syncPermissions(Permissions::getFarmerPermissions());
        $storage->syncPermissions(Permissions::getStoragePermissions());
        $processor->syncPermissions(Permissions::getProcessorPermissions());

    }
}
