<?php namespace Origami\Permissions;

use Illuminate\Support\ServiceProvider;

class PermissionsServiceProvider extends ServiceProvider {

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
        $this->app->singleton('Origami\Permissions\Acl', function($app) {
            return new Acl($app['Origami\Permissions\Acl\ZendAclAdapter']);
        });

        $this->app->bind('acl', 'Origami\Permissions\Acl');

        $this->app['router']->filter('acl', 'Origami\Permissions\AclFilter');
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array('acl');
	}

}
