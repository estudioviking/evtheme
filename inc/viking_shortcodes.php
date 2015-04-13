<?php 
/**
 * Shortcodes
 * 
 * Author: Ivanildo Dias
 */

add_shortcode( 'contac-form-scripts', 'my_contact_form_scripts' );	// Scripts do Formulário de Contato
add_shortcode( 'home-link', 'my_home_link' );						// Link para página inicial
add_shortcode( 'current-year', 'my_current_year' );					// Ano atual


/**
 * Funções dos Shortcodes
 * ----------------------------------------------------------------------------
 */

/**
 * Scripts para o formulário de contato
 * 
 * @uses [contac-form-scripts]
 * ----------------------------------------------------------------------------
 */
function my_contact_form_scripts( $atts ) {
	$scripts = '<script type="text/javascript" src="' . get_template_directory_uri() . '/js/jquery-validate.js"></script>
				<script type="text/javascript" src="' . get_template_directory_uri() . '/js/jquery-validate-add-methods.js"></script>
				<script type="text/javascript" src="' . get_template_directory_uri() . '/js/jquery-validate-messages.js"></script>
				<script type="text/javascript" src="' . get_template_directory_uri() . '/js/jquery-inputmask.js"></script>
				<script type="text/javascript">
				$(document).ready(function(){
					$("#contact-form").validate({
						rules:{
							nome: { required: true, minlength: 3 },
							email: { required: true, email: true },
							assunto: { required: true },
							msg: { required: true }
						}
					});
					$("#fone").inputmask("+55 99 9999-9999");
					$("#celfone").inputmask("+55 99 9999[9]-9999");
				});
			</script>';
	
	return $scripts;
}


/**
 * Link para página inicial do site
 * 
 * @uses [home-link]
 * ----------------------------------------------------------------------------
 */
function my_home_link( $atts ) {
	$output_link = '<a href="' . get_bloginfo( 'url', 'display' ) . '" title="' . get_bloginfo( 'name', 'display' ) . '" rel="home">' . get_bloginfo( 'name', 'display' ) . '</a>';
	return $output_link;
}


/**
 * Link para página inicial do site
 * 
 * @uses [current-year]
 * ----------------------------------------------------------------------------
 */
function my_current_year( $atts ) {
	$output_year = date( 'Y' );
	return $output_year;
}

