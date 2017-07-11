<?php

namespace akazorg\VoyagerTemplates\Setup;

use Larapack\Hooks\Events\InstallingHook;

class Install
{
    /**
     * Handle the event.
     *
     * @param  InstallingHook  $event
     * @return void
     */
    public function handle(InstallingHook $event)
    {
        dd($event);
    }
}
