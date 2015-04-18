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
 * ----------------------------------------------------------------------------
 */
if ( ! isset( $content_width ) ) $content_width = 620;


/**
 * Inclusão de recursos ao tema
 * 
 * @since Estúdio Viking 1.0
 * ----------------------------------------------------------------------------
 */
// Utilidades
require INCLUDES_PATH . '/viking_utilities.php';
// Shortcodes
require INCLUDES_PATH . '/viking_shortcodes.php';
// Inclui o Walker personalizado para construção de menus
require_once INCLUDES_PATH . '/class_viking_walker_nav.php';


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
	
	// Registro interno dos menus, não usando diretamente do tema
	add_theme_support( 'menus' );
	
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
		'header-menu'	=> __('Header Menu', 'viking-theme'),
		'social-menu'	=> __('Social Menu', 'viking-theme'),
	) );
	
	// Suporte aos formatos de post
	//add_theme_support( 'post-formats', array(
	//	'aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat'
	//) );
	
	// Suporte a elementos HTML5
	add_theme_support( 'html5', array(
		'comment-list', 'comment-form', 'search-form', 'gallery', 'caption'
	) );
	
	// Suporte a background personalizado
	add_theme_support( 'custom-background', array(
		'default-color'			=> 'fff',
		'default-image'			=> THEME_URI . '/img/bg_site.jpg',
		'default-repeat'		=> 'repeat',
		'default-position-x'	=> 'center',
		'default-attachment'	=> 'scroll'
	) );

	// Inclui o arquivo que dá suporte a cabeçalho personalizado
    require INCLUDES_PATH . '/custom-header.php';
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
	// Define Sidebar Widget Area 1
	register_sidebar( array(
		'name'			=> __( 'Widget Area', 'viking-theme' ),
		'id'			=> 'widget-area',
		'description'	=> __( 'Add widgets here to appear in your sidebar.', 'viking-theme' ),
		'before_widget'	=> '<section id="%1$s" class="widget %2$s">',
		'before_title'	=> '<h2 class="widget-title inner">',
		'after_title'	=> '</h2><div class="widget-content inner">',
		'after_widget'	=> '</div></section>'
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
		wp_enqueue_script('viking_jquery', SCRIPT_URI . '/lib/jquery.js', array(), '2.1.1');
		
		// Grid Scripts
		wp_enqueue_script('grid_js', SCRIPT_URI . '/grid.js', array(), '1.0');
		
		// JCycle 2
		wp_enqueue_script('viking_jcycle2', SCRIPT_URI . '/lib/jcycle2.js', array(), '2.1.5');
		
		// Lightbox 2
		wp_enqueue_script('viking_lightbox', SCRIPT_URI . '/lib/lightbox.js', array(), '2.7.1');
		
		// Modernizr
		wp_enqueue_script('viking_modernizr', SCRIPT_URI . '/lib/modernizr.js', array(), '2.8.3');
		
		// Scripts personalizados do tema
		wp_enqueue_script('viking_scripts', SCRIPT_URI . '/geral.js', array(), '2.0');
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
 * Remove estilos de comentários recentes injetados no wp_head()
 * 
 * @since Estúdio Viking 1.0
 * ----------------------------------------------------------------------------
 */
function my_remove_recent_comments_style() {
	global $wp_widget_factory;
	
	remove_action( 'wp_head', array(
		$wp_widget_factory->widgets['WP_Widget_Recent_Comments'],
		'recent_comments_style'
	) );
}
add_action( 'widgets_init', 'my_remove_recent_comments_style' );


/**
 * Altera a meta tag generator no wp_head()
 * 
 * @since Estúdio Viking 1.0
 * ----------------------------------------------------------------------------
 */
function change_generator() {
	return '<meta name="generator" content="' . get_bloginfo( 'name', 'display' ) . '" />';
}
add_filter( 'the_generator', 'change_generator' );


/**
 * Remove barra de administração
 * 
 * @since Estúdio Viking 1.0
 * ----------------------------------------------------------------------------
 */
function remove_admin_bar() {
	return false;
}
add_filter( 'show_admin_bar', 'remove_admin_bar' );


/**
 * Adiciona o "slug" de página como classe no elemento <body>
 * Créditos: Starkers Wordpress Theme
 * 
 * @since Estúdio Viking 1.0
 * ----------------------------------------------------------------------------
 */
function add_slug_to_body_class( $classes ) {
	global $post;
	
	if ( is_home() || is_page( 'home' ) ) {
		$key = array_search( 'blog', $classes );
		
		if ( $key > -1 ) unset( $classes[$key] );
	} elseif ( is_page() ) {
		$classes[] = sanitize_html_class( $post->post_name );
	} elseif ( is_singular() ) {
		$classes[] = sanitize_html_class( $post->post_name );
	}
	
	return $classes;
}
add_filter( 'body_class', 'add_slug_to_body_class' );


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
 * Coleta informações da imagem destacada da postagem
 * 
 * @since Estúdio Viking 1.0
 * ----------------------------------------------------------------------------
 */
function viking_get_thumb_meta( $thumbnail_id, $meta ) {
	$thumb = get_post( $thumbnail_id );
	
	$thumb = array(
		'alt'			=> get_post_meta( $thumb->ID, '_wp_attachment_image_alt', true ),
		'caption'		=> $thumb->post_excerpt,
		'description'	=> $thumb->post_content,
		'href'			=> get_permalink( $thumb->ID ),
		'src'			=> $thumb->guid,
		'title'			=> $thumb->post_title
	);
	
	return $thumb[$meta];
}


/**
 * Miniaturas personalizadas para as postagens
 * 
 * @since Estúdio Viking 1.0
 * ----------------------------------------------------------------------------
 */
function viking_post_thumb( $size = 'post-size' ) {
	$thumb_id = get_post_thumbnail_id();
	
	$thumb_link_full = wp_get_attachment_image_src( $thumb_id, 'full' );
	$thumb_link_full = $thumb_link_full[0];
	
	$thumb_caption = viking_get_thumb_meta( $thumb_id, 'caption' );
	?>
	
	<figure class="post-thumb<?php if ( is_page() ) : echo ' col_4'; endif; ?>">
		<a class="link-thumb img-link"
		   href="<?php if ( is_single() ) : echo $thumb_link_full; else : the_permalink(); endif; ?>"
		   title="<?php the_title(); ?>"
		   <?php if ( is_single() ) : ?>data-lightbox="post-<?php the_ID(); ?>" data-title="<?php echo $thumb_caption; ?>"<?php endif; ?>>
			<?php the_post_thumbnail( $size, array( 'class' => 'img-thumb' ) ); ?>
		</a>
	</figure>
	<!-- .post thumbnail -->
	
	<?php
}


/**
 * Detalhes personalizadas para as postagens
 * 
 * @since Estúdio Viking 1.0
 * ----------------------------------------------------------------------------
 */
function viking_post_details() {
	$post = get_post();
	foreach ( ( array ) get_the_category( $post->ID ) as $categ ) :
		$categ_slug = sanitize_html_class( $categ->slug, $categ->term_id );
	endforeach;
	?>
	<section class="post-details">
		<?php viking_post_thumb(); ?>
		
		<span class="post-categ shadow categ-<?php echo $categ_slug; ?>"><?php the_category( ', ' ); ?></span>
		
		<?php if ( is_single() ) : ?>
			<div class="post-details-bar">
				<span class="post-author"><?php the_author_posts_link(); ?></span> | 
				<span class="post-date"><?php viking_date_link(); ?></span> | 
				<span class="post-comments"><?php viking_comment_link(); ?></span>
				<?php if ( is_user_logged_in() ) : ?>
					 | <?php edit_post_link( __( 'Edit', 'viking-theme' ), '<span class="edit-link">', '</span>' ); ?>
				<?php endif; ?>
			</div>
		<?php endif; ?>
	</section>
	<!-- .post details -->
	<?php
}


/**
 * Remove as dimensões de largura e altura das miniaturas
 * que evitam imagens fluidas em the_thumbnail
 * 
 * @since Estúdio Viking 1.0
 * ----------------------------------------------------------------------------
 */
function remove_thumbnail_dimensions( $html ) {
	$html = preg_replace('/(width|height)=\"\d*\"\s/', "", $html);
	return $html;
}
add_filter( 'post_thumbnail_html', 'remove_thumbnail_dimensions', 10 );
add_filter( 'image_send_to_editor', 'remove_thumbnail_dimensions', 10 );


/**
 * Remove valores invalidos do atributo "rel" na lista de categorias
 * 
 * @since Estúdio Viking 1.0
 * ----------------------------------------------------------------------------
 */
function remove_category_rel_from_category_list( $thelist ) {
    return str_replace( 'rel="category tag"', 'rel="tag"', $thelist );
}
add_filter( 'the_category', 'remove_category_rel_from_category_list' );


/**
 * Cria datas como links
 * 
 * @since Estúdio Viking 1.0
 * ----------------------------------------------------------------------------
 */
function viking_date_link() {
	$ano		= get_the_time( 'Y' );
	
	$mes		= get_the_time( 'm' );
	$mes_nome	= get_the_time( 'F' );
	$data_mes	= get_the_time( 'F \d\e Y' );
	
	$dia		= get_the_time( 'd' );
	$data_dia	= get_the_time( 'd \d\e F \d\e Y' );
	
	$data_title	= get_the_time( 'l, d \d\e F \d\e Y, h:i a' );
	$data_full	= esc_attr( get_the_date( 'c' ) );
	
	$link_dia	= get_day_link( $ano, $mes, $dia );
	$link_mes	= get_month_link( $ano, $mes );
	$link_ano	= get_year_link( $ano );
	
	$data  = '<time class="date" title="'. $data_title .'" datetime="' . $data_full . '">';
	$data .= '<a href="' . $link_dia . '" title="Arquivos de ' . $data_dia . '">' . $dia . '</a> de ';
	$data .= '<a href="' . $link_mes . '" title="Arquivos de ' . $data_mes . '">' . $mes_nome . '</a> de ';
	$data .= '<a href="' . $link_ano . '" title="Arquivos de ' . $ano . '">' . $ano . '</a>';
	$data .= '</time>';
	
	echo $data;
}


/**
 * Link para os comentários
 * 
 * @since Estúdio Viking 1.0
 * ----------------------------------------------------------------------------
 */
function viking_comment_link() {
	if ( comments_open( get_the_ID() ) )
		comments_popup_link(
			__( 'Leave your thoughts', 'viking-theme' ),
			__( '1 comment', 'viking-theme' ),
			__( '% comments', 'viking-theme' )
		);
}


/**
 * Criar resumos personalizados
 * 
 * @since Estúdio Viking 1.0
 * ----------------------------------------------------------------------------
 */
function viking_excerpt( $length_callback = '', $more_callback = '' ) {
	global $post;
	
    if ( function_exists( $length_callback ) ) {
    	add_filter( 'excerpt_length', $length_callback );
	}
	
	if ( function_exists( $more_callback ) ) {
		add_filter( 'excerpt_more', $more_callback );
	}
	
	$output = get_the_excerpt();
	$output = apply_filters( 'wptexturize', $output );
	$output = apply_filters( 'convert_chars', $output );
	$output = '<section class="post-content clear"><p>' . $output . '</p></section>';
	
	echo $output;
}


/**
 * Tamanho em palavras para os resumos personalizados.
 * Uso: viking_excerpt( 'viking_index' );
 * 
 * @since Estúdio Viking 1.0
 * ----------------------------------------------------------------------------
 */
function viking_index( $length ) {
	return 50;
}


/**
 * Tamanho em palavras para os resumos personalizados do slider.
 * Uso: viking_excerpt( 'viking_length_slider' );
 * 
 * @since Estúdio Viking 1.0
 * ----------------------------------------------------------------------------
 */
function viking_length_slider( $lenght ) {
	return 10;
}


/**
 * Cria link Ver Artigo personalizado para a postagem
 * 
 * @since Estúdio Viking 1.0
 * ----------------------------------------------------------------------------
 */
function viking_view_article( $more ) {
	global $post;
	
	$tagmore  = '...<br />';
	$tagmore .= '<a class="button view-article" ';
	$tagmore .= 'href="' . get_permalink( $post->ID ) . '" ';
	$tagmore .= 'title ="Ver artigo: ' . get_the_title() . '">';
	$tagmore .= 'Ver artigo';
	$tagmore .= '</a>';
	
	return $tagmore;
}
add_filter( 'excerpt_more', 'viking_view_article' );


/**
 * Paginador para postagens com links "Próximo" e "Anterior", sem plugins.
 * 
 * @since Estúdio Viking 1.0
 * ----------------------------------------------------------------------------
 */
function viking_pagination() {
	global $wp_query;
	$big = 999999999;
	
	echo paginate_links( array(
		'base'		=> str_replace( $big, '%#%', get_pagenum_link( $big ) ),
		'format'	=> '?paged=%#%',
		'current'	=> max( 1, get_query_var( 'paged' ) ),
		'total'		=> $wp_query->max_num_pages
	) );
}
add_action( 'init', 'viking_pagination' );


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
 * Navegação dos comentários
 * 
 * @since Estúdio Viking 1.0
 * ----------------------------------------------------------------------------
 */
function viking_comment_nav() {
	// Há comentários para navegação?
	if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
		<nav class="nav comment-nav" role="navigation">
			<h2 class="screen-reader-text"><?php _e( 'Comment navigation', 'viking-theme' ); ?></h2>
			<div class="nav-links">
				<?php
					if ( $prev_link = get_previous_comments_link( __( 'Older comments', 'viking-theme' ) ) ) :
						printf( '<div class="nav-previous">%s</div>', $prev_link );
					endif;
	
					if ( $next_link = get_next_comments_link( __( 'Newer comments', 'viking-theme' ) ) ) :
						printf( '<div class="nav-next">%s</div>', $next_link );
					endif;
				?>
			</div><!-- .nav-links -->
		</nav><!-- .comment-nav -->
	<?php endif;
}

/**
 * Actions e Filtros
 * 
 * @since Estúdio Viking 1.0
 * ----------------------------------------------------------------------------
 */
// Remove Actions
remove_action( 'wp_head', 'feed_links_extra', 3 );						// Mostra os links extras de feed como feeds de categoria
remove_action( 'wp_head', 'feed_links', 2 );							// Mostra os links para os feeds gerais: Postagens e Feed de Comentários
remove_action( 'wp_head', 'rsd_link' );									// Mostra os links para os Really Simple Discovery service endpoint, EditURI link
remove_action( 'wp_head', 'wlwmanifest_link' );							// Mostra o link para o arquivo manifest do Windows Live Writer
remove_action( 'wp_head', 'index_rel_link' );							// Index link
remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );				// Prev link
remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );				// Start link
remove_action( 'wp_head', 'adjacent_posts_rel_link', 10, 0 );			// Mostra links relacionado para as postagens adjacentes a postagem atual
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
remove_action( 'wp_head', 'rel_canonical' );
remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 );

// Adiciona Filtros
add_filter( 'the_excerpt', 'shortcode_unautop' );							// Remove tags <p> automáticos nos resumos (apenas para resumos manuais)
add_filter( 'the_excerpt', 'do_shortcode' );								// Permite que Shortcodes sejam executados nos resumos (apenas para resumos manuais)
add_filter( 'widget_text', 'do_shortcode' );								// Permite shortcodes nas Sidebar Dinâmicas
add_filter( 'widget_text', 'shortcode_unautop' );							// Remove tags <p> nas Sidebar Dinâmicas (better!)

// Remove Filtros
remove_filter( 'the_excerpt', 'wpautop' );		// Remove completamente tags <p> dos resumos de postagem


/**
 * Tags de modelo personalizadas para este tema
 * 
 * @since Estúdio Viking 1.0
 * ----------------------------------------------------------------------------
 */
require INCLUDES_PATH . '/template-tags.php';