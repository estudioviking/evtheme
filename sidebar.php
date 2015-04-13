	<div class="sidebar" role="complementary">
		<?php get_template_part( 'searchform' ); ?>
		
		<aside class="sidebar-widget">
			<?php if ( ! function_exists( 'dynamic_sidebar' ) || ! dynamic_sidebar( 'widget-area-1' ) ) ?>
		</aside>
		
		<aside class="sidebar-widget">
			<?php if ( ! function_exists( 'dynamic_sidebar' ) || ! dynamic_sidebar( 'widget-area-2' ) ) ?>
		</aside>
	</div>
