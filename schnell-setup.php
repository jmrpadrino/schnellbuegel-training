<?php
/*
* This document has the functionality manage the structures that holds
* the plugin information
*/

/*
 * FORCE USE OF TEMPLATES FROM PLUGIN FOLDER (frontend/templates)
 * if need to override, developer have to insert a copy of the file
 * on theme or child theme file structure
 */

function mostrar_arreglo($array){
    echo '<pre>';
    print_r($array);
    echo '</pre>';
}


//add_action('wp_head', 'schn_styles_scripts');
function schn_styles_scripts(){
    if (
        // fontawesome for events
        is_archive('schtra_events')     ||
        is_single('schtra_events')      ||
        is_singular('schtra_events')    ||

        // fontawesome for training
        is_archive('schtra_training')   ||
        is_single('schtra_training')    ||
        is_singular('schtra_training')  ||
        
        // fontawesome for experts
        is_archive('schtra_expert')     ||
        is_single('schtra_expert')      ||
        is_singular('schtra_expert')
    ){
        //wp_enqueue_style('schnell-training-icons', 'https://use.fontawesome.com/releases/v5.3.1/css/all.css', null, null);
    }
    /*
    if (
        // fontawesome for training
        is_archive('schtra_training')     ||
        is_single('schtra_training')      ||
        is_singular('schtra_training')
    ){ 
        wp_enqueue_style('schnell-training-icons', 'https://use.fontawesome.com/releases/v5.3.1/css/all.css', null, null);
    }
    */
}

function schn_force_template( $template )
{	
    if( is_post_type_archive( 'schtra_events' ) ) {
        // Use Plugin template
        $template = SCHNELL_PLUGIN_DIR 
            . 'frontend/templates/archive-schtra_events.php';

        // to override archive template
        $active_template = TEMPLATEPATH;
        if (is_child_theme()){
            $active_template = STYLESHEETPATH;
        }
        
        $archive_file = scandir($active_template);
        $found = array_search('archive-schtra_events.php', $archive_file);
        
        if ($found){
            $template = $active_template . '/archive-schtra_events.php';
        }

    }
        
    if( is_post_type_archive( 'schtra_expert' ) ) {
        // Use Plugin template
        $template = SCHNELL_PLUGIN_DIR 
            . 'frontend/templates/archive-schtra_expert.php';

        // to override archive template
        $active_template = TEMPLATEPATH;
        if (is_child_theme()){
            $active_template = STYLESHEETPATH;
        }
        
        $archive_file = scandir($active_template);
        $found = array_search('archive-schtra_expert.php', $archive_file);
        
        if ($found){
            $template = $active_template . '/archive-schtra_expert.php';
        }

    }
    
    if( is_post_type_archive( 'schtra_training' ) ) {
        // Use Plugin template
        $template = SCHNELL_PLUGIN_DIR 
            . 'frontend/templates/archive-schtra_training.php';

        // to override archive template
        $active_template = TEMPLATEPATH;
        if (is_child_theme()){
            $active_template = STYLESHEETPATH;
        }
        
        $archive_file = scandir($active_template);
        $found = array_search('archive-schtra_training.php', $archive_file);
        
        if ($found){
            $template = $active_template . '/archive-schtra_training.php';
        }

    }

    if( is_singular( 'schtra_training' ) || is_single( 'schtra_training' ) ) {
        // Use Plugin template
        $template = SCHNELL_PLUGIN_DIR
            . 'frontend/templates/single-schtra_training.php';

        // to override archive template
        $active_template = TEMPLATEPATH;
        if (is_child_theme()){
            $active_template = STYLESHEETPATH;
        }

        $archive_file = scandir($active_template);
        $found = array_search('single-schtra_training.php', $archive_file);

        if ($found){
            $template = $active_template . '/single-schtra_training.php';
        }

    }

    if( is_singular( 'schtra_expert' ) || is_single( 'schtra_expert' ) ) {
        // Use Plugin template
        $template = SCHNELL_PLUGIN_DIR
            . 'frontend/templates/single-schtra_expert.php';

        // to override archive template
        $active_template = TEMPLATEPATH;
        if (is_child_theme()){
            $active_template = STYLESHEETPATH;
        }

        $archive_file = scandir($active_template);
        $found = array_search('single-schtra_expert.php', $archive_file);

        if ($found){
            $template = $active_template . '/single-schtra_expert.php';
        }

    }
    
    if( is_singular( 'schtra_events' ) || is_single( 'schtra_events' ) ) {
        // Use Plugin template
        $template = SCHNELL_PLUGIN_DIR
            . 'frontend/templates/single-schtra_events.php';

        // to override archive template
        $active_template = TEMPLATEPATH;
        if (is_child_theme()){
            $active_template = STYLESHEETPATH;
        }

        $archive_file = scandir($active_template);
        $found = array_search('single-schtra_events.php', $archive_file);

        if ($found){
            $template = $active_template . '/single-schtra_events.php';
        }

    }

    return $template;
}
add_filter( 'template_include', 'schn_force_template' );

