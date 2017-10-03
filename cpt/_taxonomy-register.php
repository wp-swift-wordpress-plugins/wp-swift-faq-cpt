<?php
function cptui_register_my_taxes_question_category() {

	/**
	 * Taxonomy: Question Categories.
	 */

	$labels = array(
		"name" => __( "Question Categories", "" ),
		"singular_name" => __( "Question Category", "" ),
	);

	$options = get_option( 'wp_swift_faq_cpt_settings' );

	$cpt_visibility = false;

	if (isset($options['wp_swift_faq_cpt_checkbox_visibility'])) {
		$cpt_visibility = true;
	}

	$args = array(
		"label" => __( "Question Categories", "" ),
		"labels" => $labels,
		"public" => false,
		"hierarchical" => true,
		"label" => "Question Categories",
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => array( 'slug' => 'question-category', 'with_front' => true, ),
		"show_admin_column" => true,
		"show_in_rest" => false,
		"rest_base" => "",
		"show_in_quick_edit" => false,
	);

	if ($cpt_visibility) {
		$args["public"] = true;
	}

	register_taxonomy( "question_category", array( "faq" ), $args );
}

add_action( 'init', 'cptui_register_my_taxes_question_category' );