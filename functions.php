<?php
/**
 *
 * @author Matthias Thom | http://upplex.de
 * @author Jean-François Vial | http://modulaweb.fr
 * @package upBootWP 1.1
 */

define (TPL_DIR, get_template_directory());

if (!isset($content_width)) $content_width = 770;

/**
 * upbootwp_setup function.
 * 
 * @access public
 * @return void
 */
function upbootwp_setup() {

	require 'inc/general/class-Upbootwp_Walker_Nav_Menu.php';

	load_theme_textdomain('upbootwp', TPL_DIR.'/languages');

	add_theme_support( 'automatic-feed-links' );

	/**
	 * Enable support for Post Thumbnails on posts and pages
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	//add_theme_support( 'post-thumbnails' );

	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'Bootstrap WP Primary' ),
	) );

	/**
	 * Enable support for Post Formats
	 */
	add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );

	/**
	 * Setup the WordPress core custom background feature.
	 */
	add_theme_support( 'custom-background', apply_filters( 'upbootwp_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	)));

	/**
	 *	Setup the WordPress core custom header feature : will be used as logo in nav bar
	 */
	add_theme_support( 'custom-header' );
	
}

add_action( 'after_setup_theme', 'upbootwp_setup' );

/**
 * Register widgetized area and update sidebar with default widgets
 */
function upbootwp_widgets_init() {
	register_sidebar(array(
		'name'          => __('Sidebar','upbootwp'),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget well well-sm %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	));
	register_sidebar(array(
		'name'          => __('Footer 1','upbootwp'),
		'id'            => 'footer-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	));
	register_sidebar(array(
		'name'          => __('Footer 2','upbootwp'),
		'id'            => 'footer-2',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	));
	register_sidebar(array(
		'name'          => __('Footer 3','upbootwp'),
		'id'            => 'footer-3',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	));
}
add_action( 'widgets_init', 'upbootwp_widgets_init' );

function upbootwp_scripts() {
	wp_enqueue_style( 'upbootwp-css', get_template_directory_uri().'/css/upbootwp.min.css', array(), '1.1');
	wp_enqueue_script( 'upbootwp-jQuery', get_template_directory_uri().'/js/jquery.js',array(),'2.0.3',true);
	wp_enqueue_script( 'upbootwp-basefile', get_template_directory_uri().'/js/bootstrap.min.js',array(),'1.1',true);
}
/*
// removed because of the plugin use
add_action( 'wp_enqueue_scripts', 'upbootwp_scripts' );
*/

/**
 * upbootwp_less function.
 * Load less for development or even on the running website. If you want to use less just enable this function
 * @access public
 * @return void
 */
function upbootwp_less() {
	printf('<link rel="stylesheet" type="text/less" href="%s" />', get_template_directory_uri().'/less/bootstrap.less?ver=1.1'); // raus machen :) 
	printf('<script type="text/javascript" src="%s"></script>', get_template_directory_uri().'/js/less.js?ver=1.6.1');
}
// Enable this when you want to work with less
//add_action('wp_head', 'upbootwp_less');


/**
 * Implement the Custom Header feature.
 */
//require TPL_DIR . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require TPL_DIR.'/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require TPL_DIR.'/inc/extras.php';

/**
 * Customizer additions.
 */
require TPL_DIR.'/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require TPL_DIR.'/inc/jetpack.php';

/**
 * upbootwp_breadcrumbs function.
 * Edit the standart breadcrumbs to fit the bootstrap style without producing more css
 * @access public
 * @return void
 */
function upbootwp_breadcrumbs() {

	$delimiter = '&raquo;';
	$home = 'Home';
	$before = '<li class="active">';
	$after = '</li>';

	if (!is_home() && !is_front_page() || is_paged()) {

		echo '<ol class="breadcrumb">';

		global $post;
		$homeLink = get_bloginfo('url');
		echo '<li><a href="' . $homeLink . '">' . $home . '</a> ' . $delimiter . '</li> ';

		if (is_category()) {
			global $wp_query;
			$cat_obj = $wp_query->get_queried_object();
			$thisCat = $cat_obj->term_id;
			$thisCat = get_category($thisCat);
			$parentCat = get_category($thisCat->parent);
			if ($thisCat->parent != 0) echo(get_category_parents($parentCat, TRUE, ' ' . $delimiter . ' '));
			echo $before . single_cat_title('', false) . $after;

		} elseif (is_day()) {
			echo '<li><a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a></li> ' . $delimiter . ' ';
			echo '<li><a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a></li> ' . $delimiter . ' ';
			echo $before . get_the_time('d') . $after;

		} elseif (is_month()) {
			echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a></li> ' . $delimiter . ' ';
			echo $before . get_the_time('F') . $after;

		} elseif (is_year()) {
			echo $before . get_the_time('Y') . $after;

		} elseif (is_single() && !is_attachment()) {
			if ( get_post_type() != 'post' ) {
				$post_type = get_post_type_object(get_post_type());
				$slug = $post_type->rewrite;
				echo '<a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a></li> ' . $delimiter . ' ';
				echo $before . get_the_title() . $after;
			} else {
				$cat = get_the_category(); $cat = $cat[0];
				echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
				echo $before . get_the_title() . $after;
			}

		} elseif (!is_single() && !is_page() && get_post_type() != 'post' && !is_404()) {
			$post_type = get_post_type_object(get_post_type());
			echo $before . $post_type->labels->singular_name . $after;

		} elseif (is_attachment()) {
			$parent = get_post($post->post_parent);
			$cat = get_the_category($parent->ID); $cat = $cat[0];
			echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
			echo '<a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a></li> ' . $delimiter . ' ';
			echo $before . get_the_title() . $after;

		} elseif ( is_page() && !$post->post_parent ) {
			echo $before . get_the_title() . $after;

		} elseif ( is_page() && $post->post_parent ) {
			$parent_id  = $post->post_parent;
			$breadcrumbs = array();
			while ($parent_id) {
				$page = get_page($parent_id);
				$breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a></li>';
				$parent_id  = $page->post_parent;
			}
			$breadcrumbs = array_reverse($breadcrumbs);
			foreach ($breadcrumbs as $crumb) echo $crumb . ' ' . $delimiter . ' ';
			echo $before . get_the_title() . $after;

		} elseif ( is_search() ) {
			echo $before . 'Search results for "' . get_search_query() . '"' . $after;

		} elseif ( is_tag() ) {
			echo $before . 'Posts tagged "' . single_tag_title('', false) . '"' . $after;

		} elseif ( is_author() ) {
			global $author;
			$userdata = get_userdata($author);
			echo $before . 'Articles posted by ' . $userdata->display_name . $after;

		} elseif ( is_404() ) {
			echo $before . 'Error 404' . $after;
		}

		if ( get_query_var('paged') ) {
			if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
			echo ': ' . __('Page') . ' ' . get_query_var('paged');
			if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
		}

		echo '</ol>';

	}
}
function Bootsy_readmore( $link ) {
	//$link = preg_replace( '|#more-[0-9]+|', '', $link );
	$link = '<p>' . str_replace( 'class="more-link', 'class="more-link btn btn-primary btn-sm', $link ) . '</p>';
	return $link;
}
add_filter( 'the_content_more_link', 'Bootsy_readmore' );

function Bootsy_remove_class_filter( $hook_name = '', $class_name ='', $method_name = '', $priority = 0 ) {
	// inspired by https://github.com/herewithme/wp-filters-extras/
	global $wp_filter;

	// check if this filter exists
	if ( !isset($wp_filter[$hook_name][$priority]) || !is_array($wp_filter[$hook_name][$priority]) )
		return false;

	// Loop on filters registered
	foreach( (array) $wp_filter[$hook_name][$priority] as $unique_id => $filter_array ) {
		// Test if filter is an array ! (always for class/method)
		if ( isset($filter_array['function']) && is_array($filter_array['function']) ) {
			// Test if object is a class, class and method is equal to param !
			if ( is_object($filter_array['function'][0]) && get_class($filter_array['function'][0]) && get_class($filter_array['function'][0]) == $class_name && $filter_array['function'][1] == $method_name ) {
				unset($wp_filter[$hook_name][$priority][$unique_id]);
			}
		}

	}

	return false;
}
add_action('show_user_profile', 'Bootsy_social_links_add');
add_action('personal_options_update', 'Bootsy_social_links_update');
$Bootsy_socials = array(
    'twitter' =>array(
    	'label' => 'Twitter'
    	, 'prepend' => 'https://twitter.com/'
    )
    , 'facebook' =>array(
    	'label' => 'Facebook'
    	, 'prepend' => 'https://fb.me/'
    )
    , 'googleplus' =>array(
    	'label' => 'Google+'
    	, 'prepend' => 'https://plus.google.com/u/0/'
    )
    , 'linkedin' =>array(
    	'label' => 'LinkedIn'
    	, 'prepend' => 'https://linkedin.com/in/'
    )
    , 'github' =>array(
    	'label' => 'GitHub'
    	, 'prepend' => 'https://github.com/'
    )
);

function Bootsy_social_links_add (){ 
    global $user_ID, $Bootsy_socials;
?>
    <h3><?php _e('Social things','upbootwp'); ?></h3>
    <table class="form-table">
    <?php 
    	foreach ($Bootsy_socials as $id => $vars) { 
    		$vars['value'] = get_user_meta($user_ID, $id);
    		if (is_array($vars['value'])) $vars['value'] = $vars['value'][0];
    ?>
        <tr>
            <th><label for="<?php echo $id; ?>"><?php echo $vars['label']; ?></label></th>
            <td><input type="text" id="<?php echo $id; ?>" 
            name="<?php echo $id; ?>" value="<?php echo $vars['value']; ?>" /><br />
            <span class="description"><?php echo sprintf( __( 'Will be prepended by %1$s' ), $vars['prepend'] ); ?></span></td>
        </tr>
    <?php } ?>
    </table>
    <?php
}

function Bootsy_social_links_update (){
    global $user_ID, $Bootsy_socials;
    foreach ($Bootsy_socials as $id => $vars) { 
    	update_user_meta($user_ID, $id, $_POST[$id]);
    }
}
function Bootsy_social_links_get ($user_ID){ 
    global $Bootsy_socials;
    $return = '<ul>';
   	foreach ($Bootsy_socials as $id => $vars) { 
		$vars['value'] = get_user_meta($user_ID, $id);
		if (is_array($vars['value'])) $vars['value'] = $vars['value'][0];
		if (trim($vars['value']) !== '') {
			$return .= '<li><a href="'.$vars['prepend'].$vars['value'].'" rel="author"><span class="icon-'.$id.'"></span> <span class="text-hide">'.$vars['label'].'</span></a></li>';
		}
    }
    return $return.'</ul>';
}

function Bootsy_tag_cloud( $taglinks ) {
    $tags = explode('</a>', $taglinks);  
    foreach( $tags as $i=>$tag ) {
    	$tags[$i] = preg_replace("/ style='[^']*'/", '', $tag );
    	preg_match("/title='([0-9]{1,4})/",$tags[$i], $n);
    	$n = (int)$n[1];
    	if ($n < 2) $class='label-default';
    	elseif ($n < 4) $class='label-primary';
    	elseif ($n < 6) $class='label-success';
    	elseif ($n < 8) $class='label-info';
    	elseif ($n < 14) $class='label-warning';
    	elseif ($n < 22) $class='label-danger';
    	$tags[$i] = str_replace("'", '"', $tags[$i]);
    	$tags[$i] = str_replace('>', '><span class="label '.$class.'">', $tags[$i]);
    }
    return implode('</span></a>', $tags);
}

add_action('wp_tag_cloud', 'Bootsy_tag_cloud');

// markdown support
if (!class_exists('WPCom_GHF_Markdown_Parser')) {
	if (is_file(ABSPATH . 'wp-content/plugins/jetpack/_inc/lib/markdown/gfm.php')) {
		// if the Jetpack plugin is enabled, use its markdown lib
		require_once(ABSPATH . 'wp-content/plugins/jetpack/_inc/lib/markdown/extra.php');
		require_once(ABSPATH . 'wp-content/plugins/jetpack/_inc/lib/markdown/gfm.php');
	} else {
		// use the included MD lib
		require TPL_DIR.'/inc/parsedown.php';
	}
}

if (class_exists('WPCom_GHF_Markdown_Parser')) {
	function Bootsy_markdown( $atts, $text ) {
		$parser = new WPCom_GHF_Markdown_Parser();
		return $parser->transform($text);
	}
} else {
	// use the included MD lib
	function Bootsy_markdown( $atts, $text ) {
		return Parsedown::instance()->parse($text);
	}
}

add_shortcode( 'md', 'Bootsy_markdown' );

// Enable shortcodes in widgets
add_filter( 'widget_text', 'shortcode_unautop');
add_filter( 'widget_text', 'do_shortcode');

function Bootsy_adjacent_post_link( $format, $link ) {
    if ( 'previous_post_link' === current_filter() ) {
    	return str_replace('rel="', 'class="btn btn-sm btn-primary" rel="', $format);
    } else {
    	return str_replace('rel="', 'class="btn btn-sm btn-primary pull-right" rel="', $format);
    }

}
add_filter( 'previous_post_link', 'Bootsy_adjacent_post_link', 10, 2 );
add_filter( 'next_post_link', 'Bootsy_adjacent_post_link', 10, 2 );


?>