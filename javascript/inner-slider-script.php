<script type="text/javascript">
			
			$(document).ready(function(){
	
				$(".main-header").bgswitcher({
				images: 	[	
<?php /* SHOW ONLY 5 BG IMAGES */ $loop = new WP_Query( array( 'post_type' => 'background_slider', 'posts_per_page' => 5 ) ); ?>
<?php $count = 0; ?>
<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
<?php /* GRAB THE LARGE IMAGE URL */ $bgimage = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'inner-slider-image' ); $bgurl = $bgimage['0']; ?>
<?php $count++; ?>
<?php /* IF WE'RE ON THE FIRST SLIDE USE THIS */ if ($count == 1) : ?>														
												{image : '<?php echo $bgurl ?>'}
<?php /* THEN FOR THE OTHER SLIDES USE THIS */ else : ?>														
												,{image : '<?php echo $bgurl ?>'}
<?php endif; ?>
<?php endwhile; wp_reset_query(); ?>
												], 
				effect: "fade",   
				interval: "7000",
				duration: 500, 
				easing: "swing"
				});
			
			});
			
			
		</script>