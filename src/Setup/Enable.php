<?php

namespace VoyagerTemplates\Setup;

use Larapack\Hooks\Events\EnablingHook;

class Enable
{
    /**
     * Handle the event.
     *
     * @param EnablingHook $event
     *
     * @return void
     */
    public function handle(EnablingHook $event)
    {
        // Enable
        // ----------------------------
        // 1. Run Migrations for Permissions, Menu, BREAD and Templates
        // 2. Run Seeders, will not overwrite any data (case is not the first time enabling)
        // 3. Publish files
        //
        dd('EnablingHook', $event);
    }
}
