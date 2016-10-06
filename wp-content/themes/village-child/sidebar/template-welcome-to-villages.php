<div class="fsp-welcome-branch">
    <div class="fsp-branch-title"><h4>Welcome to The Villages!</h4></div>
    <div class="fsp-branch-content">        
        <ul>
            <?php if(ENVIRONMENT_MODE!=1){ ?>
            <?php if (!is_user_logged_in()) { ?>
            <li><a href = "<?php echo network_site_url(); ?>register"><i class="fa fa-check" aria-hidden="true"></i> Join This Branch?</a></li>
            <?php } ?>
            <li class="welcome-my-pop"><a href = "<?php echo network_site_url(); ?>wp-content/themes/village-child/template-find-branch.php"><i class="fa fa-search" aria-hidden="true"></i> Find Another Branch</a></li>
            <?php } ?>
            <?php if (!is_user_logged_in() && !is_category( 'popup-studio' )) { ?>
            <li><a href = "<?php echo network_site_url(); ?>"><i class="fa fa-reply" aria-hidden="true"></i> Return to Main Site</a></li>
            <?php } ?>
        </ul>    
    </div>
</div>
<div id="current-blog" style="display:none"><?php echo $blog_id = get_current_blog_id(); ?></div>


