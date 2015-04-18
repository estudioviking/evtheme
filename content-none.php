<?php
/**
 * O template para exibir a mensagem de que os posts não foram encontrados
 * 
 * @package Estúdio Viking
 * @since 1.0
 */
?>

<article id="post-not-found" class="not-found no-results post">
	
	<header class="post-header">
		<h3 class="post-title"><?php _e( 'Nothing found', 'viking-theme' ); ?></h3>
	</header><!-- .post header -->
	
	<section class="post-content">
		
		<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

			<p><?php printf( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'viking-theme' ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>

		<?php elseif ( is_search() ) : ?>

			<p><?php _e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'viking-theme' ); ?></p>
			<?php get_search_form(); ?>

		<?php else : ?>

			<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'viking-theme' ); ?></p>
			<?php get_search_form(); ?>

		<?php endif; ?>
		
		<p><a href="<?php echo home_url(); ?>"><?php _e( 'Return home?', 'viking-theme' ); ?></a></p>
	</section><!-- .post content -->

</article><!-- #post-not-found -->