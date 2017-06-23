<?php

namespace akazorg\VoyagerTemplates;

use Illuminate\Events\Dispatcher;
use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use TCG\Voyager\Models\DataRow;
use TCG\Voyager\Models\DataType as DataType;
use TCG\Voyager\Models\Menu;
use TCG\Voyager\Models\MenuItem;
use TCG\Voyager\Models\Permission;
use TCG\Voyager\Models\Role;

class VoyagerTemplatesServiceProvider extends ServiceProvider
{
    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {
        // Publish Migrations
        $this->publishes([
            dirname(__DIR__).'/database/migrations' => database_path('migrations')
        ], 'migrations');

        // dd(Artisan);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Dispatcher $events, Menu $menu)
    {
        // Load migrations
        // $this->loadMigrationsFrom(__DIR__.'/database/migrations');
        // Artisan::call('migrate');

        $events->listen('voyager.admin.routing', [$this, 'addRoutes']);
        $this->addMenuItem($menu);
    }


    public function addRoutes(Router $router)
    {
        $hookController = '\\akazorg\\VoyagerTemplates\\Http\\Controllers\\VoyagerTemplatesController@';
        $router->get('templates', ['uses' => $hookController.'index', 'as' => 'templates']);
    }



    public function addMenuItem(Menu $menu)
    {
        $menu = $menu::where('name', 'admin')->first();
        $url  = '/admin/templates';

        if (!is_null($menu)) {
            $menuItem = MenuItem::firstOrNew([
                'menu_id' => $menu->id,
                'url'     => $url,
            ]);

            if (!$menuItem->exists) {
                $menuItem->fill([
                    'title'      => 'Templates',
                    'target'     => '_self',
                    'icon_class' => 'voyager-megaphone',
                    'color'      => null,
                    'parent_id'  => null,
                    'order'      => 98,
                ])->save();

                $this->setPermission();
                $this->addTable();
                $this->addBREAD();
            }
        }
    }


    protected function setPermission()
    {
        $permission = Permission::firstOrCreate([
            'key'        => 'browse_voyager_templates',
            'table_name' => 'voyager_templates',
        ]);

        $role = Role::where('name', 'admin')->first();
        if (!is_null($role)) {
            if ($role->permissions()->where('id', $permission->id)->count() == 0) {
                $role->permissions()->attach($permission);
            }
        }
    }


    /**
     * addTable
     * this should call migration "2017_06_13_000000_create_voyager_templates_table"
     */
    private function addTable(){
        if(!Schema::hasTable('voyager_templates')){
            Schema::create('voyager_templates', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name')->unique();
                $table->string('slug')->unique();
                $table->text('view')->nullable();
                $table->timestamps();
            });
        }
    }


    /**
     * Add BREAD system
     */
    private function addBREAD()
    {
        /**
         * Add DataType
         */
        $dataType = DataType::firstOrNew(['slug' => 'templates']);
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'voyager_templates',
                'display_name_singular' => 'Template',
                'display_name_plural'   => 'Templates',
                'icon'                  => 'voyager-news',
                'model_name'            => 'akazorg\\VoyagerTemplates\\Models\\Templates',
                'controller'            => '',
                'generate_permissions'  => 1,
                'description'           => '',
            ])->save();
        }


        /**
         * Add DataRows
         */
        $this->__addDataRow($dataType->id, 'id', [
            'type'         => 'number',
            'display_name' => 'id',
            'required'     => 1,
            'browse'       => 0,
            'read'         => 0,
            'edit'         => 0,
            'add'          => 0,
            'delete'       => 0,
            'details'      => '',
            'order'        => 1,
        ]);

        $this->__addDataRow($dataType->id, 'name', [
            'type'         => 'text',
            'display_name' => 'Name',
            'required'     => 1,
            'browse'       => 1,
            'read'         => 1,
            'edit'         => 1,
            'add'          => 1,
            'delete'       => 1,
            'details'      => '',
            'order'        => 2,
        ]);

        $this->__addDataRow($dataType->id, 'slug', [
            'type'         => 'text',
            'display_name' => 'slug',
            'required'     => 1,
            'browse'       => 0,
            'read'         => 1,
            'edit'         => 1,
            'add'          => 1,
            'delete'       => 1,
            'details'      => json_encode([
                'slugify' => [
                    'origin' => 'name',
                ],
            ]),
            'order' => 3,
        ]);

        $this->__addDataRow($dataType->id, 'view', [
            'type'         => 'rich_text_box',
            'display_name' => 'body',
            'required'     => 1,
            'browse'       => 0,
            'read'         => 1,
            'edit'         => 1,
            'add'          => 1,
            'delete'       => 1,
            'details'      => '',
            'order'        => 4,
        ]);

        $this->__addDataRow($dataType->id, 'created_at', [
            'type'         => 'timestamp',
            'display_name' => 'created_at',
            'required'     => 1,
            'browse'       => 1,
            'read'         => 1,
            'edit'         => 0,
            'add'          => 0,
            'delete'       => 0,
            'details'      => '',
            'order'        => 5,
        ]);

        $this->__addDataRow($dataType->id, 'updated_at', [
            'type'         => 'timestamp',
            'display_name' => 'updated_at',
            'required'     => 1,
            'browse'       => 0,
            'read'         => 0,
            'edit'         => 0,
            'add'          => 0,
            'delete'       => 0,
            'details'      => '',
            'order'        => 6,
        ]);
    }

    private function __addDataRow($dataTypeId, $field, Array $row)
    {
        $dataRow = DataRow::firstOrNew([
            'data_type_id' => $dataTypeId,
            'field'        => $field
        ]);

        if (!$dataRow->exists) {
            $dataRow->fill($row)->save();
        }
    }
}
