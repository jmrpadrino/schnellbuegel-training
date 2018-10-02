<?php
if ( has_filter( 'et_builder_post_types') ) 
    add_filter( 'et_builder_post_types', 'schn_add_ctp_to_divi' );
    
function schn_add_ctp_to_divi(){
    echo '<pre>';
    echo 'hola';
    echo '</pre>';
}