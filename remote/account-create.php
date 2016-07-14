<?php
/*
  Functionality : Create account based on Formstack.com Registeration form
 * Author: Ramkumar.S
 * Date: June 25,2016
 * Updated : July 2, 2016
 */

//Removed functionality for theme account create setup
  exit();

// define some vars
require_once '../wp-config.php';
if (defined('ABSPATH'))
    $abspath = ABSPATH;
else
    $abspath = '/var/www/dev.myevergreenwellness.com';

/*
 * define the role of the new user here
 * @see http://codex.wordpress.org/Roles_and_Capabilities
 */
$role = 'subscriber';
$form_email = 'Email';
/*
 * fetch post data
 */
$user_email = ( isset($_POST[$form_email]) && !empty($_POST[$form_email]) ) ? $_POST[$form_email] : '';
$branch0 = ( isset($_POST['BranchVillages']) && !empty($_POST['BranchVillages']) ) ? $_POST['BranchVillages'] : '';
$branch1 = ( isset($_POST['BranchOther']) && !empty($_POST['BranchOther']) ) ? $_POST['BranchOther'] : '';
// TODO: Add additional branches above as required by site
$branchn = ( isset($_POST['BranchNone']) && !empty($_POST['BranchNone']) ) ? $_POST['BranchNone'] : '';

if (!empty($branch0)) {
    $branch = $branch0;
} elseif (!empty($branch1)) {
    $branch = $branch1;
} elseif (!empty($branchn)) {
    $branch = 'None';
}

// no email, or Branch, no registration!
if (empty($user_email) || $branch == 'None') {
// TODO: More error handling like an email to yourself or something else
    exit();
}
if (!is_email($user_email)) {
    echo '<div class="error notice"><p>Email is not valid. Please try again ! - Redirecting in 2 sec</p></div>';
    header('Refresh: 2;url= /register');
    exit();
}
//if (email_exists($user_email)) {
//    echo '<dirname(path)                                                                                                                                                      v class="error notice"><p>Email Already in use. Please try again ! - Redirecting in 2 sec</p></div>';
//    header('Refresh: 2;url= /register');
//    exit();
//}

// needed to prevent wordpress to load the complete environment. we need only a basic wordpress
define('SHORTINIT', TRUE);

// include the needed files which are excluded by SHORTINIT
require_once $abspath . '/wp-load.php';
require_once $abspath . '/wp-includes/user.php';
require_once $abspath . '/wp-includes/pluggable.php';
require_once $abspath . '/wp-includes/formatting.php';
require_once $abspath . '/wp-includes/capabilities.php';
require_once $abspath . '/wp-includes/kses.php';
require_once $abspath . '/wp-includes/meta.php';
require_once $abspath . '/wp-includes/l10n.php';

// create a random password
$random_password = wp_generate_password($length = 12, $include_standard_special_chars = false);

/*
 * setup the registration data
 * here we use the user email as login name!
 * the minimum of data is user_pass (password) and user_login (login name)
 *
 * @see http://codex.wordpress.org/Function_Reference/wp_insert_user
 */

//Extract Email from user email
//$user_email = 'ram1489@gmail.com';

$username = strstr($user_email, '@', true) . rand(1, 1000); //"username"

$data = array(
    'user_pass' => $random_password,
    'user_login' => $user_email,
    'user_email' => $user_email,
    'user_nicename'=>$username,
    'display_name'=>$username,
    'role' => $role // optional but useful if you create a special role for remote registered users
);

$new_user = wp_insert_user($data);

$login_page = home_url('/login');
$register_page = home_url('/register');


// optional email component
if (!is_wp_error($new_user)) {

    $subject = "Evergreen Wellness remote registration";
    $message = "Hi there! \n You have successfully registered to the site. Your login name is {$user_email} and your password is {$random_password}\nPlease change your password immediately!\n\nTesting content\n"
            . "<a href='$login_page'>Click Here </a> to login\n";
    foreach($_POST as $key => $val){
        $message .= 'key=> '.$key;
        $message .= '\n';
        $message .= 'val=> '.$val;
    }
    $sender = 'From: Admin <ramfsp@gmail.com>' . "\r\n";
    $headers[] = 'MIME-Version: 1.0' . "\r\n";
    $headers[] = 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    $headers[] = "X-Mailer: PHP \r\n";
    $headers[] = $sender;

    // @see http://codex.wordpress.org/Function_Reference/wp_mail
    $success = wp_mail($user_email, $subject, $message, $headers, $attachments);

    // maybe you want to be informed if the registration was successfull
    if (true == $success) {
        wp_mail('ramfsp@gmail.com', 'Evergreen Wellness remote registration', "User {$user_email} was registered on " . date('d.m. Y H:i:s', time()));
    }
} else {
    echo '<div class="error notice"><p>There has been an error while register. Please try again ! - Redirecting in 2 sec</p></div>';
    wp_mail('ramfsp@gmail.com', 'Evergreen Wellness remote registration Failed', "User {$user_email} was registered Failed on " . date('d.m. Y H:i:s', time()));
    header('Refresh: 2;url= /register');
    exit();
}
