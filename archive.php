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
	
<div id="principal" class="col_8">
	<main id="main-content" role="main">
	
		<section id="page-header">
			<?php if ( is_date() ) : ?>
				<h1 id="page-title">
					<?php
						
						$date_title = __( 'Archives of: ', 'viking-theme' );
						$archive_day = get_the_date( 'd' );
						$archive_month = ucfirst( get_the_date( 'F' ) );
						$archive_year = get_the_date( 'Y' );
						$sep = __( ' of ', 'viking-theme' );
						
						if ( is_day() ) :
							echo $date_title . $archive_day . $sep . $archive_month . $sep . $archive_year;
						elseif ( is_month() ) :
							echo $date_title . $archive_month . $sep . $archive_year;
						elseif ( is_year() ) :
							echo $date_title . $archive_year;
						endif;
						
					?>
				</h1>
			<?php else :
				the_archive_title( '<h1 class="page-title">', '</h1>' );
				the_archive_description( '<div class="taxonomy-description">', '</div>' );
			endif; ?>
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