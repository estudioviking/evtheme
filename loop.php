<?php if ( have_posts() ): while ( have_posts() ) : the_post(); ?>

	<!-- article -->
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		
		<!-- post header -->
		<header class="post-header">
	
			<!-- post title -->
			<h2 class="post-title">
				<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
			</h2>
			<!-- /post title -->
			
			<?php viking_post_details(); ?>
			
		</header>
		<!-- /post header -->
		
		<!-- post content -->
		<?php viking_excerpt( 'viking_index' ); ?>
		<!-- /post content -->

	</article>
	<!-- /article -->
	<hr>

<?php endwhile; ?>

<?php else: ?>

	<!-- article -->
	<article>
		<h2><?php _e( 'Sorry, nothing to display.', 'viking-theme' ); ?></h2>
	</article>
	<!-- /article -->

<?php endif; ?>