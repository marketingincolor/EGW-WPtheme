<div class="mkd-comment-holder clearfix" id="comments">
	<div class="mkd-comment-number">
		<?php comments_number(
			discussion_execute_shortcode('mkd_section_title', array('title' => esc_html__('Comments','discussionwp'))),
			discussion_execute_shortcode('mkd_section_title', array('title' => esc_html__('Comments','discussionwp'))),
			discussion_execute_shortcode('mkd_section_title', array('title' => esc_html__('Comments','discussionwp')))
			); ?>
	</div>
	<div class="mkd-comments">
<?php if ( post_password_required() ) : ?>
		<p class="mkd-no-password"><?php esc_html_e( 'This post is password protected. Enter the password to view any comments.', 'discussionwp' ); ?></p>
	</div>
</div>
<?php
		return;
	endif;
?>
<?php if ( have_comments() ) : ?>
	<ul class="mkd-comment-list">
		<?php wp_list_comments(array( 'callback' => 'custom_comment')); ?>
	</ul>
<?php // End Comments ?>

 <?php else : // this is displayed if there are no comments so far 

	if ( ! comments_open() ) :
?>
		<!-- If comments are open, but there are no comments. -->

	 
		<!-- If comments are closed. -->
		<p><?php esc_html_e('Sorry, the comment form is closed at this time.', 'discussionwp'); ?></p>

	<?php else : ?>
                <div style="margin-bottom:31px">No Comments</div>
            <?php endif; ?>
<?php endif; ?>
</div></div>

    
<?php 
if ( is_user_logged_in() ) :
    $userid=get_current_user_id();
    $user_blog_id=get_user_meta($userid,'primary_blog',true);
    $blog_id = get_current_blog_id();    
    if($user_blog_id!=1)
        $meta_data=get_user_meta($userid,'wp_'.$user_blog_id.'_capabilities',true);
    else 
        $meta_data=get_user_meta($userid,'wp_capabilities',true);
    $user_profile_url=admin_url( 'profile.php' );
    if(isset($meta_data['subscriber'])){
        $user_profile_url=home_url( '/user-profile' );
    }
endif;
?>

<?php
$commenter = wp_get_current_commenter();
$req = get_option( 'require_name_email' );
$aria_req = ( $req ? " aria-required='true'" : '' );

$args = array(
	'id_form' => 'commentform',
	'id_submit' => 'submit_comment',
	'title_reply'=> discussion_execute_shortcode('mkd_section_title', array('title' => esc_html__('Leave A Comment','discussionwp'))),
	'title_reply_to' => esc_html__( 'Post a Reply to %s','discussionwp' ),
	'cancel_reply_link' => esc_html__( 'Cancel Reply','discussionwp' ),
	'label_submit' => esc_html__( 'Post A Comment','discussionwp' ),
	'comment_field' => '<textarea id="comment" placeholder="'.esc_html__( 'Type Message:','discussionwp' ).'" name="comment" cols="45" rows="8" aria-required="true"></textarea>',
	'comment_notes_before' => '',
	'comment_notes_after' => '',
        'must_log_in' => '<p class="must-log-in">' .  sprintf( __( 'You must be <a href="%s">logged in</a> to post a comment.' ), home_url('/login') ) . '</p>',
        'logged_in_as' => '<p class="logged-in-as">' .sprintf(__( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>' ),$user_profile_url,$user_identity,wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) )) . '</p>',
	'fields' => apply_filters( 'comment_form_default_fields', array(
		'author' => '<div class="mkd-three-columns clearfix"><div class="mkd-three-columns-inner"><div class="mkd-column"><div class="mkd-column-inner"><input id="author" name="author" placeholder="'. esc_html__( 'Name:','discussionwp' ) .'" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '"' . $aria_req . ' /></div></div>',
		'url' => '<div class="mkd-column"><div class="mkd-column-inner"><input id="email" name="email" placeholder="'. esc_html__( 'E-mail:','discussionwp' ) .'" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '"' . $aria_req . ' /></div></div>',
		'email' => '<div class="mkd-column"><div class="mkd-column-inner"><input id="url" name="url" type="text" placeholder="'. esc_html__( 'Websites:','discussionwp' ) .'" value="' . esc_attr( $commenter['comment_author_url'] ) . '" /></div></div></div></div>'
		 ) ) 
	);
 ?>
<?php if(get_comment_pages_count() > 1){
	?>
	<div class="mkd-comment-pager">
		<p><?php paginate_comments_links(); ?></p>
	</div>
<?php } ?>


<?php
if(isset($blog_id) && $blog_id != $user_blog_id): ?>
        <div class="mkd-comment-form">
            <div class="comment-respond" id="respond">
                <h3 class="comment-reply-title" id="reply-title">
                    <span class="mkd-section-title-holder clearfix ">
                        <span class="mkd-st-title">Leave A Comment        </span>
                    </span> 
                    <small><a style="display:none;" href="#" id="cancel-comment-reply-link" rel="nofollow">Cancel Reply</a></small>
                </h3>
                <p class="must-log-in">You must be <a href="<?php echo home_url('/login'); ?>">logged in</a> to post a comment.<br/>Only members of this branch can comment.</p>		</div><!-- #respond -->                    
		</div>
<?php else: ?>
 <div class="mkd-comment-form">
     <?php comment_form($args); ?>
</div>
<?php endif; ?>