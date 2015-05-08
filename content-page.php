<?php
/**
 * O template usado para exibir o conteúdo de páginas
 * 
 * @package Estúdio Viking
 * @since 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
	<header class="post-header">
		<h1 id="page-title"<?php if ( is_home() || is_front_page() ) echo ' class="screen-reader-text"'; ?>>
			<?php the_title(); ?>
		</h1>
	</header><!-- .post header -->
		
	<?php edit_post_link( __( 'Edit', 'viking-theme' ), '<span class="edit-link">', '</span>' ); ?>
	
	<section class="post-content">
		<?php the_content(); ?>
	</section><!-- .post content -->

</article><!-- #post## -->