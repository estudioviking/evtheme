<?php
/**
 * O arquivo principal do tema
 * 
 * Este é o mais genérico arquivo de template em um tema WordPress
 * e um dos dois arquivos necessários para um tema (o outro seria o style.css).
 * Ele é usado para exibir uma página quando nada mais específico corresponde a uma consulta.
 * Por exemplo, ele reúne a home page quando nenhum arquivo home.php existe.
 * 
 * @package Estúdio Viking
 * @since 1.0
 */

get_header();
?>
	
<div id="principal" class="col_8">
	<main id="main-content" role="main">
	
		<section id="page-header">
			<h1 id="page-title"><?php _e( 'Latest Posts', 'viking-theme' ); ?></h1>
		</section><!-- #page-header -->
		
		<?php
			if ( have_posts() ) :
				// Início do Loop
				while ( have_posts() ) : the_post();
					
					/**
					 * Inclui o template do formato de postagem específico para o conteúdo.
					 * Se você quiser usar isso em um child theme, inclua um arquivo chamado content-____.php
					 * (onde ____ é o formato de postagem) e que será utilizado em seu lugar.
					 */
					get_template_part( 'content', get_post_format() );
				
				endwhile;
				
				// Paginação de artigos
				viking_post_pagination();
				
			else:
				// Se não houver conteúdo, inclui o template "Nenhum artigo encontrado".
				get_template_part( 'content', 'none' );
				
			endif;
		?>
		
	</main><!-- #main-content -->
</div><!-- #principal -->

<?php
get_footer();