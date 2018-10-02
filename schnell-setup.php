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

function schn_force_template( $template )
{	
    if( is_archive( 'schtra_events' ) ) {
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

    return $template;
}
add_filter( 'template_include', 'schn_force_template' );