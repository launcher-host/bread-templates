<?php

namespace akazorg\VoyagerTemplates\Setup;

use Larapack\Hooks\Events\DisablingHook;

class Disable
{
    /**
     * Handle the event.
     *
     * @param DisablingHook $event
     *
     * @return void
     */
    public function handle(DisablingHook $event)
    {
        // Access hook $event->hook...
    }
}
