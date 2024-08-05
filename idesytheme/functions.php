<?php
/**
 * idesy functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package idesy
 */

if (!defined('_S_VERSION')) {
	// Replace the version number of the theme on each release.
	define('_S_VERSION', '1.0.0');
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function idesy_setup()
{
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on idesy, use a find and replace
	 * to change 'idesy' to the name of your theme in all the template files.
	 */
	load_theme_textdomain('idesy', get_template_directory() . '/languages');

	// Add default posts and comments RSS feed links to head.
	add_theme_support('automatic-feed-links');

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support('title-tag');

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support('post-thumbnails');

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'primary' => esc_html__('Primary', 'idesy'),
		)
	);

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);



	// Add theme support for selective refresh for widgets.
	add_theme_support('customize-selective-refresh-widgets');

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height' => 250,
			'width' => 250,
			'flex-width' => true,
			'flex-height' => true,
		)
	);
}
add_action('after_setup_theme', 'idesy_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function idesy_content_width()
{
	$GLOBALS['content_width'] = apply_filters('idesy_content_width', 640);
}
add_action('after_setup_theme', 'idesy_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function idesy_widgets_init()
{
	register_sidebar(
		array(
			'name' => esc_html__('Sidebar', 'idesy'),
			'id' => 'sidebar-1',
			'description' => esc_html__('Add widgets here.', 'idesy'),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget' => '</section>',
			'before_title' => '<h2 class="widget-title">',
			'after_title' => '</h2>',
		)
	);
}
add_action('widgets_init', 'idesy_widgets_init');

/**
 * Enqueue scripts and styles.
 */

/**
 * Enqueue scripts and styles.
 */
function idesy_scripts()
{
	wp_enqueue_style('idesytheme-style', get_template_directory_uri() . '/assets/css/styles.min.css', array(), _S_VERSION);
	wp_enqueue_script('idesytheme-swiper-bundle', get_template_directory_uri() . '/assets/js/swiper-bundle.min.js', array(), _S_VERSION, true);
	wp_enqueue_script('idesytheme-smooth-scroll', get_template_directory_uri() . '/assets/js/SmoothScroll.min.js', array(), _S_VERSION, true);

	wp_enqueue_script('idesytheme-scripts', get_template_directory_uri() . '/assets/js/scripts.min.js', array(), _S_VERSION, true);

	wp_enqueue_script('idesytheme-navigation', get_template_directory_uri() . '/assets/js/navigation.js', array(), _S_VERSION, true);


	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}
}
add_action('wp_enqueue_scripts', 'idesy_scripts');


function my_custom_post_types_to_archives($query)
{
	if (is_admin() || !$query->is_main_query()) {
		return;
	}

	if ((is_category() || is_tag()) && empty($query->query_vars['suppress_filters'])) {
		$all_custom_post_types = get_post_types(array('_builtin' => false));

		$query->set(
			'post_type',
			array_merge(
				array('post'),
				$all_custom_post_types
			)
		);
	}
}
add_action('pre_get_posts', 'my_custom_post_types_to_archives');


function get_template_for_category($template)
{

	if (basename($template) === 'category.php') { // No custom template for this specific term, let's find it's parent
		// get the current term, e.g. red
		$term = get_queried_object();

		// check for template file for the page category
		$slug_template = locate_template("category-{$term->slug}.php");
		if ($slug_template)
			return $slug_template;

		// if the page category doesn't have a template, then start checking back through the parent levels to find a template for a parent slug
		$term_to_check = $term;
		while ($term_to_check->parent) {
			// get the parent of the this level's parent
			$term_to_check = get_category($term_to_check->parent);

			if (!$term_to_check || is_wp_error($term_to_check))
				break; // No valid parent found

			// Use locate_template to check if a template exists for this categories slug
			$slug_template = locate_template("category-{$term_to_check->slug}.php");
			// if we find a template then return it. Otherwise the loop will check for this level's parent
			if ($slug_template)
				return $slug_template;
		}
	}

	return $template;
}
add_filter('category_template', 'get_template_for_category');

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if (defined('JETPACK__VERSION')) {
	require get_template_directory() . '/inc/jetpack.php';
}

/* add full size of image to post */
add_image_size('full', 0, 0, false);


/* breadcrumbs from rank_math */
function idesy_get_breadcrumbs()
{
	if (function_exists('rank_math_the_breadcrumbs'))
		rank_math_the_breadcrumbs([]);
}

/* change breadcrumbs */
add_filter('rank_math/frontend/breadcrumb/html', function ($html, $crumbs, $_class) {
	$html = '';
	$size = count($crumbs);
	foreach ($crumbs as $key => $crumb) {
		$link = !empty($crumb[1]) && ($size !== $key + 1);

		$link = $link ? '<li><a href="' . esc_url($crumb[1]) . '">' . esc_html($crumb[0]) . '</a></li>' :
			'<li><span>' . esc_html($crumb[0]) . '</span></li>';
		$html .= $link;
	}

	return '<ul class="breadcrumb">' . $html . '</ul>';
}, 25, 3);


/* filter archive title */
add_filter('get_the_archive_title', function ($title) {
	if (is_category()) {
		$title = single_cat_title('', false);
	} elseif (is_tag()) {
		$title = single_tag_title('', false);
	} elseif (is_author()) {
		$title = '<span class="vcard">' . get_the_author() . '</span>';
	} elseif (is_tax()) {
		$title = sprintf(__('%1$s'), single_term_title('', false));
	} elseif (is_post_type_archive()) {
		$title = post_type_archive_title('', false);
	}
	return $title;
});

add_filter('auto_update_plugin', '__return_false');

// translate home title in breadcramb
add_filter('rank_math/frontend/breadcrumb/items', function ($crumbs, $class) {
	$home_link = pll_home_url(pll_current_language());
	$crumbs[0][0] = pll__("Home");
	$crumbs[0][1] = $home_link;
	return $crumbs;
}, 10, 2);