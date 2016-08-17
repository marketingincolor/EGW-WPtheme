<div id="apsc_widget-4" class="widget widget_apsc_widget">
    <div class="mkd-section-title-holder clearfix">
        <span class="mkd-st-title">Share This Page</span>
    </div>
   <div class="sidebar-social-icons">
        <div class="social-icon-wd-container">                        
            <ul>
                <ul>            
                <?php $image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full'); ?>
                
                <li class="wd-fb"><a onclick="<?php echo SocialNetworkShareLink('facebook',$image); ?>" href="javascript: void(0)"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                <li class="wd-twitter"><a onclick="<?php echo SocialNetworkShareLink('twitter',$image); ?>" href="javascript: void(0)"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                <li class="wd-googleplus"><a onclick="<?php echo SocialNetworkShareLink('google_plus',$image); ?>" href="javascript: void(0)"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
                <li class="wd-pinterest"><a onclick="<?php echo SocialNetworkShareLink('pinterest',$image); ?>" href="javascript: void(0)"><i class="fa fa-pinterest-p" aria-hidden="true"></i></a></li>
                <li class="wd-linkedin"><a onclick="<?php echo SocialNetworkShareLink('linkedin',$image); ?>" href="javascript: void(0)"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
            </ul>
            </ul>
        </div>
    </div>
</div>