<script type="text/javascript">
    <?php
    $cat_name="";
    $cat_id="";
    if(isset($category)) $cat_id=get_cat_ID($category);
    if(isset($category_id)) $cat_id=$category_id;
    ?>
    jQuery(document).ready(function() {

        jQuery(window).scroll(function() {
            total_post = parseInt(jQuery('#total_post').val());
            current_post_total = parseInt(jQuery('#current_post').val());
//                alert("dfdfd-"+jQuery(window).scrollTop() +jQuery(window).height())
//                alert("top-"+jQuery('.mkd-footer-inner').offset().top)
            if (jQuery(window).scrollTop() + jQuery(window).height() > jQuery('.mkd-footer-inner').offset().top)
            {
                if (total_post > 6 && total_post > current_post_total && jQuery('#processing').val() == '0') {
                    jQuery('#processing').val(1);
                    jQuery('.mkd-ratings-holder').show();

                    jQuery.ajax({
                        type: "POST",
                        url: "<?php echo bloginfo('wpurl'); ?>/wp-admin/admin-ajax.php",
//                        async: false,
                        data: {
                            action: 'custom_scroll_post_load',
                            offset: parseInt(jQuery('#current_post').val()),                         
                            cat_id:'<?php echo $cat_id; ?>',                        
                            post_type:'post',
                            perpage: '6'
                        },
                        success: function(data)
                        {
                            jQuery('.mkd-ratings-holder').hide();
                            Current_loop=jQuery('#currentloop').val();
                            active_loop=parseInt(Current_loop)+parseInt(1);                           
                            jQuery('#currentloop').val(active_loop)
                            jQuery('#adv_row_'+active_loop).show();
//                            jQuery(".mkd-post-columns-3").append(data).before(jQuery('#adv_row_'+active_loop));
                            jQuery(data).insertAfter('#adv_row_'+Current_loop)
//                            Current_loop=jQuery('#currentloop').val();
//                            jQuery('#adv_row_'+Current_loop).after(data);
//                            active_loop=parseInt(Current_loop)+parseInt(1);
//                            jQuery('#currentloop').val(active_loop)
//                            jQuery('#adv_row_'+active_loop).show();
                            jQuery('#processing').val(0);
                            current_total = parseInt(jQuery('#current_post').val()) + parseInt(6)
                            jQuery('#current_post').val(current_total)
//                        alert("new current post-"+jQuery('#current_post').val());
                        }

                    });
                }
            }
        });

    });
</script>
<?php
?>