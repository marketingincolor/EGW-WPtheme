<?php
/**
 * Template Name: Videos Page
 *
 * Selectable from a dropdown menu on the edit page screen.
 */
?>

<?php get_header(); ?>

        <div class="mkd-container">
            <div id="content" class="mkd-container-inner">

<?php

$type = 'videos';
$args=array(
  'post_type' => $type,
  'post_status' => 'publish',
  'posts_per_page' => 2,
  'paged' => ( get_query_var('paged') ? get_query_var('paged') : 1 ),
);
$my_query = null;
$my_query = query_posts($args);

if(have_posts() ) {  echo "<ul>";
  while (have_posts()) :the_post(); ?>
         <li><h3><?php echo the_title(); ?></h3></li> <?php
   
        $video_url=get_field('video_url');
        $video_file=get_field('video_file');
        if($video_url!=""){
            $val = get_videoid_from_url($video_url); ?>
            <div style="width:30%;height:50%">
            <iframe style="cursor:default" width="15%" height="10%" src="<?php  echo $val;?>"></iframe>
            </div><br>
                <?php   
        }  
        
        if($video_file!=""){ ?>
            <div style="width:50%;height:50%">
            <iframe style="cursor:default" width="50%" height="50%" src="<?php echo $video_file;?>"></iframe>
            </div>
        <?php }

   endwhile;
   ?>
       <div class="navigation">
         <div class="alignleft"><?php previous_posts_link('&laquo; Previous') ?></div>
         <div class="alignright"><?php next_posts_link('More &raquo;') ?></div>
       </div>       
            
<?php
    echo "</ul>";
} else {
    echo "No content found";
}
wp_reset_query();  // Restore global post data stomped by the_post().
?>
            
            </div><!-- #content -->
        </div><!-- #container -->


<?php get_footer(); ?>