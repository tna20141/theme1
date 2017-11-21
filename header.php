<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package theme1
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<link href="https://fonts.googleapis.com/css?family=Bangers|Open+Sans" rel="stylesheet">
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site <?php
// $__post_count = $wp_query->post_count;

// pages with excerpts (index, search, topics, tags, series) have a different style
if (is_home() || is_search() || is_tax('series') || is_tax('topic') || is_tag()):
// if (is_singular('post') || is_page()):
	echo 'site-color';
else:
	echo 'site-color-single';
endif;
?>">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'theme1' ); ?></a>

	<header id="masthead" class="site-header header-fixed">

		<nav id="site-navigation" class="main-navigation">
			<div class="site-branding">
				<p class="logo-header">
				<?php
					the_custom_logo();
				?>
				</p>
			</div>
			<!-- <button class="menu&#45;toggle" aria&#45;controls="primary&#45;menu" aria&#45;expanded="false"><?php esc_html_e( 'Primary Menu', 'theme1' ); ?></button> -->
			<?php
				wp_nav_menu( array(
					'theme_location'  => 'menu-1',
					'menu_id'         => 'primary-menu',
					'menu_class'      => 'header-menu-item',
					'container_class' => 'header-menu',
				) );
			?>
		</nav><!-- #site-navigation -->
	</header><!-- #masthead -->

	<div id="content" class="site-content site-inner">
