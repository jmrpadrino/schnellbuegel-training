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

//jQuery( '#anmeldung-privat' ).submit( function(e){
//    console.log('enviando');
//    //e.preventDefault();
//});

var formPrivat = document.querySelector('#anmeldung-privat');
var formCompany = document.querySelector('#anmeldung-geschaftlich');
var submit_form_privat = document.querySelector('#anmeldung-privat-btn');
var submit_form_company = document.querySelector('#anmeldung-geschaftlich-btn');

submit_form_privat.addEventListener('click', function () {
    if (!formPrivat.checkValidity()) {
        formPrivat.querySelector('#anmeldung-privat-btn').click();
    }
}, false);

formPrivat.addEventListener('submit', function (e) {
    e.preventDefault();

    var form_validated = jQuery('#anmeldung-privat');
    var submit_form = jQuery('anmeldung-privat-btn');

    jQuery.ajax({
            type    : 'post',
            url     : schnell_vars.ajaxurl,
            data: {
                action : 'schnell_send_form',
                values : form_validated.serialize()
            },
            beforeSend : function(){
                submit_form.find('i').remove();
                btn_text = submit_form.html();
                submit_form.html( btn_text + ' <i class="fa fa-circle-o-notch fa-spin"></i>' );

            },
            success    : function( response ){
                submit_form
                    .find('i')
                    .remove();
//                form_validated
//                    .trigger('reset');
                console.log( response );
            },
            error      : function( response ){
                submit_form
                    .find('i')
                    .removeClass('fa-circle-o-notch')
                    .removeClass('fa-spin')
                    .addClass('fa-exclamation-triangle');
                console.log( response );
            }
        })
}, false);

// COMPANY FORM

submit_form_company.addEventListener('click', function () {
    if (!formCompany.checkValidity()) {
        formCompany.querySelector('#anmeldung-geschaftlich-btn').click();
    }
}, false);

formCompany.addEventListener('submit', function (e) {
    e.preventDefault();

    var form_validated = jQuery('#anmeldung-geschaftlich');
    var submit_form = jQuery('anmeldung-geschaftlich-btn');

    jQuery.ajax({
            type    : 'post',
            url     : schnell_vars.ajaxurl,
            data: {
                action : 'schnell_send_form',
                values : form_validated.serialize()
            },
            beforeSend : function(){
                submit_form.find('i').remove();
                btn_text = submit_form.html();
                submit_form.html( btn_text + ' <i class="fa fa-circle-o-notch fa-spin"></i>' );

            },
            success    : function( response ){
                submit_form
                    .find('i')
                    .remove();
                form_validated
                    .trigger('reset');
                console.log( response );
            },
            error      : function( response ){
                submit_form
                    .find('i')
                    .removeClass('fa-circle-o-notch')
                    .removeClass('fa-spin')
                    .addClass('fa-exclamation-triangle');
                console.log( response );
            }
        })
}, false);
