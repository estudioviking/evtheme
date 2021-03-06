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
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="profile" href="http://gmpg.org/xfn/11">
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
		
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
										<p id="name"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a></p>
									<?php endif;
									
									$description = get_bloginfo( 'description', 'display' ); ?>
									<p id="desc" class="sub-title"><?php echo $description; ?></p>
								</div><!-- #head-txt -->
							</hgroup><!-- #brand -->
							
							<div id="toggle-container">
								<span class="screen-reader-text">
									<?php _e( 'Click on the button to display the menu.', 'viking-theme' ); ?>
								</span>
								<button id="toggle" type="button"><i class="fa fa-bars"></i></button>
							</div><!-- #toggle-container -->
						</header><!-- #header -->
						
						<?php get_sidebar(); ?>
					
					</section><!-- #sidebar -->
					
					<?php get_slider(); ?>