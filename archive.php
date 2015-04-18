<?php
/**
 * O template para exibir as páginas de arquivos
 * 
 * Usado para exibir páginas do tipo "arquivo",
 * se nada mais específico corresponder a consulta.
 * Por exemplo, reúne páginas baseadas em data se nenhum arquivo
 * date.php existir.
 * 
 * Se você gostaria de personalizar ainda mais estas visualização de arquivos,
 * você pode criar um novo arquivo de template para cada um. Por exemplo,
 * tag.php para arquivos de Tags, category.php arquivos de Categorias,
 * author.php para arquivos de Autor, etc.
 * 
 * @link http://codex.wordpress.org/Template_Hierarchy
 * 
 * @package Estúdio Viking
 * @since 1.0
 */

get_header();
?>
	
<main id="principal" class="col_8" role="main">

	<header id="page-header">
		<?php
			the_archive_title( '<h1 id="page-title">', '</h1>' );
			the_archive_description( '<div class="taxonomy-description">', '</div>' );
		?>
	</header><!-- #page-header -->
	
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
	
</main><!-- #principal -->

<?php
get_footer();