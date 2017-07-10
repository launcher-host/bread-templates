<?php

namespace akazorg\VoyagerTemplates\Listeners;

use Larapack\Hooks\Events\InstallingHook;

class InstallHook
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
     * @param  InstallingHook  $event
     * @return void
     */
    public function handle(InstallingHook $event)
    {
        // Access hook $event->hook...
    }
}
