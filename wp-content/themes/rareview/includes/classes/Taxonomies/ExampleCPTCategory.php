<?php
/**
 * RV Category custom taxonomy.
 *
 * @package Rareview
 */

namespace rareview\Taxonomies;

use rareview\PostTypes\ExampleCPT;

/**
 * ExampleCPTCategory class
 */
class ExampleCPTCategory extends Taxonomy {

	/**
	 * The name of the taxonomy.
	 *
	 * @var string
	 */
	public const NAME = 'example_cpt_category';

	/**
	 * The labels of the taxonomy.
	 *
	 * @var array
	 */
	protected array $labels = [
		'plural'   => 'Category',
		'singular' => 'Categories',
	];

	/**
	 * The post types to apply the taxonomy to.
	 *
	 * @var array
	 */
	protected array $post_types = [
		ExampleCPT::NAME,
	];

	/**
	 * Booted
	 *
	 * @return void
	 */
	public function booted(): void {
	}
}
