<?php

namespace VoyagerTemplates\Setup;

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
        // Disable
        // ----------------------------
        // 1. Remove Menu, Permissions and BREAD rows
        // 2. Optionally, Delete `templates` table
        //
        dd('DisablingHook', $event);
    }
}
