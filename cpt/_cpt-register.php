<?php
/**
 * Post Type: Frequently Asked Questions.
 */
function cptui_register_my_cpts_faq() {

	$labels = array(
		"name" => __( "Frequently Asked Questions", "" ),
		"singular_name" => __( "Questions", "" ),
		"menu_name" => __( "FAQs", "" ),
		"all_items" => __( "All FAQs", "" ),
	);

	$supports = array( "title", "editor" );	

	$options = get_option( 'wp_swift_faq_cpt_settings' );

	$cpt_visibility = false;

	if (isset($options['wp_swift_faq_cpt_checkbox_visibility'])) {
		$cpt_visibility = true;
	}

	if (isset($options['wp_swift_faq_cpt_checkbox_support_featured_image'])) {
		$supports[] = "thumbnail";
	}

	if (isset($options['wp_swift_faq_cpt_checkbox_support_excerpt'])) {
		$supports[] = "excerpt";
	}

	$args = array(
		"label" => __( "Frequently Asked Questions", "" ),
		"labels" => $labels,
		"description" => "Post type for frequently asked questions",
		"public" => false,// private
		"publicly_queryable" => false,// private
		"show_ui" => true,
		"show_in_rest" => false,
		"rest_base" => "",
		"has_archive" => false,
		"show_in_menu" => true,
		"exclude_from_search" => true,// private
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => array( "slug" => "faq", "with_front" => true ),
		"query_var" => true,
		"menu_position" => 50,
		"menu_icon" => "dashicons-sos",
		"supports" => $supports,
	);

	if ($cpt_visibility) {
		$args["public"] = true;
		$args["publicly_queryable"] = true;
		$args["exclude_from_search"] = false;
	}

	register_post_type( "faq", $args );
}
add_action( 'init', 'cptui_register_my_cpts_faq' );