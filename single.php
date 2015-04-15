<?php
/**
 * O template para exibir todos os single posts
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
				
				/**
				 * Inclui o template do formato de postagem específico para o conteúdo.
				 * Se você quiser usar isso em um child theme, inclua um arquivo chamado content-____.php
				 * (onde ____ é o formato de postagem) e que será utilizado em seu lugar.
				 */
				get_template_part( 'content', get_post_format() );
				
				// Se os comentários estiverem habilitados ou temos pelo menos um comentário, carrega o template de comentários
				if ( comments_open() || get_comments_number() ) comments_template();
				
				// Navegação de artigos
				the_post_navigation( array(
					'next_text' => '<span class="meta-nav">' . __( 'Next', 'viking-theme' ) . '</span> ' .
						'<span class="screen-reader-text">' . __( 'Next post:', 'viking-theme' ) . '</span> ' .
						'<span class="post-title">%title</span>',
					'prev_text' => '<span class="meta-nav">' . __( 'Previous', 'viking-theme' ) . '</span> ' .
						'<span class="screen-reader-text">' . __( 'Previous post:', 'viking-theme' ) . '</span> ' .
						'<span class="post-title">%title</span>',
				) );
				?><!-- .post-navigation --><?php
				
			endwhile;
		?>
		
	</main><!-- #main-content -->
	
</div><!-- #principal -->

<?php
get_footer();
	
	


			
