<script type="text/javascript">
			
			jQuery(function($){
				
				$.supersized({
					// Functionality
					slide_interval          :   6000,		// Length between transitions
					transition              :   1, 			// 0-None, 1-Fade, 2-Slide Top, 3-Slide Right, 4-Slide Bottom, 5-Slide Left, 6-Carousel Right, 7-Carousel Left
					transition_speed		:	1200,		// Speed of transition
					horizontal_center		: 1,
					vertical_center			: 1,
															   
					// Components							
					slide_links				:	'blank',	// Individual links for each slide (Options: false, 'num', 'name', 'blank')
					slides 					:  	[	
<?php /* SHOW ONLY 5 BG IMAGES */ $loop = new WP_Query( array( 'post_type' => 'background_slider', 'posts_per_page' => 5 ) ); ?>
<?php $count = 0; ?>
<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
<?php /* GRAB THE LARGE IMAGE URL */ $bgimage = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'background-slider-image' ); $bgurl = $bgimage['0']; ?>
<?php $count++; ?>
<?php /* IF WE'RE ON THE FIRST SLIDE USE THIS */ if ($count == 1) : ?>														
												{image : '<?php echo $bgurl ?>', title : '<?php the_title(); ?>'}
<?php /* THEN FOR THE OTHER SLIDES USE THIS */ else : ?>														
												,{image : '<?php echo $bgurl ?>', title : '<?php the_title(); ?>'}
<?php endif; ?>
<?php endwhile; wp_reset_query(); ?>
												]
					
				});
				
			});
			
		</script>