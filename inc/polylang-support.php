<?php



/**
 * Adiciona o seletor de idiomas do tema
 * 
 * OBS.: Essa função só vai funcionar se você instalar o plugin "Polylang"
 * @link https://wordpress.org/plugins/polylang/
 * 
 * @since Estúdio Viking 1.0
 * ----------------------------------------------------------------------------
 */
function get_lang_switcher() {
	global $wp_widget_factory;
	
	$widget = 'PLL_Widget_Languages';
	
	$widget_obj = $wp_widget_factory->widgets[$widget];
	if ( ! ( $widget_obj instanceof WP_Widget ) ) return;
	
	$instance = array(
		'title'						=> __( 'Language Switcher', 'viking-theme' ),
		'show_flags'				=> 1,
		'hide_if_no_translation'	=> 1
	);
	
	$args = array(
		'before_widget'	=> sprintf( '<aside id="polylang-switcher" class="widget %s">', $widget_obj->widget_options['classname'] ),
		'before_title'	=> '<h2 class="widget-title inner screen-reader-text">',
		'after_title'	=> '</h2><div class="widget-content inner">' . '<div class="polylang-switcher-caption">' . __( 'Choose the website language:', 'viking-theme' ) . '</div>',
		'after_widget'	=> '</div></aside>'
	);
	
	the_widget( $widget, $instance, $args );
	echo '<!-- #polylang-switcher -->';
}

function lang_switcher_walker( $output, $args ) {
	$output = str_replace( '&nbsp;', '<span class="screen-reader-text">', $output);
	$output = str_replace( '</a>', '</span></a>', $output);
	return $output;
}
add_filter( 'pll_the_languages', 'lang_switcher_walker', 10, 2 );