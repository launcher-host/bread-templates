<?php

namespace akazorg\VoyagerTemplates\Listeners;

use Larapack\Hooks\Events\UninstallingHook;

class UninstallHook
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

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
