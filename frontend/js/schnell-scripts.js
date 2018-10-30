/**
 * Package: WordPress
 * Project: Schnellbugel Training Plugin
 * Author: Jose Rodriguez
 * Version: 1.0
 * Description: SCHNELLBUGEL JAVASCRIPT AND JQUERY ACTIONS
 */

/**
 * Ajax Call to send form on Single Events
 */


var form = document.querySelector('#anmeldung-privat');
var submit_form_btn = document.querySelector('#anmeldung-privat-btn');

submit_form_btn.addEventListener('click', function () {
    if (!form.checkValidity()) {
        form.querySelector('#anmeldung-privat-btn').click();
    }
}, false);

form.addEventListener('submit', function (e) {
    e.preventDefault();

    var form_validated = jQuery('#anmeldung-privat');
    var submit_form = jQuery('anmeldung-privat-btn');

    jQuery.ajax({
            type    : 'post',
            url     : schnell_vars.ajaxurl,
            data: {
                action : 'schnell_send_form',
                values : form_validated.serializeArray()
            },
            beforeSend : function(){
                submit_form.find('i').remove();
                btn_text = submit_form.html();
                submit_form.html( btn_text + ' <i class="fas fa-circle-notch fa-spin"></i>' );

            },
            success    : function( response ){
                submit_form
                    .find('i')
                    .remove();
                //form_validated
                //    .trigger('reset');
                console.log( response );
            },
            error      : function( response ){
                submit_form
                    .find('i')
                    .removeClass('fa-circle-notch')
                    .removeClass('fa-spin')
                    .addClass('fa-exclamation-triangle');
                console.log( response );
            }
        })
}, false);
