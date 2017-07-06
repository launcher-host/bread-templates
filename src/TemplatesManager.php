<?php

namespace akazorg\VoyagerTemplates;

use Illuminate\Support\Facades\File;
use TCG\Voyager\Facades\Voyager;
use akazorg\VoyagerTemplates\Models\Template as VoyagerTemplate;

class TemplatesManager
{
    /**
     * Register Template Handler
     */
    public static function registerTemplateHandler()
    {
        self::checkCache();

        foreach (['read', 'edit-add'] as $view) {
            Voyager::onLoadingView('voyager::bread.'.$view,
                function (&$name, array &$params) use ($view) {
                    self::handle($view, $name, $params);
                }
            );
        }
    }

    /**
     * Handler
     */
    protected static function handle($view, &$name, &$params)
    {
        // Determine the method to call
        $method = ($view === 'read')
                ? 'readRows'
                : isset($params['dataTypeContent']->id) ? 'editRows' : 'addRows';

        // Load dataRows
        $params['dataRows'] = $params['dataType']->{$method};

        // Return the template slug if found on DataRows
        //
        $_template = false;
        $params['dataRows']->first(function ($dataRow) use (&$_template) {
            $_row = json_decode($dataRow->details);
            if (isset($_row->template->slug)) {
                $_template = $_row->template->slug;
                return;
            }
        });

        // BreadTemplate is active
        if ($_template) {
            $name = 'templates::bread.'.$view;
            $params['template'] = $_template;
        }
    }

    /**
     * Delete a single template file from cached.
     *
     * @param string  $name
     * @return void
     */
    public static function deleteFile($name)
    {
        $_file = self::getPath($name);

        if (File::exists($_file)) {
            File::delete($_file);
        }
    }

    /**
     * Ensure all templates are cached.
     *
     * @return void
     */
    public static function checkCache()
    {
        $templates = VoyagerTemplate::all();

        foreach ($templates as $template) {
            $_file = self::getPath($template->slug);

            // ******************************************************
            // We should delete a template file when this is updated/deleted.
            // This way we skip a DB call for checking if the template was modified.
            // ******************************************************
            if (!File::exists($_file) || $template->updated_at->timestamp > File::lastModified($_file)) {
                File::put($_file, $template->view);
            }
        }
    }

    /**
     * Get view file path.
     *
     * @param string  $name
     * @return string
     */
    private static function getPath($name)
    {
        return resource_path('views/vendor/voyager/templates/').$name.'.blade.php';
    }
}
