<?php
discussion_get_footer();
?>
<script>
    jQuery('li.welcome-my-pop a').magnificPopup({
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


