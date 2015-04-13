<?php get_header(); ?>
	
<!-- principal -->
<div id="principal" class="col_8">
	
	<h1 id="page-title"><?php echo sprintf( __( '%s Search Results for: ', 'viking-theme' ), $wp_query->found_posts ); echo get_search_query(); ?></h1>
	
	<main role="main">
		
		<?php get_template_part( 'loop' ); ?>
		
		<?php get_template_part( 'pagination' ); ?>
		
	</main>
	
</div>
<!-- /principal -->

<?php get_footer(); ?>
