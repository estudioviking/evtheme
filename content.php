<?php
/**
 * O template padrão para exibir o conteúdo
 * 
 * Usado por todos os singles e também index, archive, author, catagory, search, tag
 * 
 * @package Estúdio Viking
 * @since 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
	<header class="post-header">
		
		<?php
			if ( is_single() ) :
				the_title( '<h1 class="post-title">', '</h1>' );
			else :
				?>
				<h2 class="post-title">
					<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
				</h2>
				<?php
			endif;
			
			// Quadro de detalhes da postagem
			viking_post_details();
		?>
	
	</header>
	<!-- .post-header -->
	
	<?php
		if ( is_single() ) : ?>
			<section class="post-content">
				<?php the_content(); ?>
			</section>
			<!-- .post-content -->
			
			<footer class="post-footer">
				<?php if ( get_the_author_meta( 'description' ) ) get_template_part( 'author-info' ); ?>
				
				<p>
					<?php _e( 'This post was written by ', 'viking-theme' ); the_author_posts_link(); _e( ' in ', 'viking-theme' ); viking_date_link(); ?>.<br />
					<i class="fa fa-folder-open"></i> <?php _e( 'Categorised in: ', 'viking-theme' ); the_category( ', ' ); // Separado por vírgula ?>.<br />
					<i class="fa fa-tags"></i> <?php the_tags( __( 'Tags: ', 'viking-theme' ) ); ?>.
				</p>
			</footer>
			<!-- .post-footer -->
	<?php
		else :
			viking_excerpt( 'viking_index' );
		endif;
	?>
	
</article>
<!-- #post## -->

<hr />