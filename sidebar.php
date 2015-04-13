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

<div class="sidebar" role="complementary">
	<?php get_template_part( 'searchform' ); ?>
	
	<aside class="sidebar-widget">
		<?php if ( ! function_exists( 'dynamic_sidebar' ) || ! dynamic_sidebar( 'widget-area-1' ) ) ?>
	</aside>
	
	<aside class="sidebar-widget">
		<?php if ( ! function_exists( 'dynamic_sidebar' ) || ! dynamic_sidebar( 'widget-area-2' ) ) ?>
	</aside>
</div>
<!-- .sidebar -->