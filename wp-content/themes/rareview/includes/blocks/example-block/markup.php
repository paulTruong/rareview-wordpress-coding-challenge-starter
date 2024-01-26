<?php
/**
 * Example block markup
 *
 * @package Rareview
 * @subpackage Theme
 *
 * @var array $attributes Block attributes.
 */

$block_title = $attributes['title'] ?? '';

?>
	<div class="example_block">
		<?php if ( $block_title ) : ?>
			<h1 class="customer_reviews__title"><?php echo wp_kses_post( $block_title ); ?></h1>
		<?php endif; ?>
		<div class="example_block__content">
			<p>Example block content</p>
		</div>
	</div>
