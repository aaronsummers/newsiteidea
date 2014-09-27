<?php get_header(); 


/*
 * Page Template
 * Displays all generic page content
 *************************************************************/
?>

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

	<section class="main-body">
			<div class="wrapper">
				<article id="post-<?php the_ID(); ?>">
					<header>
						<h1><?php the_title(); ?></h1>
					</header>
					<section>
						<?php the_content(); ?>
					</section>
				</article>

				<?php endwhile; ?>
			
				<?php endif; ?>
				
			</div> <!-- /.wrapper -->
		</section> <!-- /.main-body -->

<?php get_footer(); ?>