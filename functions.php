<?php
/**
 * Author: Ivanildo Dias (@ivanildodias_id)
 * Author URI: http://estudioviking.com/ivanildodias
 * Funções personalizadas, suporte, posts personalizados e mais.
 */

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
 * ----------------------------------------------------------------------------
 */
require INCLUDES_PATH . '/viking_utilities.php';		// Utilidades
require INCLUDES_PATH . '/viking_shortcodes.php';		// Shortcodes


/**
 * Administração do Tema
 * ----------------------------------------------------------------------------
 */
/*
if ( ! class_exists( 'ReduxFramework' ) && file_exists( ADMIN_PATH . '/ReduxCore/framework.php' ) ) {
    require_once( ADMIN_PATH . '/ReduxCore/framework.php' );
}
if ( ! isset( $site_options ) && file_exists( ADMIN_PATH . '/viking/site-config.php' ) ) {
    require_once( ADMIN_PATH . '/viking/site-config.php' );
}
if ( ! isset( $site_options ) && file_exists( ADMIN_PATH . '/sample/sample-config.php' ) ) {
    require_once( ADMIN_PATH . '/sample/sample-config.php' );
}*/


/**
 * Setup de Features suportadas pelo tema
 * ----------------------------------------------------------------------------
 */
function viking_setup() {
	// Suporte a menus
	add_theme_support( 'menus' );
	
	// Habilita RSS feed links de postagens e comentários para o head
	add_theme_support( 'automatic-feed-links' );
	
	// Suporte a miniaturas
    add_theme_support( 'post-thumbnails' );
	add_image_size( 'large', 620, '', true );		// Miniatura grande
	add_image_size( 'medium', 250, '', true );		// Miniatura média
	add_image_size( 'small', 120, '', true );		// Miniatura pequena
	add_image_size( 'post-size', 660, 300, true );	// Miniatura personalizada. Uso: the_post_thumbnail( 'post-size' );
	
	// Suporte a background personalizado
	add_theme_support( 'custom-background', array(
		'default-color'			=> 'fff',
		'default-image'			=> THEME_URI . '/img/bg/bg_site.jpg',
		'default-repeat'		=> 'no-repeat',
		'default-position-x'	=> 'center',
		'default-attachment'	=> 'fixed'
	) );

	// Inclui o arquivo que dá suporte a cabeçalho personalizado
    require INCLUDES_PATH . '/viking_custom_header.php';
	
	// Suporte a elementos HTML5
	add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ) );
	
	// Suporte a idiomas
	load_theme_textdomain( 'viking-theme', THEME_PATH . '/languages' );
}
add_action( 'after_setup_theme', 'viking_setup' );


/**
 * Favicon personalizado
 * ----------------------------------------------------------------------------
 */
function my_favicon(){
	$favicon 			= ICONS_URI . '/favicon.ico';
	$apple_icons 		= read_dir( ICONS_PATH, 'png' );
	$apple_icons_name 	= array_keys( $apple_icons );
	$apple_icons_count 	= count( $apple_icons_name );
	$apple_icons_size 	= str_replace( '-', '', $apple_icons_name);
	$apple_icons_size 	= str_replace( 'appletouchicon', '', $apple_icons_size);
	
	$favicons  = '<!-- Favicon IE 9 -->';
	$favicons .= '<!--[if lte IE 9]><link rel="icon" type="image/x-icon" href="' . $favicon . '" /> <![endif]-->';
	
	$favicons .= '<!-- Favicon Outros Navegadores -->';
	$favicons .= '<link rel="shortcut icon" type="image/png" href="' . $favicon . '" />';
	
	$favicons .='<!-- Favicon Apple -->';
	
	for ( $i = 0; $i < $apple_icons_count; $i++ ) :
		$size = ( $apple_icons_size[$i] == '' ) ? '' : ' sizes="' . $apple_icons_size[$i] . '"';
		
		$favicons .='<link rel="apple-touch-icon"' . $size . ' href="' . ICONS_URI . $apple_icons_name[$i] . '.png" />';
	endfor;
	
	echo $favicons;
}
add_action( 'wp_head', 'my_favicon' );
add_action( 'admin_head', 'my_favicon' );
add_action( 'login_head', 'my_favicon' );


/**
 * Ícone personalizado para a tela de login
 * ----------------------------------------------------------------------------
 */
