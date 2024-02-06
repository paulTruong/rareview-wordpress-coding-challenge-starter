<?php
/**
 * RV custom post type.
 *
 * @package Rareview
 */

namespace rareview\PostTypes;

/**
 * Book post type class.
 */
class BookCPT extends PostType {

	/**
	 * The name of the post type.
	 *
	 * @var string
	 */
	public const NAME = 'book';

	/**
	 * The singular label of the post type.
	 *
	 * @var string
	 */
	public const SINGULAR_LABEL = 'Book';

	/**
	 * The plural label of the post type.
	 *
	 * @var string
	 */
	public const PLURAL_LABEL = 'Books';

	public const BOOK_AUTHOR_NAME_META_KEY = self::META_KEY_PREFIX . self::NAME . '_author_name';

	/**
	 * The options of the post type.
	 *
	 * @var array
	 */
	protected array $options = [
		'menu_position' => 25,
		'menu_icon'     => 'dashicons-book',
		'rewrite'       => [
			'slug' => 'books',
		],
		'supports'      => [
			'title',
			'editor',
			'custom-fields',
			'thumbnail',
			'author',
			'revisions',
			'page-attributes',
			'excerpt',
		],
	];

	/**
	 * The post meta fields of the post type.
	 *
	 * @var array
	 */
	protected array $post_meta = [
		self::BOOK_AUTHOR_NAME_META_KEY => [
			'show_in_rest'      => true,
			'single'            => true,
			'description'       => 'Author Name.',
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
