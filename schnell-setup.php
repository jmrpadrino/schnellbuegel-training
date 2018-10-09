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

function mostrar_arreglo($array){
    echo '<pre>';
    print_r($array);
    echo '</pre>';
}
