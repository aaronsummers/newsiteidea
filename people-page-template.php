<?php
/*
Template Name: People
*/
?>
<?php get_header(); ?>
<section class="people clearfix">
		<header>
			<div class="wrapper">
				<h2>People</h2>
			</div>
		</header>
			<div class="wrapper">
				<ul class="clearfix">
					 
<?php
	// select our people post types
	$wptricckspost = array( 'post_type' => 'people', );
	// Create the new loop
	$loop = new WP_Query( $wptricckspost );
	?>
	 
	<?php // Make sure we're on the correct post type
		 while ( $loop->have_posts() ) : $loop->the_post();?>
				<li class="flip-container about-me clearfix" ontouchstart="this.classList.toggle('hover');">
                    <div class="flipper clearfix">
                        <div class="front">
						<header>
								  
							<?php // Check we have the content
								$my_about_meta = get_post_meta($post->ID,'_wptricks_about_meta',TRUE); ?>
									 
							<h3><?php // Output the name
									 echo the_title(); ?></h3>
									 
							<p><?php // Output Position
									 echo $my_about_meta['position']; ?></p>
                                     
                            <ul class="email-links">				 
							<?php if(!empty ($my_about_meta['email'])) {?>
							  <li><i class="fa  fa-envelope-o"></i> <a href="mailto:<?php echo $my_about_meta['email']; ?>"><?php echo $my_about_meta['email']; ?></a></li>
							<?php }; ?>
							<?php if(!empty ($my_about_meta['paemail'])) {?>
							  <li><i class="fa  fa-envelope-o"></i> PA: <a href="mailto:<?php echo $my_about_meta['paemail']; ?>"><?php echo $my_about_meta['paemail']; ?></a></li>
						   <?php }; ?>
                           </ul>
						</header>
                        <section>
							<?php // Output the featured image
								 the_post_thumbnail('people-thumbnail'); ?>
                        </section>
                        </div>
                        
                        <div class="back">
                        <header>
                        	<h5><?php // Output the name
									 echo the_title(); ?></h5>			
                            <?php // Output the featured image
								 the_post_thumbnail('small-people-thumbnail'); ?>						 
							<p><?php // Output Position
									 echo $my_about_meta['position']; ?></p>
                        	<ul class="email-links">				 
							<?php if(!empty ($my_about_meta['email'])) {?>
							  <li><i class="fa  fa-envelope-o"></i> <a href="mailto:<?php echo $my_about_meta['email']; ?>"><?php echo $my_about_meta['email']; ?></a></li>
							<?php }; ?>
							<?php if(!empty ($my_about_meta['paemail'])) {?>
							  <li><i class="fa  fa-envelope-o"></i> PA: <a href="mailto:<?php echo $my_about_meta['paemail']; ?>"><?php echo $my_about_meta['paemail']; ?></a></li>
						   <?php }; ?>
                           </ul>
                        </header>
						<section>
                        
						 	<?php //Output the main description
								the_content(); ?>
						 
						</section>
                        </div>
                        </div>
				</li> 
				<?php endwhile; ?>
				<?php wp_reset_query(); ?>
				 
				 </ul>
			</div><!-- /.wrapper -->
		</section> <!-- /.people -->
 
<?php
 
		/* END ABOUT US SECTION
		 *****************************************************/
?>
<?php get_footer(); ?>