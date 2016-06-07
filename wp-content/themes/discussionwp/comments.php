<div class="mkd-comment-holder clearfix" id="comments">
	<div class="mkd-comment-number">
		<?php comments_number(
			discussion_execute_shortcode('mkd_section_title', array('title' => esc_html__('No Comments','discussionwp'))),
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
		<?php wp_list_comments(array( 'callback' => 'discussion_comment')); ?>
	</ul>
<?php // End Comments ?>

 <?php else : // this is displayed if there are no comments so far 

	if ( ! comments_open() ) :
?>
		<!-- If comments are open, but there are no comments. -->

	 
		<!-- If comments are closed. -->
		<p><?php esc_html_e('Sorry, the comment form is closed at this time.', 'discussionwp'); ?></p>

	<?php endif; ?>
<?php endif; ?>
</div></div>
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
 <div class="mkd-comment-form">
	<?php comment_form($args); ?>
</div>