<?php
$sidebar = discussion_get_sidebar();
?>
<div class="mkd-column-inner">
    <aside class="mkd-sidebar">
        <?php
            if (is_active_sidebar($sidebar)) {
                dynamic_sidebar($sidebar);
            }
        ?>
    </aside>
</div>
