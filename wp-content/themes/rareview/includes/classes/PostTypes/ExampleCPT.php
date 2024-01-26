<?php
/**
 * RV custom post type.
 *
 * @package Rareview
 */

namespace rareview\PostTypes;

/**
 * Example post type class.
 */
class ExampleCPT extends PostType {

	/**
	 * The name of the post type.
	 *
	 * @var string
	 */
	public const NAME = 'example_cpt';

	/**
	 * The singular label of the post type.
	 *
	 * @var string
	 */
	public const SINGULAR_LABEL = 'Example CPT';

	/**
	 * The plural label of the post type.
	 *
	 * @var string
	 */
	public const PLURAL_LABEL = 'Example CPT';

	public const EXAMPLE_CPT_EXAMPLE_META_KEY = self::META_KEY_PREFIX . self::NAME . '_example_meta';

	/**
	 * The options of the post type.
	 *
	 * @var array
	 */
	protected array $options = [
		'menu_position' => 25,
		'menu_icon'     => 'dashicons-hammer',
		'rewrite'       => [
			'slug' => 'example-cpts',
		],
		'supports'      => [
			'title',
			'editor',
			'custom-fields',
			'thumbnail',
			'author',
			'revisions',
			'page-attributes',
		],
	];

	/**
	 * The post meta fields of the post type.
	 *
	 * @var array
	 */
	protected array $post_meta = [
		self::EXAMPLE_CPT_EXAMPLE_META_KEY => [
			'show_in_rest'      => true,
			'single'            => true,
			'description'       => 'Example Meta Key.',
			'type'              => 'string',
			'sanitize_callback' => 'sanitize_text_field',
		],
	];

	/**
	 * Code to run when the post type is booted.
	 *
	 * @link https://developer.wordpress.org/reference/hooks/save_post_post-post_type/
	 *
	 * @return void
	 */
	public function booted(): void {
	}
}
