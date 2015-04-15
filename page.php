<?php
/**
 * O template para exibir páginas
 * 
 * Este é o template que exibe todas as páginas por padrão.
 * Por favor, note que esta é a construtor WordPress de páginas e que
 * as outras "páginas" em seu site WordPress usarão um template diferente.
 * 
 * @package Estúdio Viking
 * @since 1.0
 */

get_header();
?>
	
<div id="principal" class="col_8">
	<main id="main-content" role="main">
		
		<?php
			// Início do Loop
			while ( have_posts() ) : the_post();
				
				// Inclui o template de conteúdo de páginas
				get_template_part( 'content', 'page' );
				
				// Se os comentários estiverem habilitados ou temos pelo menos um comentário, carrega o template de comentários
				if ( comments_open() || get_comments_number() ) comments_template();
				
			endwhile;
		?>
		
	</main><!-- #main-content -->
</div><!-- #principal -->

<?php
get_footer();