<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <main id="main">
 *
 * @author Matthias Thom | http://upplex.de
 * @package upBootWP 1.1
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/css/bootsy.min.css">
<style>
/* custom for modulaweb */
#home-nav{padding-top:10px}#home-nav img{height:28px;}
</style>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<?php do_action( 'before' ); ?>
	<header id="masthead" class="site-header container" role="banner">
		<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
		
			<div class="container">
				<div class="row">
					<div class="col-md-12">
				        <div class="navbar-header">
				            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
					            <span class="icon-bar"></span>
					            <span class="icon-bar"></span>
					            <span class="icon-bar"></span>
							</button>
				            
				            <a id="home-nav" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"  class="navbar-brand"><?php
				             $img = get_header_image();
				             if ($img == '') {
				             	bloginfo( 'name' ); 
				             } else {
				             	?><img src="<?php echo $img; ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"><?php
				             }
				            ?></a>
				            
				        </div>
						
						<?php 
						$args = array('theme_location' => 'primary', 
									  'container_class' => 'navbar-collapse collapse', 
									  'menu_class' => 'nav navbar-nav',
									  'fallback_cb' => '',
			                          'menu_id' => 'main-menu',
			                          'walker' => new Upbootwp_Walker_Nav_Menu()); 
						wp_nav_menu($args);
						?>
						<script type="text/html" id="social-nav-html">
							<ul id="social-nav" class="nav navbar-nav navbar-right">
								<li><a href="https://twitter.com/Modulaweb" title="Twitter">		<span class="icon-twitter"></span>		<span class="visible-xs"> Twitter</span></a></li>
								<li><a href="http://fb.me/modulaweb" title="Facebook">				<span class="icon-facebook"></span>		<span class="visible-xs"> Facebook</span></a></li>
								<li><a href="https://plus.google.com/+ModulawebFr" title="Google+">	<span class="icon-googleplus"></span>	<span class="visible-xs"> Google+</span></a></li>
								<li><a href="https://github.com/Modulaweb" title="GitHub">			<span class="icon-github"></span>		<span class="visible-xs"> GitHub</span></a></li>
							</ul>
						</script>
					</div><!-- .col-md-12 -->
				</div><!-- row -->
			</div><!-- container -->
		</nav>
		
	</header><!-- #masthead -->

	<div id="content" class="site-content">
