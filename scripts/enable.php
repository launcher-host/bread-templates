<?php

use akazorg\VoyagerTemplates\Models\Templates;
use TCG\Voyager\Models\DataRow;
use TCG\Voyager\Models\DataType;
use TCG\Voyager\Models\Menu;
use TCG\Voyager\Models\MenuItem;
use TCG\Voyager\Models\Permission;
use TCG\Voyager\Models\Role;


    /**
     * Add Template data
     */
    $tpl = Templates::firstOrNew([
        'slug' => 'edit-2-columns',
    ]);
    if (!$tpl->exists) {
        $tpl->fill([
            'name' => 'View Edit 2 Columns',
        ])->save();
    }

    $tpl = Templates::firstOrNew([
        'slug' => 'edit-3-columns',
    ]);
    if (!$tpl->exists) {
        $tpl->fill([
            'name' => 'View Edit 3 Columns',
        ])->save();
    }



    /**
     * Add to Menu
     */
    $prefix = route('voyager.templates', [], false);
    $menu = Menu::where('name', 'admin')->first();

    if (!is_null($menu)) {
        $menuItem = MenuItem::firstOrNew([
            'menu_id' => $menu->id,
            'url'     => $prefix.'/templates',
        ]);
        if (!$menuItem->exists) {
            $menuItem->fill([
                'title'      => 'BREAD Templates',
                'target'     => '_self',
                'icon_class' => 'voyager-megaphone',
                'color'      => null,
                'parent_id'  => null,
                'order'      => 2,
            ])->save();
        }
    }


    /**
     * Add Permission
     */
    $permission = Permission::firstOrCreate([
        'key'        => 'browse_templates',
        'table_name' => 'admin',
    ]);

    $role = Role::where('name', 'admin')->first();
    if (!is_null($role)) {
        if ($role->permissions()->where('id', $permission->id)->count() == 0) {
            $role->permissions()->attach($permission);
        }
    }


    /**
     * Add DataType, so we can use the BREAD system
     */
    $dataType = DataType::where('slug', 'templates');
    if (!$dataType->exists) {
        $dataType->fill([
            'name'                  => 'templates',
            'display_name_singular' => 'Template',
            'display_name_plural'   => 'Templates',
            'icon'                  => 'voyager-news',
            'model_name'            => 'akazorg\\VoyagerTemplates\\Models\\Templates',
            'controller'            => '',
            'generate_permissions'  => 1,
            'description'           => '',
        ])->save();
    }


    /**
     * Add DataRows
     */
    $dataRow = DataRow::where('data_type_id', $dataType->id)->where('field', 'id');
    if (!$dataRow->exists) {
        $dataRow->fill([
            'type'         => 'number',
            'display_name' => 'id',
            'required'     => 1,
            'browse'       => 0,
            'read'         => 0,
            'edit'         => 0,
            'add'          => 0,
            'delete'       => 0,
            'details'      => '',
            'order'        => 1,
        ])->save();
    }

    $dataRow = DataRow::where('data_type_id', $dataType->id)->where('field', 'name');
    if (!$dataRow->exists) {
        $dataRow->fill([
            'type'         => 'text',
            'display_name' => 'Name',
            'required'     => 1,
            'browse'       => 1,
            'read'         => 1,
            'edit'         => 1,
            'add'          => 1,
            'delete'       => 1,
            'details'      => '',
            'order'        => 2,
        ])->save();
    }

    $dataRow = DataRow::where('data_type_id', $dataType->id)->where('field', 'slug');
    if (!$dataRow->exists) {
        $dataRow->fill([
            'type'         => 'text',
            'display_name' => 'slug',
            'required'     => 1,
            'browse'       => 0,
            'read'         => 1,
            'edit'         => 1,
            'add'          => 1,
            'delete'       => 1,
            'details'      => json_encode([
                'slugify' => [
                    'origin' => 'name',
                ],
            ]),
            'order'        => 3,
        ])->save();
    }

    $dataRow = DataRow::where('data_type_id', $dataType->id)->where('field', 'view');
    if (!$dataRow->exists) {
        $dataRow->fill([
            'type'         => 'rich_text_box',
            'display_name' => 'body',
            'required'     => 1,
            'browse'       => 0,
            'read'         => 1,
            'edit'         => 1,
            'add'          => 1,
            'delete'       => 1,
            'details'      => '',
            'order'        => 4,
        ])->save();
    }

    $dataRow = DataRow::where('data_type_id', $dataType->id)->where('field', 'created_at');
    if (!$dataRow->exists) {
        $dataRow->fill([
            'type'         => 'timestamp',
            'display_name' => 'created_at',
            'required'     => 1,
            'browse'       => 1,
            'read'         => 1,
            'edit'         => 0,
            'add'          => 0,
            'delete'       => 0,
            'details'      => '',
            'order'        => 5,
        ])->save();
    }

    $dataRow = DataRow::where('data_type_id', $dataType->id)->where('field', 'updated_at');
    if (!$dataRow->exists) {
        $dataRow->fill([
            'type'         => 'timestamp',
            'display_name' => 'updated_at',
            'required'     => 1,
            'browse'       => 0,
            'read'         => 0,
            'edit'         => 0,
            'add'          => 0,
            'delete'       => 0,
            'details'      => '',
            'order'        => 6,
        ])->save();
    }


file_put_contents(__DIR__.'/enable.log', 'enabled');
