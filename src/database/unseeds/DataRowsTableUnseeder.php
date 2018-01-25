<?php

namespace Launcher\VoyagerTemplates\database\unseeds;

use Illuminate\Database\Seeder;
use TCG\Voyager\Models\DataRow;

class DataRowsTableUnseeder extends Seeder
{
    /**
     * Will remove template attributes from JSON field.
     *
     * @return void
     */
    public function run()
    {
        // fetch all rows where JSON not empty
        $rows = DataRow::whereNot('details', '');

        // find every record for existence of Template attributes
        // and delete this key.
        foreach ($rows as $row) {
            $details = json_decode($row->details);

            // delete key if found
            if (isset($details->template)) {
                unset($details['template']);

                $row->details = json_encode($details);

                $row->save();
            }
        }
    }
}
