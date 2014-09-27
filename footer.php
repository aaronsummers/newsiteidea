		<?php if(!is_home()){ ?>
        <footer class="main-footer">
			<div class="wrapper">
				<div class="footer clearfix">
					<ul><?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('footer-one')) : endif; ?></ul>
				</div>
			</div> <!-- /.wrapper -->
		</footer> <!-- /.main-footer -->
        <?php }; ?>
		<?php wp_footer(); ?>

	<!-- JAVASCRIPT -->
		<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/javascript/jquery.tooltipster.min.js"></script>
		<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/javascript/jquery.magnific-popup.js"></script>
		
	<!-- ADD JS CALLS IN WPTRICKS-STARTER.JS -->
		<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/javascript/wptricks-starter.js"></script>
		
				<?php if (is_home()) { ?>
					<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/javascript/supersized.3.2.7.js"></script>
					<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/javascript/supersized.shutter.js"></script>
					<?php include('javascript/home-slider-script.php');?> 			
				<?php }; ?>
				<?php if (is_page()) { ?>
					<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/javascript/jquery.bgswitcher.js"></script>
					<?php include('javascript/inner-slider-script.php');?> 			
				<?php }; ?>
		
		
		
	</body>
</html>