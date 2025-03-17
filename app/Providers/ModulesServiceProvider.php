<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ModulesServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     * @throws \Exception
     */
    public function boot(): void
    {
        // Đường dẫn tới thư mục chứa các module của bạn
        $modulesPath = base_path('modules');

        // Quét và load tất cả các module từ thư mục modules
        $modules = $this->getModules($modulesPath);

        foreach ($modules as $module) {
            // Nạp các files nếu có
            $this->loadModuleFiles($module);

            // Đăng ký providers nếu có
            $this->registerModuleProviders($module);

            // Nạp các routes, views, config từ module
            $this->registerModuleResources($module);
        }
    }

    /**
     * Get all modules from the folder.
     */
    private function getModules(string $path): array
    {
        $modules = [];
        foreach (scandir($path) as $folder) {
            $modulePath = $path . DIRECTORY_SEPARATOR . $folder;

            // Kiểm tra xem folder có module.json không
            if (is_dir($modulePath) && file_exists($modulePath . '/module.json')) {
                $modules[] = json_decode(file_get_contents($modulePath . '/module.json'));
            }
        }

        // Sắp xếp module theo thứ tự (order)
        usort($modules, function ($a, $b) {
            return $a->priority <=> $b->priority;
        });
        return $modules;
    }

    /**
     * Load all files defined in module.json.
     */
    private function loadModuleFiles($module): void
    {
        if (isset($module->files)) {
            foreach ($module->files as $file) {
                $filePath = base_path("modules/{$module->name}/{$file}");

                if (file_exists($filePath)) {
                    require_once $filePath;
                }
            }
        }
    }

    /**
     * Register all providers defined in module.json.
     */
    private function registerModuleProviders($module): void
    {
        if (isset($module->providers) && !is_array($module->providers)) {
            $module->providers = [$module->providers];
        }
        if (isset($module->providers)) {
            foreach ($module->providers as $provider) {
                if (!class_exists($provider)) {
                    throw new \Exception("Provider không tồn tại hoặc không hợp lệ: ".$provider);
                } else {
                    $this->app->register($provider);
                }
            }
        }
    }

    /**
     * Register routes, views and configs of a module.
     */
    private function registerModuleResources($module): void
    {
        $modulePath = base_path("modules/{$module->name}");

        // Nạp Routes
        if (file_exists($modulePath . '/Routes/web.php')) {
            $this->loadRoutesFrom($modulePath . '/Routes/web.php');
        }

        // Nạp Views
        if (is_dir($modulePath . '/Resources/views')) {
            $this->loadViewsFrom($modulePath . '/Resources/views', $module->alias);
        }

        // Nạp Config
        if (is_dir($modulePath . '/Config')) {
            foreach (scandir($modulePath . '/Config') as $configFile) {
                if (pathinfo($configFile, PATHINFO_EXTENSION) === 'php') {
                    $this->mergeConfigFrom(
                        $modulePath . '/Config/' . $configFile,
                        $module->alias
                    );
                }
            }
        }

        // Nạp Migrations
        if (is_dir($modulePath . '/Migrations')) {
            $this->loadMigrationsFrom($modulePath . '/Migrations');
        }
    }
}
