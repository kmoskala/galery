<?php

if (!class_exists('Timber')) {
	add_action('admin_notices', function () {
		echo '<div class="error"><p>Timber not activated. Make sure you activate the plugin in <a href="' . esc_url(admin_url('plugins.php#timber')) . '">' . esc_url(admin_url('plugins.php')) . '</a></p></div>';
	});
	return;
}
Timber::$dirname = array('templates', 'views');
Timber::$autoescape = false;

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

	public function add_to_context($context)
	{
		$context['header_menu'] = new Timber\Menu('header-menu');
		$context['footer_menu'] = new Timber\Menu('footer-menu');
		$context['img_url'] = home_url() . '/wp-content/themes/kmoskala_theme/assets/images';
		$context['js_url'] = home_url() . '/wp-content/themes/kmoskala_theme/public/js';
		$context['css_url'] = home_url() . '/wp-content/themes/kmoskala_theme/public/css';
		$context['theme_url'] = home_url() . '/wp-content/themes/kmoskala_theme/';
		$context['home_url'] = home_url();
		$context['theme_dir'] = __DIR__;
		$context['site'] = $this;
		$context['option'] = get_fields('options');
		return $context;
	}

	public function theme_supports()
	{
		register_nav_menus(array('header-menu' => __('Header Menu', 'header-menu'),));
		register_nav_menus(array('footer-menu' => __('Footer Menu', 'footer-menu'),));
		add_theme_support('automatic-feed-links');
		add_theme_support('title-tag');
		add_theme_support('align-wide');
		add_theme_support('post-thumbnails');
		add_theme_support(
			'html5',
			array(
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			)
		);
		add_theme_support('menus');
	}
	public function add_to_twig($twig)
	{
		$twig->addExtension(new Twig_Extension_StringLoader());
		$twig->addFilter(new Twig_SimpleFilter('myfoo', array($this, 'myfoo')));
		return $twig;
	}
}
new StarterSite();

remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'wp_shortlink_wp_head');
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('admin_print_scripts', 'print_emoji_detection_script');
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action('admin_print_styles', 'print_emoji_styles');
remove_action('wp_head', 'feed_links', 2);
remove_action('wp_head', 'feed_links_extra', 3);


if (function_exists('acf_add_options_page')) {
	acf_add_options_page(array(
		'page_title' 	=> 'Options',
		'menu_title' 	=> 'Options',
		'menu_slug' 	=> 'Options',
		'position' => '20',
		'icon_url' => 'dashicons-editor-insertmore'
	));
}


// add_filter('allowed_block_types', 'misha_allowed_block_types');
// function misha_allowed_block_types($allowed_blocks)
// {
// 	return array(
// 		'core/paragraph',
// 		'core/heading',
// 		'core/list',
// 		'core/columns',
// 		'core/image',
// 		'core/gallery',
// 		'core/shortcode',
// 		'core/embed',
// 		'core/spacer',
// 	);
// }

function sparxoo_dev_scripts()
{
	wp_enqueue_style('bundle-css', get_stylesheet_uri(), array(), '1');

	wp_enqueue_script('theme-jquery', 'https://code.jquery.com/jquery-3.6.0.min.js"', array(), '1', true);
	wp_enqueue_script('theme-mansonry', 'https://cdn.jsdelivr.net/npm/macy@2"', array(), '1', true);
	
	
	wp_enqueue_style('theme-custom-css', get_template_directory_uri() . '/public/css/custom.css', array(), '1', true);
	wp_enqueue_script('theme-custom-js', get_template_directory_uri() . '/public/js/custom.js', array(), '1', true);

	wp_enqueue_script('bundle-js', get_template_directory_uri() . '/public/js/bundle.js', array(), '1', true);
}
add_action('wp_enqueue_scripts', 'sparxoo_dev_scripts');

// Hook the enqueue functions into the editor
add_action( 'enqueue_block_editor_assets', 'my_block_plugin_editor_scripts' );
function my_block_plugin_editor_scripts() {
	wp_enqueue_style('bundle-css', get_stylesheet_uri(), array(), '1');
}


add_action('admin_init', 'edit_page_supports');
function edit_page_supports()
{
	$post_ids = [8];
	if (isset($_GET['post']) && in_array($_GET['post'], $post_ids)) remove_post_type_support('page', 'editor');
	//OR
	//$post_templates = ['page-blog.php'];
	//if (isset($_GET['post']) && in_array(get_page_template_slug($_GET['post']), $post_templates)) remove_post_type_support('page', 'editor');

	remove_post_type_support('page', 'thumbnail');
	remove_post_type_support('page', 'comments');
	remove_post_type_support('page', 'author');
	remove_post_type_support('page', 'excerpt');
}

