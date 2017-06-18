<?php

use Illuminate\Support\Facades\Schema;

/**
 * Drop table
 */
Schema::drop('voyager_templates');


file_put_contents(__DIR__.'/uninstall.log', 'uninstalled');
