<?php
/**
 *
 * @author Jean-François Vial | modulaweb.fr
 * @package upBootWP 1.1
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php wp_title( '|', true, 'right' ); ?></title>
<meta name="description" content="Modulaweb - Web, OpenSource, OpenData | Développement web, Accompagnement, Formation">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<meta name="alexaVerifyID" content="OBYJuPjjkiycuJRI9zB8uwFaoCs" />

<link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo get_template_directory_uri(); ?>/apple-touch-icon-114x114-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo get_template_directory_uri(); ?>/apple-touch-icon-72x72-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="57x57" href="<?php echo get_template_directory_uri(); ?>/apple-touch-icon-57x57-precomposed.png">
<link rel="apple-touch-icon-precomposed" href="<?php echo get_template_directory_uri(); ?>/apple-touch-icon-precomposed.png">
<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/apple-touch-icon.png">
<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico">
<link rel="alternate" type="application/rss+xml" title="RSS" href="<?php bloginfo('rss2_url'); ?>">
<link rel="alternate" type="application/atom+xml" title="Atom" href="<?php bloginfo('atom_url'); ?>">
<?php wp_head(); ?>
<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/css/bootsy.min.css">
<style>
/* custom for modulaweb */
@font-face {
    font-family: 'exo_2.0semi_bold';
    src: url('<?php echo get_stylesheet_directory_uri(); ?>/fonts/exo2/Exo2.0-SemiBold-webfont.eot');
    src: url('<?php echo get_stylesheet_directory_uri(); ?>/fonts/exo2/Exo2.0-SemiBold-webfont.eot?#iefix') format('embedded-opentype'),
         url('<?php echo get_stylesheet_directory_uri(); ?>/fonts/exo2/Exo2.0-SemiBold-webfont.woff') format('woff'),
         url('<?php echo get_stylesheet_directory_uri(); ?>/fonts/exo2/Exo2.0-SemiBold-webfont.ttf') format('truetype'),
         url('<?php echo get_stylesheet_directory_uri(); ?>/fonts/exo2/Exo2.0-SemiBold-webfont.svg#exo_2.0semi_bold') format('svg');
    font-weight: normal;
    font-style: normal;
}
@font-face {
    font-family: 'socialico';
    src: url('<?php echo get_stylesheet_directory_uri(); ?>/fonts/socialico/socialico-webfont.eot');
    src: url('<?php echo get_stylesheet_directory_uri(); ?>/fonts/socialico/socialico-webfont.eot?#iefix') format('embedded-opentype'),
         url('<?php echo get_stylesheet_directory_uri(); ?>/fonts/socialico/socialico-webfont.woff') format('woff'),
         url('<?php echo get_stylesheet_directory_uri(); ?>/fonts/socialico/socialico-webfont.ttf') format('truetype'),
         url('<?php echo get_stylesheet_directory_uri(); ?>/fonts/socialico/socialico-webfont.svg#SocialicoRegular') format('svg');
    font-weight: normal;
    font-style: normal;
}
#main-logo{background:url('<?php echo get_stylesheet_directory_uri(); ?>/images/modulaweb-web-open-source-open-data.png') center center no-repeat;background-size:contain;width:430px;height:370.67px;position:absolute;margin:0;padding:0;}
#slogan{width:470px;font-family:'exo_2.0semi_bold';font-size:37px;color:rgb(126,126,126);}
#home-nav{width:230px;padding-right:0;padding-left:0}
.navbar-toggle{margin-right:0}
body{background:#cbcbcb url('<?php echo get_stylesheet_directory_uri(); ?>/images/body-bg.jpg') center center repeat;}
@media (max-width: 767px){#social-nav .visible-xs {display: inline-block!important;}}
</style>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<?php do_action( 'before' ); ?>
	<nav class="navbar navbar-inverse navbar-fixed-bottom" role="navigation">
	
		<div class="container">
			<div class="row">
				<div class="col-md-12">
			        <div class="navbar-header">
			            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
				            <span class="icon-bar"></span>
				            <span class="icon-bar"></span>
				            <span class="icon-bar"></span>
						</button>  
						<a id="home-nav" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"  class="navbar-brand visible-xs">
							<span class="one" style="display:none">Web</span> <span class="two" style="display:none">OpenSource</span> <span class="three" style="display:none">OpenData</span>
						</a>					
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

	<div id="content" class="site-content">
		<h1 id="main-logo" class="text-hide" style="display:none;">Modulaweb</h1>
		<div id="slogan" class="hidden-xs">
			<span class="one" style="display:none">Web</span> <span class="two" style="display:none">OpenSource</span> <span class="three" style="display:none">OpenData</span>
		</div>
	</div><!-- #content -->
</div><!-- #page -->

<?php wp_footer(); ?>
<script>
	$(function(){
		jQuery.fn.centerH = function (dleft) {
		    var left = Math.max(0, (($(window).width() - $(this).outerWidth()) / 2) + $(window).scrollLeft());
		    if (dleft) left += dleft;
		    this.css({
		    	'position': 'absolute'
		    	, 'left': left + 'px'
		    });
		    return this;
		}
		jQuery.fn.center = function (dtop,dleft) {
		    var top = Math.max(0, (($(window).height() - $(this).outerHeight()) / 2) + $(window).scrollTop());
		    if (dtop) top += dtop;
		    this.centerH(dleft);
		    this.css({
		    	'top': top + 'px'
		    });
		    return this;
		}
		var $mainLogo = $('#main-logo');
		var $slogan = $('#slogan');
		var $homeNav = $('#home-nav');
		var setPos = function() {
			$mainLogo.css('max-width', $(window).width() - 20);
			$mainLogo.css('max-height', $(window).height() - ($('#page nav').height() * 2 + 20));
			$mainLogo.center(-($('#page nav').height()));
			$slogan.center($mainLogo.outerHeight() / 2);
			$homeNav.centerH();
		}
		$(window).resize(setPos);
		setPos();
		$('#main-menu').parent().append($('#social-nav-html').html());
		window.setTimeout(function() {
			$mainLogo.fadeIn(400);
		}, 200);
		window.setTimeout(function() {
			$('.one').fadeIn(400, function(){
				window.setTimeout(function() {
					$('.two').fadeIn(400, function(){
						window.setTimeout(function() {
							$('.three').fadeIn(400);
						}, 400);
					});
				}, 400);
			});
		}, 1000);
	});
</script>
</body>
</html>