function viking_login_icon(){
	$login_icon_url 	= IMAGES_URI . '/login_icon.png';
	$login_icon_width 	= 290;
	$login_icon_height 	= 250;
	
	$output  = '<style id="viking_login_icon" type="text/css">';
	$output .= 'body.login #login {';
	$output .= 'width: 1000px;';
	$output .= 'max-width: 95%;';
	$output .= 'padding-top: 5%;';
	$output .= '}';
	$output .= 'body.login #login h1 {';
	$output .= 'float: left;';
	$output .= 'width: 29%;';
	$output .= 'margin-right: 2%;';
	$output .= '}';
	$output .= 'body.login #login h1 a {';
	$output .= 'background: url("' . $login_icon_url . '") no-repeat;';
	$output .= 'background-position: center center;';
	$output .= 'width: ' . $login_icon_width . 'px;';
	$output .= 'height: ' . $login_icon_height . 'px;';
	$output .= 'max-width: 100%;';
	$output .= 'margin: auto;';
	$output .= 'margin-bottom: 0;';
	$output .= '}';
	$output .= 'body.login #login #loginform {';
	$output .= 'margin-top: 0;';
	$output .= '}';
	$output .= 'body.login #login > p {';
	$output .= 'text-align: right;';
	$output .= '}';
	$output .= '</style>';
	
	echo $output;
}
add_action( 'login_head', 'viking_login_icon' );


/**
 * Carregar as folhas de estilo do tema
 * ----------------------------------------------------------------------------
 */
function viking_styles() {
	wp_register_style( 'reset', STYLES_URI . '/reset.css', array(), '2.0', 'all' );
	wp_enqueue_style( 'reset' );
	
	wp_register_style( 'grid', STYLES_URI . '/grid.css', array(), '2.0', 'all' );
	wp_enqueue_style( 'grid' );
	
	wp_register_style( 'font-awesome', THEME_URI . '/font-awesome/css/font-awesome.min.css', array(), '4.3.0', 'all' );
	wp_enqueue_style( 'font-awesome' );
	
	wp_register_style( 'font-metamorphous', 'http://fonts.googleapis.com/css?family=Metamorphous&subset=latin,latin-ext', array(), '1.0', 'all' );
	wp_enqueue_style( 'font-metamorphous' );
	
	wp_register_style( 'viking_style', THEME_URI . '/style.css', array(), '2.0', 'all' );
	wp_enqueue_style( 'viking_style' );
	
	wp_register_style( 'viking_lightbox', STYLES_URI . '/lightbox.css', array(), '2.7.1', 'all' );
	wp_enqueue_style( 'viking_lightbox' );
}
add_action( 'wp_enqueue_scripts', 'viking_styles' );


/**
 * Remove 'text/css' das folhas de estilo
 * ----------------------------------------------------------------------------
 */
function my_style_remove( $tag ) {
	return preg_replace( '~\s+type=["\'][^"\']++["\']~', '', $tag );
}
add_filter( 'style_loader_tag', 'my_style_remove' );


/**
 * Carregar os scripts do tema
 * ----------------------------------------------------------------------------
 */
function viking_header_scripts() {
	if ( ! is_admin() ) :
		wp_register_script('viking_jquery', SCRIPT_URI . '/lib/jquery.js', array(), '2.1.1'); // JQuery
		wp_enqueue_script('viking_jquery');
		
		wp_register_script('grid_js', SCRIPT_URI . '/grid.js', array(), '1.0'); // Grid Scripts
		wp_enqueue_script('grid_js');
	//elseif ( $GLOBALS['pagenow'] != 'wp-login.php' && ! is_admin() ) :
		wp_register_script('viking_jcycle2', SCRIPT_URI . '/lib/jcycle2.js', array(), '2.1.5'); // JCycle 2
		wp_enqueue_script('viking_jcycle2');
		
		wp_register_script('viking_lightbox', SCRIPT_URI . '/lib/lightbox.js', array(), '2.7.1'); // Lightbox 2
		wp_enqueue_script('viking_lightbox');
		
		wp_register_script('viking_modernizr', SCRIPT_URI . '/lib/modernizr.js', array(), '2.8.3'); // Modernizr
		wp_enqueue_script('viking_modernizr');
		
		wp_register_script('viking_scripts', SCRIPT_URI . '/geral.js', array(), '2.0'); // Scripts personalizados
		wp_enqueue_script('viking_scripts');
	endif;
}
add_action( 'init', 'viking_header_scripts');


