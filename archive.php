<?php get_header(); ?>
	
<!-- principal -->
<div id="principal" class="col_8">
	
	<h1 id="page-title">
		<?php _e( 'Archives of: ', 'viking-theme' );
		
		$archive_day = get_the_date( 'd' );
		$archive_month = ucfirst( get_the_date( 'F' ) );
		$archive_year = get_the_date( 'Y' );
		$sep = __( ' of ', 'viking-theme' );
		
		if ( is_day() ) : echo $archive_day . $sep . $archive_month . $sep . $archive_year;
		elseif ( is_month() ) : echo $archive_month . $sep . $archive_year;
		elseif ( is_year() ) : echo $archive_year;
		endif; ?>
	</h1>
	
	<main role="main">
		
		<?php get_template_part( 'loop' ); ?>
		
		<?php get_template_part( 'pagination' ); ?>
		
	</main>
	
</div>
<!-- /principal -->

<?php get_footer(); ?>