<?php get_header(); ?>
	
<!-- principal -->
<div id="principal" class="col_8">
	
	<h1 id="page-title"><?php _e( 'Author Archives: ', 'viking-theme' ); echo get_the_author(); ?></h1>
	
	<main role="main">
		<?php if ( get_the_author_meta( 'description' ) ) : ?>
			<!-- post-info -->
			<div id="post-info">
				<?php get_template_part( 'author-info' ); ?>
			</div>
			<!-- /post-info -->
		<?php endif; ?>
		
		<?php get_template_part( 'loop' ); ?>
		
		<?php get_template_part( 'pagination' ); ?>
		
	</main>
	
</div>
<!-- /principal -->

<?php get_footer(); ?>