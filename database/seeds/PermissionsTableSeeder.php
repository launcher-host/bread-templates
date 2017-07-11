<?php

use Illuminate\Database\Seeder;
use TCG\Voyager\Models\Permission;
use TCG\Voyager\Models\Role;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     *
     * @return void
     */
    public function run()
    {
        // Skip if already exists
        if (Permission::where('table_name', 'voyager_templates')->first()) {
            return;
        }

        Permission::generateFor('voyager_templates');

        $role = Role::where('name', 'admin')->first();

        if (!is_null($role)) {
            $role->permissions()->attach(
                Permission::where('table_name', 'voyager_templates')->pluck('id')->all()
            );
        }
    }
}
