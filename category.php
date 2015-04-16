<?php
/**
 * O template para exibir as páginas de Categorias
 * 
 * @link http://codex.wordpress.org/Template_Hierarchy
 * 
 * @package Estúdio Viking
 * @since 1.0
 */

get_header();
?>
	
<div id="principal" class="col_8">
	<main id="main-content" role="main">
	
		<section id="page-header">
			<h1 id="page-title"><?php single_cat_title( __( 'Posts for category: ', 'viking-theme' ) ); ?></h1>
			<?php the_archive_description( '<div class="taxonomy-description">', '</div>' ); ?>
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