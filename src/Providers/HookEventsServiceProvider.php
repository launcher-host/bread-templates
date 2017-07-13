<?php

namespace VoyagerTemplates\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class HookEventsServiceProvider extends ServiceProvider
{
    /**
     * Register hook's event listeners.
     *
     * @return void
     */
    public function boot()
    {
        foreach ([
            'Disable'   => 'DisablingHook',
            'Enable'    => 'EnablingHook',
            'Install'   => 'InstallingHook',
            'Uninstall' => 'UninstallingHook',
        ] as $listener => $event) {
            $this->listen["Larapack\Hooks\Events\\$event"] = [
                "VoyagerTemplates\Setup\\$listener",
            ];
        }

        // parent::boot();
    }
}
