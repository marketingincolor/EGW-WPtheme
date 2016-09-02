/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//Forgot Password 
jQuery(document).ready(function ()
{
    updateClassforTrendingNews();
    resetpassword();
    clearCommentText();
    loginFormValidation();
    //registrationFormValidation();
    commentFormValidation();
    userProfileUpload();
    userProfileFormValidation();
    saveArticleSessionValidation();
    postRatingSessionValidation();    

});

function resetpassword() {

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
                jQuery('#user_email').val("");
            }
        });
        e.preventDefault();
    });
}
/**
 * Modifier - Akilan
 * Date - 11-07-2016 
 * Purpose - For clearing comment text when clicking cancel reply text and reply text.
 */
//clear comment textarea content in comment form
function clearCommentText() {
    jQuery('#cancel-comment-reply-link,.comment-reply-link ').on('click', function () {
        jQuery('#comment').val("");
    }); 
}

//Login Form Validation
function loginFormValidation() {
    
    jQuery('#fspr_login_submit').click(function(){
        if(jQuery('.fspr_errors').length){
            jQuery('.fspr_errors').remove();
        }        
    });
    if (jQuery('#fspr_login_form').length) {
        jQuery('#fspr_login_form').validate();
    }
}

//Registration Form Validation
//function registrationFormValidation() {
//    jQuery('#fsForm2394143').on('submit', function (e) {
//        var firstname = jQuery('#field44058772').val();
//        var lastname = jQuery('#field44058847').val();
//        var email = jQuery('#field43284833').val();
//        var zipcode = jQuery('#field43284990').val();
//        var age = jQuery('#field43284944').val();
//        if (jQuery('.fspr_register_error').length)
//            jQuery('.fspr_register_error').remove();
//        firstNameValidation(firstname, '#field44058772', 'fspr_register_error');
//        lastNameValidation(lastname, '#field44058847', 'fspr_register_error');
//        emailValidation(email, '#field43284833', 'fspr_register_error');
//        zipcodeValidation(zipcode, '#field43284990', 'fspr_register_error');
//        ageValidation(age, '#field43284944', 'fspr_register_error');
//        if (jQuery('.fspr_register_error').length) {
//            e.preventDefault();
//        }
//        else {
//            var data = {
//                action: 'register_user',
//                userfname: firstname,
//                userlname: lastname,
//                userzipcode: zipcode,
//                userage: age,
//                Email: email,
//            };
//            var homeurl = jQuery('.mkd-logo-area .mkd-logo-wrapper a').attr('href');
//            //var ajaxurl = homeurl + "account-create";
//            var ajaxurl = "http://192.168.1.154/evergreen/remote/account-create.php";
//            jQuery.ajax({
//                type: "POST",
//                url: ajaxurl,
//                data: data,
//                cache: false,
//                async: false,
//                success: function (successvalue) {
//                    console.log(successvalue);
//                    if (jQuery.trim(successvalue) == 'success') {
//                        jQuery('#accountvalid').val('valid');
//                    } else {
//                        jQuery('.register_error').html(successvalue);
//                        jQuery('.register_error').fadeIn();
//                    }
//                },
//                error: function (successvalue) {
//                    alert('Error occurs Please try again.');
//                }
//            });
//            console.log(jQuery('#accountvalid').val());
//            if ((jQuery('#accountvalid').val()) != 'valid') {
//                e.preventDefault();
//                console.log('not valid');
//            }
//            else {
//                console.log('valid and form submitted');
//                // e.preventDefault();
//            }
//        }
//    });
//}

function commentFormValidation() {
//Comment Form Validation    
    jQuery('#commentform').submit(function (e) {

        if (jQuery('.fspr_comment_error').length)
            jQuery('.fspr_comment_error').remove();
        //Name field validation
        if (jQuery('#commentform #author').length) {
            var name = jQuery('#commentform #author').val();
            fullnameValidation(name, '#commentform #author', 'fspr_comment_error');
        }

//Email field validation
        if (jQuery('#commentform #email').length) {
            var email = jQuery('#commentform #email').val();
            emailValidation(email, '#commentform #email', 'fspr_comment_error');
        }

//Comment field validation
        var comment = jQuery('#commentform #comment').val();
        if (comment == "") {
            jQuery('<label class="fspr_comment_error">This field is required.</label>').insertAfter('#commentform #comment');
        }

        if (jQuery('.fspr_comment_error').length)
            e.preventDefault();
    });
}

