<?php
/**
 * The main template file
 *
 * @package Rareview
 * @subpackage Theme
 */

get_header(); ?>
<?php if ( have_posts() ) : ?>
	<?php while ( have_posts() ) : the_post(); // phpcs:ignore Squiz.ControlStructures.ControlSignature.NewlineAfterOpenBrace ?>
		<?php the_content(); ?>
	<?php endwhile; ?>
<?php endif; ?>
<?php
get_footer();
