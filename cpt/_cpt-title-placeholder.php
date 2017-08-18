<?php
/**
 * Replace the default "Enter title here" placeholder text in the title input box
 * with something more descriptive can be helpful for custom post types
 */
function change_default_title_faq( $title ){

    $screen = get_current_screen();

    if ( 'faq' == $screen->post_type ){
        $title = "Enter question here";
    }
    return $title;
}
add_filter( 'enter_title_here', 'change_default_title_faq' );