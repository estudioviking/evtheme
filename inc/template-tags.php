<?php
/**
 * Tags de modelo personalizadas para este tema
 * 
 * Eventualmente, algumas das funcionalidades aqui poderia ser substituída
 * por características do wordpress
 * 
 * @package Estúdio Viking
 * @since 1.0
 */


/**
 * Favicon personalizado
 * 
 * @since Estúdio Viking 1.0
 * ----------------------------------------------------------------------------
 */
function my_favicon(){
	$favicon 			= ICONS_URI . '/favicon.ico';
	$apple_icons 		= viking_readdir( ICONS_PATH, 'png' );
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
 * 
 * @since Estúdio Viking 1.0
 * ----------------------------------------------------------------------------
 */
function viking_login_icon(){
	$login_icon_url 	= IMAGES_URI . '/login_icon.png';
	$login_icon_width 	= 290;
	$login_icon_height 	= 250;
	
	$output  = '
		<style id="viking_login_icon" type="text/css">
			body.login #login {
				width: 1000px;
				max-width: 95%;
				padding-top: 5%;
			}
			body.login #login h1 {
				float: left;
				width: 29%;
				margin-right: 2%;
			}
			body.login #login h1 a {
				background: url("' . $login_icon_url . '") no-repeat;
				background-position: center center;
				width: ' . $login_icon_width . 'px;
				height: ' . $login_icon_height . 'px;
				max-width: 100%;
				margin: auto;
				margin-bottom: 0;
			}
			body.login #login #loginform {
				margin-top: 0;
			}
			body.login #login > p {
				text-align: right;
			}
		</style>
	';
	
	echo $output;
}
add_action( 'login_head', 'viking_login_icon' );


/**
 * Remove 'text/css' das folhas de estilo
 * 
 * @since Estúdio Viking 1.0
 * ----------------------------------------------------------------------------
 */
function my_style_remove( $tag ) {
	return preg_replace( '~\s+type=["\'][^"\']++["\']~', '', $tag );
}
add_filter( 'style_loader_tag', 'my_style_remove' );


/**
 * Título das páginas
 * 
 * @since Estúdio Viking 1.0
 * ----------------------------------------------------------------------------
 *//*
function my_wp_title( $title, $sep ) {
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
add_filter( 'wp_title', 'my_wp_title', 10, 2 );*/


/**
 * Títulos personalizados para páginas arquivos
 * 
 * @since Estúdio Viking 1.0
 * ----------------------------------------------------------------------------
 */
function my_archive_title( $title ) {
	if ( is_category() ) :
		$title = sprintf( __( 'Posts in category: %s', 'viking-theme' ), single_cat_title( '', false ) );
	elseif ( is_tag() ) :
		$title = sprintf( __( 'Posts in tag: %s', 'viking-theme' ), single_tag_title( '', false ) );
	elseif ( is_author() ) :
		$title = sprintf( __( 'Posts of the author: %s', 'viking-theme' ), get_the_author() );
	elseif ( is_day() ) :
		$title = sprintf( __( 'Posts of the day: %s', 'viking-theme' ), get_the_date( get_option( 'date_format' ) ) );
	elseif ( is_month() ) :
		$title = sprintf( __( 'Posts of the month: %s', 'viking-theme' ), get_the_date( 'F\/Y' ) );
	elseif ( is_year() ) :
		$title = sprintf( __( 'Posts of the year: %s', 'viking-theme' ), get_the_date( 'Y' ) );
	endif;
	
	return $title;
}
add_filter( 'get_the_archive_title', 'my_archive_title' );

/**
 * Paginação de Artigos
 * 
 * @since Estúdio Viking 1.0
 * ----------------------------------------------------------------------------
 */
function viking_post_pagination() {
	the_posts_pagination( array(
		'prev_text'          => '<i class="fa fa-arrow-left"></i> ' . __( 'Previous page', 'viking-theme' ),
		'next_text'          => __( 'Next page', 'viking-theme' ) . ' <i class="fa fa-arrow-right"></i>',
		'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'viking-theme' ) . ' </span>',
	) );
	
	echo '<!-- .pagination -->';
}
