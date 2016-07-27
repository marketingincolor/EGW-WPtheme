<?php
discussion_get_footer();
?>
<script>
    jQuery('li.welcome-my-pop a').magnificPopup({
         callbacks: {
          ajaxContentAdded: function() {
          var blog_id = jQuery('#current-blog').text();
          jQuery("#findavillage option[id='" + blog_id + "']").remove();
          }
     },
     type: 'ajax',
        ajax: {
            settings: null, // Ajax settings object that will extend default one - http://api.jquery.com/jQuery.ajax/#jQuery-ajax-settings
            // For example:
            // settings: {cache:false, async:false}
            cursor: 'mfp-ajax-cur', // CSS class that will be added to body during the loading (adds "progress" cursor)
            tError: '<a href="%url%">The content</a> could not be loaded.' //  Error message, can contain %curr% and %total% tags if gallery is enabled
        },
        closeOnBgClick: false
    });
</script>

<script>
    jQuery('.f-newsletter').magnificPopup({
        type: 'ajax',
        ajax: {
            settings: null, // Ajax settings object that will extend default one - http://api.jquery.com/jQuery.ajax/#jQuery-ajax-settings
            // For example:
            // settings: {cache:false, async:false}

            cursor: 'mfp-ajax-cur', // CSS class that will be added to body during the loading (adds "progress" cursor)
            tError: '<a href="%url%">The content</a> could not be loaded.' //  Error message, can contain %curr% and %total% tags if gallery is enabled
        },
        closeOnBgClick: false
    });


    jQuery(document).on('click', '#myevergreen', function () {
        if (jQuery("#findavillage").val() == "") {
            return false;
        } else {
            window.open(jQuery("#findavillage").val(), "_self");
            jQuery('.f-newsletter').magnificPopup('close');


        }
    });
</script>

<input type="hidden" id="accountvalid" value="test"/>
<input type="hidden" name="user_primary_site" id="user_primary_site" value="<?php echo other_user_profile_redirection(); ?>">
<input type="hidden" name="is_user_login" id="is_user_login" value="<?php echo is_user_logged_in(); ?>" >

<div class="white-popup-block user-session-block mfp-hide" id="site_user_validation_popup">
    <div class="find-a-branch-container">        
        <div class="fs-custom-select-container fs-custom-session-container">
            <div class="egw-homesite egw-homesite-session-popup" id="site_user_validation_popup_message">                
            </div>
            <div class="fs-custom-select">                
            </div>
        </div>        
    </div>
</div>


