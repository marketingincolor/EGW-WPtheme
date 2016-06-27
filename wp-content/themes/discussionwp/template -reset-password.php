<?php
/*
Template Name: reset_password
Author - Vinoth Raja
Date  - 27-06-2016
Purpose - For reset password functionality
*/ 
?>

<?php get_header(); ?>
<?php
  echo '<input type="hidden" name="fp-ajax-nonce" id="fp-ajax-nonce" value="' . wp_create_nonce( 'fp-ajax-nonce' ) . '" />';
?>
<script type="text/javascript">
    var resetpassword_ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
</script>


<form id="forgot_password" class="ajax-auth" method="post">    
    <h1>Reset Password</h1>
    <p class="status"></p>  
    <label for="user_email">E-mail</label>
    <input id="user_email" type="text" class="required" name="user_email">
    <input class="submit_button" type="button" value="Reset Password">
</form>

<?php get_footer(); ?>