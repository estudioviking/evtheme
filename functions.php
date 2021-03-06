<?php
/**
 * Funções e definições do Estúdio Viking
 * 
 * Funções personalizadas, suporte, posts personalizados e mais
 * 
 * @package Estúdio Viking
 * @since 1.0
 */

// Definindo constantes
defined( 'THEME_PATH' ) or define( 'THEME_PATH', get_template_directory() );
defined( 'THEME_URI' ) or define( 'THEME_URI', get_template_directory_uri() );
define( 'INCLUDES_PATH', THEME_PATH . '/inc' );
define( 'INCLUDES_URI', THEME_URI . '/inc' );
define( 'STYLES_PATH', THEME_PATH . '/css' );
define( 'STYLES_URI', THEME_URI . '/css' );
define( 'IMAGES_PATH', THEME_PATH . '/img' );
define( 'IMAGES_URI', THEME_URI . '/img' );
define( 'ICONS_PATH', IMAGES_PATH . '/icon' );
define( 'ICONS_URI', IMAGES_URI . '/icon' );
define( 'SCRIPT_PATH', THEME_PATH . '/js' );
define( 'SCRIPT_URI', THEME_URI . '/js' );


/**
 * Configura o valor da largura do conteúdo baseado no design do tema
 * 
 * @since Estúdio Viking 1.0
 * ----------------------------------------------------------------------------
 */
if ( ! isset( $content_width ) ) $content_width = 740;


if ( ! function_exists( 'viking_setup' ) ) :
/**
 * Setup de Features suportadas pelo tema
 * 
 * @since Estúdio Viking 1.0
 * ----------------------------------------------------------------------------
 */
function viking_setup() {
	// Suporte a idiomas
	load_theme_textdomain( 'viking-theme', THEME_PATH . '/languages' );
	
	// Habilita RSS feed links de postagens e comentários para o <head>
	add_theme_support( 'automatic-feed-links' );
	
	// Habilita a tag <title>
	add_theme_support( 'title-tag' );
	
	// Suporte a miniaturas
    add_theme_support( 'post-thumbnails' );
		// Miniatura grande
		add_image_size( 'large', 740, '', true );
		// Miniatura média
		add_image_size( 'medium', 250, '', true );
		// Miniatura pequena
		add_image_size( 'small', 120, '', true );
		// Miniatura personalizada. Uso: the_post_thumbnail( 'post-size' );
		add_image_size( 'post-size', 780, 300, true );
	
	// Registro dos menus de navegação usados nesse tema
	register_nav_menus( array(
		'header-menu' => __( 'Header Menu', 'viking-theme' ),
		'social-menu' => __( 'Social Menu', 'viking-theme' ),
	) );
	
	// Suporte aos formatos de post
	//add_theme_support( 'post-formats', array(
	//	'aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat'
	//) );
	
	// Suporte a elementos HTML5
	add_theme_support( 'html5', array(
		'caption', 'comment-form', 'comment-list', 'gallery', 'search-form', 'widgets'
	) );
	
	// Suporte a background personalizado
	add_theme_support( 'custom-background', array(
		'default-color'			=> 'fff',
		'default-image'			=> THEME_URI . '/img/bg_site.jpg',
		'default-repeat'		=> 'repeat-x',
		'default-position-x'	=> 'center',
		'default-attachment'	=> 'fixed'
	) );

	// Inclui o arquivo que dá suporte a cabeçalho personalizado
    require INCLUDES_PATH . '/custom-header.php';
	
	// Estilo personalizado para o editor
	add_editor_style( array(
		'css/editor-style.css',
		'http://fonts.googleapis.com/css?family=Metamorphous&subset=latin,latin-ext'
	) );
}
endif; // viking_setup
add_action( 'after_setup_theme', 'viking_setup' );


/**
 * Registro da áreas de widgets
 * 
 * @since Estúdio Viking 1.0
 * 
 * @link https://codex.wordpress.org/Function_Reference/register_sidebar
 * ----------------------------------------------------------------------------
 */
