<?php

namespace akazorg\VoyagerTemplates\Models;

use Illuminate\Database\Eloquent\Model;
use akazorg\VoyagerTemplates\TemplatesManager;

class Template extends Model
{
    protected $table = 'voyager_templates';

    protected $fillable = [
        'name',
        'slug',
        'view',
    ];

    public static function boot()
    {
        static::saved(function (Template $template) {
            TemplatesManager::templateModified($template);
        });

        static::deleted(function (Template $template) {
            TemplatesManager::templateModified($template);
        });
    }
}
