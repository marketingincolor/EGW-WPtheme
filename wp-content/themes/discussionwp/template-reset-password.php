<?php
/*
Template Name: reset_password
Author - Vinoth Raja
Date  - 27-06-2016
Purpose - For reset password functionality
*/ 
?>

<?php get_header(); ?>

<script type="text/javascript">
    var admin_ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
</script>

<div class="login-container">
    <h3 class="fspr_header">Reset Password</h3>
    <div class="status"></div>
    <form id="fspr_login_form"  class="fspr_form"action="" method="post">
        <fieldset>
            <ul>
                <li>
                    <label for="fspr_user_Login">Username</label>
                    <input id="user_email" type="text" class="required" name="user_email">
                </li>
            </ul>
            <p>
                <input type="hidden" name="fp-ajax-nonce" id="fp-ajax-nonce" value="<?php echo wp_create_nonce('fp-ajax-nonce'); ?>"/>
                <input id="fspr_login_submit" name="fspr_login_submit" type="button" value="Reset Password" class="fsplogin_btn submit_button" />
            </p>

        </fieldset>
    </form>
</div>

<?php get_footer(); ?>