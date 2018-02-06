<?php

use Illuminate\Database\Seeder;
use TCG\Voyager\Traits\Seedable;

class BreadTemplatesDatabaseSeeder extends Seeder
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
        $this->seed('BreadTemplatesTableSeeder');
        $this->seed('BreadTemplatesMenuTableSeeder');
        $this->seed('BreadTemplatesPermissionsTableSeeder');
        $this->seed('BreadTemplatesDataRowsTableSeeder');
    }
}
