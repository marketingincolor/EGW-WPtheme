<div class="mkd-pt-four-item mkd-post-item <?php echo esc_attr($classes);?>">
    <div class="mkd-pt-four-item-inner">
        <div class="mkd-pt-four-content-holder">
			<?php discussion_post_info_category(array(
				'category' => $display_category,
			)); ?>
            <<?php echo esc_html( $title_tag)?> class="mkd-pt-four-title">
            <a itemprop="url" class="mkd-pt-link" href="<?php echo esc_url(get_permalink()) ?>" target="_self"><?php echo discussion_get_title_substring(get_the_title(), $title_length) ?></a>
            </<?php echo esc_html($title_tag) ?>>
			<?php
				discussion_post_info_date(array(
					'date' => $display_date,
					'date_format' => $date_format
				));
			?>
        </div>
    </div>
</div>