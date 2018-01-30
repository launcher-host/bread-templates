<?php

namespace Launcher\BreadTemplates;

use Illuminate\Support\Facades\Facade;

class BreadTemplatesFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return TemplatesManager::class;
    }
}
