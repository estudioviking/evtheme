<?php
/**
 * O cabeçalho do tema
 *
 * Mostra toda a seção <head>, sidebar e a chamada para o slider
 *
 * @package Estúdio Viking
 * @since 1.0
 */
?>

<!doctype html>
<html class="no-js" <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<link rel="dns-prefetch" href="//www.google-analytics.com">
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
		
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="<?php bloginfo( 'description' ); ?>">
		
		<?php wp_head(); ?>
	</head>
	<body <?php body_class(); ?>>
			<div id="grid" style="display: none;"><div class="conteiner"></div></div>
			
			<div id="page" class="conteiner site">
				<div class="linha">
					
					<section id="sidebar" class="col_4">
						
						<header id="header" role="banner">
							<hgroup id="brand">
								<a id="logo-header" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
								
								<div id="head-txt">
									<?php if ( is_home() || is_front_page() || is_archive() ) : ?>
										<h1 id="name"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
									<?php else : ?>
										<p id="name"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
									<?php endif;
									
									$description = get_bloginfo( 'description', 'display' ); ?>
									<p id="desc" class="sub-title"><?php echo $description; ?></p>
								</div><!-- #head-txt -->
								
								<h6 id="toggle-container" class="clear">
									<?php _e( 'Click on the button to display the menu.', 'viking-theme' ); ?>
									<button id="toggle" type="button"><i class="fa fa-bars"></i></button>
								</h6><!-- #toggle-container -->
							</hgroup><!-- #brand -->
							
							<aside id="nav-header">
								<?php
									if ( has_nav_menu( 'header-menu' ) ) :
										wp_nav_menu( array(
											'theme_location'	=> 'header-menu',
											'container'			=> 'nav',
											'container_id'		=> 'header-menu-nav',
											'menu_id'			=> 'header-menu',
											'walker'			=> new Viking_Walker_Nav()
										) );
										echo '<!-- #header-menu-nav -->';
									endif;
									
									if ( has_nav_menu( 'social-menu' ) ) :
										wp_nav_menu( array(
											'theme_location'	=> 'social-menu',
											'container'			=> 'nav',
											'container_id'		=> 'social-menu-nav',
											'menu_id'			=> 'social-menu',
											'walker'			=> new Viking_Walker_Nav()
										) );
										echo '<!-- #social-menu-nav -->';
									endif;
									
									get_search_form();
								?>
							</aside><!-- #nav-header -->
						</header><!-- #header -->
						
						<?php get_sidebar(); ?>
					
					</section><!-- #sidebar -->
					
					<?php get_slider(); ?>