function viking_widgets_init() {
	// Define Sidebar Widget Area
	register_sidebar( array(
		'name'			=> __( 'Widget Area', 'viking-theme' ),
		'id'			=> 'widget-area',
		'description'	=> __( 'Add widgets here to appear in your sidebar.', 'viking-theme' ),
		'before_widget'	=> '<aside id="%1$s" class="widget %2$s">',
		'before_title'	=> '<h2 class="widget-title inner">',
		'after_title'	=> '</h2><div class="widget-content inner">',
		'after_widget'	=> '</div></aside>'
	) );
}
add_action( 'widgets_init', 'viking_widgets_init' );


/**
 * Carrega as folhas de estilo do tema na tag <head>
 * 
 * @since Estúdio Viking 1.0
 * ----------------------------------------------------------------------------
 */
function viking_styles() {
	// Reset
	wp_enqueue_style( 'reset', STYLES_URI . '/reset.css', array(), '2.0', 'all' );
	
	// Grid
	wp_enqueue_style( 'grid', STYLES_URI . '/grid.css', array(), '2.0', 'all' );
	
	// Font-Awesome
	wp_enqueue_style( 'font-awesome', THEME_URI . '/font-awesome/css/font-awesome.min.css', array(), '4.3.0', 'all' );
	
	// Font Metamorphous
	wp_enqueue_style( 'font-metamorphous', 'http://fonts.googleapis.com/css?family=Metamorphous&subset=latin,latin-ext', array(), '1.0', 'all' );
	
	// CSS Principal
	wp_enqueue_style( 'viking_style', THEME_URI . '/style.css', array(), '2.0', 'all' );
	
	// LightBox
	wp_enqueue_style( 'viking_lightbox', STYLES_URI . '/lightbox.css', array(), '2.7.1', 'all' );
}
add_action( 'wp_enqueue_scripts', 'viking_styles' );


/**
 * Carregar os scripts do tema
 * 
 * @since Estúdio Viking 1.0
 * ----------------------------------------------------------------------------
 */
function viking_header_scripts() {
	if ( ! is_admin() ) :
		// JQuery
		wp_enqueue_script( 'viking_jquery', SCRIPT_URI . '/lib/jquery.js', array(), '2.1.3' );
		//wp_enqueue_script( 'jquery' );
		
		// JCycle 2
		wp_enqueue_script( 'viking_jcycle2', SCRIPT_URI . '/lib/jcycle2.js', array(), '2.1.5' );
		
		// Lightbox 2
		wp_enqueue_script( 'viking_lightbox', SCRIPT_URI . '/lib/lightbox.js', array(), '2.7.1' );
		
		// Modernizr
		wp_enqueue_script( 'viking_modernizr', SCRIPT_URI . '/lib/modernizr.js', array(), '2.8.3' );
		
		// Scripts personalizados do tema
		wp_enqueue_script( 'viking_scripts', SCRIPT_URI . '/geral.js', array(), '2.0' );
	endif;
}
add_action( 'init', 'viking_header_scripts');


/**
 * Adiciona a imagem destacada dos artigos como background nos elementos
 * da navegação dos posts
 * 
 * @since Estúdio Viking 1.0
 * ----------------------------------------------------------------------------
 */
function viking_post_nav_background() {
	if ( ! is_single() ) return;
	
	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );
	$css      = '';
	
	if ( is_attachment() && 'attachment' == $previous->post_type ) return;

	if ( $previous &&  has_post_thumbnail( $previous->ID ) ) :
		$prevthumb = wp_get_attachment_image_src( get_post_thumbnail_id( $previous->ID ), 'post-size' );
		$prevthumb = $prevthumb[0];
		$css .= '
			.post-navigation .nav-previous {
				background-image: url(' . esc_url( $prevthumb ) . ');
			}
		';
	endif; // $previous

	if ( $next && has_post_thumbnail( $next->ID ) ) :
		$nextthumb = wp_get_attachment_image_src( get_post_thumbnail_id( $next->ID ), 'post-size' );
		$nextthumb = $nextthumb[0];
		$css .= '
			.post-navigation .nav-next {
				background-image: url(' . esc_url( $nextthumb ) . ');
			}
		';
	endif; // $next

	wp_add_inline_style( 'viking_style', $css );
}
add_action( 'wp_enqueue_scripts', 'viking_post_nav_background' );


