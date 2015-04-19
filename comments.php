<?php
/**
 * O template para exibir os comentários
 * 
 * A área da página que contém os comentários e o formulário dos comentários
 * 
 * @package Estúdio Viking
 * @since 1.0
 */
?>

<section id="comments">
	<?php
		/**
		 * Se o artigo atual for protegido por senha e o visitante ainda não entrou com a senha,
		 * nós iremos retornar ao modo anterior sem o carregamento dos comentários.
		 */
		if ( post_password_required() ) : ?>
			
	<p class="comments-protected"><?php _e( 'Post is password protected. Enter the password to view any comments.', 'viking-theme' ); ?></p>
</section><!-- #comments --><?php
			
			return;
		endif;
	?>
	
	<?php if ( have_comments() ) : ?>
		
		<h2 class="comments-title">
			<?php
				comments_number( __( 'Leave your thoughts', 'viking-theme' ), __( '1 comment', 'viking-theme' ), __( '% comments', 'viking-theme' ) );
				echo ' ' . __( 'on', 'viking-theme' ) . ' <span>&quot;' . get_the_title() . '&quot;</span>';
			?>
		</h2>
		
		<?php viking_comment_nav(); ?>
		
		<ul class="comments-list">
			<?php // Lista de comentários
				wp_list_comments( array(
					'short_ping'  => true,
					'avatar_size' => 72,
				) );
			?>
		</ul><!-- .comments-list -->
		
		<?php viking_comment_nav(); ?>
		
	<?php endif; // have_comments ?>
	
	<?php // Se os comentários estão fechados e há comentários, vamos deixar uma pequena nota!
		if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="no-comments"><?php _e( 'Comments are closed here.', 'viking-theme' ); ?></p>
	<?php endif; ?>
	
	<?php // Formulário de comentários
		$commenter 	= wp_get_current_commenter();
		$req 		= get_option( 'require_name_email' );
		$aria_req 	= ( $req ? " aria-required='true'" : '' );
		
		comment_form( array(
			'title_reply' => __( 'Leave your thoughts', 'viking-theme' ),
			'comment_notes_after'	=> '',
			'comment_field'			=> '<div class="comment-form-comment form-group"><label for="comment">' . __( 'Comment', 'viking-theme' ) . '</label> ' .
									   '<textarea id="comment" name="comment" cols="45" rows="8" aria-describedby="form-allowed-tags" aria-required="true"></textarea></div>',
			'fields'				=> apply_filters( 'comment_form_default_fields', array(
				'author' => '<div class="comment-form-author form-group">' . '<label for="author">' . __( 'Name', 'viking-theme' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> ' .
							'<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="40"' . $aria_req . ' /></div>',
				'email'  => '<div class="comment-form-email form-group"><label for="email">' . __( 'Email', 'viking-theme' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> ' .
							'<input id="email" name="email" type="email" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="40" aria-describedby="email-notes"' . $aria_req . ' /></div>',
				'url'    => '<div class="comment-form-url form-group"><label for="url">' . __( 'Website', 'viking-theme' ) . '</label> ' .
							'<input id="url" name="url" ' . ( $html5 ? 'type="url"' : 'type="text"' ) . ' value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="40" /></div>',
			) )
		) );
	?>
	
</section><!-- #comments -->
