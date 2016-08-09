<?php
/**
 * Template Name: contact
 *
 * 
 */
?>
<?php get_header(); ?>
<div class="contact-us-wrapper">
<div class="mkd-container-inner"> 
    <div class="mkd-two-columns-75-25  mkd-content-has-sidebar clearfix">
        <div class="mkd-column1 mkd-content-left-from-sidebar">
            <div class="mkd-column-inner">
                <div class="mkd-blog-holder mkd-blog-single">
                    <div class="contact-us-container">
                        <h1><?php the_title(); ?></h1>
                        <?php the_content(); ?>
                    </div>  
                    <!-- <div style="" class="vc_row wpb_row vc_inner vc_row-fluid mkd-section vc_custom_1457693380284 mkd-content-aligment-left">
                                                   <div class="mkd-full-section-inner">
                                                       <div class="wpb_column vc_column_container vc_col-sm-6">
                                                           <div class="vc_column-inner vc_custom_1457350178380">
                                                               <div class="wpb_wrapper">
                                                                   <div class="wpb_single_image wpb_content_element vc_align_left">

                                                                       <figure class="wpb_wrapper vc_figure">
                                                                           <div class="vc_single_image-wrapper   vc_box_border_grey"><img height="375" width="600" sizes="(max-width: 600px) 100vw, 600px"  alt="a" class="vc_single_image-img attachment-full" src="<?php echo get_field('image'); ?>"></div>
                                                                       </figure>
                                                                   </div>
                                                               </div>
                                                           </div>
                                                       </div>
                                                       <div class="wpb_column vc_column_container vc_col-sm-6">
                                                           <div class="vc_column-inner ">
                                                               <div class="wpb_wrapper">
                                                                   <div class="wpb_text_column wpb_content_element ">
                                                                       <div class="wpb_wrapper">
                                                                           <h4><?//php $title = get_field_object('office');
                                                                           echo $title['label'];
                                                                           ?></h4>
                                                                       </div>
                                                                   </div>
                                                                   <div class="wpb_text_column wpb_content_element ">
                                                                       <div class="wpb_wrapper">
                                                                           <?//php echo get_field('office');
                                                                           ?>
                                                                       </div>
                                                                   </div>
                                                                   <div style="height: 20px" class="vc_empty_space"><span class="vc_empty_space_inner"></span></div>

                                                                   <div class="wpb_text_column wpb_content_element ">
                                                                       <div class="wpb_wrapper">
                                                                           <h5><?//php $title = get_field_object('address');
                                                                           echo $title['label'];
                                                                           ?></h5>
                                                                       </div>
                                                                   </div>
                                                                   <div class="wpb_text_column wpb_content_element ">
                                                                       <div class="wpb_wrapper">
                                                                               <?//php echo get_field('address'); ?>
                                                                       </div>
                                                                   </div>
                                                                   <div style="height: 40px" class="vc_empty_space"><span class="vc_empty_space_inner"></span></div>
                                                               </div>
                                                           </div>
                                                       </div>
                                                   </div>
                                               </div> -->
                     <!-- <div style="" class="vc_row wpb_row vc_row-fluid mkd-section vc_custom_1457353735985 mkd-content-aligment-left">
                                              <?//php echo do_shortcode("[contact-form-7 id=393 title='contact']"); ?>
                            </div> --> 
                </div>
            </div>
        </div>
        <div class="mkd-column2">
                <aside class="mkd-sidebar" style="transform: translateY(0px);">
                    <?php get_sidebar(); ?>
                </aside>
        </div>
    </div>
</div>
</div>

<?php get_footer(); ?>
