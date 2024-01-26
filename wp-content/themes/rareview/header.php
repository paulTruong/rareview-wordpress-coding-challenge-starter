<?php
/**
 * The template for displaying the header.
 *
 * @package Rareview
 * @subpackage Theme
 */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<div class="rv-cursor">
	<div class="rv-cursor__default">
		<span class="start"><?php echo esc_html__( 'Let’s do this!', 'rareview-theme' ); ?></span>
		<span class="pull"><?php echo esc_html__( 'Pull', 'rareview-theme' ); ?></span>
	</div>
	<div class="rv-cursor__button"></div>
</div>
<?php wp_body_open(); ?>
<main id="main" role="main" tabindex="-1">
