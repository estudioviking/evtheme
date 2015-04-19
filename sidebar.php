<?php
/**
 * A área de widgets do tema
 *
 * Contém o formmulário de busca e as chamadas das áreas de widgets
 *
 * @package Estúdio Viking
 * @since 1.0
 */
?>

<section class="sidebar" role="complementary">
	
	
	<aside class="sidebar-widget">
		<?php if ( ! function_exists( 'dynamic_sidebar' ) || ! dynamic_sidebar( 'widget-area' ) ) ?>
	</aside>
</section><!-- .sidebar -->