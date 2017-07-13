<?php

namespace VoyagerTemplates;

use VoyagerTemplates\Models\Template;
use Illuminate\Support\Facades\File;
use TCG\Voyager\Facades\Voyager;

class TemplatesManager
{
    protected $path = '';

    public function __construct()
    {
        $this->path = resource_path('views/vendor/voyager/templates');
    }

    /**
     * Register Template Handler.
     */
    public function registerTemplateHandler()
    {
        $this->ensureCacheFolder();

        $this->checkCache();

        /*
         * Event listener for Voyager view request
         */
        foreach (['read', 'edit-add'] as $view) {
            Voyager::onLoadingView('voyager::bread.'.$view,
                function (&$name, array &$params) use ($view) {
                    $this->handle($view, $name, $params);
                }
            );
        }
    }

    /**
     * Handle Template Request.
     *
     * @param string $view    Requested view
     * @param string &$name   Name of the view to be opened
     * @param array  &$params View parameters
     *
     * @return void
     */
    protected function handle($view, &$name, &$params)
    {
        // Determine the method to call (read/addRows/editRows)
        $method = ($view === 'read') ? 'readRows' : isset($params['dataTypeContent']->id) ? 'editRows' : 'addRows';

        // Load dataRows, it will be returned to the view
        $params['dataRows'] = $params['dataType']->{$method};

        /**
         * Check for a template defined on the dataRows.
         */
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
            $params['template'] = (object) [
                'slug'        => $slug,
                'fullWithRow' => $fullWithRow,
            ];
        }
    }

    /**
     * When a template is modified (saved/deleted) we delete the cache file.
     *
     * @param Template $template
     *
     * @return void
     */
    public static function templateModified(Template $template)
    {
        $_file = $this->getPath($template->slug);

        if (File::exists($_file)) {
            File::delete($_file);
        }
    }

    /**
     * Ensure all templates are cached.
     *
     * @return void
     */
    public function checkCache()
    {
        $templates = Template::all();

        foreach ($templates as $template) {
            $_file = $this->getPath($template->slug);

            if (!File::exists($_file)) {
                File::put($_file, $template->view);
            }
        }
    }

    /**
     * Get view file path.
     *
     * @param string $name
     *
     * @return string
     */
    private function getPath($name)
    {
        return resource_path('views/vendor/voyager/templates/').$name.'.blade.php';
    }

    /**
     * Ensure the cache folder exists.
     *
     * @return void
     */
    private function ensureCacheFolder()
    {
        if (!File::exists($this->path)) {
            File::makeDirectory($this->path, 0775, true);
        }
    }
}
