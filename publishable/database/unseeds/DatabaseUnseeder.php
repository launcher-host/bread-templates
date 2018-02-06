<?php

use Illuminate\Database\Seeder;
use TCG\Voyager\Traits\Seedable;

class DatabaseUnseeder extends Seeder
{
    use Seedable;

    protected $seedersPath = __DIR__.'/';

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->seed('BreadTemplatesTableUnseeder');
        $this->seed('MenuItemsTableUnseeder');
        $this->seed('PermissionsTableUnseeder');
        $this->seed('DataRowsTableUnseeder');
    }
}
