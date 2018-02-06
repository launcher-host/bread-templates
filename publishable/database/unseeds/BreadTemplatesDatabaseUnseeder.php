<?php

use Illuminate\Database\Seeder;
use TCG\Voyager\Traits\Seedable;

class BreadTemplatesDatabaseUnseeder extends Seeder
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
        $this->seed('BreadTemplatesMenuTableUnseeder');
        $this->seed('BreadTemplatesPermissionsTableUnseeder');
        $this->seed('BreadTemplatesDataRowsTableUnseeder');
    }
}
