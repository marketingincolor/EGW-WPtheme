<?php
discussion_get_footer();
?>
<script>
    jQuery('li.welcome-my-pop a').magnificPopup({
        callbacks: {
            ajaxContentAdded: function () {
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

    // Email form validation
    function validate_popupform() {
        var valreturn = 0;
        var emailRegex = /^[A-Za-z0-9._]*\@[A-Za-z]*\.[A-Za-z]{2,5}$/;
        var emailaddress = document.selectedArticleform.emailaddress.value,
                comments = document.selectedArticleform.comments.value;
        document.getElementById("errorBox-email").innerHTML = " ";
        document.getElementById("errorBox-comments").innerHTML = " ";
        if (emailaddress == "")
        {
            document.selectedArticleform.emailaddress.focus();
            document.getElementById("errorBox-email").innerHTML = "Enter the email address";
            return false;
        } else {
            //this validates all the emails that are seperated by a comma
            var emailArray = emailaddress.split(",");
            for (i = 0; i <= (emailArray.length - 1); i++) {
                if (checkEmail(emailArray[i])) {
                    //Do what ever with the email.
                } else {
                    document.getElementById("errorBox-email").innerHTML = "invalid email: " + emailArray[i];
                    return false;
                }
            }

        }
        if (comments == "")
        {
            document.selectedArticleform.emailaddress.focus();
            document.getElementById("errorBox-comments").innerHTML = "Required Value";
            return false;
        }
        return true;
    }
    //this validates all the emails that are seperated by a comma
    function checkEmail(email) {
        var regExp = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9\-\.])+\.([A-Za-z]{2,4})$/;
        return regExp.test(email);
    }
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
    //pop email - cancel button
    jQuery(document).on('click', '.fsp_cancel_btn_pop', function () {
        jQuery.magnificPopup.close();
        jQuery("#savedArticles").trigger('reset');
        return false;
    });
    //pop email - close button
    jQuery(document).on('click', '.mfp-close', function () {
        jQuery.magnificPopup.close();
        //location.reload();
        jQuery("#savedArticles").trigger('reset');
        return false;
    });
    //pop email - send button
    jQuery('#successmsg').hide();
    jQuery(document).on('click', '#emailsend', function () {
        var isValidated = validate_popupform();

        if (isValidated == true) {
            var name = jQuery("#enquiryForm").val();
            var dataString = jQuery('#enquiryForm').serialize();


            jQuery.ajax({
                type: "POST",
                url: "<?php echo bloginfo('wpurl'); ?>/wp-admin/admin-ajax.php",
                data: {
                    action: 'saved_articles_popup_email',
                    emaildata: dataString,
                },
                success: function (result) {
                    jQuery('.form-group').hide();
                    jQuery('#successmsg').show();
                    jQuery('#successmsg>h3').html(result);
                }
            });


        }
        return false;
    });
    //pop email - selected article close button
    jQuery(document).on('click', '.ion-android-close', function () {
        var x;
        if (confirm("Do you want to remove this article?") == true) {
            jQuery('#element_' + this.id).remove();
        } else {

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

<!--<script type="text/javascript">
adroll_adv_id = "ZYDTNLNKUFFZ5LUNLQPX6K";
adroll_pix_id = "EDOUBMWD4FAZLDGFKPAZIA";
/* OPTIONAL: provide email to improve user identification */
/* adroll_email = "username@example.com"; */
(function () {
var _onload = function(){
if (document.readyState && !/loaded|complete/.test(document.readyState)){setTimeout(_onload, 10);return}
if (!window.__adroll_loaded){__adroll_loaded=true;setTimeout(_onload, 50);return}
var scr = document.createElement("script");
var host = (("https:" == document.location.protocol) ? "https://s.adroll.com" : "http://a.adroll.com");
scr.setAttribute('async', 'true');
scr.type = "text/javascript";
scr.src = host + "/j/roundtrip.js";
((document.getElementsByTagName('head') || [null])[0] ||
document.getElementsByTagName('script')[0].parentNode).appendChild(scr);
};
if (window.addEventListener) {window.addEventListener('load', _onload, false);}
else {window.attachEvent('onload', _onload)}
}());
</script>-->

<script>
//    jQuery(document).ready(function () {
//        jQuery('#openEnquiryForm').magnificPopup({
//            type: 'ajax',
//            data: { name:jQuery(this).data()},
//            ajax: {
//                settings: null, // Ajax settings object that will extend default one - http://api.jquery.com/jQuery.ajax/#jQuery-ajax-settings
//                // For example:
//                // settings: {cache:false, async:false}
//
//                cursor: 'mfp-ajax-cur', // CSS class that will be added to body during the loading (adds "progress" cursor)
//                tError: '<a href="%url%">The content</a> could not be loaded.' //  Error message, can contain %curr% and %total% tags if gallery is enabled
//            },
//            closeOnBgClick: false
//        });
//    });
//    
//    jQuery(document).ready(function () {
//        jQuery('#openEnquiryForm').click(function () {
////            console.log(jQuery('#savedArticles').serialize());
////            jQuery.ajax({
////                type: "POST",
////                url: 'http://192.168.1.154/evergreen/wp-content/themes/village-child/saved-article-email-trigger.php',
////                data: jQuery('#savedArticles').serialize(),
////                success: function (data) {
////                    console.log(data);
////                    jQuery.magnificPopup.open({
////                        type: 'ajax',
////                        items: {
////                            src: data
////                        }
////                    })
////                }
////            });
//
//        var homeurl = "http://192.168.1.154/evergreen";
//        var ajaxurl = homeurl + "/wp-admin/admin-ajax.php";
//        var data = {
//                action: "get_selected_articles",
//                savedposts: jQuery('#savedArticles').serialize()
//            }
//
//        
//         jQuery.post(ajaxurl, data, function(response) {
//             console.log(response);
//            return false;
//        });
//    });
// });

    jQuery(document).ready(function () {
        jQuery('#openEnquiryForm').click(function () {
            //console.log(jQuery('#savedArticles').serialize());
            //validation

            var values = jQuery('input:checkbox:checked.save-article-checkbox').map(function () {
                return this.value;
            }).get(); // ["18", "55", "10"]

            if (values.length == 0) {
                alert('You must check at least one box!');
                return false; // The form will *not* submit
            } else { //alert(values.length);
                jQuery.ajax({
                    type: "POST",
                    url: "<?php echo bloginfo('wpurl'); ?>/wp-admin/admin-ajax.php",
                    data: {
                        action: 'saved_articles_load_popup',
                        offset: jQuery('#savedArticles').serialize(),
                    },
                    success: function (data) {
                        jQuery.magnificPopup.open({
                            type: 'inline',
                            items: {
                                src: data
                            },
                            closeOnBgClick: false,
                            callbacks: {
                                open: function () {
                                    jQuery(window).scroll(function () {
                                        return false;
                                    });
                                    jQuery('html, body').addClass('mfp-overflow');
                                    jQuery('#enquiryForm').find('.fsp-saved-articles-pop').getNiceScroll().show();
                                    jQuery('#enquiryForm').find('.fsp-saved-articles-pop').niceScroll({cursorcolor: "#e8882e", autohidemode: false});
                                    jQuery('#enquiryForm').find('.fsp-saved-articles-pop').getNiceScroll().hide();
                                },
                                close: function () {
                                    jQuery(window).unbind('scroll');
                                    jQuery('html, body').removeClass('mfp-overflow');
                                    jQuery('#enquiryForm').find('.fsp-saved-articles-pop').getNiceScroll().hide();
                                }
                            }
                        });
                    }
                });
            }
        });

        //cancel button 

    });


</script>