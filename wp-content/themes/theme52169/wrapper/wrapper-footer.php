<?php /* Wrapper Name: Footer */ ?>

<div class="row">
	<div class="span9">

		<div data-motopress-type="static" data-motopress-static-file="static/static-footer-nav.php">
			<?php get_template_part("static/static-footer-nav"); ?>
		</div>
		<div data-motopress-type="dynamic-sidebar" data-motopress-sidebar-id="footer-sidebar">
			<?php dynamic_sidebar("footer-sidebar"); ?>
		</div>
		
	</div>
	<!-- Social Links -->
	<div class="span3" data-motopress-type="static" data-motopress-static-file="static/static-social-networks.php">
		<div class="social-nets-wrapper"><?php get_template_part("static/static-social-networks"); ?></div>
	</div>
	<!-- /Social Links -->
</div>

<div class="row">
	<div class="span12" data-motopress-type="static" data-motopress-static-file="static/static-footer-text.php">

		<div class="copyright"><?php get_template_part("static/static-footer-text"); ?></div>

	</div>
</div>