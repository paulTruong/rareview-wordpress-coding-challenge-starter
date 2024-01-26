<?php
/**
 * Base taxonomy class.
 *
 * @package Rareview
 * @subpackage Theme
 */

namespace rareview\Taxonomies;

/**
 * Taxonomy class
 */
class Taxonomy {

	/**
	 * The name of the taxonomy.
	 *
	 * @var string
	 */
	public const NAME = '';

	/**
	 * The options of the taxonomy.
	 *
	 * @var array
	 */
	protected array $default_options = [
		'hierarchical'      => true,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'show_in_rest'      => true,
	];

	/**
	 * The labels of the taxonomy.
	 *
	 * @var array
	 */
	protected array $labels = [];

	/**
	 * The options of the taxonomy.
	 *
	 * @var array
	 */
	protected array $options = [];

	/**
	 * The post types to apply the taxonomy to.
	 *
	 * @var array
	 */
	protected array $post_types = [];

	/**
	 * Boot the taxonomy.
	 */
	public function __construct() {
		add_action(
			'init',
			function () {
				$this->register();
				$this->booted();
			}
		);
	}

	/**
	 * Register the custom taxonomy.
	 *
	 * @link https://developer.wordpress.org/reference/functions/register_taxonomy/
	 * @return void
	 */
	public function register(): void {
		register_taxonomy( $this->name(), $this->post_types(), $this->options() );
	}

	/**
	 * Code to run when the taxonomy is booted.
	 *
	 * @return void
	 */
	public function booted(): void {
	}

	/**
	 * Return the name of the taxonomy.
	 *
	 * @return string
	 */
	public function name(): string {
		return static::NAME;
	}

	/**
	 * Return the post types the taxonomy should be applied to.
	 *
	 * @return array
	 */
	public function post_types(): array {
		$post_types = [];

		foreach ( $this->post_types as $post_type ) {
			$post_types[] = $post_type;
		}

		return $post_types;
	}

	/**
	 * Return the options of the taxonomy.
	 *
	 * @return array
	 */
	public function options(): array {
		return array_merge(
			array_merge( $this->default_options, [ 'labels' => $this->labels() ] ),
			$this->options
		);
	}

	/**
	 * The labels for the custom taxonomy.
	 *
	 * @return array
	 */
	protected function labels(): array {
		$plural_label   = $this->plural_label();
		$singular_label = $this->singular_label();

		return [
			'name'              => $plural_label,
			'singular_name'     => $singular_label,
			'all_items'         => sprintf( 'All %s', $plural_label ),
			'add_new_item'      => sprintf( 'Add New %s', $singular_label ),
			'edit_item'         => sprintf( 'Edit %s', $singular_label ),
			'new_item'          => sprintf( 'New %s', $singular_label ),
			'view_item'         => sprintf( 'View %s', $singular_label ),
			'search_items'      => sprintf( 'Search %s', $plural_label ),
			'parent_item'       => sprintf( 'Parent %s', $singular_label ),
			'parent_item_colon' => sprintf( 'Parent %s:', $singular_label ),
		];
	}

	/**
	 * Return the plural label of the taxonomy.
	 *
	 * @return string
	 */
	public function plural_label(): string {
		return $this->labels['plural'] ?? $this->name();
	}

	/**
	 * Return the singular label of the taxonomy.
	 *
	 * @return string
	 */
	public function singular_label(): string {
		return $this->labels['singular'] ?? $this->name();
	}
}
