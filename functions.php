<?php

/**
 * Timber starter-theme
 * https://github.com/timber/starter-theme
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since   Timber 0.1
 */

/**
 * If you are installing Timber as a Composer dependency in your theme, you'll need this block
 * to load your dependencies and initialize Timber. If you are using Timber via the WordPress.org
 * plug-in, you can safely delete this block.
 */
$composer_autoload = __DIR__ . '/vendor/autoload.php';
if (file_exists($composer_autoload)) {
	require_once $composer_autoload;
	$timber = new Timber\Timber();
}

/**
 * This ensures that Timber is loaded and available as a PHP class.
 * If not, it gives an error message to help direct developers on where to activate
 */
if (!class_exists('Timber')) {

	add_action(
		'admin_notices',
		function () {
			echo '<div class="error"><p>Timber not activated. Make sure you activate the plugin in <a href="' . esc_url(admin_url('plugins.php#timber')) . '">' . esc_url(admin_url('plugins.php')) . '</a></p></div>';
		}
	);

	add_filter(
		'template_include',
		function ($template) {
			return get_stylesheet_directory() . '/static/no-timber.html';
		}
	);
	return;
}

/**
 * Sets the directories (inside your theme) to find .twig files
 */
Timber::$dirname = array('templates', 'views');

/**
 * By default, Timber does NOT autoescape values. Want to enable Twig's autoescape?
 * No prob! Just set this value to true
 */
Timber::$autoescape = false;


/**
 * We're going to configure our theme inside of a subclass of Timber\Site
 * You can move this to its own file and include here via php's include("MySite.php")
 */
class StarterSite extends Timber\Site
{
	/** Add timber support. */
	public function __construct()
	{
		add_action('after_setup_theme', array($this, 'theme_supports'));
		add_filter('timber/context', array($this, 'add_to_context'));
		add_filter('timber/twig', array($this, 'add_to_twig'));
		add_action('init', array($this, 'register_post_types'));
		add_action('init', array($this, 'register_taxonomies'));
		parent::__construct();
	}
	/** This is where you can register custom post types. */
	public function register_post_types()
	{
	}
	/** This is where you can register custom taxonomies. */
	public function register_taxonomies()
	{
	}

	/** This is where you add some context
	 *
	 * @param string $context context['this'] Being the Twig's {{ this }}.
	 */
	public function add_to_context($context)
	{
		$context['foo']   = 'bar';
		$context['stuff'] = 'I am a value set in your functions.php file';
		$context['notes'] = 'These values are available everytime you call Timber::context();';
		$context['nav_menu']  = new Timber\Menu('Primary');
		$context['footer_menu']  = new Timber\Menu('Footer');
		$context['site']  = $this;
		return $context;
	}

	public function theme_supports()
	{
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

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			)
		);

		/*
		 * Enable support for Post Formats.
		 *
		 * See: https://codex.wordpress.org/Post_Formats
		 */
		add_theme_support(
			'post-formats',
			array(
				'aside',
				'image',
				'video',
				'quote',
				'link',
				'gallery',
				'audio',
			)
		);

		add_theme_support('menus');
	}

	/** This Would return 'foo bar!'.
	 *
	 * @param string $text being 'foo', then returned 'foo bar!'.
	 */
	public function myfoo($text)
	{
		$text .= ' bar!';
		return $text;
	}

	/** This is where you can add your own functions to twig.
	 *
	 * @param string $twig get extension.
	 */
	public function add_to_twig($twig)
	{
		$twig->addExtension(new Twig\Extension\StringLoaderExtension());
		$twig->addFilter(new Twig\TwigFilter('myfoo', array($this, 'myfoo')));
		return $twig;
	}
}

if (function_exists('acf_add_options_page')) {

	acf_add_options_page(array(
		'page_title'    => 'Site General Settings',
		'menu_title'    => 'Site Settings',
		'menu_slug'     => 'site-general-settings',
		'capability'    => 'edit_posts',
		'redirect'      => false
	));

	// acf_add_options_sub_page(array(
	// 	'page_title'    => 'Site SEO Settings',
	// 	'menu_title'    => 'SEO',
	// 	'parent_slug'   => 'site-general-settings',
	// ));
}

add_filter('timber_context', 'mytheme_timber_context');

function mytheme_timber_context($context)
{
	$context['options'] = get_fields('option');
	return $context;
}

