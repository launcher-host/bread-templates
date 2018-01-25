<?php

namespace Launcher\VoyagerTemplates\database\unseeds;

use Illuminate\Database\Seeder;
use TCG\Voyager\Models\Permission;

class PermissionsTableUnseeder extends Seeder
{
    /**
     * Remove permissions data file.
     *
     * @return void
     */
    public function run()
    {
        Permission::removeFrom('voyager_templates');
    }
}