/**
 * Título das páginas
 * ----------------------------------------------------------------------------
 */
function my_wp_title ( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() ) return $title;

	// Adiciona o nome do site.
	$title .= get_bloginfo( 'name', 'display' );

	// Adiciona a descrição do site para a home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) ) $title = "$title $sep $site_description";

	// Adiciona o número da página se necessário.
	if ( $paged >= 2 || $page >= 2 ) $title = "$title $sep " . sprintf( __( 'Page %s', 'viking-theme' ), max( $paged, $page ) );

	return $title;
}
add_filter( 'wp_title', 'my_wp_title', 10, 2 );


/**
 * Remove estilos de comentários recentes injetados no wp_head()
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
 * ----------------------------------------------------------------------------
 */
function change_generator() {
	return '<meta name="generator" content="' . get_bloginfo( 'name', 'display' ) . '" />';
}
add_filter( 'the_generator', 'change_generator' );


/**
 * Remove barra de administração
 * ----------------------------------------------------------------------------
 */
function remove_admin_bar() {
	return false;
}
add_filter( 'show_admin_bar', 'remove_admin_bar' );


/**
 * Adiciona o "slug" de página como classe no elemento <body>
 * Créditos: Starkers Wordpress Theme
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
 * Menu de navegação customizado.
 * 
 * @param	$menu				string	Nome do menu personalizado pre-registrado em Aparência > Menus
 * @param	$container_class	string	Classe que vai ser aplicada no conteiner
 * @param	$menu_class			string	Classe que vai ser aplicada no menu
 * @param	$container_id		string	Id que vai ser aplicada no conteiner
 * @return	Menu de navegação
 * ----------------------------------------------------------------------------
 */
function viking_nav( $menu, $container_class = null, $menu_class = null, $container_id = null ) {
	// Inclui o Walker personalizado para construção do menu
	require INCLUDES_PATH . '/viking_walker_nav_menu.php';
	
	$container_id = ( ! empty( $container_id ) ) ? ' ' . $container_id : '';
	$container_class = ( ! empty( $container_class ) ) ? ' ' . $container_class : '';
	$menu_class = ( ! empty( $menu_class ) ) ? ' ' . $menu_class : '';
	
	wp_nav_menu( array(
		'theme_location'	=> '',
		'menu'				=> $menu,
		'container'			=> 'nav',
		'container_class'	=> 'nav-menu-container' . $container_class,
		'container_id'		=> $menu . '-nav' . $container_id,
		'menu_class'		=> 'nav-menu' . $menu_class,
		'menu_id'			=> $menu,
		'echo'				=> true,
		'fallback_cb'		=> 'wp_page_menu',
		'before'			=> '',
		'after'				=> '',
		'link_before'		=> '',
		'link_after'		=> '',
		'items_wrap'		=> '<ul id="%1$s" class="%2$s">%3$s</ul>',
		'depth'				=> 0,
		'walker'			=> new viking_walker_nav_menu()
	) );
}


/**
 * Menu de navegação customizado do cabeçalho.
 * 
 * @param	$menu				string	Nome do menu personalizado pre-registrado em Aparência > Menus
 * @param	$container_class	string	Classe que vai ser aplicada no conteiner
 * @param	$menu_class			string	Classe que vai ser aplicada no menu
 * @param	$container_id		string	Id que vai ser aplicada no conteiner
 * @return	Menu de navegação
 * ----------------------------------------------------------------------------
 */
function viking_nav_header( $menu, $container_class = null, $menu_class = null ) {
	// Inclui o Walker personalizado para construção do menu
	require INCLUDES_PATH . '/viking_walker_nav_menu.php';
	
	$container_class = ( ! empty( $container_class ) ) ? ' ' . $container_class : '';
	$menu_class = ( ! empty( $menu_class ) ) ? ' ' . $menu_class : '';
	
	wp_nav_menu( array(
		'theme_location'	=> '',
		'menu'				=> $menu,
		'container'			=> 'nav',
		'container_class'	=> $container_class,
		'container_id'		=> $menu . '-nav',
		'menu_class'		=> $menu_class,
		'menu_id'			=> $menu,
		'echo'				=> true,
		'fallback_cb'		=> 'wp_page_menu',
		'before'			=> '',
		'after'				=> '',
		'link_before'		=> '',
		'link_after'		=> '',
		'items_wrap'		=> '<ul id="%1$s" class="%2$s">%3$s</ul>',
		'depth'				=> 0,
		'walker'			=> new viking_walker_nav_menu()
	) );
}


