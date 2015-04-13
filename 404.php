<?php get_header(); ?>
	
<!-- principal -->
<div id="principal" class="col_8">
	
	<main role="main">
		<!-- section -->
		<section class="inner">
			
			<!-- article -->
			<article id="post-404">
				
				<h1><?php _e( 'Page not found', 'ignus-theme' ); ?></h1>
				<p><?php _e( 'Sorry, nothing to display.', 'ignus-theme' ); ?></p>
				<h4><a href="<?php echo home_url(); ?>"><?php _e( 'Return home?', 'ignus-theme' ); ?></a></h4>
				
			</article>
			<!-- /article -->
			
		</section>
		<!-- /section -->
	</main>
	
</div>
<!-- /principal -->

<?php get_footer(); ?>