function userProfileUpload() {

//User profile image upload        
    jQuery("#upload").click(function () {
        jQuery("#userProfileImage").click();
    })


    jQuery('#userProfileImage').change(function () {
        userProfilePreview(this);
        if (jQuery('.fspr_user_profile_upload_error').length)
            jQuery('.fspr_user_profile_upload_error').remove();
        var filename = jQuery('#userProfileImage').val().toLowerCase();
        var regex = new RegExp("(.*?)\.(jpg|jpeg|png)$");
        if (!(regex.test(filename))) {
            jQuery(this).val('');
            jQuery('<label class="fspr_user_profile_upload_error">sorry,uploaded file is invalid, allowed extensions are: jpg, jpeg and png</label>').insertAfter('.aavthar #upload');
        } else {
            jQuery('#user-profile-avatar').html('Profile Picture Added !').css('color', 'green');
        }
    });
}

//User profile image preview

function userProfilePreview(imgData){
	if (imgData.files && imgData.files[0]) {
        var readerObj = new FileReader();
        
        readerObj.onload = function (element) {
            jQuery('#image_upload_preview').attr('src', element.target.result);
        }
        
        readerObj.readAsDataURL(imgData.files[0]);
    }
}

//User profile form validation
function userProfileFormValidation() {
    jQuery('#user-profile-form').submit(function (e) {
        var firstname = jQuery('#first_name').val();
        var lastname = jQuery('#last_name').val();
        var email = jQuery('#email').val();
        var password = jQuery('#pass1').val();
        var confirm_password = jQuery('#pass2').val();
        var city = jQuery('#city').val();
        var state = jQuery('#state').val();
        var zipcode = jQuery('#postalcode').val();
        var address = jQuery('#address').val();
        if (jQuery('.fspr_user_profile_error').length)
            jQuery('.fspr_user_profile_error').remove();
        firstNameValidation(firstname, '#first_name', 'fspr_user_profile_error');
        lastNameValidation(lastname, '#last_name', 'fspr_user_profile_error');
        emailValidation(email, '#email', 'fspr_user_profile_error');
        cityNameValidation(city, '#city', 'fspr_user_profile_error');
        stateNameValidation(state, '#state', 'fspr_user_profile_error');
        zipcodeValidation(zipcode, '#postalcode', 'fspr_user_profile_error');
        passwordValidation(password, '#pass1', 'fspr_user_profile_error');
        confirmPasswordValidation(password, confirm_password, '#pass2', 'fspr_user_profile_error');
        if (jQuery('.fspr_user_profile_error').length || jQuery('.fspr_user_profile_upload_error').length)
            e.preventDefault();
    });
}


function fullnameValidation(firstname, current_element, error_element) {
    if (firstname === "") {
        jQuery('<label class="' + error_element + '">This field is required.</label>').insertAfter(current_element);
    } else if (firstname.length > 40) {
        jQuery('<label class="' + error_element + '">Name cannot be more than 20 characters.</label>').insertAfter(current_element);
    } else if (/[^a-zA-Z0-9\s\-]/.test(firstname)) {
        jQuery('<label class="' + error_element + '">Name can only contain alphanumeric characters and hyphens(-).</label>').insertAfter(current_element);
    }
}

function firstNameValidation(firstname, current_element, error_element) {
    if (firstname === "") {
        jQuery('<label class="' + error_element + '">This field is required.</label>').insertAfter(current_element);
    } else if (firstname.length > 20) {
        jQuery('<label class="' + error_element + '">First name cannot be more than 20 characters.</label>').insertAfter(current_element);
    } else if (/[^a-zA-Z0-9\s\-]/.test(firstname)) {
        jQuery('<label class="' + error_element + '">First name can only contain alphanumeric characters and hyphens(-).</label>').insertAfter(current_element);
    }
}

function lastNameValidation(lastname, current_element, error_element) {
    if (lastname === "") {
        jQuery('<label class="' + error_element + '">This field is required.</label>').insertAfter(current_element);
    } else if (lastname.length > 20) {
        jQuery('<label class="' + error_element + '">Last name cannot be more than 20 characters.</label>').insertAfter(current_element);
    } else if (/[^a-zA-Z0-9\s\-]/.test(lastname)) {
        jQuery('<label class="' + error_element + '">Last name can only contain alphanumeric characters and hyphens(-).</label>').insertAfter(current_element);
    }
}