add_action('pre_get_posts', function(){
    flush_rewrite_rules();
});


/**
* ADDING SETTING FIELD TO GOOGLE MAPS API KEY
* ADDING WORDPRESS ADMIN NOTICE VALIDATION
*/

function schnell_option_markup(){
	$markup = '';

	$markup = '<p class="description">It is mandatory, for the maps to be displayed, that you get a key from the Google Maps API. If you don\'t have one, you can get it by clicking <a href="https://developers.google.com/maps/documentation/javascript/get-api-key" target="_blank">here</a>.</p>';

	echo $markup;
}
function schnell_option_markup_field(){
	$value = get_option( 'schnell_google_map_api_key', '' );
	$markup = '';

	$markup = sprintf(
		'<input
			type="%1$s"
			id="%2$s"
			name="%3$s"
			value="%4$s"
		/>',
		'text',
		'schnell_google_map_api_key',
		'schnell_google_map_api_key',
		$value
	);

	echo $markup;
}
function schnell_option_markup_field_email(){
	$value = get_option( 'schnell_email_for_event_forms', '' );
	$markup = '';

	$markup = sprintf(
		'<input
			type="%1$s"
			id="%2$s"
			name="%3$s"
			value="%4$s"
		/>',
		'text',
		'schnell_email_for_event_forms',
		'schnell_email_for_event_forms',
		$value
	);

	echo $markup;
}
function schnell_options(){
	register_setting( 'general',
		'schnell_google_map_api_key',
		'esc_attr'
	);
    register_setting( 'general',
		'schnell_email_for_event_forms',
		'esc_attr'
	);
	add_settings_section( 'schnell-options',
		'Schnellbugel Plugin Requirements',
		'schnell_option_markup',
		'general'
	);

	add_settings_field( 'schnell_google_map_api_key',
		'API key',
		'schnell_option_markup_field',
		'general',
		'schnell-options',
		array( 'label_for' => 'schnell_google_map_api_key' )
	);
    add_settings_field( 'schnell_option_markup_field_email',
		'Email for Events Forms',
		'schnell_option_markup_field_email',
		'general',
		'schnell-options',
		array( 'label_for' => 'schnell_email_for_event_forms' )
	);
}
add_action('admin_init', 'schnell_options');


function schnell_admin_notice__success() {
	$value = get_option( 'schnell_google_map_api_key', '' );
	$markup = '';
	if (!$value){
		$markup = sprintf(
			'<div class="notice notice-warning  is-dismissible">
      			<h3>%1$s</h3>
        		<p>It is mandatory, for the maps to be displayed,
				that you get a key from the Google Maps API.
				If you don\'t have one, you can get it by clicking
				<a href="%2$s" target="_blank">here</a>.
				</p>
    		</div>',
			__('Schnellbugel Plugin', 'schnell'), 										// #1 Title
			'https://developers.google.com/maps/documentation/javascript/get-api-key' 	// #2 URL
		);
	}
	echo $markup;
}
add_action( 'admin_notices', 'schnell_admin_notice__success' );



