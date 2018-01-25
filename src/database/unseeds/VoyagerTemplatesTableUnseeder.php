<?php

namespace Launcher\VoyagerTemplates\database\unseeds;

use Illuminate\Database\Seeder;
use Launcher\VoyagerTemplates\Models\Template as VoyagerTemplate;
use TCG\Voyager\Models\DataType;

class VoyagerTemplatesTableUnseeder extends Seeder
{
    /**
     * Remove Voyager Templates data.
     *
     * @return void
     */
    public function run()
    {
        DataType::where('slug', 'templates')->delete();
    }
}
