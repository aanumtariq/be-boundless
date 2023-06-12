<?php

namespace App\Providers;

use App\Models\category;
use App\Models\m_flag;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
    public static function getConfig()
    {
        $config = m_flag::where('is_config', 1)->get();
        $data = array();
        foreach ($config as $con) {
            $data[$con->flag_type] = $con->flag_value;
        }
        return $data;
    }
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        View()->share('config', $this->getConfig());      
    }
}
