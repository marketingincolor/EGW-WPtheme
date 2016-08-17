<div class ="mkd-blog-share">
	<div class="mkd-social-share-holder mkd-dropdown">
		<a href="javascript:void(0)" target="_self" class="mkd-social-share-dropdown-opener">
			<span class="mkd-social-share-title"><?php esc_html_e('Share', 'discussionwp') ?></span>
		</a>
		<div class="mkd-social-share-dropdown">
			<ul>
				<?php foreach (array_reverse($networks) as $net) {
					print $net;
				} ?>
			</ul>
		</div>
	</div>
</div>