/**
 * Chamada para o slider
 * 
 * @since Estúdio Viking 1.0
 * ----------------------------------------------------------------------------
 */
function get_slider() {
	if ( is_home() || is_front_page() || is_archive() ) get_template_part( 'slider' );
}


/**
 * Gravatar personalizado
 * Acesse em Configurações > Discussão
 * ----------------------------------------------------------------------------
 * Obs.: Não funciona com imagens em servidor local (wampserver, xamp, etc..).
 * Quando o tema estiver online irá funcionar.
 * 
 * @since Estúdio Viking 1.0
 * ----------------------------------------------------------------------------
 */
function viking_gravatar( $avatar_defaults ) {
	$my_avatar = IMAGES_URI . '/gravatar.png';
	$avatar_defaults[ $my_avatar ] = "Viking Gravatar";
	return $avatar_defaults;
}
add_filter( 'avatar_defaults', 'viking_gravatar' );


/**
 * Comentários 'Threaded'
 * 
 * @since Estúdio Viking 1.0
 * ----------------------------------------------------------------------------
 */
function enable_threaded_comments() {
	if ( ! is_admin() ) :
		if ( is_singular() && comments_open() && ( get_option( 'thread_comments' ) == 1 ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
	endif;
}
add_action( 'get_header', 'enable_threaded_comments' );


/**
 * Descrição para os itens dos Nav Menus
 * 
 * @since Estúdio Viking 1.0
 * ----------------------------------------------------------------------------
 */
function viking_nav_description( $item_output, $item, $depth, $args ) {
	if ( 'header-menu' == $args->theme_location && $item->description ) :
		$item_output = str_replace( $args->link_after . '</a>', '<div class="menu-item-desc">' . $item->description . '</div>' . $args->link_after . '</a>', $item_output );
	endif;
	
	return $item_output;
}
add_filter( 'walker_nav_menu_start_el', 'viking_nav_description', 10, 4 );


/**
 * Classe para os links dos Nav Menus
 * 
 * @since Estúdio Viking 1.0
 * ----------------------------------------------------------------------------
 */
function classes_nav_item( $classes, $item, $args, $depth ) {
	$classes[] = ( $depth > 0 ) ? 'sub-menu-item' : '';
	
	return $classes;
}
add_filter( 'nav_menu_css_class', 'classes_nav_item', 10, 4 );


/**
 * Classe para os links dos Nav Menus
 * 
 * @since Estúdio Viking 1.0
 * ----------------------------------------------------------------------------
 */
function class_nav_link( $atts, $item, $args, $depth  ) {
	$atts['class']  = ( $depth <= 0 ) ? 'menu-link' : 'menu-link sub-menu-link';
	
	return $atts;
}
add_filter( 'nav_menu_link_attributes', 'class_nav_link', 10, 4 );


/**
 * Remove o "id" dos itens dos Nav Menus
 * 
 * @since Estúdio Viking 1.0
 * ----------------------------------------------------------------------------
 */
add_filter( 'nav_menu_item_id', '__return_false' );

/**
 * Inclusão de recursos ao tema
 * 
 * @since Estúdio Viking 1.0
 * ----------------------------------------------------------------------------
 */
// Limpeza e otimização do tema
require_once INCLUDES_PATH . '/cleanup.php';
// Shortcodes úteis no tema
require_once INCLUDES_PATH . '/shortcodes.php';
// Funções para algumas utilidades básicas no tema
require_once INCLUDES_PATH . '/utilities.php';
// Funções exclusivas do tema
require_once INCLUDES_PATH . '/template-tags.php';
// Funções para incrementar o formulário de contato no tema ou post
require_once INCLUDES_PATH . '/viking-contact-form.php';
// Funções para incrementar o seletor de idioma no tema
require_once INCLUDES_PATH . '/polylang-support.php';
// Opções para personalização do tema
require_once INCLUDES_PATH . '/theme-options.php';