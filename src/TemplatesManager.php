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
        // Determine the method to call (read/addRows/editRows)
        $method = ($view === 'read') ? 'readRows' : isset($params['dataTypeContent']->id) ? 'editRows' : 'addRows';

        // Load dataRows, it will be returned to the view
        $params['dataRows'] = $params['dataType']->{$method};

        /**
         * Check if template exist on the dataRows.
         */
        // Template slug
        $slug = false;

        // Find for any row with an empty stack, to help build the UI.
        $fullWithRow = false;

        // This is ugly, but works :O
        foreach ($params['dataRows'] as $row) {
            $opt = json_decode($row->details);
            if (isset($opt->template->slug)) {
                $slug = $opt->template->slug;
            }
            if (!isset($opt->template->stack)) {
                $fullWithRow = true;
            }
        }
        if ($slug) {
            $name = 'templates::bread.'.$view;
            $params['template'] =  (object) [
                'slug' => $slug,
                'fullWithRow' => $fullWithRow,
            ];
        }
    }

    /**
     * Delete a single template file from cache.
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
            // When we add/edit/delete a template, the cache file should be deleted.
            // The next time it's requested, it will be generated, and this we skip
            // the DB query for checking if the template was modified.
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
