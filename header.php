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
					
					<div id="sidebar" class="col_4">
						
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
								
							</hgroup><!-- #brand -->
							
							<div id="nav-header">
								<?php viking_nav_header( 'header-menu' ); ?>
							</div><!-- #nav-header -->
						</header><!-- #header -->
						
						<?php get_sidebar(); ?>
					
					</div><!-- #sidebar -->
					
					<?php get_slider(); ?>