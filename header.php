<!doctype html>

<!--[if lt IE 7]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8 lt-ie7"><![endif]-->
<!--[if (IE 7)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8"><![endif]-->
<!--[if (IE 8)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9"><![endif]-->
<!--[if gt IE 8]><!--> <html <?php language_attributes(); ?> class="no-js"><!--<![endif]-->

	<head>
		<meta charset="utf-8">

		<?php // force Internet Explorer to use the latest rendering engine available ?>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">

		<title><?php wp_title(''); ?></title>

		<?php // mobile meta (hooray!) ?>
		<meta name="HandheldFriendly" content="True">
		<meta name="MobileOptimized" content="320">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0"/>
       
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
        
        <link rel="apple-touch-startup-image" href="<?php echo get_template_directory_uri(); ?>/library/images/startup.png">
        
		<?php // icons & favicons (for more: http://www.jonathantneal.com/blog/understand-the-favicon/) ?>
		<link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/library/images/icon-129.png">
		<link rel="icon" href="<?php echo get_template_directory_uri(); ?>/favicon.png">
		<link rel="apple-touch-icon-precomposed" sizes="57x57" href="<?php echo get_template_directory_uri(); ?>/library/images/icon-57.png" />
		<!--[if IE]>
			<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico">
		<![endif]-->
		<?php // or, set /favicon.ico for IE10 win ?>
		<meta name="msapplication-TileColor" content="#000">
		<meta name="msapplication-TileImage" content="<?php echo get_template_directory_uri(); ?>/library/images/icon-144.png">
        <meta name="theme-color" content="#000">

		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
		<!-- Icon Font -->
		<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">
		
		<!-- PREVENT LINK EVENT IN WEBAPP -->
		<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/library/js/plugin/stay_standalone.js"></script>
		
		<!-- Manifest JSON -->
        <link rel="manifest" href="<?php echo get_template_directory_uri(); ?>/manifest.json" >

		<?php // wordpress head functions ?>
		<?php wp_head(); ?>
		<?php // end of wordpress head ?>

		<?php // drop Google Analytics Here ?>
		<?php // end analytics ?>

	</head>

	<body <?php body_class(); ?>>

		<div id="container">

			<header class="header">
				<div id="inner-header" class="p10-20 wrapper_2">

                    
                    
				</div>

				<?php get_template_part('template-part/menu'); ?>
			</header>

			<div id="body">
