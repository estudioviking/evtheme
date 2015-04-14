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
 * 
 * @since Estúdio Viking 1.0
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

