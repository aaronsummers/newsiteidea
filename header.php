<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>

		<!-- "WPtricks Starter": The HTML-5 WordPress Template Theme -->
		<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>">
		<title><?php wp_title(''); ?><?php if(wp_title('', false)) { echo ' | '; } ?><?php bloginfo('name'); if(is_home()) { echo ' | WordPress Theme Development' ; } ?></title>
		
		<!-- Start built in SEO -->
		<meta name="keywords" content="<?php echo tags4meta(); ?>" />
			<?php if (is_single() || is_page() ) : if ( have_posts() ) : while ( have_posts() ) : the_post(); // IF ON A PAGE OR SINGLE POST INCLUDE THE_EXCERPT ?>
		 <meta name="description" content="<?php $content = get_the_content(); echo wp_trim_words( $content , '38' ); ?>" />
			 <?php endwhile; endif; elseif(is_home()) : // IF ON THE HOME PAGE SHOW SITE DESCRIPTION ?>
		 <meta name="description" content="<?php bloginfo('description'); ?>" />
			 <?php endif; ?>
			 <?php if(is_single() || is_page() || is_home()) { // NOINDEX ARCHIVES, TAGS & AUTHOR PAGES?>
		 <meta name="robots" content="index" />
			 <?php } else { ?>
		 <meta name="robots" content="noindex, nofollow" />
			 <?php }?>
		
		<!-- FACEBOOK OG's -->
		<meta property="og:image" content="<?php $thumb_id = get_post_thumbnail_id(); $thumb_url = wp_get_attachment_image_src($thumb_id,'facebook-og-thumbnail', true); echo $thumb_url[0]; ?>"/>
		<meta property="og:title" content="<?php echo the_title(); ?>"/>
		<meta property="og:url" content="<?php echo the_permalink(); ?>"/>
		<meta property="og:site_name" content="<?php echo the_title(); ?> - <?php bloginfo('description'); ?>"/>
		<meta property="og:type" content="blog"/>

		<!-- STYLESHEETS -->
		<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url'); ?>" media="screen">
		<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/css/options.css" media="screen">
		<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/css/font-awesome.min.css" media="screen">
		<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/css/tooltipster.css" media="screen">
		<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/css/magnific-popup.css" media="screen">
		<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/css/supersized.css" media="screen">
		<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/css/supersized.shutter.css" media="screen">
		
		<link rel="alternate" type="text/xml" title="<?php bloginfo('name'); ?> RSS 0.92 Feed" href="<?php bloginfo('rss_url'); ?>">
		<link rel="alternate" type="application/atom+xml" title="<?php bloginfo('name'); ?> Atom Feed" href="<?php bloginfo('atom_url'); ?>">
		<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS 2.0 Feed" href="<?php bloginfo('rss2_url'); ?>">
		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

		<!-- JQUERY / other scripts loaded in the footer -->
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
		<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/javascript/modernizr.wptricks.js"></script>
			<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/javascript/jquery.easing.min.js"></script>
		

		<?php wp_head(); ?>
		
	</head>
	<body id="top" <?php body_class( $class ); ?>>
  
	
		<section class="main-header">
			<header>
				<div class="wrapper">
                
					<hgroup id="logo">
						<a href="#" title='WPtricks' rel='home' target="new">
							<h1><?php bloginfo('name'); ?></h1>
                        </a>
					</hgroup> <!-- /#logo -->
                    <nav>
						<?php wp_nav_menu( array( 'theme_location' => 'header-menu' )); ?>
                    </nav>
						
				</div><!-- /.wrapper -->
			</header>
		</section> <!-- /.main-header -->