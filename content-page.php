<?php
/**
 * O template usado para exibir o conteúdo de páginas
 * 
 * @package Estúdio Viking
 * @since 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
	<header class="post-header<?php if ( is_page( 'home' ) ) echo ' inner'; ?>">
		<?php if ( ! is_page( 'home' ) ) : ?>
			<h1 id="page-title"><?php the_title(); ?></h1>
		<?php endif; ?>
		
		<span class="edit-link"><?php edit_post_link(); ?></span>
		
	</header><!-- .post header -->
	
	<section class="post-content">
		<?php the_content(); ?>
	</section><!-- .post content -->

</article><!-- #post## -->