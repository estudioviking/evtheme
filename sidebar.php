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

<section id="sidebar-content" role="complementary">
	<div id="nav-header">
		<?php
			if ( has_nav_menu( 'header-menu' ) ) :
				wp_nav_menu( array(
					'theme_location'	=> 'header-menu',
					'container'			=> 'nav',
					'container_id'		=> 'header-menu-nav',
					'menu_id'			=> 'header-menu'
				) );
				echo '<!-- #header-menu-nav -->';
			endif;
			
			if ( has_nav_menu( 'social-menu' ) ) :
				wp_nav_menu( array(
					'theme_location'	=> 'social-menu',
					'container'			=> 'nav',
					'container_id'		=> 'social-menu-nav',
					'menu_id'			=> 'social-menu',
					'menu_class'		=> 'nav-menu',
					'depth'				=> 1,
					'link_before'		=> '<span class="screen-reader-text">',
					'link_after'		=> '</span>'
				) );
				echo '<!-- #social-menu-nav -->';
			endif;
			/*
			if ( class_exists( 'PLL_Widget_Languages' ) ) :
				$instance = array(
					'show_flags'				=> 1,
					'hide_if_no_translation'	=> 1
				);
				
				$args = array(
					'title'			=> __( 'Language Switcher', 'viking-theme' ),
					'before_widget'	=> '<aside id="%1$s" class="widget %2$s">',
					'before_title'	=> '<h2 class="widget-title inner screen-reader-text">',
					'after_title'	=> '</h2><div class="widget-content inner">',
					'after_widget'	=> '</div></aside>'
				);
				
				the_widget( 'PLL_Widget_Languages', $instance, $args );
			endif;
			*/
			get_search_form();
		?>
	</div><!-- #nav-header -->
	
	<?php if ( is_active_sidebar( 'widget-area' ) ) : ?>
		<div class="widget-area" role="complementary">
			<?php dynamic_sidebar( 'widget-area' ); ?>
		</div><!-- .widget-area -->
	<?php endif; ?>
</section><!-- .sidebar -->