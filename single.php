<?php get_header(); ?>
	
<div id="principal" class="col_8">
	
	<main role="main">
		
		<?php if ( have_posts() ): while ( have_posts() ) : the_post(); ?>
		
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				
				<header class="post-header">
		
					<h1 class="post-title"><?php the_title(); ?></h1>
					
					<?php viking_post_details(); ?>
				
				</header>
				<!-- .post-header -->
				
				<section class="post-content">
					<?php the_content(); ?>
				</section>
				<!-- .post-content -->
				
				<div id="post-info">
					<?php if ( get_the_author_meta( 'description' ) ) get_template_part( 'author-info' ); ?>
					
					<p>
						<?php _e( 'This post was written by ', 'viking-theme' ); the_author_posts_link(); _e( ' in ', 'viking-theme' ); viking_date_link(); ?>.<br />
						<i class="fa fa-folder-open"></i> <?php _e( 'Categorised in: ', 'viking-theme' ); the_category( ', ' ); // Separado por vírgula ?>.<br />
						<i class="fa fa-tags"></i> <?php the_tags( __( 'Tags: ', 'viking-theme' ) ); ?>.
					</p>
				</div>
				<!-- .post-info -->
		
				<?php comments_template(); ?>
		
			</article>
			<!-- .article -->
		
		<?php endwhile; ?>
		
		<?php else: ?>
		
			<article>
		
				<h1><?php _e( 'Sorry, nothing to display.', 'viking-theme' ); ?></h1>
		
			</article>
			<!-- .article -->
		
		<?php endif; ?>
		
		<?php
		the_post_navigation( array(
			'next_text' => '<span class="meta-nav">' . __( 'Next', 'viking-theme' ) . '</span> ' .
				'<span class="screen-reader-text">' . __( 'Next post:', 'viking-theme' ) . '</span> ' .
				'<span class="post-title">%title</span>',
			'prev_text' => '<span class="meta-nav">' . __( 'Previous', 'viking-theme' ) . '</span> ' .
				'<span class="screen-reader-text">' . __( 'Previous post:', 'viking-theme' ) . '</span> ' .
				'<span class="post-title">%title</span>',
		) );
		?>
	
	</main>
	
</div>
<!-- #principal -->

<?php get_footer(); ?>
