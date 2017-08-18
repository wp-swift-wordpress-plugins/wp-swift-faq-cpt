<?php
if( function_exists('acf_add_local_field_group') ):
$options = get_option( 'wp_swift_faq_cpt_settings' );
$faq_fields = array ();
$faq_attribution = array (
	'key' => 'field_5996b73d6b54e',
	'label' => 'Attribution',
	'name' => 'attribution',
	'type' => 'text',
	'instructions' => 'Who asked this question?',
	'required' => 0,
	'conditional_logic' => 0,
	'wrapper' => array (
		'width' => '',
		'class' => '',
		'id' => '',
	),
	'default_value' => '',
	'placeholder' => '',
	'prepend' => '',
	'append' => '',
	'maxlength' => '',
);
$position_or_status = array (
	'key' => 'field_5996b7576b54f',
	'label' => 'Position or Status',
	'name' => 'position_or_status',
	'type' => 'text',
	'instructions' => 'Eg. CEO, Housewife',
	'required' => 0,
	'conditional_logic' => 0,
	'wrapper' => array (
		'width' => '',
		'class' => '',
		'id' => '',
	),
	'default_value' => '',
	'placeholder' => '',
	'prepend' => '',
	'append' => '',
	'maxlength' => '',
);
$faq_location = array (
	'key' => 'field_5996b7a66b550',
	'label' => 'Location',
	'name' => 'location',
	'type' => 'text',
	'instructions' => 'Eg. Waterford, Ireland',
	'required' => 0,
	'conditional_logic' => 0,
	'wrapper' => array (
		'width' => '',
		'class' => '',
		'id' => '',
	),
	'default_value' => '',
	'placeholder' => '',
	'prepend' => '',
	'append' => '',
	'maxlength' => '',
);
if (isset($options['wp_swift_faq_cpt_checkbox_acf_field_attribution'])) {
	$faq_fields[] = $faq_attribution;
}
if (isset($options['wp_swift_faq_cpt_checkbox_acf_field_position_or_status'])) {
	$faq_fields[] = $position_or_status;
}
if (isset($options['wp_swift_faq_cpt_checkbox_acf_field_location'])) {
	$faq_fields[] = $faq_location;
}						
if (count($faq_fields)>0) {
	acf_add_local_field_group(array (
		'key' => 'group_5996b6e7bd554',
		'title' => 'FAQ Attribution',
		'fields' => $faq_fields,
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'faq',
				),
			),
		),
		'menu_order' => 0,
		'position' => 'normal',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => '',
		'active' => 1,
		'description' => '',		
	));
}
endif;