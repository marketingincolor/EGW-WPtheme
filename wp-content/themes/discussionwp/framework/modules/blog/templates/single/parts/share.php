<?php

//Is social share enabled
$enable_social_share = (discussion_options()->getOptionValue('enable_social_share') == 'yes') ? true : false;

//Is social share enabled for post
$enabled_on_post = (discussion_options()->getOptionValue('enable_social_share_on_post') == 'yes') ? true : false;

//Is social share enabled for blog single
$enabled_on_post_single = (discussion_options()->getOptionValue('blog_single_share') == 'yes') ? true : false;

$enabled_social = $enable_social_share && $enabled_on_post && $enabled_on_post_single;

if ($enabled_social){

?>

<div class ="mkd-blog-single-share">
<span class="mkd-single-share-title"><?php esc_html_e('Share With:', 'discussionwp'); ?></span>
<?php echo discussion_get_social_share_html(array('type'=>'list')); ?>
</div>

<?php } ?>