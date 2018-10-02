<?php
/*
* This document has the functionality to create the structures that holds
* the plugin information for Training as meta fields
*/

// CUSTOM META FIELDS FOR SCHNELLBUGEL TRAINING


add_filter( 'rwmb_meta_boxes', 'schn_register_experts_meta_boxes' );
function schn_register_experts_meta_boxes( $meta_boxes ) {
    $prefix = 'schnell_';
    $meta_boxes[] = array(
        'id'         => 'personal',
        'title'      => __('Expert Contact Information', 'schnell'),
        'post_types' => 'schtra_expert',
        'context'    => 'normal',
        'priority'   => 'high',

        'fields' => array(
            array(
                'name'  => __('Address', 'schnell'),
                'id'    => $prefix . 'address',
                'type'  => 'textarea',
            ),
            array(
                'name'  => __('Phone', 'schnell'),
                'id'    => $prefix . 'phone',
                'type'  => 'text',
            ),
            array(
                'name'  => __('Email', 'schnell'),
                'id'    => $prefix . 'mail',
                'type'  => 'email',
            ),
            array(
                'type'  => 'divider',
            ),
            array(
                'name'  => __('Facebook', 'schnell'),
                'id'    => $prefix . 'facebook',
                'type'  => 'url',
            ),
            array(
                'name'  => __('Twitter', 'schnell'),
                'id'    => $prefix . 'twitter',
                'type'  => 'url',
            ),
            array(
                'name'  => __('LinkedIn', 'schnell'),
                'id'    => $prefix . 'linkedin',
                'type'  => 'url',
            ),
            array(
                'name'  => __('Xing', 'schnell'),
                'id'    => $prefix . 'xing',
                'type'  => 'url',
            ),
            array(
                'name'  => __('Website', 'schnell'),
                'id'    => $prefix . 'website',
                'type'  => 'url',
            ),
            array(
                'type'  => 'divider',
            ),
            array(
                'name'  => __('Expert PDF CV', 'schnell'),
                'id'    => $prefix . 'pdf',
                'type'  => 'file_input',
                'mime_type' => 'pdf',
                'max_file_uploads' => 1,
            )
        )
    );
    
    $meta_boxes[] = array(
        'id'         => 'trainerprofile',
        'title'      => __('Trainerprofile', 'schnell'),
        'post_types' => 'schtra_expert',
        'context'    => 'normal',
        'priority'   => 'high',

        'fields' => array(
            array(
                'name'  => __('', 'schnell'),
                'id'    => $prefix . 'trainerprofile',
                'type'  => 'wysiwyg',
            )
        )
    );

    
    $meta_boxes[] = array(
        'id'         => 'curriculum',
        'title'      => __('Curriculum', 'schnell'),
        'post_types' => 'schtra_expert',
        'context'    => 'normal',
        'priority'   => 'high',

        'fields' => array(
            array(
                'name'  => __('', 'schnell'),
                'id'    => $prefix . 'curriculum',
                'type'  => 'wysiwyg',
            )
        )
    );
    
    $meta_boxes[] = array(
        'id'         => 'powerandhumanity',
        'title'      => __('Power and Humanity', 'schnell'),
        'post_types' => 'schtra_expert',
        'context'    => 'normal',
        'priority'   => 'high',

        'fields' => array(
            array(
                'name'  => __('', 'schnell'),
                'id'    => $prefix . 'powerandhumanity',
                'type'  => 'wysiwyg',
            )
        )
    );
    
    $meta_boxes[] = array(
        'id'         => 'whoaremycustomers',
        'title'      => __('Who are my customers', 'schnell'),
        'post_types' => 'schtra_expert',
        'context'    => 'normal',
        'priority'   => 'high',

        'fields' => array(
            array(
                'name'  => __('', 'schnell'),
                'id'    => $prefix . 'whoaremycustomers',
                'type'  => 'wysiwyg',
            )
        )
    );
    
    return $meta_boxes;
}