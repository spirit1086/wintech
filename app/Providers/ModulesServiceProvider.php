<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ModulesServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //получаем список модулей, которые надо подгрузить
	    $modules = config("modules.modules");

        if($modules)
	    {
	        foreach($modules as $module)
                {
                    if(file_exists(app_path().'/Modules/'.$module.'/Routes/routes.php'))
                    {
                        $this->loadRoutesFrom(app_path().'/Modules/'.$module.'/Routes/routes.php');
                    }

                    if(is_dir(app_path().'/Modules/'.$module.'/Views'))
                    {
                        $this->loadViewsFrom(app_path().'/Modules/'.$module.'/Views', $module);
                    }

                    if(is_dir(app_path().'/Modules/'.$module.'/Migrations'))
                    {
                        $this->loadMigrationsFrom(app_path().'/Modules/'.$module.'/Migrations');
                    }

                    if(is_dir(app_path().'/Modules/'.$module.'/Langs'))
                    {
                         $this->loadTranslationsFrom(app_path().'/Modules/'.$module.'/Langs', $module);
                    }
                }
         }
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
