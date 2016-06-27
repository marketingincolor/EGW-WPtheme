/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
      jQuery(document).ready(function() 
       {
	jQuery('form .submit_button').on('click', function(e){

		jQuery.ajax({
			type: 'POST',
                        url: resetpassword_ajaxurl,
			data: { 
				'action': 'ajax_forgotPassword', 
				'user_email': jQuery('#user_email').val(), 
				'security': jQuery( '#fp-ajax-nonce' ).val(), 
			},
			success: function(data){						
                               jQuery('.status').html(data);
			}
		});
		e.preventDefault();
	});
    });