/**
 * Registro dos Menus de Navegação do Tema
 * ----------------------------------------------------------------------------
 */
function register_viking_menu() {
	register_nav_menus( array(		// Use o array para especificar mais menus, se necessário.
		'header-menu'	=> __('Header Menu', 'viking-theme'),	// Menu Principal
		'sidebar-menu'	=> __('Sidebar Menu', 'viking-theme'),	// Menu da Barra Lateral
		'extra-menu'	=> __('Extra Menu', 'viking-theme')		// Menu Extra. Se necessário, duplique para quantos precisar.
	) );
}
add_action( 'init', 'register_viking_menu' );


/**
 * Chamada para o slider
 * ----------------------------------------------------------------------------
 */
function get_slider() {
	if ( is_home() || is_front_page() || is_archive() ) get_template_part( 'slider' );
}


/**
 * Coleta informações da imagem destacada da postagem
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
 * ----------------------------------------------------------------------------
 */
function viking_post_thumb( $size = 'post-size' ) {
	$thumb_id = get_post_thumbnail_id();
	
	$thumb_link_full = wp_get_attachment_image_src( $thumb_id, 'full' );
	$thumb_link_full = $thumb_link_full[0];
	
	$thumb_caption = viking_get_thumb_meta( $thumb_id, 'caption' );
	?>
	
	<!-- post thumbnail -->
	<figure class="post-thumb<?php if ( is_page() ) : echo ' col_4'; endif; ?>">
		<a class="link-thumb img-link"
		   href="<?php if ( is_single() ) : echo $thumb_link_full; else : the_permalink(); endif; ?>"
		   title="<?php the_title(); ?>"
		   <?php if ( is_single() ) : ?>data-lightbox="post-<?php the_ID(); ?>" data-title="<?php echo $thumb_caption; ?>"<?php endif; ?>>
			<?php the_post_thumbnail( $size, array( 'class' => 'img-thumb' ) ); ?>
		</a>
	</figure>
	<!-- /post thumbnail -->
	
	<?php
}


/**
 * Detalhes personalizadas para as postagens
 * ----------------------------------------------------------------------------
 */
function viking_post_details() {
	$post = get_post();
	foreach ( ( array ) get_the_category( $post->ID ) as $categ ) :
		$categ_slug = sanitize_html_class( $categ->slug, $categ->term_id );
	endforeach;
	?>
	<!-- post details -->
	<section class="post-details">
		<?php viking_post_thumb(); ?>
		
		<span class="post-categ shadow categ-<?php echo $categ_slug; ?>"><?php the_category( ', ' ); ?></span>
		
		<?php if ( is_single() ) : ?>
			<div class="post-details-bar">
				<span class="post-author"><?php the_author_posts_link(); ?></span> | 
				<span class="post-date"><?php viking_date_link(); ?></span> | 
				<span class="post-comments"><?php viking_comment_link(); ?></span>
				<?php if ( is_user_logged_in() ) : ?>
					 | <span class="edit-link"><?php edit_post_link(); // Link para editar a postagem ?></span>
				<?php endif; ?>
			</div>
		<?php endif; ?>
	</section>
	<!-- /post details -->
	<?php
}


/**
 * Remove as dimensões de largura e altura das miniaturas
 * que evitam imagens fluidas em the_thumbnail
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
 * ----------------------------------------------------------------------------
 */
function remove_category_rel_from_category_list( $thelist ) {
    return str_replace( 'rel="category tag"', 'rel="tag"', $thelist );
}
add_filter( 'the_category', 'remove_category_rel_from_category_list' );


/**
 * Cria datas como links
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
 * ----------------------------------------------------------------------------
 */
function viking_comment_link() {
	if ( comments_open( get_the_ID() ) )
		comments_popup_link(
			__( 'Leave your thoughts', 'viking-theme' ),
			__( '1 Comment', 'viking-theme' ),
			__( '% Comments', 'viking-theme' )
		);
}


/**
 * Criar resumos personalizados
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
 * ----------------------------------------------------------------------------
 */
