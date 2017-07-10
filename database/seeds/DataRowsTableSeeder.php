<?php

use Illuminate\Database\Seeder;
use TCG\Voyager\Models\Page;
use TCG\Voyager\Models\DataRow;
use TCG\Voyager\Models\DataType;
use TCG\Voyager\Facades\Voyager;
use akazorg\VoyagerTemplates\Models\Template as VoyagerTemplate;

class DataRowsTableSeeder extends Seeder
{
    /**
     * Will change Pages dataType in order to use templates.
     *
     * @return void
     */
    public function run()
    {
        $pageDataType = DataType::where('slug', 'pages')->firstOrFail();

        if (!$pageDataType->exists) {
            return;
        }

        $dataTypeID = $pageDataType->id;
        $dataRow = $this->dataRow($dataTypeID, 'title');
        if ($dataRow->exists) {
            $dataRow->fill([
                'order'   => 3,
                'details' => json_encode([
                    'template' => [
                        'slug'  => 'columns-8-4',
                        'stack' => 'r01_lf',
                    ],
                ]),
            ])->save();
        }

        $dataRow = $this->dataRow($dataTypeID, 'slug');
        if ($dataRow->exists) {
            $dataRow->fill([
                'order' => 4,
                'details' => json_encode([
                    'slugify' => [
                        'origin' => 'title',
                    ],
                    'template' => [
                        'slug'  => 'columns-8-4',
                        'stack' => 'r01_lf',
                    ],
                ]),
            ])->save();
        }

        $dataRow = $this->dataRow($dataTypeID, 'meta_description');
        if ($dataRow->exists) {
            $dataRow->fill([
                'order'   => 5,
                'details' => json_encode([
                    'template' => [
                        'slug'  => 'columns-8-4',
                        'stack' => 'r01_lf',
                    ],
                ]),
            ])->save();
        }

        $dataRow = $this->dataRow($dataTypeID, 'meta_keywords');
        if ($dataRow->exists) {
            $dataRow->fill([
                'order'   => 6,
                'details' => json_encode([
                    'template' => [
                        'slug'  => 'columns-8-4',
                        'stack' => 'r01_lf',
                    ],
                ]),
            ])->save();
        }

        $dataRow = $this->dataRow($dataTypeID, 'excerpt');
        if ($dataRow->exists) {
            $dataRow->fill([
                'order'   => 7,
                'details' => json_encode([
                    'template' => [
                        'slug'  => 'columns-8-4',
                        'stack' => 'r02_lf',
                    ],
                ]),
            ])->save();
        }

        $dataRow = $this->dataRow($dataTypeID, 'status');
        if ($dataRow->exists) {
            $dataRow->fill([
                'order'   => 8,
                'details' => json_encode([
                    'default' => 'INACTIVE',
                    'options' => [
                        'INACTIVE' => 'INACTIVE',
                        'ACTIVE'   => 'ACTIVE',
                    ],
                    'template' => [
                        'slug'  => 'columns-8-4',
                        'stack' => 'r01_rg',
                    ],
                ]),
            ])->save();
        }

        $dataRow = $this->dataRow($dataTypeID, 'created_at');
        if ($dataRow->exists) {
            $dataRow->fill([
                'order'   => 9,
                'details' => json_encode([
                    'template' => [
                        'slug'  => 'columns-8-4',
                        'stack' => 'r01_rg',
                    ],
                ]),
            ])->save();
        }

        $dataRow = $this->dataRow($dataTypeID, 'image');
        if ($dataRow->exists) {
            $dataRow->fill([
                'order'   => 10,
                'details' => json_encode([
                    'template' => [
                        'slug'  => 'columns-8-4',
                        'stack' => 'r02_rg',
                    ],
                ]),
            ])->save();
        }

        $dataRow = $this->dataRow($dataTypeID, 'body');
        if ($dataRow->exists) {
            $dataRow->fill([
                'order'   => 11,
                'details' => json_encode([
                    'template' => [
                        'slug'  => 'columns-8-4',
                    ],
                ]),
            ])->save();
        }
    }

    /**
     * [dataRow description].
     *
     * @param [type] $type  [description]
     * @param [type] $field [description]
     *
     * @return [type] [description]
     */
    protected function dataRow($dataTypeID, $field)
    {
        return DataRow::where([
                'data_type_id' => $dataTypeID,
                'field'        => $field,
            ])->first();
    }
}
