<?php

namespace akazorg\VoyagerTemplates\Listeners;

use Larapack\Hooks\Events\DisablingHook;

class DisableHook
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
     * @param  DisablingHook  $event
     * @return void
     */
    public function handle(DisablingHook $event)
    {
        // Access hook $event->hook...
    }
}
