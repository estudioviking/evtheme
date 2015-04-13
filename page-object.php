<?php
/**
 * Template Name: Object Page
 */

get_header(); ?>

<!-- principal -->
<div id="principal" class="col_8">
	
	<main role="main">
		
		<?php if ( have_posts() ): while ( have_posts() ) : the_post(); ?>

			<!-- article -->
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			
				<!-- post header -->
				<header class="post-header">
					<?php if ( ! is_page( 'home' ) ) : ?>
					<h1 id="page-title"><?php the_title(); ?></h1>
					<?php endif; ?>
					<span class="edit-link"><?php edit_post_link(); // Link para editar a postagem ?></span>
					
				</header>
				<!-- /post header -->
				
				<!-- post content -->
				<section class="post-content linha">
					<?php
						global $site_options;
						
						echo "<pre>";
						print_r( $site_options );		// Os valores das opções
						echo "</pre>"; 
					?>
				</section>
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
