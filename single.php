<?php get_header(); ?>
	
<!-- principal -->
<div id="principal" class="col_8">
	
	<main role="main">
		
		<?php if ( have_posts() ): while ( have_posts() ) : the_post(); ?>
		
			<!-- article -->
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				
				<!-- post-header -->
				<header class="post-header">
		
					<!-- post-title -->
					<h1 class="post-title"><?php the_title(); ?></h1>
					<!-- /post-title -->
					
					<?php viking_post_details(); ?>
				
				</header>
				<!-- /post-header -->
				
				<!-- post-content -->
				<section class="post-content">
					<?php the_content(); // Dynamic Content ?>
				</section>
				<!-- /post-content -->
				
				<!-- post-info -->
				<div id="post-info">
					<?php if ( get_the_author_meta( 'description' ) ) get_template_part( 'author-info' ); ?>
					
					<p>
						<?php _e( 'This post was written by ', 'viking-theme' ); the_author_posts_link(); _e( ' in ', 'viking-theme' ); viking_date_link(); ?>.<br />
						<i class="fa fa-folder-open"></i> <?php _e( 'Categorised in: ', 'viking-theme' ); the_category( ', ' ); // Separado por vírgula ?>.<br />
						<i class="fa fa-tags"></i> <?php the_tags( __( 'Tags: ', 'viking-theme' ) ); ?>.
					</p>
				</div>
				<!-- /post-info -->
		
				<?php comments_template(); ?>
		
			</article>
			<!-- /article -->
		
		<?php endwhile; ?>
		
		<?php else: ?>
		
			<!-- article -->
			<article>
		
				<h1><?php _e( 'Sorry, nothing to display.', 'viking-theme' ); ?></h1>
		
			</article>
			<!-- /article -->
		
		<?php endif; ?>
	
	</main>
	
</div>
<!-- /principal -->

<?php get_footer(); ?>
