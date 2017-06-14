#!/usr/bin/env php
<?php

file_put_contents(__DIR__.'/disable.log', 'disabled');

use TCG\Voyager\Models\DataType;
use TCG\Voyager\Models\MenuItem;
use TCG\Voyager\Models\Permission;


    /**
     * Delete Menu
     */
    $prefix = route('voyager.templates', [], false);
    MenuItem::where('url', $prefix.'/templates')
        ->delete();


    /**
     * Delete Permission
     */
    Permission::where('table_name', 'admin')
        ->where('key', 'browse_templates')
        ->delete();


    /**
     * Delete DataType
     */
    DataType::where('slug', 'templates')
        ->delete();

