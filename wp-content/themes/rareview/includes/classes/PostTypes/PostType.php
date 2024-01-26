<?php
/**
 * Base post type class.
 *
 * @package Rareview
 * @subpackage Theme
 */

namespace rareview\PostTypes;

/**
 * PostType Class
 */
class PostType {

	/**
	 * The common prefix for the meta keys name.
	 *
	 * @var string
	 */
	public const META_KEY_PREFIX = '_rareview_';

	/**
	 * The name of the post type.
	 *
	 * @var string
	 */
	public const NAME = '';


	/**
	 * The singular label of the post type.
	 *
	 * @var string
	 */
	public const SINGULAR_LABEL = '';

	/**
	 * The name of the order column name used by the OrderablePostType trait.
	 *
	 * @var string
	 */
	public const ORDER_COLUMN_NAME = 'order';

	/**
	 * The plural label of the post type.
	 *
	 * @var string
	 */
	public const PLURAL_LABEL = '';

	/**
	 * The options of the post type.
	 *
	 * @var array
	 */
	protected array $default_options = [
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'show_in_rest'       => true,
		'supports'           => [ 'title', 'editor', 'thumbnail', 'custom-fields', 'revisions', 'author' ],
		'show_in_graphql'    => true,
	];

	/**
	 * The options of the post type.
	 *
	 * @var array
	 */
	protected array $options = [];

	/**
	 * The post meta fields of the post type.
	 *
	 * @var array
	 */
	protected array $post_meta = [];

	/**
	 * Boot the post type.
	 */
	public function __construct() {
		add_action(
			'init',
			function () {
				$this->register();
				$this->register_post_meta();
				$this->booted();
			}
		);

		add_action(
			'admin_init',
			function () {
				$this->admin_booted();
			}
		);
	}

	/**
	 * Register the custom post type.
	 *
	 * @link https://developer.wordpress.org/reference/functions/register_post_type/
	 *
	 * @return void
	 */
	public function register(): void {
		register_post_type( $this->name(), $this->options() );
	}

	/**
	 * Register the post meta of the post type.
	 *
	 * @return void
	 */
	public function register_post_meta(): void {
		foreach ( $this->post_meta as $meta_key => $meta_args ) {
			if ( '_' === $meta_key[0] ) {
				if ( 'boolean' === $meta_args['type'] ) {
					$meta_args['sanitize_callback'] = static function ( $value ) {
						return $value && (bool) $value;
					};
				}
				/** @noinspection SlowArrayOperationsInLoopInspection */ // phpcs:ignore
				$meta_args = array_merge(
					$meta_args,
					[
						'auth_callback' => function () {
							return current_user_can( 'edit_posts' );
						},
					]
				);
			}

			register_post_meta( $this->name(), $meta_key, $meta_args );
		}
	}

	/**
	 * Code to run when the post type is booted.
	 *
	 * @return void
	 */
	public function booted(): void {

	}

	/**
	 * Code to run only for admin when the post type is booted.
	 *
	 * @return void
	 */
	public function admin_booted(): void {

	}

	/**
	 * Return the options of the post type.
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
	 * The labels for the custom post type.
	 *
	 * @return array
	 */
	protected function labels(): array {
		$plural_label   = $this->plural_label();
		$singular_label = $this->singular_label();

		return [
			'name'               => $plural_label,
			'singular_name'      => $singular_label,
			'all_items'          => sprintf( 'All %s', $plural_label ),
			'add_new_item'       => sprintf( 'Add New %s', $singular_label ),
			'edit_item'          => sprintf( 'Edit %s', $singular_label ),
			'new_item'           => sprintf( 'New %s', $singular_label ),
			'view_item'          => sprintf( 'View %s', $singular_label ),
			'search_items'       => sprintf( 'Search %s', $plural_label ),
			'not_found'          => sprintf( 'No %s found.', strtolower( $plural_label ) ),
			'not_found_in_trash' => sprintf( 'No %s found in Trash.', strtolower( $plural_label ) ),
			'parent_item_colon'  => sprintf( 'Parent %s:', $plural_label ),
		];
	}

	/**
	 * Return the plural label of the post type.
	 *
	 * @return string
	 */
	public function plural_label(): string {
		return static::PLURAL_LABEL ?? $this->name();
	}

	/**
	 * Return the singular label of the post type.
	 *
	 * @return string
	 */
	public function singular_label(): string {
		return static::SINGULAR_LABEL ?? $this->name();
	}

	/**
	 * Return the name of the post type.
	 *
	 * @return string
	 */
	public function name(): string {
		return static::NAME;
	}

	/**
	 * Insert a value or key/value pair after a specific key in an array. If key doesn't exist, value is appended
	 * to the end of the array.
	 *
	 * @param array  $array The array to insert into.
	 * @param string $key  The key to insert after.
	 * @param array  $new An array of values to insert.
	 *
	 * @return array
	 */
	protected function array_insert_after( array $array, string $key, array $new ): array {
		$keys  = array_keys( $array );
		$index = array_search( $key, $keys, true );
		$pos   = false === $index ? count( $array ) : $index + 1;

		return array_merge( array_slice( $array, 0, $pos ), $new, array_slice( $array, $pos ) );
	}
}
