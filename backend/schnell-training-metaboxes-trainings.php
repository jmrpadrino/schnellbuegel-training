<?php
/*
* This document has the functionality to create the structures that holds
* the plugin information for Training as meta fields
*/

// CUSTOM META FIELDS FOR SCHNELLBUGEL TRAINING


add_filter( 'rwmb_meta_boxes', 'schn_register_trainings_meta_boxes' );
function schn_register_trainings_meta_boxes( $meta_boxes ) {
    $prefix = 'schnell_';
    $meta_boxes[] = array(
        'id'         => 'additionalcontent',
        'title'      => __('Additional Information', 'schnell'),
        'post_types' => 'schtra_training',
        'context'    => 'normal',
        'priority'   => 'high',

        'fields' => array(
            array(
                'name'  => __('Slogan', 'schnell'),
                'id'    => $prefix . 'slogan',
                'type'  => 'textarea',
            ),
            array(
                'name'  => __('Resume', 'schnell'),
                'id'    => $prefix . 'resume',
                'type'  => 'textarea',
                'rows'  => 10
            ),
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
            ),
            array(
                'name'  =>  __('Further Information', 'schnell'),
                'id'    => $prefix . 'furtherinformation',
                'type'  => 'textarea',
                'rows'  => 5
            ),
            array(
                'name'  => __('Anmerkungen Kosten', 'schnell'),
                'id'    => $prefix . 'costcomment',
                'type'  => 'textarea',
            ),
            array(
                'name'  => __('Training PDF document', 'schnell'),
                'id'    => $prefix . 'pdf',
                'type'  => 'file_input',
                'mime_type' => 'pdf',
                'max_file_uploads' => 1,
            )
        )
    );
    
    $meta_boxes[] = array(
        'id'         => 'eventfeatures',
        'title'      => __('Training Price', 'schnell'),
        'post_types' => 'schtra_training',
        'context'    => 'side',
        'priority'   => 'high',

        'fields' => array(
            array(
                'name'  => __('Cost', 'schnell'),
                'id'    => $prefix . 'cost',
                'type'  => 'number',
                'step'  => 0.01
            ),
        )
    );

    $meta_boxes[] = array(
        'id'         => 'maininformation',
        'title'      => __('Main Information', 'schnell'),
        'post_types' => 'schtra_training',
        'context'    => 'normal',
        'priority'   => 'high',

        'fields' => array(
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
        )
    );
    

    return $meta_boxes;
}
