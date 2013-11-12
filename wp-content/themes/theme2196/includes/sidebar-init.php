<?php
function elegance_widgets_init() {
	// Main Content Area
	// Location: at the middle of the content
	register_sidebar(array(
		'name'					=> 'Main Content Area',
		'id' 						=> 'main-content-area',
		'description'   => __( 'Located at the middle of the content.'),
		'before_widget' => '<div id="%1$s" class="widget-main">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	));
	// Sidebar Widget
	// Location: the sidebar
	register_sidebar(array(
		'name'					=> 'Sidebar',
		'id' 						=> 'main-sidebar',
		'description'   => __( 'Located at the right side of pages.'),
		'before_widget' => '<div id="%1$s" class="widget">',
		'after_widget' => '</div>',
		'before_title' => '<h4>',
		'after_title' => '</h4>',
	));
	
	// Footer Widget 1
	// Location: footer
	register_sidebar(array(
		'name'					=> 'Footer 1',
		'id' 						=> 'footer-widget-1',
		'description'   => __( 'Located at the bottom of pages.'),
		'before_widget' => '<div id="%1$s" class="footer-widget">',
		'after_widget' => '</div>',
		'before_title' => '<h4>',
		'after_title' => '</h4>',
	));
	// Footer Widget 2
	// Location: footer
	register_sidebar(array(
		'name'					=> 'Footer 2',
		'id' 						=> 'footer-widget-2',
		'description'   => __( 'Located at the bottom of pages.'),
		'before_widget' => '<div id="%1$s" class="footer-widget grid_2">',
		'after_widget' => '</div>',
		'before_title' => '<h4>',
		'after_title' => '</h4>',
	));
	// Footer Widget 3
	// Location: footer
	register_sidebar(array(
		'name'					=> 'Footer 3',
		'id' 						=> 'footer-widget-3',
		'description'   => __( 'Located at the bottom of pages.'),
		'before_widget' => '<div id="%1$s" class="footer-widget">',
		'after_widget' => '</div>',
		'before_title' => '<h4>',
		'after_title' => '</h4>',
	));

}
/** Register sidebars by running elegance_widgets_init() on the widgets_init hook. */
add_action( 'widgets_init', 'elegance_widgets_init' );
?>