//this adds tailwind to the admin pages so that the block editor looks fine
// Update CSS within in Admin
function admin_style()
{
	wp_enqueue_style('admin-styles', get_template_directory_uri() . '/style.css');
}
add_action('admin_enqueue_scripts', 'admin_style');

// adding some custom scripts

function custom_plugin_assets()
{
	wp_register_script('sitejs', get_template_directory_uri() . '/static/site.js.css');
}
add_action('wp_enqueue_scripts', 'custom_plugin_assets');

// get rid of jquery nonsense
function my_jquery_enqueue()
{
	wp_deregister_script('jquery');
}

add_action('wp_enqueue_scripts', 'my_jquery_enqueue');

//get rid of emojis js that is not being used in the front end
add_action('init', 'smartwp_disable_emojis');

function smartwp_disable_emojis()
{
	remove_action('wp_head', 'print_emoji_detection_script', 7);
	remove_action('admin_print_scripts', 'print_emoji_detection_script');
	remove_action('wp_print_styles', 'print_emoji_styles');
	remove_filter('the_content_feed', 'wp_staticize_emoji');
	remove_action('admin_print_styles', 'print_emoji_styles');
	remove_filter('comment_text_rss', 'wp_staticize_emoji');
	remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
	add_filter('tiny_mce_plugins', 'disable_emojis_tinymce');
}

function disable_emojis_tinymce($plugins)
{
	if (is_array($plugins)) {
		return array_diff($plugins, array('wpemoji'));
	} else {
		return array();
	}
}

//add custom js if needed 
function load_js()
{
	//page transitions
	wp_register_script('swup', 'https://unpkg.com/swup@3', false);
	wp_enqueue_script('swup');
	//for scroll animations
	wp_register_script('alpineintersect', 'https://cdn.jsdelivr.net/npm/@alpinejs/intersect@3.x.x/dist/cdn.min.js', false);
	wp_enqueue_script('alpineintersect');
	//alpine js
	wp_register_script('alpine', 'https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js', false);
	wp_enqueue_script('alpine');
	//anything custom
	wp_register_script('site-js', get_template_directory_uri() . '/static/site.js', '', '', true);
	wp_enqueue_script('site-js');

	wp_scripts()->add_data('swup', 'type', 'module');
}

add_action('wp_enqueue_scripts', 'load_js');

function defer_scripts($tag, $handle, $src)
{
	$defer = array(
		'alpine',
		'alpineintersect',
	);
	if (in_array($handle, $defer)) {
		return '<script src="' . $src . '" defer="defer" type="text/javascript"></script>' . "\n";
	}

	return $tag;
}
add_filter('script_loader_tag', 'defer_scripts', 10, 3);

//add custom styles to block editor
// Gutenberg custom stylesheet
add_theme_support('editor-styles');
add_editor_style(get_template_directory_uri() . '/style.css');


//wrap classic editor content in div to control max width
add_filter('render_block', 'wrap_table_block', 10, 2);
function wrap_table_block($block_content, $block)
{
	if ('core/paragraph' === $block['blockName']) {
		$block_content = '<div class="max-w-xl mx-auto px-4 py-8 duration-500 delay-300">' . $block_content . '</div>';
	}

	if ('tadv/classic-paragraph' === $block['blockName']) {
		$block_content = '<div class="max-w-xl mx-auto px-4 py-8 duration-500 delay-300">' . $block_content . '</div>';
	}

	return $block_content;
}





//custom post types
// include get_template_directory() . './custom-posts/Yearbook.php';
include get_template_directory() . './custom-posts/Sponsors.php';
include get_template_directory() . './custom-posts/Events.php';

//register custom logo for the club
function wpb_login_logo()
{ ?>
	<style type="text/css">
		.login {
			background-color: white;
		}

		#login h1 a,
		.login h1 a {
			background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/club-logo.png);
			height: 50px;
			width: 50px;
			background-size: 50px 50px;
			background-repeat: no-repeat;
			padding-bottom: 10px;
			background-size: contain;
		}
	</style>
<?php }
add_action('login_enqueue_scripts', 'wpb_login_logo');


// disable theme editors
define('DISALLOW_FILE_EDIT', true);

// add editor the privilege to edit theme

// get the the role object
$role_object = get_role('editor');

// add $cap capability to this role object
$role_object->add_cap('edit_theme_options');

new StarterSite();
