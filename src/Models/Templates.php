<?php

namespace akazorg\VoyagerTemplates\Models;

use Illuminate\Database\Eloquent\Model;

class Templates extends Model
{
    protected $table = 'voyager_templates';

    protected $fillable = [
        'name',
        'slug',
        'view',
    ];
}
