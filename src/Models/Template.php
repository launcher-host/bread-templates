<?php

namespace Launcher\BreadTemplates\Models;

use Illuminate\Database\Eloquent\Model;
use Launcher\BreadTemplates\TemplatesManager;

class Template extends Model
{
    protected $table = 'bread_templates';

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
