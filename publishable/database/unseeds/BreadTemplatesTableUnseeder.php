<?php

use Illuminate\Database\Seeder;
use TCG\Voyager\Models\DataType;

class BreadTemplatesTableUnseeder extends Seeder
{
    /**
     * Remove Bread Templates data.
     *
     * @return void
     */
    public function run()
    {
        DataType::where('slug', 'templates')->delete();
    }
}
