<?php

use Illuminate\Database\Seeder;
use TCG\Voyager\Models\Menu;
use TCG\Voyager\Models\MenuItem;

class MenuItemsTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     *
     * @return void
     */
    public function run()
    {
        $menu = Menu::where('name', 'admin')->firstOrFail();

        $url  = '/admin/templates';

        // Skip if already exists
        if (MenuItem::where('menu_id', $menu->id)->where('url', $url)->first()) {
            return;
        }

        $menuItem = MenuItem::firstOrNew([
            'menu_id' => $menu->id,
            'url'     => $url,
        ]);

        $menuItem->fill([
            'title'      => 'Templates',
            'target'     => '_self',
            'icon_class' => 'voyager-megaphone',
            'color'      => null,
            'parent_id'  => null,
            'order'      => 98,
        ])->save();
    }
}
