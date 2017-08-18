<?php
function manage_columns_for_faq($columns){
    $options = get_option( 'wp_swift_faq_cpt_settings' );
    // Remove columns
    unset($columns['date']);
    unset($columns['title']);
    // Add columns
    $columns['title'] = _x('Question', 'column name');
    $columns['answer'] = 'Answer';
	$columns['date'] = _x('Date', 'column name');
    return $columns;
}
add_action('manage_faq_posts_columns','manage_columns_for_faq');
function populate_faq_columns($column,$post_id){
	global $post;
    if($column == 'answer'){
        the_excerpt();
    }
}
add_action('manage_faq_posts_custom_column','populate_faq_columns',10,2);