function emailValidation(email, current_element, error_element) {
    if (email == "") {
        jQuery('<label class="' + error_element + '">This field is required.</label>').insertAfter(current_element);
    } else {
        var pattern = new RegExp(/^[+a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i);
        if (!pattern.test(email)) {
            jQuery('<label class="' + error_element + '">This must be a valid email address.</label>').insertAfter(current_element);
        }
    }
}

function cityNameValidation(city, current_element, error_element) {

    if (city === "") {
        jQuery('<label class="' + error_element + '">This field is required.</label>').insertAfter(current_element);
    } else if (/[^a-zA-Z0-9\s\-]/.test(city)) {
        jQuery('<label class="' + error_element + '">City can only contain alphanumeric characters and hyphens(-).</label>').insertAfter(current_element);
    }
}

function stateNameValidation(state, current_element, error_element) {

    if (state === "") {
        jQuery('<label class="' + error_element + '">This field is required.</label>').insertAfter(current_element);
    } else if (/[^a-zA-Z0-9\s\-]/.test(state)) {
        jQuery('<label class="' + error_element + '">State can only contain alphanumeric characters and hyphens(-).</label>').insertAfter(current_element);
    }
}


function zipcodeValidation(zipcode, current_element, error_element) {

    if (zipcode == "") {
        jQuery('<label class="' + error_element + '">This field is required.</label>').insertAfter(current_element);
    } else {
        US_postalCodeRegex = new RegExp(/^([0-9]{5})(?:[-\s]*([0-9]{4}))?$/);
        if (!US_postalCodeRegex.test(zipcode)) {
            CA_postalCodeRegex = new RegExp(/^([A-Z][0-9][A-Z])\s*([0-9][A-Z][0-9])$/);
            if (!CA_postalCodeRegex.test(zipcode)) {
                jQuery('<label class="' + error_element + '">This must be a valid zipcode.</label>').insertAfter(current_element);
            }
        }
    }
}

function passwordValidation(password, current_element, error_element) {

    if (password) {
        passwordExp = new RegExp(/^(?=.*\d)(?=.*[a-zA-Z])[0-9a-zA-Z!@#\$%\^&\*\(\)\+=\|;'"{}<>\.\?\-_\\/:,~`]{8,}$/);
        if (!passwordExp.test(password)) {
            jQuery('<label class="' + error_element + '">Password should contains minimum 8 characters length,one character(A to Z or a to z) and one number(0-9).</label>').insertAfter(current_element);
        }
    }
}

function confirmPasswordValidation(password1, password2, current_element, error_element) {
    if (password1 !== password2) {
        jQuery('<label class="' + error_element + '">Passwords should be match.</label>').insertAfter(current_element);
    }
}

function ageValidation(age, current_element, error_element) {
    if (age === "") {
        jQuery('<label class="' + error_element + '">This field is required.</label>').insertAfter(current_element);
    } else if (age < 1 || age > 100) {
        jQuery('<label class="' + error_element + '">Age must be a number between 1 and 100.</label>').insertAfter(current_element);
    }

}

function saveArticleSessionValidation(){
        
    if (jQuery(".wpfp-link").length) {
        jQuery(".wpfp-link").attr('id', 'wpfp-link');
        jQuery('#wpfp-link').removeClass('wpfp-link'); 

        jQuery('#wpfp-link').live('click', function() {

         var user_primary_site=jQuery.trim(jQuery('#user_primary_site').val());
         if(user_primary_site && user_primary_site!== '0'){
             jQuery('#site_user_validation_popup_message').text('Only members of this branch can save or remove articles');
             jQuery.magnificPopup.open({
                items: {
                    src: '#site_user_validation_popup',
                },
                type: 'inline'
            });             
             return false;
         }

         dhis = jQuery(this);
         wpfp_do_js( dhis, 1 );
         // for favorite post listing page
         if (dhis.hasClass('remove-parent')) {
             dhis.parent("li").fadeOut();
         }
         return false;
        });              
    }
}
    
function postRatingSessionValidation(){
    if(jQuery(".post-ratings").length){
        jQuery(".post-ratings img").attr('onkeypress','DiscussionRatePost();')
                . attr('onclick','DiscussionRatePost();');
    }
}
    
function DiscussionRatePost(){
    
    var message="";
    var is_user_login = jQuery.trim(jQuery('#is_user_login').val());
    var user_primary_site=jQuery.trim(jQuery('#user_primary_site').val());
    if(!is_user_login){
        message="You need to be a registered member to rate this Article.";
    }else if(user_primary_site && user_primary_site!== '0'){
        message="Only members of this branch can give ratings to the post.";        
    }
    if(message){
        jQuery('#site_user_validation_popup_message').text(message);
        jQuery.magnificPopup.open({
                items: {
                    src: '#site_user_validation_popup',
                },
                type: 'inline'
            });
        return false;
    }
    rate_post(); // Plugin default functionality
}

function updateClassforTrendingNews(){
    
    if(jQuery(".mkd-content-top-holder > .mkd-grid > .mkd-bn-holder").length){        
        jQuery(".mkd-content-top-holder > .mkd-grid > .mkd-bn-holder").addClass('trending-news-blk');
    }
}