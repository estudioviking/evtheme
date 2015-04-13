<?php get_header(); ?>

<!-- principal -->
<div id="principal" class="col_8">
	
	<main role="main">
		
		<?php if ( have_posts() ): while ( have_posts() ) : the_post(); ?>

			<!-- article -->
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			
				<!-- post header -->
				<header class="post-header<?php if ( is_page( 'home' ) ) echo ' inner'; ?>">
					<?php if ( ! is_page( 'home' ) ) : ?>
						<h1 id="page-title"><?php the_title(); ?></h1>
					<?php endif; ?>
					
					<span class="edit-link">
						<?php // Link para editar a postagem
							edit_post_link(); ?>
					</span>
					
				</header>
				<!-- /post header -->
				
				<!-- post content -->
				<?php if ( has_post_thumbnail() ) : // Checa se existe miniaturas ?>
					<section class="post-content linha">
						<div class="col_8">
							<?php the_content(); // Conteúdo Dinâmico ?>
						</div>
						
						<?php viking_post_thumb() ?>
					</section>
				<?php else : ?>
					<section class="post-content">
						<?php the_content(); // Conteúdo Dinâmico ?>
					</section>
				<?php endif; ?>
				<!-- /post content -->

			</article>
			<!-- /article -->

		<?php endwhile; ?>

		<?php else: ?>

			<!-- article -->
			<article>

				<h2><?php _e( 'Sorry, nothing to display.', 'viking-theme' ); ?></h2>

			</article>
			<!-- /article -->

		<?php endif; ?>
		
	</main>
	
</div>
<!-- /principal -->


<?php get_footer(); ?>
