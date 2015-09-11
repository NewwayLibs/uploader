<?php namespace Newway\Uploader;

use Illuminate\Support\ServiceProvider;

/**
 * Class ImageneServiceProvider
 * @package Newway\Uploader
 */
class UploaderServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		// merge & publihs config
        $configPath = __DIR__ . '/../../../config/config.php';
        $this->mergeConfigFrom($configPath, 'uploader');
        $this->publishes([$configPath => config_path('uploader.php')]);


        $this->app['uploader'] = $this->app->share(
                function ($app) {
	                $path = $app['config']->get('uploader.path');
	                $scheme = $app['config']->get('uploader.scheme');
                    $hash_levels = $app['config']->get('uploader.hash_levels');
                    return new Uploader($path, $scheme, $hash_levels);
                }
        );
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return [];
	}

}
