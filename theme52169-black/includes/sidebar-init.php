<?php
// Register sidebars by running cherry_widgets_init() on the widgets_init hook.
add_action( 'widgets_init', 'cherry_widgets_init' );

function cherry_widgets_init() {
	// Sidebar Widget
	// Location: the sidebar
	register_sidebar( array(
		'name'          => theme_locals("sidebar"),
		'id'            => 'main-sidebar',
		'description'   => theme_locals("sidebar_desc"),
		'before_widget' => '<div id="%1$s" class="widget">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3>',
		'after_title'   => '</h3>',
	) );
	// Header Widget Area
	// Location: at the top of the header
	register_sidebar( array(
		'name'          => __("Header Area", CURRENT_THEME),
		'id'            => 'header-sidebar',
		'description'   => __("Located at the top of pages.", CURRENT_THEME),
		'before_widget' => '<div id="%1$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4>',
		'after_title'   => '</h4>',
	) );
	// Footer Widget Area
	// Location: at the top of the footer, above the copyright
	register_sidebar( array(
		'name'          => __("Footer Area", CURRENT_THEME),
		'id'            => 'footer-sidebar',
		'description'   => theme_locals("footer_desc"),
		'before_widget' => '<div id="%1$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4>',
		'after_title'   => '</h4>',
	) );
} ?>