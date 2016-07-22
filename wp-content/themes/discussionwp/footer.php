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
closeOnBgClick :false
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
closeOnBgClick :false
});


    jQuery(document).on('click', '#myevergreen',  function() {        
            if (jQuery("#findavillage").val() == "") {
                return false;
            } else {                                                      
                window.open(jQuery("#findavillage").val(),"_self");
                jQuery('.f-newsletter').magnificPopup('close');
                
                    
            }
    });
</script>

<input type="hidden" id="accountvalid" value="test"/>
<input type="hidden" name="user_primary_site" id="user_primary_site" value="<?php echo other_user_profile_redirection(); ?>">                                                                    

<div id="site_user_validation_popup">    
    <div id="site_user_validation_popup_content">
        <img id="site_user_validation_popup_close" width="22px" src="https://cdn1.iconfinder.com/data/icons/random-crafticons/48/misc-_close_-32.png" />
        <div id="site_user_validation_popup_message"></div>
    </div>
</div>

<style>
    #site_user_validation_popup{display:none;position:fixed;left:0;top:0;height:100%;width:100%;background-color:rgba(0,0,0,0.5);z-index:9999;}
    #site_user_validation_popup_close{cursor:pointer;left: 98%;position: relative;top: -14px;}
    #site_user_validation_popup_content{background-color:#ffffff;position:absolute;width:300px;height:100px;margin-left:35%;top:40%;padding:20px}
    #site_user_validation_popup_message{text-align:center;}
</style>