function viking_index( $length ) {
	return 50;
}


/**
 * Tamanho em palavras para os resumos personalizados do slider.
 * Uso: viking_excerpt( 'viking_length_slider' );
 * ----------------------------------------------------------------------------
 */
function viking_length_slider( $lenght ) {
	return 10;
}


/**
 * Cria link Ver Artigo personalizado para a postagem 
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
 * Comentários personalizados
 * ----------------------------------------------------------------------------
 */
function viking_comments( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	
	extract( $args, EXTR_SKIP );
	
	if ( 'div' == $args['style'] ) :
		$tag = 'div';
		$add_below = 'comment';
	else :
		$tag = 'li';
		$add_below = 'div-comment';
	endif;
?>
	<!-- heads up: starting < for the html tag (li or div) in the next line: -->
	<<?php echo $tag; ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ) ?> id="comment-<?php comment_ID() ?>">
		
		<?php if ( 'div' != $args['style'] ) : ?>
			<div id="div-comment-<?php comment_ID() ?>" class="comment-body">
		<?php endif; ?>
		
		<div class="comment-author vcard">
			<?php if ( $args['avatar_size'] != 0 ) echo get_avatar( $comment, $args['180'] ); ?>
			<?php printf( __( '<cite class="fn">%s</cite> <span class="says">says:</span>' ), get_comment_author_link() ) ?>
		</div>
		
		<?php if ( $comment->comment_approved == '0' ) : ?>
			<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'viking-theme' ) ?></em><br />
		<?php endif; ?>
		
		<div class="comment-meta commentmetadata">
			<a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>">
				<?php printf( __( '%1$s at %2$s', 'viking-theme' ), get_comment_date(),  get_comment_time() ) ?>
			</a><?php edit_comment_link( __( '[Edit]', 'viking-theme' ),'  ','' ); ?>
		</div>
		
		<?php comment_text(); ?>
		
		<div class="reply">
			<?php comment_reply_link( array_merge( $args, array( 'add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ) ?>
		</div>
		
	<?php if ( 'div' != $args['style'] ) : ?>
		</div>
	<?php endif;
}


/**
 * Navegação dos comentários
 * ----------------------------------------------------------------------------
 */
function viking_comment_nav() {
	// Há comentários para navegação?
	if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
		<nav class="nav comment-nav" role="navigation">
			<h2 class="screen-reader-text"><?php _e( 'Comment navigation', 'twentyfifteen' ); ?></h2>
			<div class="nav-links">
				<?php
					if ( $prev_link = get_previous_comments_link( __( 'Older Comments', 'twentyfifteen' ) ) ) :
						printf( '<div class="nav-previous">%s</div>', $prev_link );
					endif;
	
					if ( $next_link = get_next_comments_link( __( 'Newer Comments', 'twentyfifteen' ) ) ) :
						printf( '<div class="nav-next">%s</div>', $next_link );
					endif;
				?>
			</div><!-- .nav-links -->
		</nav><!-- .comment-nav -->
	<?php endif;
}


/**
 * Registro de Áreas de Widget
 * ----------------------------------------------------------------------------
 */
function viking_widgets_init() {
	// Define Sidebar Widget Area 1
	register_sidebar( array(
		'name'			=> __( 'Widget Area 1', 'viking-theme' ),
		'id'			=> 'widget-area-1',
		'description'	=> __( 'Description for this widget-area...', 'viking-theme' ),
		'before_widget'	=> '<section id="%1$s" class="widget %2$s">',
		'after_widget'	=> '</div></section>',
		'before_title'	=> '<h5 class="widget-title inner">',
		'after_title'	=> '</h5><div class="widget-content inner">'
	) );
	
	// Define Sidebar Widget Area 2
	register_sidebar( array(
		'name'			=> __( 'Widget Area 2', 'viking-theme' ),
		'id'			=> 'widget-area-2',
		'description'	=> __( 'Description for this widget-area...', 'viking-theme' ),
		'before_widget'	=> '<section id="%1$s" class="widget %2$s">',
		'after_widget'	=> '</div></section>',
		'before_title'	=> '<h5 class="widget-title inner">',
		'after_title'	=> '</h5><div class="widget-content inner">'
	) );
}
add_action( 'widgets_init', 'viking_widgets_init' );


/**
 * Actions, Filtros e ShortCodes
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

?>