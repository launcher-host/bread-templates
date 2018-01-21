<?php

namespace LauncherHost\VoyagerTemplates;

use Illuminate\Support\Facades\Facade;

class VoyagerTemplatesFacade extends Facade
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
