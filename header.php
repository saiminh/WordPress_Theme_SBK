<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width" />
	<link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="<?php echo esc_url( home_url( '/' ) ); ?>/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="<?php echo esc_url( home_url( '/' ) ); ?>/favicon-16x16.png">
	<link rel="manifest" href="/site.webmanifest">
	<link rel="mask-icon" href="/safari-pinned-tab.svg" color="#000000">
	<meta name="msapplication-TileColor" content="#da532c">
	<meta name="theme-color" content="#ffffff">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,400i,700" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_uri(); ?>" />
	<!-- Senna 
 	<script src="<?php echo get_template_directory_uri(); ?>/js/senna-debug.js"></script>-->
	<?php wp_head(); ?>
</head>
<body <?php body_class('loading '); ?>>
	<!-- Preloader -->
	<div id="preloader" class="loading">
	  <div id="status">&nbsp;</div>
	</div>
	<div id="wrapper" class="hfeed">
		<header id="header" role="banner">
			<section id="branding">
				<div id="site-title">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_html( get_bloginfo( 'name' ) ); ?>" rel="home"><?php include ("assets/img/SBK_Logo.svg"); ?></a>
				</div>				
			</section>
			

				<a href="#menu-container" class="nav-toggle">
					<?php include ("assets/img/SBK_Hamburger.svg"); ?>
					<span class="nav-toggle_text">Menu</span>
				</a> 


			<nav id="menu-container" role="navigation">
				

				<a href="#close-menu-container" class="nav-toggle nav-toggle-close">
					Projects <i class="fa fa-times" aria-hidden="true"></i>
				</a> 
	

				<?php wp_nav_menu( array( 'theme_location' => 'main-menu' ) ); ?>
			
				<?php /* COMMENT OUT Search for the moment
				<div id="search">
					<?php get_search_form(); ?>
				</div>  
				*/ ?>
			
			</nav>
		</header>
		<div id="container">