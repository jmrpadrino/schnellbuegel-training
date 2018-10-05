<?php
/*
 * PRE GET POST ON ARCHIVE VIEW TO ORDER POST BY MATAVALUE START DATE
 */

function schnell_set_order_on_archive( $query ){

    if ( is_admin() && $query->is_main_query() ) return;

    //  IF IS ARCHIVE VIEW FOR TRAINING EVENTS
    // if ( is_archive( 'schtra_events' ) ){
    if ( is_archive( 'schnellbugel-training-events' ) ){

        $query->set('meta_key', 'schnell_startdate');
        $query->set('orderby', array ('meta_value_num' => 'DESC' ));
    }

    return $query;

}
add_action('pre_get_posts', 'schnell_set_order_on_archive');



function schnell_show_month($month_number){
    $months = array(
        1 => __('Januar','schnell'),
        2 => __('Februar','schnell'),
        3 => __('März','schnell'),
        4 => __('April','schnell'),
        5 => __('Mai','schnell'),
        6 => __('Juni','schnell'),
        7 => __('Juli','schnell'),
        8 => __('August','schnell'),
        9 => __('September','schnell'),
        10 => __('Oktober','schnell'),
        11 => __('November','schnell'),
        12 => __('Dezember','schnell'),
    );
    return $months[$month_number];
}

//add_action( 'template_redirect', 'schnell_template_redirect_checkout' );
function schnell_template_redirect_checkout( ){
    if ($_SERVER['REQUEST_URI'] == 'schnellbugel-checkout') {
        global $wp_query;
        $wp_query->is_404 = false;
        status_header(200);
        include(SCHNELL_PLUGIN_DIR . 'frontend/templates/schnellbugel-checkout.php');
        exit();
    }
}
