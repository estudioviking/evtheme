<?php
/**
 * O template para exibir rodapé do tema
 *
 * Contém o #copyright onde é exibido os créditos do site e do tema
 * e o fechamento da div#page.
 *
 * @package Estúdio Viking
 * @since 1.0
 */
?>

				<footer id="footer" class="col_8" role="contentinfo">
					<p id="copyright">
						&copy; <?php echo date( 'Y' ) . ' ' . do_shortcode( '[home-link]' ) . ' - ' . __( 'All rights reserved.', 'viking-theme' ) . ' ' .
						sprintf(
							__( 'Powered by <a href="%s" rel="nofollow" target="_blank">Estúdio Viking</a> on <a href="%s" rel="nofollow" target="_blank">WordPress</a>.', 'viking-theme' ),
							'https://github.com/ivanildodias/evtheme',
							'http://wordpress.org/' ); ?>
					</p><!-- #copyright -->
				</footer><!-- #footer -->
				
			</div>
		</div><!-- #page -->

		<?php wp_footer(); ?>

	</body>
</html>
