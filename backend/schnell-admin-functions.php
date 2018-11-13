<?php
function schnell_columns_head($defaults){
    if ( $_GET['post_type'] == 'schtra_events' ){
        $defaults['startdate'] = 'Startdatum';
        $defaults['expert'] = 'Experte';
        $defaults['training'] = 'Name des Trainings';
    }
    return $defaults;
}

function schnell_columns_content($column_name, $post_ID){

    $prefix = 'schnell_';

    if ( $column_name == 'startdate'){
        echo str_replace('-', '.', get_post_meta( $post_ID, $prefix . 'startdate', true));
    }
    if ( $column_name == 'expert' ){
        $expert_id = get_post_meta( $post_ID, $prefix . 'mainexpert', true);
        $expert = get_post($expert_id);
        $expertMail = get_post_meta( $expert->ID, $prefix . 'mail', true);
        echo '<span>';
        echo (!empty($expertMail)) ? '<a href="mailto:'.$expertMail.'"><span title="Mail senden" class="dashicons dashicons-email-alt"></span></a> | ' : '';
        echo $expert->post_title . '</span>';
    }
    if ( $column_name == 'training' ){
        $training_id = get_post_meta( $post_ID, $prefix . 'training', true);
        $training = get_post($training_id);
        echo $training->post_title;
    }

}

function schnell_filter_posts_columns( $columns ) {
    if ( $_GET['post_type'] == 'schtra_events' ){
        $columns['title'] = __( 'Ereignisname' );
        $columns['date'] = __( 'Datum' );
    }
    return $columns;
}

add_filter( 'manage_schtra_events_posts_columns', 'schnell_filter_posts_columns' );
add_filter('manage_posts_columns', 'schnell_columns_head');
add_action('manage_posts_custom_column', 'schnell_columns_content', 10, 2);
