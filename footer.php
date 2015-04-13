<?php
/**
 * O rodapé do tema
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
						&copy; <?php echo do_shortcode( '[current-year]' ) ?> | <?php echo do_shortcode( '[home-link]' ) ?>. 
						Orgulhosamente desenvolvido com 
						<a id="wordpress-ico" href="//wordpress.org" title="Desenvolvido com WordPress"><i class="fa fa-wordpress"></i> WordPress</a>.
					</p><!-- #copyright -->
				</footer><!-- #footer -->
				
			</div>
		</div><!-- #page -->

		<?php wp_footer(); ?>

	</body>
</html>
