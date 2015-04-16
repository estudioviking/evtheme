<?php
/**
 * Suporte a cabeçalho personalizado
 * ----------------------------------------------------------------------------
 */

/**
 * Diretório dos cabeçalhos personalizados
 * %s é um placeholder para o diretório URI do tema.
 */
$headers_uri = '%s/img/headers/';

add_theme_support( 'custom-header', array(
	// Imagem e cor de texto padrão
	'default-image'          => $headers_uri . 'logo_header.png',
	'default-text-color'     => '000',
	
	// Tamanho padrão para as imagens
	'width'                  => 340,
	'height'                 => 120,
	
	// Opções extras
	'random-default'         => false,	// Cabeçalho aleatório
	'flex-height'            => true,	// Altura flexível
	'flex-width'             => false,	// Largura flexível
	'header-text'            => true,	// Habilita suporte a personalização do texto
	'uploads'                => true,	// Permite upload de imagens
	
	// Estilo que vai apareceer no head do site
	'wp-head-callback'       => 'viking_header_style',
) );

/**
 * Pacote de imagens personalizadas para o cabeçalho
 * Remova os comentários para habilitar
 * ----------------------------------------------------------------------------
 */
/*
register_default_headers( array(
	'exemplo' => array(
		'url'           => $headers_uri . 'exemplo.png',
		'thumbnail_url' => $headers_uri . 'exemplo-thumbnail.png',
		'description'   => _x( 'Exemplo', 'header image description', 'viking-theme' )
	),
) );
*/

/**
 * Elementos que vão aparecer no head do site após personalização
 * na área de administração do cabeçalho personalizado do site.
 * ----------------------------------------------------------------------------
 */
function viking_header_style() {
	$header_image = get_header_image();
	$image_width_px  = get_custom_header()->width;
	$image_width_rem  = ( $image_width_px / 10 );
	$image_height_px  = get_custom_header()->height;
	$image_height_rem = ( $image_height_px / 10 );
	$text_color   = get_header_textcolor();

	// Se nenhuma cor personalizada para o texto estiver configurada.
	//if ( display_header_text() && $text_color === get_theme_support( 'custom-header', 'default-text-color' ) ) return;

	// Se chegarmos a este ponto, temos estilos personalizados.
	?>
	<style type="text/css" id="viking-header-css">
	<?php
		// Se a imagem estiver sendo exibida...
		if ( ! empty( $header_image ) ) :
	?>
		#logo-header {
			background: url(<?php header_image(); ?>) no-repeat center top;
			-webkit-background-size: contain;
			-moz-background-size:    contain;
			-o-background-size:      contain;
			background-size:         contain;
			padding-top: <?php echo $image_height_px; ?>px;
			padding-top: <?php echo $image_height_rem; ?>rem;
			width: <?php echo $image_width_px; ?>px;
			width: <?php echo $image_width_rem; ?>rem;
			line-height: 0;
			height: 0;
			text-indent: -99999px;
		}
	<?php endif;
		
		// Se o texto está sendo exibido...
		if ( display_header_text() ) :
	?>
		#head-txt {
			padding: 5px 0;
			padding: 0.5rem 0;
		}
		#name, #name a {
			font-family: 'PiecesOfEight', sans-serif;
			font-size: 45px;
			font-size: 4.5rem;		/* 45 / $rembase */
			line-height: 1.1111em; 	/* 50 / font-size */
		}
		#name a { color: #<?php echo esc_attr( $text_color ); ?>; }
		#name a:hover { font-weight: normal; }
	<?php endif;
		
		// Se o texto e a imagem estiverem sendo exibidos...
		if ( display_header_text() && ! empty( $header_image ) ) :
	?>
		#name, #desc {
			margin-left: 20px;
			margin-left: 2rem;
		}
	<?php endif;
		
		// Se apenas o texto estiver sendo exibido...
		if ( display_header_text() && empty( $header_image ) ) :
	?>
		#head-txt { text-align: center; }
	<?php endif;
		
		// Se não estiver sendo exibida a imagem...
		if ( empty( $header_image ) ) :
	?>
		#logo-header {
			clip: rect(1px, 1px, 1px, 1px);
			position: absolute !important;
		}
	<?php endif;
		
		// Se não estiver sendo exibida o texto...
		if ( ! display_header_text() ) :
	?>
		#head-txt {
			clip: rect(1px, 1px, 1px, 1px);
			position: absolute !important;
		}
	<?php endif; ?>
	</style>
	<?php
}
?>