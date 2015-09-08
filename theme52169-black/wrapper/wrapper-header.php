<?php /* Wrapper Name: Header */ ?>

<div class="row">
	
	<div class="span12" data-motopress-type="static" data-motopress-static-file="static/static-logo.php">
		<?php get_template_part("static/static-logo"); ?>
	</div>
	<div class="span12" data-motopress-type="dynamic-sidebar" data-motopress-sidebar-id="header-sidebar">
		
		<div class="header_widget">
<?php //dynamic_sidebar("header-sidebar"); ?>
<?php //echo "Now on air here";  ?>
<?php echo do_shortcode('[dj-widget title"Now On-Air" display_djs"1" show_playlist"0"]'); ?>

			<div class="listen-live header-btn"><a href="javascript:void(0)" onclick="window.open('/liveshow.php','mywindow','menubar=no,resizable=no,modal=no,scrollbars=no,status=no,toolbar=no,width=236,height=300,left = 665,top = 190')">Listen Live <img src="/wp-content/uploads/2015/02/play2.png"/></a>
			</div>
		</div>
	</div>
</div>

<div class="spacer"></div>

<div class="header_block">
	<div class="row">
			
		<div class="span12" data-motopress-type="static" data-motopress-static-file="static/static-nav.php">
				<?php get_template_part("static/static-nav"); ?>
		</div>
		<div class="span3 hidden-phone" data-motopress-type="static" data-motopress-static-file="static/static-search.php">
					<?php get_template_part("static/static-search"); ?>
		</div>
	</div>
</div>