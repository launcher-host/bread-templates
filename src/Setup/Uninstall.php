<?php

namespace akazorg\VoyagerTemplates\Setup;

use Larapack\Hooks\Events\UninstallingHook;

class Uninstall
{
    /**
     * Handle the event.
     *
     * @param  UninstallingHook  $event
     * @return void
     */
    public function handle(UninstallingHook $event)
    {
        // Access hook $event->hook...
    }
}
