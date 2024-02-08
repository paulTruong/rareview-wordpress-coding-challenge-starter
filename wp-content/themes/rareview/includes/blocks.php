<?php
/**
 * Gutenberg Blocks setup
 *
 * @package Rareview
 * @subpackage Theme
 */

namespace rareview\Blocks;

use rareview\Utility;

use WP_Block_Type_Registry;

/**
 * Set up blocks
 *
 * @return void
 */
function setup(): void {
	$n = function ( $function ) {
		return __NAMESPACE__ . "\\$function";
	};

	add_action( 'enqueue_block_editor_assets', $n( 'blocks_editor_styles' ) );

	add_action( 'init', $n( 'register_theme_blocks' ) );

	add_action( 'init', $n( 'register_block_pattern_categories' ) );

	add_filter( 'block_categories_all', $n( 'register_block_category' ) );

	add_filter( 'allowed_block_types_all', $n( 'set_allowed_block_types' ), 10, 2 );

	/*
	If you are using the block library, remove the blocks you don't need.

	add_filter( 'ndorh_available_blocks', function ( $blocks ) {
		if ( ! empty( $blocks['integrated-hero'] ) ) {
			unset( $blocks['integrated-hero'] );
		}

		return $blocks;
	} );
	*/
}

/**
 * Automatically registers all blocks that are located within the includes/blocks directory.
 *
 * @return void
 */
function register_theme_blocks(): void {
	global $wp_version;

	$is_pre_wp_6 = version_compare( $wp_version, '6.0', '<' );

	if ( $is_pre_wp_6 ) {
		// Filter the plugins URL to allow us to have blocks in themes with linked assets. i.e editorScripts.
		add_filter( 'plugins_url', __NAMESPACE__ . '\filter_plugins_url', 10, 2 );
	}

	// Register all the blocks in the theme.
	if ( file_exists( RAREVIEW_THEME_BLOCK_DIST_DIR ) ) {
		$block_json_files = glob( RAREVIEW_THEME_BLOCK_DIST_DIR . '*/block.json' );

		// auto register all blocks that were found.
		foreach ( $block_json_files as $filename ) {

			$block_folder = dirname( $filename );

			$block_options = [];

			$markup_file_path = $block_folder . '/markup.php';
			if ( file_exists( $markup_file_path ) ) {

				// only add the render callback if the block has a file called markdown.php in it's directory.
				$block_options['render_callback'] = function ( $attributes, $content, $block ) use ( $block_folder ) {

					// create helpful variables that will be accessible in markup.php file.
					$context = $block->context;

					// get the actual markup from the markup.php file.
					ob_start();
					// phpcs:disable
					include $block_folder . '/markup.php';
					// phpcs:enable
					return ob_get_clean();
				};
			};

			register_block_type_from_metadata( $block_folder, $block_options );
		};
	};

	if ( $is_pre_wp_6 ) {
		// Remove the filter after we register the blocks.
		remove_filter( 'plugins_url', __NAMESPACE__ . '\filter_plugins_url', 10, 2 );
	}
}

/**
 * Filter the plugins_url to allow us to use assets from theme.
 *
 * @param string $url  The plugins url.
 * @param string $path The path to the asset.
 *
 * @return string The overridden url to the block asset.
 */
function filter_plugins_url( string $url, string $path ): string {
	$file = preg_replace( '/\.\.\//', '', $path );
	return trailingslashit( get_stylesheet_directory_uri() ) . $file;
}


/**
 * Enqueue editor-only JavaScript/CSS for blocks.
 *
 * @return void
 */
function blocks_editor_styles(): void {
	wp_enqueue_style(
		'editor-style-overrides',
		RAREVIEW_THEME_TEMPLATE_URL . '/dist/css/editor-style-overrides.css',
		[],
		Utility\get_asset_info( 'editor-style-overrides', 'version' )
	);

	if ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) {
		wp_enqueue_script(
			'editor-style-overrides',
			RAREVIEW_THEME_TEMPLATE_URL . '/dist/js/editor-style-overrides.js',
			Utility\get_asset_info( 'editor-style-overrides', 'dependencies' ),
			Utility\get_asset_info( 'editor-style-overrides', 'version' ),
			true
		);
	}
}

/**
 * Register block pattern categories
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-patterns/
 *
 * @return void
 */
function register_block_pattern_categories(): void {

	// Register a block pattern category.
	register_block_pattern_category(
		'rareview',
		[ 'label' => __( 'Rareview', 'rareview-theme' ) ]
	);
}

/**
 * Add rareview block category.
 *
 * @param array $categories The existing block categories.
 * @return array
 */
function register_block_category( array $categories ): array {
	array_unshift(
		$categories,
		[
			'slug'  => 'rareview',
			'title' => 'rareview',
		]
	);

	return $categories;
}

/**
 * Set what post types certains blocks can be used.
 *
 * @param array|true $allowed_blocks Currently allowed blocks. True means all blocks are allowed.
 * @param object     $editor_context The editor context object.
 * @return array
 */
function set_allowed_block_types( $allowed_blocks, $editor_context ) {
	// Get all registered blocks.
	$blocks = array_keys( WP_Block_Type_Registry::get_instance()->get_all_registered() );

	// Make everyblock available on 'posts'
	if ( 'post' === $editor_context->post->post_type ) {
		return $allowed_blocks;
	}

	// Remove the book-listing block for all other post types
	// array_diff will return a new array with all the values from $blocks except for 'rareview/book-listing'.
	// i.e it will remove 'rareview/book-listing' from the array and return all other blocks.
	$allowed = array_diff( $blocks, [ 'rareview/book-listing' ] );

	return array_values( $allowed );
}
