<?php namespace Newway\Imagene;

use Illuminate\Support\ServiceProvider;

/**
 * Class ImageneServiceProvider
 * @package Newway\Imagene
 */
class ImageneServiceProvider extends ServiceProvider {

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
        $this->mergeConfigFrom($configPath, 'imagene');
        $this->publishes([$configPath => config_path('imagene.php')]);


        // init theme with default finder
        /*$this->app['imagene'] = $this->app->share(
                function ($app) {

                    return new Imagene();
                }
        );*/

        $this->app['imagene_uploader'] = $this->app->share(
                function ($app) {
	                $path = $app['config']->get('imagene.uploader.path');
	                $scheme = $app['config']->get('imagene.uploader.scheme');
                    $hash_levels = $app['config']->get('imagene.uploader.hash_levels');
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
