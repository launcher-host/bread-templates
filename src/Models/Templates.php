<?php

namespace akazorg\VoyagerTemplates\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use TCG\Voyager\Database\Schema\SchemaManager;
use TCG\Voyager\Facades\Voyager;

class VoyagerTemplates extends Model
{
    protected $table = 'voyager_templates';

    protected $fillable = [
        'name',
        'view',
    ];
}
