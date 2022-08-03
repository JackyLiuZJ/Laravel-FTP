<?php namespace JackyLiu\Ftp;

use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\AliasLoader;

class FtpServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../../config/config.php' => config_path('ftp.php'),
        ]);
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('ftp', function ($app) {
            $return = $app->make('JackyLiu\Ftp\FtpManager');

            return $return;
        });

        $this->app->booting(function () {
            $loader = AliasLoader::getInstance();
            $loader->alias('Madzipper', 'JackyLiu\Ftp\Facades\Ftp');
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['ftp'];
    }
}
