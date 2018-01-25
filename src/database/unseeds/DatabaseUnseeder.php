<?php

namespace Launcher\VoyagerTemplates\database\unseeds;

use Illuminate\Database\Seeder;

class DatabaseUnseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->seed('VoyagerTemplatesTableUnseeder');
        $this->seed('MenuItemsTableUnseeder');
        $this->seed('PermissionsTableUnseeder');
        $this->seed('DataRowsTableUnseeder');
    }
}
