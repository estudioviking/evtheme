<?php
/**
 * Template que exibe as páginas 404 (Nada encontrado)
 * 
 * @package Estúdio Viking
 * @since 1.0
 */

get_header();
?>
	
<main id="principal" class="col_8" role="main">
	
	<article id="post-error-404" class="not-found error-404 post">
		
		<header class="post-header">
			<h1 id="page-title"><?php _e( 'Page not found', 'viking-theme' ); ?></h1>
		</header><!-- .post header -->
		
		<section class="post-content">
			<p>
				<?php _e( 'Sorry, nothing to display.', 'viking-theme' ); ?><br />
				<?php _e( 'It looks like nothing was found at this location. Maybe try a search?', 'viking-theme' ); ?>
			</p>
			<?php get_search_form(); ?>
			<p><a href="<?php echo home_url(); ?>"><?php _e( 'Return home?', 'viking-theme' ); ?></a></p>
		</section><!-- .post content -->
	
	</article><!-- #post-error-404 -->
	
</main><!-- #principal -->

<?php
get_footer();
