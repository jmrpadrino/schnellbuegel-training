<?php
/*
* This document has the functionality to create the structures that holds
* the plugin information for Training as meta fields
*/

// CUSTOM META FIELDS FOR SCHNELLBUGEL TRAINING


add_filter( 'rwmb_meta_boxes', 'schn_register_events_meta_boxes' );
function schn_register_events_meta_boxes( $meta_boxes ) {
    $prefix = 'schnell_';
    $meta_boxes[] = array(
        'id'         => 'information',
        'title'      => __('Information', 'schnell'),
        'post_types' => 'schtra_events',
        'context'    => 'normal',
        'priority'   => 'high',

        'fields' => array(
            array(
                'name'  => __('The Training', 'schnell'),
                'id'    => $prefix . 'training',
                'type'  => 'post',
                'post_type' => 'schtra_training'
            ),
            array(
                'name'  => __('Main Expert', 'schnell'),
                'id'    => $prefix . 'mainexpert',
                'type'  => 'post',
                'post_type' => 'schtra_expert'
            ),
            array(
                'name'  => __('Main Location', 'schnell'),
                'id'    => $prefix . 'mainlocation',
                'type'  => 'post',
                'post_type' => 'schtra_location'
            )
            /*,
            array(
                'name'  => __('The Duration', 'schnell'),
                'id'    => $prefix . 'duration',
                'type'  => 'textarea',
            ),
            array(
                'name'  => __('More information', 'schnell'),
                'id'    => $prefix . 'moreinformation',
                'type'  => 'textarea',
                'rows'  => 5
            )*/
        )
    );
    
    $meta_boxes[] = array(
        'id'         => 'eventfeatures',
        'title'      => __('Event Features', 'schnell'),
        'post_types' => 'schtra_events',
        'context'    => 'side',
        'priority'   => 'high',

        'fields' => array(
            /*
            array(
                'name'  => __('Cost', 'schnell'),
                'id'    => $prefix . 'cost',
                'type'  => 'number',
                'step'  => 0.01
            ),
            */
            array(
                'name'  => __('Start Date', 'schnell'),
                'id'    => $prefix . 'startdate',
                'type'  => 'date',
                'js_options' => array(
                    'dateFormat'      => 'yy-mm-dd',
                    'showButtonPanel' => true,
                ),
            ),
            array(
                'name'  => __('End Date', 'schnell'),
                'id'    => $prefix . 'enddate',
                'type'  => 'date',
                'js_options' => array(
                    'dateFormat'      => 'yy-mm-dd',
                    'showButtonPanel' => true,
                ),
            ),
        )
    );

    
    /*
    * HERE STARTS THE METABOX GROUP 
    */
        
    $meta_boxes[] = array(
        'title'      => __('Modules', 'schnell'),
        'id'         => 'modulegroups',
        'post_types' => array( 'schtra_events' ),
        'context'    => 'normal',
        'priority'   => 'high',

        'fields' => array(
            array(
                'id' => 'modulegroup', // ID group
                'name' => 'Module', 
                'type' => 'group', // Data of “Group”
                'add_button' => __('Add another module', 'schnell'),
                'clone' => true,
                'sort_clone' => true,
                // List of custom fields
                'fields' => array(
                    array(
                        'id'    => $prefix . 'moduleid',
                        'type'  => 'post',
                        'name'  => __('Module Title', 'schnell'),
                        'post_type' => array(
                            0 => 'schtra_module'
                        ),
                        'field_type' => 'select'
                    ),
                    array(
                        'id'    => $prefix . 'moduleexpert',
                        'type'  => 'post',
                        'name'  => __('Module Expert', 'schnell'),
                        'post_type' => array(
                            0 => 'schtra_expert'
                        ),
                        'field_type' => 'select'
                    ),
                    array(
                        'id'    => $prefix . 'modulelocation',
                        'type'  => 'post',
                        'name'  => __('Location', 'schnell'),
                        'post_type' => array(
                            0 => 'schtra_location'
                        ),
                        'field_type' => 'select'
                    ),
                    array(
                        'id'    => $prefix . 'moduledate',
                        'type'  => 'date',
                        'name'  => __('Date', 'schnell'),
                        'js_options' => array(
                            'dateFormat'      => 'dd-mm-yy',
                            'showButtonPanel' => true,
                        ),
                    ),
                ),                
            ),
        )
    );
    

    return $meta_boxes;
}


/* 
            array(
                'name'  => __('The Target Group', 'schnell'),
                'id'    => $prefix . 'target',
                'type'  => 'wysiwyg',
            ),
            array(
                'name'  => __('The Goal', 'schnell'),
                'id'    => $prefix . 'goal',
                'type'  => 'wysiwyg',
            ),
            array(
                'name'  => __('The Benefits', 'schnell'),
                'id'    => $prefix . 'benefits',
                'type'  => 'wysiwyg',
            ),
            array(
                'name'  => __('The Contents', 'schnell'),
                'id'    => $prefix . 'contents',
                'type'  => 'wysiwyg',
            )
