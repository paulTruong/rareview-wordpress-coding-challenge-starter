<?php
/**
 * The main application instance.
 *
 * @package Rareview
 * @subpackage Theme
 */

namespace rareview;

use rareview\PostTypes\PostTypeServiceProvider;
use rareview\Taxonomies\TaxonomyServiceProvider;

/**
 * App class
 */
class App {

	/**
	 * The providers of the application.
	 *
	 * @var array
	 */
	public static array $providers = [
		PostTypeServiceProvider::class,
		TaxonomyServiceProvider::class,
	];

	/**
	 * Boot the app.
	 *
	 * @return void
	 */
	public function __construct() {
		$this->boot();
	}

	/**
	 * Boot all the providers.
	 *
	 * @return void
	 */
	public function boot(): void {
		foreach ( static::$providers as $provider ) {
			new $provider();
		}
	}
}
