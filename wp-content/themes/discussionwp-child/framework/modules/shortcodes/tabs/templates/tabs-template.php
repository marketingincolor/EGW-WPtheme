<div class="mkd-tabs clearfix <?php echo esc_attr($tabs_classes) ?>">
    <div class="mkd-tabs-nav">
        <?php if($tabs_title != '') { ?>
            <div class="mkd-tabs-title-holder">
				<?php echo discussion_execute_shortcode('mkd_section_title', array(
						'title' => $tabs_title,
						'title_tag' => $title_tag
						)
					); ?>
            </div>
        <?php } ?>
        <ul>
            <?php  foreach ($tabs_titles as $tab_title) {?>
                <li>
                    <a href="#tab-<?php echo sanitize_title($tab_title)?>"><?php echo esc_attr($tab_title)?></a>
                </li>
            <?php } ?>
        </ul>
    </div>
    <?php echo do_shortcode($content) ?>
</div>