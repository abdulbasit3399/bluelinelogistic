<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Touhidurabir\StubGenerator\Facades\StubGenerator;

class WidgetCreate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:widget {class} {--module=} {--force}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create new widget to show in any sidebar in frontend.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        if (check_module('widget')) {
            $className = ucfirst($this->argument('class'));
            $classNameLower = strtolower($this->argument('class'));
            $moduleName = ucfirst($this->option('module'));
            $moduleNameLower = strtolower($this->option('module'));
            $replace = $this->option('force') ? true : false;
            $moduleViewPath = '';
            $classPath = "Widgets";
            $viewShortPath = '';
            if ($moduleName) {
                $classPath = "Modules/{$moduleName}/" . $classPath;
                $namespace = $classPath;
                $moduleViewPath = $moduleNameLower . '::';
                $viewShortPath = "Modules/{$moduleName}/Resources/views/widgets/{$classNameLower}";
                $viewPath = module_path($moduleName, "Resources/views/widgets/{$classNameLower}");
            } else {
                $namespace = 'App/' . $classPath;
                $classPath = 'app/' . $classPath;
                $viewShortPath = "resources/views/widgets/{$classNameLower}";
                $viewPath = resource_path("views/widgets/{$classNameLower}");
            }
    
            // create class
            StubGenerator::from(app_path('Core/Widget/stubs/widget.stub'), true)
            ->to(base_path($classPath), true, true) // the second argument **true** specify to generated path if not exists
            ->as($className)
            ->withReplacers([
                'namespace' => str_replace('/', '\\', $namespace),
                'class' => $className,
                'widgetViewName' => $classNameLower,
                'moduleViewPath' => $moduleViewPath
            ])
            ->replace($replace) // instruct to replace if already exists at the give path
            ->save();
    
            // create view
            File::ensureDirectoryExists($viewPath);
            // form
            $viewPathForm = "{$viewPath}/form.blade.php";
            $viewPathView = "{$viewPath}/view.blade.php";
            if ($replace == true || (!File::exists($viewPathForm) && $replace == false)) {
                File::put($viewPathForm, $this->formBlade($classNameLower));
            }
            if ($replace == true || (!File::exists($viewPathView) && $replace == false)) {
                File::put($viewPathView, $this->viewBlade($classNameLower));
            }
            $this->info("Widget class found it in path -> '{$classPath}'");
            $this->info("Widget blade files found it in path -> '{$viewShortPath}'");
        } else {
            $this->info("Widget module is not installed.");
        }
    }


    private function formBlade($widget_name)
    {
        return "<form class=\"{$widget_name}-widget\">\n\r</form>";
    }


    private function viewBlade($widget_name)
    {
        return "<section class=\"{$widget_name}-widget\">\n\r</section>";
    }
}
