<?php

namespace VoyagerTemplates\Models;

use VoyagerTemplates\TemplatesManager;
use Illuminate\Database\Eloquent\Model;

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
        foreach (['saved', 'deleted'] as $action) {
            static::{$action}(function (Template $template) {
                TemplatesManager::templateModified($template);
            });
        }
    }
}
