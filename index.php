<?php get_header(); ?>

<?php
	$sticky = get_option('sticky_posts');
	if (!empty($sticky)) {
		
		// Newest IDs first
		rsort($sticky);
		
		$args = array(
			'post__in' => $sticky,
			'posts_per_page' => '1'
		);
		
		// Override the query
		$sticky_query = new WP_Query($args);
?>

		<section class="main-body">
			<div class="wrapper">
            
               <!--Slide captions displayed here-->
			<div id="slidecaption">caption</div>

                 <ul class="sticky-posts">
				<?php if ( $sticky_query->have_posts() ) : while ( $sticky_query->have_posts() ) : $sticky_query->the_post(); ?>
                    <li>
                        <a href="<?php the_permalink() ?>">
                        <span><?php the_date('F,Y'); ?></span>
                        <strong><?php the_title(); ?></strong></a>
                    </li>
                <?php endwhile; endif; /* END: (!empty($sticky) */ }; wp_reset_query(); ?>
                </ul>

			</div><!-- /.wrapper -->
		</section> <!-- /.main-body -->

<?php get_footer(); ?>