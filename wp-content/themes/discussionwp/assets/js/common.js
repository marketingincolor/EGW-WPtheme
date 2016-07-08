/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

 //Forgot Password 
jQuery(document).ready(function ()
{
    jQuery('form .submit_button').on('click', function (e) {

        jQuery.ajax({
            type: 'POST',
            url: admin_ajaxurl,
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
    
    //Formstack Registration
    formstack_registration();

    //Login Form Validation
    if(jQuery('#fspr_login_form').length){
        jQuery('#fspr_login_form').validate();
    }
        
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


//Comment cancelation link

    jQuery('#cancel-comment-reply-link').on('click', function () 
    {
        jQuery('#comment').val("");
    });
