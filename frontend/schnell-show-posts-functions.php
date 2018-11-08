<?php
/*
 * PRE GET POST ON ARCHIVE VIEW TO ORDER POST BY MATAVALUE START DATE
 */

function schnell_set_order_on_archive( $query ){

    if ( is_admin() && $query->is_main_query() ) return;

    //  IF IS ARCHIVE VIEW FOR TRAINING EVENTS
    if ( $query->is_main_query() && $query->is_post_type_archive('schtra_events') ){

        $prefix = 'schnell_';

        $keyname = $prefix . 'startdate';

        //        ( isset ( $_GET['trainer'] ) && !empty( $_GET['trainer'] ) ) ?
        //            $keyname = $prefix . 'mainexpert' : '';
        //
        //        ( isset ( $_GET['training'] ) && !empty( $_GET['training'] ) ) ?
        //            $keyname = $prefix . 'training' : '';

        if (
            isset ( $_GET['trainer'] ) &&
            !empty( $_GET['trainer'] )
        ){
            $args = array(
                array(
                    'key' => $prefix . 'mainexpert',
                    'value' => $_GET['trainer'],
                    'compare' => 'LIKE'
                )
            );

            $query->set('meta_query', $args );
        }

        if (
            isset ( $_GET['training'] ) &&
            !empty( $_GET['training'] )
        ){
            $args = array(
                array(
                    'key' => $prefix . 'training',
                    'value' => $_GET['training'],
                    'compare' => 'LIKE'
                )
            );

            $query->set('meta_query', $args );
        }

        if(
            isset ( $_GET['trainer'] ) &&
            !empty( $_GET['trainer'] ) &&
            isset ( $_GET['training'] ) &&
            !empty( $_GET['training'] )
        ){
            $args = array(
                'relation' => 'AND',
                array(
                    'key' => $prefix . 'training',
                    'value' => $_GET['training'],
                    'compare' => 'LIKE'
                ),
                array(
                    'key' => $prefix . 'mainexpert',
                    'value' => $_GET['trainer'],
                    'compare' => 'LIKE'
                )
            );

            $query->set('meta_query', $args );
        }

        $query->set( 'paged', true );
        $query->set( 'posts_per_page', 1 );
        $query->set( 'meta_key', $keyname);
        $query->set( 'orderby', array ('meta_value_num' => 'DESC' ));

    }
    
    //  IF IS ARCHIVE VIEW FOR TRAINING EVENTS
    if ( $query->is_main_query() && $query->is_post_type_archive('schtra_training') ){
        
        if ( 
            isset ( $_GET['training-category'] ) &&
            !empty ( $_GET['training-category'] )
        ){
        
            $taxquery = array(
                array(
                    'taxonomy' => 'schnell-training-cat',
                    'field' => 'id',
                    'terms' => $_GET['training-category'],
                )
            );

            $query->set('tax_query', $taxquery);
        }
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

/*
 * SHORTCODE TO SHOW LAST EVENTS OR EVENTS BY EXPERT
 * SET ATTRIBUTE showboxtitle TO FALSE TO HIDE LIST TITLE
 * SET ATTRIBUTO boxtitle TO CHANCE THE LIST TITLE TEXT
 */

add_shortcode('schnell-show-events', 'schnell_show_events');
function schnell_show_events( $atts ){

    $prefix = 'schnell_';

    $a = shortcode_atts( array(
        'expert' => '',
        'show-box-title' => "true",
        'box-title' => esc_html('Bevorstehende Veranstaltungen', 'schnell'),
        'posts-per-page' => 4,
        'theme' => 'default'
    ), $atts );

    $args = array( 'post_type' => 'schtra_events', 'posts_per_page' => $a['posts-per-page'] );

    if ( $a['expert'] != ''){
        $args = array(
            'meta_query'        => array(
                array(
                    'key'       => $prefix . 'mainexpert',
                    'value'     => $a['expert']
                )
            ),
            'post_type'         => 'schtra_events',
            'posts_per_page'    => $a['posts-per-page']
        );
    }

    $events = get_posts( $args );

    if ( $events ){
        $html .= '<div class="shortcode-event-list-container theme-' . $a['theme'] . '">';
        if ($a['show-box-title'] == "true"){
        $html .= '<h3 class="shortcode-event-list-title">' . $a['box-title'] . '</h3>';
        }
        $html .= '<ul class="shortcode-event-list">';
        foreach ( $events as $event ){
            $training_ID            = get_post_meta( $event->ID, $prefix . 'training', true );
            $training_title         = get_the_title( $training_ID );
            $training_startdate     = get_post_meta( $event->ID, $prefix . 'startdate', true );
            $training_permalink     = get_post_permalink( $training_ID );

            // LOCATION METADATA
            $location_ID            = get_post_meta( $event->ID, $prefix . 'mainlocation', true );
            $location_name          = get_the_title( $location_ID );
            $location_address       = get_post_meta( $location_ID, $prefix . 'address', true);
            $location_city          = get_post_meta( $location_ID, $prefix . 'city', true);

            $html .= '<li>';
            $html .= '<a href="' . $training_permalink . '" target="_blank">';
            $html .= '<h4>' . $training_title . '</h4>';
            $html .= '</a>';
            $html .= '<p class="training-date"><i class="fa fa-calendar-alt"></i> ' . str_replace('-', '.',  $training_startdate ). '</p>';
            $html .= '<p><strong><i class="fa fa-map-marker"></i> ' . $location_name . '</strong></p>';
            $html .= '<p>' . $location_address . '</p>';
            $html .= '<p>' . $location_city . '</p>';
            $html .= '<a class="shortcode-event-list-single-link" href="' . get_post_permalink( $event->ID ) . '" target="_blank">' . esc_html('Anmeldung', 'schnell') . ' <i class="fa fa-angle-double-right"></i></a>';
            $html .= '</li>';
        }
        $html .= '</ul>';
        $html .= '</div>';
    }
    return $html;
}


/*
 * SHORTCODE TO SHOW LAST EVENTS BY TRAINING
 */

function schnell_show_events_by_training( $training_id ){

    $prefix = 'schnell_';
    
    $keyname = $prefix . 'startdate';

    $args = array(
        'meta_query'        => array(
            array(
                'key'       => $prefix . 'training',
                'value'     => $training_id
            )
        ),
        'post_type'         => 'schtra_events',
        'posts_per_page'    => 3,
        'meta_key' => $keyname,
        'orderby' => array ('meta_value_num' => 'ASC' )
    );

    $events = get_posts( apply_filters('filter_show_events_by_training', $args ) );
    

    if ( $events ){
        echo '<div class="shortcode-event-list-container theme-red">';
        echo '<h3 class="shortcode-event-list-title">' . esc_html('Bevorstehende Veranstaltungen für dieses Training', 'schnell') . '</h3>';
        echo '<ul class="shortcode-event-list">';
        foreach ( $events as $event ){
            $training_ID            = get_post_meta( $event->ID, $prefix . 'training', true );
            $training_title         = get_the_title( $training_ID );
            $training_startdate     = get_post_meta( $event->ID, $prefix . 'startdate', true );
            $training_permalink     = get_post_permalink( $event->ID );
            
            // EXPERT METADATA
            $expert_ID              = get_post_meta( $event->ID, $prefix . 'mainexpert', true );
            $expert_name            = get_the_title( $expert_ID );
            $expert_permalink       = get_post_permalink( $expert_ID );

            // LOCATION METADATA
            $location_ID            = get_post_meta( $event->ID, $prefix . 'mainlocation', true );
            $location_name          = get_the_title( $location_ID );
            $location_address       = get_post_meta( $location_ID, $prefix . 'address', true);
            $location_city          = get_post_meta( $location_ID, $prefix . 'city', true);

            echo '<li>';
            echo '<p class="training-date"><i class="far fa-calendar-alt"></i> '
                . str_replace('-', '.',  $training_startdate )
                . '</p>';
            echo '<p><i class="fa fa-map-marker"></i> ' 
                . $location_name 
                . ', ' 
                . $location_address 
                . ' ' 
                . $location_city . '</p>';
            echo '<p><i class="fa fa-user"></i> ' 
                . esc_html('Trainer', 'schnell') 
                . ': <a href="'
                . $expert_permalink 
                . '" target="_blank">'
                . $expert_name 
                . '</a></p>';
            
            echo '<a class="shortcode-event-list-single-link" href="'
                . $training_permalink . '">' 
                . esc_html('Merh info / Anmelden', 'schnell') 
                . ' <i class="fa fa-angle-double-right"></i></a>';
            
            echo '</li>';
        }
        echo '</ul>';
        echo '</div>';
    }

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

function schnell_frontend_css_js(){
    if( ! is_admin() and is_singular('schtra_events') or is_singular('schtra_training') ){
        wp_enqueue_style( 'schnel-bootstrap', SCHNELL_PLUGIN_URI . '/frontend/css/bootstrap.min.css', false, NULL, 'all' );
        wp_enqueue_style( 'schnel-trainings', SCHNELL_PLUGIN_URI . '/frontend/css/schnel-style.css', false, NULL, 'all' );
        wp_enqueue_script( 'schnel-bootstrap-js', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js', array('jquery'), null, true );

        // REGISTER AJAX BEHAVIOR
        wp_register_script('schnell_scripts', SCHNELL_PLUGIN_URI . '/frontend/js/schnell-scripts.js', array('jquery'), '1', true );
        wp_enqueue_script('schnell_scripts');

        wp_localize_script('schnell_scripts','schnell_vars',['ajaxurl'=>admin_url('admin-ajax.php')]);

    }
	if ( is_page() ){
		wp_enqueue_style( 'schnel-trainings', SCHNELL_PLUGIN_URI . '/frontend/css/schnel-style.css', false, NULL, 'all' );
	}
}
add_action('wp_enqueue_scripts', 'schnell_frontend_css_js');

function schnell_plugin_body_classes($classes) {

	global $post;
    if ('schtra_events' == $post->post_type){
        $classes[] = 'schnell-plugin-wrapper';
        $classes[] = 'schnell-plugin-'.$post->post_name;
    }
	return $classes;
}
add_filter('body_class', 'schnell_plugin_body_classes');
