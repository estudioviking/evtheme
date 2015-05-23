<?php
/**
 * Opções para personalização do tema
 * 
 * @package Estúdio Viking
 * @since 1.0
 */

/**
 * Adiciona o menu de personalização do tema
 * 
 * @since Estúdio Viking 1.0
 * ----------------------------------------------------------------------------
 */
function ev_options_menu_pages() {
	// Menu de Opções Gerais
	add_menu_page(
		__( 'Viking General Options', 'viking-theme' ),	// Título da página
		__( 'Viking Options', 'viking-theme' ),			// Título do menu
		'edit_theme_options',							// Capacidade
		'ev_general_options_page',						// Termo único do Menu
		'ev_general_options_page_screen',				// Função de exibição
		'',												// Ícone
		61												// Posição
	);
	
	// Menu de Estilos
	add_submenu_page(
		'ev_general_options_page',						// Termo único do menu pai
		__( 'Viking Style Options', 'viking-theme' ),	// Título da página
		__( 'Style Options', 'viking-theme' ),			// Título do sub-menu
		'edit_theme_options',							// Capacidade
		'ev_style_options_page',						// Termo único do sub-menu
		'ev_style_options_page_screen'					// Função de exibição
	);
}
add_action( 'admin_menu', 'ev_options_menu_pages' );


/**
 * Registro das opções do menu de personalização do tema
 * 
 * @since Estúdio Viking 1.0
 * ----------------------------------------------------------------------------
 */
function ev_options_init(){
	// Registro das configurações
	register_setting(
		'ev_general_options',	// Grupo de opções
		'ev_theme_options'		// Nome da opção
		//'ev_options_validate'	// Função para validar opções
	);
	
	/**
	 * Seção de Opções Gerais
	 * ----------------------------------------------------------------------------
	 */
	add_settings_section(
		'ev_general_options_page_section',			// Id
		__( 'General Options', 'viking-theme' ),	// Título
		'ev_general_settings_section_callback',		// Função para exibição da seção
		'ev_general_options'						// Grupo de opções em que a seção é exibida
	);
	
	// Texto do rodapé
	add_settings_field(
		'ev_options_footer_text',							// Id
		__( 'Custom footer-text', 'viking-theme' ),			// Título
		'ev_textarea_field_render',							// Função de exibição do campo
		'ev_general_options',								// Grupo de opções em que o campo é exibido
		'ev_general_options_page_section',					// Seção de opções em que o campo é exibido
		array(												// Argumentos do campo
			'id'			=> 'ev_options_footer_text',
			'desc'			=> __( 'Type your custom copyright text displayed on footer', 'viking-theme' ),
			'field_class'	=> 'large-text',
			'rows'			=> 3,
			'default'		=> '&copy; ' . date( 'Y' ) . ' ' . do_shortcode( '[home-link]' ) . ' - ' . __( 'All rights reserved.', 'viking-theme' ) . ' ' .
							   sprintf(
							   		__( 'Powered by <a href="%s" rel="nofollow" target="_blank">Estúdio Viking</a> on <a href="%s" rel="nofollow" target="_blank">WordPress</a>.', 'viking-theme' ),
							   		'https://github.com/estudioviking/evtheme',
							   		'http://wordpress.org/' )
		)
	);
}
add_action( 'admin_init', 'ev_options_init' );


/**
 * Função para exibição da seção de opções gerais do tema
 * 
 * @since Estúdio Viking 1.0
 * ----------------------------------------------------------------------------
 */
function ev_general_settings_section_callback( $arg ) {
	echo $output = '<p>' . __( 'General options to customize Estúdio Viking theme.', 'viking-theme' ) . '</p>';
}


/**
 * Função para a exibição de textarea gerais
 * 
 * @since Estúdio Viking 1.0
 * ----------------------------------------------------------------------------
 */
function ev_textarea_field_render( $args ) {
	global $ev_options;
	
	$id			= ( $args['id'] ) ? $args['id'] : '';
	$slug		= 'ev_theme_options[' . $id . ']';
	$desc		= $args['desc'];
	$class		= ( $args['field_class'] ) ? 'class="' . $args['field_class'] . '" ' : '';
	$cols		= ( $args['cols'] ) ? $args['cols'] : 50;
	$rows		= ( $args['rows'] ) ? $args['rows'] : 10;
	$default	= $args['default'];
	$value		= $ev_options[ $id ];
	
	if ( ! isset( $value ) ) $value = $default;
	
	$field_output  = '<textarea id="' . esc_attr( $slug ) . '" name="' . esc_attr( $slug ) . '" ' . $class . 'cols="' . esc_attr( $cols ) . '" rows="' . esc_attr( $rows ) . '">';
	$field_output .= esc_textarea( $value );
	$field_output .= '</textarea>';
	
	if ( $desc ) :
		$field_output .= '<p id="' . esc_attr( $slug ) . '-description" class="description">' . $desc .'</p>';
	endif;
	
	if ( $default ) :
		$field_output .= '<p id="' . esc_attr( $slug ) . '-default"><strong>Default: </strong>' . esc_html( $default ) . '</p>';
		
		add_filter( 'default_option_' . $id, $default, 10, 1 );
	endif;
	
	echo $field_output;
}


/**
 * Cria a página de opções gerais do tema
 * 
 * @since Estúdio Viking 1.0
 * ----------------------------------------------------------------------------
 */
function ev_general_options_page_screen() {
	if ( ! isset( $_REQUEST['settings-updated'] ) )
		$_REQUEST['settings-updated'] = false;
	
	?>
	<div class="wrap">
		<h2><?php echo esc_html( get_current_theme() . __( ' General Theme Options', 'viking-theme' ) ); ?></h2>
		
		<?php
			if ( false !== $_REQUEST['settings-updated'] ) :
				settings_errors();
			endif;
		?>
		
		<form method="post" action="options.php">
			<?php
				settings_fields( 'ev_general_options' );
				do_settings_sections( 'ev_general_options' );
				submit_button();
			?>
		</form>
	</div>
	<?php
}


/**
 * Cria a página de opções de estilo do tema
 * 
 * @since Estúdio Viking 1.0
 * ----------------------------------------------------------------------------
 */
function ev_style_options_page_screen() {
	echo 'Style Page';
}

/**
 * Sanitize and validate input. Accepts an array, return a sanitized array.
 */
function ev_options_validate( $input ) {
	global $select_options, $radio_options;

	// Our checkbox value is either 0 or 1
	if ( ! isset( $input['option1'] ) )
		$input['option1'] = null;
	$input['option1'] = ( $input['option1'] == 1 ? 1 : 0 );

	// Say our text option must be safe text with no HTML tags
	$input['sometext'] = wp_filter_nohtml_kses( $input['sometext'] );

	// Our select option must actually be in our array of select options
	if ( ! array_key_exists( $input['selectinput'], $select_options ) )
		$input['selectinput'] = null;

	// Our radio option must actually be in our array of radio options
	if ( ! isset( $input['radioinput'] ) )
		$input['radioinput'] = null;
	if ( ! array_key_exists( $input['radioinput'], $radio_options ) )
		$input['radioinput'] = null;

	// Say our textarea option must be safe text with the allowed tags for posts
	$input['sometextarea'] = wp_filter_post_kses( $input['sometextarea'] );

	return $input;
}


$ev_options = get_option( 'ev_theme_options' );
