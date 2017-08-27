<?php

namespace App\Providers\Feature;
use App\Model\Feature;
use Illuminate\Support\ServiceProvider;
class FeatureServiceProvider extends ServiceProvider
{
    protected $defer = true;
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Providers\Feature\FeatureService',function ($app){
            $featureModel = new Feature();
            $cachedService = new CachedFeatureService($featureModel);
            return $cachedService;
        });
    }

    public function provides()
    {
        return ['App\Providers\Feature\FeatureService'];
    }
}
