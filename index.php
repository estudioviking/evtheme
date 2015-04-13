<?php
/**
 * O arquivo principal do tema
 *
 * Mostra uma camada para o cabeçalho, a div#principal com as chamadas do loop
 * e da paginação e uma chamada para o rodapé do tema
 *
 * @package Estúdio Viking
 * @since 1.0
 */

get_header(); ?>
	
<div id="principal" class="col_8">
	
	<h1 id="page-title"><?php _e( 'Latest Posts', 'viking-theme' ); ?></h1>
	
	<main role="main">
		
		<?php get_template_part( 'loop' ); ?>
		
		<?php get_template_part( 'pagination' ); ?>
		
	</main>
	
</div>
<!-- #principal -->

<?php get_footer(); ?>