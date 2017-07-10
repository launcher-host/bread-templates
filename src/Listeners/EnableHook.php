<?php

namespace akazorg\VoyagerTemplates\Listeners;

use Larapack\Hooks\Events\EnablingHook;

class EnableHook
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
     * @param  EnablingHook  $event
     * @return void
     */
    public function handle(EnablingHook $event)
    {
        // Access hook $event->hook...
    }
}
