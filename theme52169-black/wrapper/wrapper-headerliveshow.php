<?php /* Wrapper Name: Header */ ?>

<div class="row">
	<div class="span5" data-motopress-type="static" data-motopress-static-file="static/static-logo.php">
		<?php //get_template_part("static/static-logo"); ?>
	</div>
	<div class="span7" data-motopress-type="dynamic-sidebar" data-motopress-sidebar-id="header-sidebar">
		<div class="header_widget"><?php dynamic_sidebar("header-sidebar"); ?></div>
	</div>
</div>

<div class="spacer"></div>

<div class="header_block">
	<div class="row">
		<div class="span9" data-motopress-type="static" data-motopress-static-file="static/static-nav.php">
			<?php //get_template_part("static/static-nav"); ?>
		</div>
		<div class="span3 hidden-phone" data-motopress-type="static" data-motopress-static-file="static/static-search.php">
			<?php //get_template_part("static/static-search"); ?>
		</div>
	</div>
</div>