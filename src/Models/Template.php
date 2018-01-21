<?php

namespace LauncherHost\VoyagerTemplates\Models;

use Illuminate\Database\Eloquent\Model;
use LauncherHost\VoyagerTemplates\TemplatesManager;

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
