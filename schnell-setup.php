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


add_action('wp_head', 'schn_styles_scripts');
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
        wp_enqueue_style('schnell-training-icons', 'https://use.fontawesome.com/releases/v5.3.1/css/all.css', null, null);
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

/**
 * SENDING MAIL VIA AJAX
 */
add_action('wp_ajax_nopriv_schnell_send_form','schnell_send_event_form');
add_action('wp_ajax_schnell_send_form','schnell_send_event_form');

function schnell_send_event_form()
{
    $email_address = get_option( 'schnell_email_for_event_forms', '' );
    $array_values = $_POST['values'];
    $text = '';
    /**
     * IF USER SUBMITED Privat FORM
     */

//    echo '<pre>';
//    print_r($array_values);
//    echo '</pre>';
//
//    die;

    ob_start();
    if ($array_values[0]['value'] == 'privat'){
    ?>
        <h1>Anmeldung - <?= $array_values[0]['value'] ?></h1>
        <p><strong>Fur: </strong> <?= $array_values[1]['value'] ?></p>
        <p>Vom <?= $array_values[2]['value'] ?> Bis <?= $array_values[3]['value'] ?></p>
        <p><strong>Datum der Anwendung</strong> <?= $array_values[4]['value'] ?></p>
        <ul>
            <li><strong><?= $array_values[5]['value'] ?> <?= $array_values[7]['value'] ?> <?= $array_values[8]['value'] ?></strong></li>
            <li>
                <strong>E-Mail</strong>
                <span><?= $array_values[12]['value'] ?></span>
            </li>
            <li>
                <strong>Telefonnummer</strong>
                <span><?= $array_values[13]['value'] ?></span>
            </li>
            <li>
                <strong>Straße/Hausnr.</strong>
                <span><?= $array_values[9]['value'] ?></span>
            </li>
            <li>
                <strong>Ort</strong>
                <span><?= $array_values[11]['value'] ?></span>
            </li>
            <li>
                <strong>PLZs</strong>
                <span><?= $array_values[10]['value'] ?></span>
            </li>
        </ul>
    <?php
        $html = ob_get_contents();
    }
    ob_end_clean();


    /**
     * IF USER SUBMITED Geschäftlich FORM
     */

    if ($array_values[0]['value'] == 'geschaftlich'){
        $text = 'Anmeldung: ' . strtoupper($array_values[0]['value']) . '<br /> testeo';
    }

    add_filter( 'wp_mail_content_type', 'schnell_set_html_mail_content_type' );

    $to = $email_address;
    $subject = 'Anmeldung - '
        . $array_values[1]['value'] . ' - '
        . $array_values[2]['value'] . ' / '
        . $array_values[3]['value'];

    $body = $html;
    $headers = array('Content-Type: text/html; charset=UTF-8');

    $mail = wp_mail($email_address, $subject, $body);

    remove_filter( 'wp_mail_content_type', 'schnell_set_html_mail_content_type' );

	wp_die();
}
function schnell_set_html_mail_content_type() {
    return 'text/html';
}

