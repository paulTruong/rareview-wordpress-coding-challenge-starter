<?php
/**
 * Markup for individual book item blocks.
 *
 * @package Rareview
 * @subpackage Theme
 *
 * @var array $attributes Block attributes.
 */

$post_id            = $attributes['id'] ?? '';
$featured_image_url = get_the_post_thumbnail_url( $post_id );
$featured_image_alt = get_post_meta( get_post_thumbnail_id( $post_id ), '_wp_attachment_image_alt', true );
$author_name        = get_post_meta( $post_id, '_rareview_book_author_name', true );
$excerpt            = get_the_excerpt( $post_id );
$title              = get_the_title( $post_id );
?>

<li class="rv-book-block">
	<div class="rv-book-block__meta">
		<p class="rv-book-block__title"><?php echo esc_html( $title ); ?></p>
		<p class="rv-book-block__author-name"><?php echo esc_html( $author_name ); ?></p>
		<?php if ( $featured_image_url ) : ?>
			<img class="rv-book-block__featured-image" src="<?php echo esc_url( $featured_image_url ); ?>" alt="<?php echo esc_attr( $featured_image_alt ); ?>">
		<?php endif; ?>
		<p class="rv-book-block__excerpt"><?php echo esc_html( $excerpt ); ?></p>
	</div>
</li>