add_action('admin_head', 'editor_full_width_gutenberg');
function editor_full_width_gutenberg()
{

	echo '<style>
    body.gutenberg-editor-page .editor-post-title__block, body.gutenberg-editor-page .editor-default-block-appender, body.gutenberg-editor-page .editor-block-list__block {
		max-width: none !important;
	}
    .block-editor__container .wp-block {
        max-width: none !important;
	}
	.edit-post-layout__content .edit-post-visual-editor {
		margin-bottom: 150px;
	}
  </style>';
}

// add_action('init', 'add_cpt');
// function add_cpt()
// {
// 	register_post_type('cpt', array(
// 		'labels' => array(
// 			'name' => _x('cpt', 'cpt', 'cpt'),
// 			'singular_name'      => _x('cpt', 'cpt', 'cpt'),
// 			'add_new'            => _x('Dodaj', 'cpt', 'dodaj'),
// 			'add_new_item'       => __('Dodaj Nowy', 'cpt', 'dodaj-nowy'),
// 			'new_item'           => __('Nowy', 'nowa'),
// 			'edit_item'          => __('Edytuj', 'edytuj'),
// 			'view_item'          => __('Zobacz', 'zobacz'),
// 			'all_items'          => __('Wszystkie', 'wszystkie'),
// 			'search_items'       => __('Szukaj', 'szukaj'),
// 			'parent_item_colon'  => __('Rodzic:', 'rodzic'),
// 			'not_found'          => __('Nie znaleziono.', 'nie-znaleziono'),
// 			'not_found_in_trash' => __('Nie znaleziono w koszu.', 'nie-znaleziono-w-koszu')
// 		),
// 		'has_archive'        => true,
// 		'public' => true,
// 		'publicly_queryable' => true,
// 		'menu_position' => 20,
// 		'rewrite'            => array('slug' => 'cpt'),
// 		'capability_type'    => 'post',
// 		'menu_icon'   => 'dashicons-store',
// 		'supports' => array('title', 'custom-fields', 'thumbnail', 'page-attributes'),
// 	));
// }


function custom_menu_page_removing() {
	if ( get_current_user_id() != 1 ) remove_menu_page('edit.php?post_type=acf-field-group');
	remove_menu_page('edit-comments.php');
}
add_action( 'admin_menu', 'custom_menu_page_removing' );


add_action( 'acf/init', 'my_acf_init' );

function my_acf_init() {
    // Bail out if function doesn’t exist.
    if ( ! function_exists( 'acf_register_block' ) ) {
        return;
    }

    
  acf_register_block( array(
        'name'            => 'container',
        'title'           => __( 'container', 'your-text-domain' ),
        'description'     => __( 'Add Container.', 'your-text-domain' ),
        'render_callback' => 'my_acf_block_render_container',
        'category'        => 'formatting',
        'icon'            => 'admin-comments',
        'supports'			=> array(
            'align' => true,
            'mode' => false,
            'jsx' => true
        ),
        'keywords'        => array( 'container' ),
    ) );
	acf_register_block( array(
        'name'            => 'gallery',
        'title'           => __( 'Gallery', 'your-text-domain' ),
        'description'     => __( 'Add gallery.', 'your-text-domain' ),
        'render_callback' => 'my_acf_block_render_gallery',
        'category'        => 'formatting',
        'icon'            => 'admin-comments',
        'keywords'        => array( 'gallery' ),
    ) );
}
function my_acf_block_render_gallery( $block, $content = '', $is_preview = true ) {
    $context = Timber::context();

    // Store block values.
    $context['block'] = $block;

    // Store field values.
    $context['acf'] = get_fields();

    // Store $is_preview value.
    $context['is_preview'] = $is_preview;

    // Render the block.
    Timber::render( 'templates/blocks/gallery.twig', $context );
}
function my_acf_block_render_container( $block, $content = '', $is_preview = true ) {
    $context = Timber::context();

    // Store block values.
    $context['block'] = $block;

    // Store field values.
    $context['acf'] = get_fields();

    // Store $is_preview value.
    $context['is_preview'] = $is_preview;

    // Render the block.
    Timber::render( 'templates/blocks/container.twig', $context );
}

// /**
//  * Gutenberg scripts and styles
//  */
// function be_gutenberg_scripts() {

// 	wp_enqueue_script(
// 		'be-editor', 
// 		get_stylesheet_directory_uri() . '/public/js/editor.js', 
// 		array( 'wp-blocks', 'wp-dom' ), 
// 		filemtime( get_stylesheet_directory() . '/public/js/editor.js' ),
// 		true
// 	);
// }
// add_action( 'enqueue_block_editor_assets', 'be_gutenberg_scripts' );

