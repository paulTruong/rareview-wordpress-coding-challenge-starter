<?php
/**
 * Book listing block markup. Essentially a wrapper for the book-item blocks.
 *
 * @package Rareview
 * @subpackage Theme
 */

?>
<div class="example_block">
	<ul class="rv-book-listing-block__list">
		<?php echo wp_kses( $content, 'post' ); ?>
	</ul>
</div>
