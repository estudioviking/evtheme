<div id="comments">
	<?php
		/**
		 * Se o artigo atual for protegido por senha e o visitante
		 * ainda não entrou com a senha, nós iremos retornar ao
		 * modo anterior sem o carregamento dos comentários.
		 */
		if ( post_password_required() ) : ?>
			<p class="comments-protected"><?php _e( 'Post is password protected. Enter the password to view any comments.', 'viking-theme' ); ?></p>
			</div>
			<!-- #comments -->
			<?php return;
		endif;
	?>
	
	<?php if ( have_comments() ) : ?>
		
		<h2 class="comments-title"><?php comments_number(); ?></h2>
		
		<?php viking_comment_nav(); ?>
		
		<ul class="comments-list">
			<?php //wp_list_comments( 'type=comment&callback=viking_comments' );
				wp_list_comments( array(
					'short_ping'  => true,
					'avatar_size' => 72,
				) );
			?>
		</ul>
		<!-- .comments-list -->
		
		<?php viking_comment_nav(); ?>
		
	<?php endif; // have_comments ?>
	
	<?php // Se os comentários estão fechados e há comentários, vamos deixar uma pequena nota!
		if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="no-comments"><?php _e( 'Comments are closed here.', 'viking-theme' ); ?></p>
	<?php endif; ?>
	
	<?php comment_form(); ?>
	
</div>
<!-- #comments -->
