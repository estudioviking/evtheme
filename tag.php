<?php get_header(); ?>
	
<!-- principal -->
<div id="principal" class="col_8">
	
	<h1 id="page-title"><?php _e( 'Tag Archive: ', 'viking-theme' ); echo ucfirst( single_tag_title( '', false ) ); ?></h1>
	
	<main role="main">
		
		<?php get_template_part( 'loop' ); ?>
		
		<?php get_template_part( 'pagination' ); ?>
		
	</main>
	
</div>
<!-- /principal -->

<?php get_footer(); ?>