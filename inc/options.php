<?php
/**
 * Opções para personalização do tema
 *
 * @package Estúdio Viking
 * @since 1.0
 */



add_action( 'admin_menu', 'ev_add_admin_menu' );
add_action( 'admin_init', 'ev_settings_init' );


function ev_add_admin_menu() {
	add_theme_page( 'Estúdio Viking', 'Estúdio Viking', 'manage_options', 'estudio_viking', 'ev_options_page' );
}


function ev_settings_init() {
	register_setting( 'theme_options_page', 'ev_settings' );
	
	add_settings_section(
		'ev_theme_options_page_section', 
		__( 'Your section description', 'viking-theme' ), 
		'ev_settings_section_callback', 
		'theme_options_page'
	);

	add_settings_field( 
		'ev_text_field_0', 
		__( 'Settings field description', 'viking-theme' ), 
		'ev_text_field_0_render', 
		'theme_options_page', 
		'ev_theme_options_page_section' 
	);

	add_settings_field( 
		'ev_checkbox_field_1', 
		__( 'Settings field description', 'viking-theme' ), 
		'ev_checkbox_field_1_render', 
		'theme_options_page', 
		'ev_theme_options_page_section' 
	);

	add_settings_field( 
		'ev_radio_field_2', 
		__( 'Settings field description', 'viking-theme' ), 
		'ev_radio_field_2_render', 
		'theme_options_page', 
		'ev_theme_options_page_section' 
	);

	add_settings_field( 
		'ev_textarea_field_3', 
		__( 'Settings field description', 'viking-theme' ), 
		'ev_textarea_field_3_render', 
		'theme_options_page', 
		'ev_theme_options_page_section' 
	);

	add_settings_field( 
		'ev_select_field_4', 
		__( 'Settings field description', 'viking-theme' ), 
		'ev_select_field_4_render', 
		'theme_options_page', 
		'ev_theme_options_page_section' 
	);


}


function ev_text_field_0_render(  ) { 

	$options = get_option( 'ev_settings' );
	?>
	<input type='text' name='ev_settings[ev_text_field_0]' value='<?php echo $options['ev_text_field_0']; ?>'>
	<?php

}


function ev_checkbox_field_1_render(  ) { 

	$options = get_option( 'ev_settings' );
	?>
	<input type='checkbox' name='ev_settings[ev_checkbox_field_1]' <?php checked( $options['ev_checkbox_field_1'], 1 ); ?> value='1'>
	<?php

}


function ev_radio_field_2_render(  ) { 

	$options = get_option( 'ev_settings' );
	?>
	<input type='radio' name='ev_settings[ev_radio_field_2]' <?php checked( $options['ev_radio_field_2'], 1 ); ?> value='1'>
	<?php

}


function ev_textarea_field_3_render(  ) { 

	$options = get_option( 'ev_settings' );
	?>
	<textarea cols='40' rows='5' name='ev_settings[ev_textarea_field_3]'> 
		<?php echo $options['ev_textarea_field_3']; ?>
 	</textarea>
	<?php

}


function ev_select_field_4_render(  ) { 

	$options = get_option( 'ev_settings' );
	?>
	<select name='ev_settings[ev_select_field_4]'>
		<option value='1' <?php selected( $options['ev_select_field_4'], 1 ); ?>>Option 1</option>
		<option value='2' <?php selected( $options['ev_select_field_4'], 2 ); ?>>Option 2</option>
	</select>

<?php

}


function ev_settings_section_callback(  ) { 

	echo __( 'This section description', 'viking-theme' );

}


function ev_options_page(  ) { 

	?>
	<form action='options.php' method='post'>
		
		<h2>Estúdio Viking</h2>
		
		<?php
		settings_fields( 'theme_options_page' );
		do_settings_sections( 'theme_options_page' );
		submit_button();
		?>
		
	</form>
	<?php

}

