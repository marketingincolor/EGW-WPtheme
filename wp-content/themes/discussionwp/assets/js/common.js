/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

jQuery(document).ready(function ()
{
    jQuery('form .submit_button').on('click', function (e) {

        jQuery.ajax({
            type: 'POST',
            url: resetpassword_ajaxurl,
            data: {
                'action': 'ajax_forgotPassword',
                'user_email': jQuery('#user_email').val(),
                'security': jQuery('#fp-ajax-nonce').val(),
            },
            success: function (data) {
                jQuery('.status').html(data);
            }
        });
        e.preventDefault();
    });

    //Login Form Validation
    if(jQuery('#fspr_login_form').length){
        jQuery('#fspr_login_form').validate();
    }
    
    //Registration Form Validation
    jQuery('#fsForm2394143').submit(function (e) {
        var firstname=jQuery('#field43284834-first').val();
        var lastname=jQuery('#field43284834-last').val();
        var email=jQuery('#field43284833').val();
        var zipcode=jQuery('#field43284990').val();
        var age= jQuery('#field43284944').val();
        
        if(jQuery('.fspr_register_error').length)
            jQuery('.fspr_register_error').remove();
        
        //FirstName field validation
        if(firstname==""){            
            jQuery('.fsNameFirst').append( '<label class="fspr_register_error">This field is required.</label>' );
        }else if(firstname.length>20){
            jQuery('.fsNameFirst').append( '<label class="fspr_register_error">First name cannot be more than 20 characters</label>' );
        }else if(/[^a-zA-Z0-9\-]/.test( firstname )){
            jQuery('.fsNameFirst').append( '<label class="fspr_register_error">First name can only contain alphanumeric characters and hyphens(-)</label>' );
        }
            
        //LastName field validation
        if(lastname==""){
            jQuery('.fsNameLast').append( '<label class="fspr_register_error">This field is required.</label>' );
        }else if(lastname.length>20){
            jQuery('.fsNameLast').append( '<label class="fspr_register_error">Last name cannot be more than 20 characters</label>' );
        }else if(/[^a-zA-Z0-9\-]/.test( lastname )){
            jQuery('.fsNameLast').append( '<label class="fspr_register_error">Last name can only contain alphanumeric characters and hyphens(-)</label>' );
        }
        
        //Email Validation
        if(email==""){
            jQuery('#fsCell43284833').append( '<label class="fspr_register_error">This field is required.</label>' );
        }else {
            var pattern = new RegExp(/^[+a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i);
            if(!pattern.test(email)){
                jQuery('#fsCell43284833').append( '<label class="fspr_register_error">This must be a valid email address</label>' );
            }
        }
        
        //Zip Code validation
        if(zipcode==""){
            jQuery('#fsCell43284990').append( '<label class="fspr_register_error">This field is required.</label>' );            
        }else{
            US_postalCodeRegex = new RegExp(/^([0-9]{5})(?:[-\s]*([0-9]{4}))?$/);
            if(!US_postalCodeRegex.test(zipcode)){
              CA_postalCodeRegex = new RegExp(/^([A-Z][0-9][A-Z])\s*([0-9][A-Z][0-9])$/); 
              if(!CA_postalCodeRegex.test(zipcode)){
                  jQuery('#fsCell43284990').append( '<label class="fspr_register_error">This must be a valid zipcode.</label>' );
              }
            }
        }   
        
        //Age validation
        if(age=="")
            jQuery('#fsCell43284944').append( '<label class="fspr_register_error">This field is required.</label>' );
        
        if(jQuery('.fspr_register_error').length)
            e.preventDefault();
                        
    });
        
    //Comment Form Validation    
    jQuery('#commentform').submit(function (e) {
       
        
        if(jQuery('.fspr_comment_error').length)
            jQuery('.fspr_comment_error').remove();
        
        //Name field validation
        if(jQuery('#commentform #author').length){
            var name=jQuery('#commentform #author').val();
            if(name==""){            
                jQuery('<label class="fspr_comment_error">This field is required.</label>').insertAfter( '#commentform #author' );
            }else if(name.length>40){
                jQuery('<label class="fspr_comment_error">Name cannot be more than 40 characters.</label>').insertAfter( '#commentform #author' );
            }else if(/[^a-zA-Z0-9\-]/.test( name )){
                jQuery('<label class="fspr_comment_error">Name can only contain alphanumeric characters and hyphens(-).</label>').insertAfter('#commentform #author');
            }
        }
        
        //Email field validation
        if(jQuery('#commentform #email').length){
            var email=jQuery('#commentform #email').val();
            
            if(email==""){
                jQuery('<label class="fspr_comment_error">This field is required.</label>').insertAfter( '#commentform #email' );                
            }else {
                var pattern = new RegExp(/^[+a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i);
                if(!pattern.test(email)){
                    jQuery('<label class="fspr_comment_error">This must be a valid email address.</label>').insertAfter( '#commentform #email' );
                }
            }
            
        }
        
        //Comment field validation
        var comment=jQuery('#commentform #comment').val();
        if(comment==""){
            jQuery('<label class="fspr_comment_error">This field is required.</label>').insertAfter( '#commentform #comment' );
        }
        
                        
        if(jQuery('.fspr_comment_error').length)
            e.preventDefault();
    });
        


});



