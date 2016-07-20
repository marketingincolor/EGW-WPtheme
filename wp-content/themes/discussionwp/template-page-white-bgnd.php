<?php
/*
 * Author - MIC
 * Date - 13-06-2016
 * Purpose - For displaying specific pages and landing pages with a white background 
 * Template Name: White Background
 *
*/ 
$centered = is_page('register-success') ? 'text-align:center;' : '' ;
$listed = (is_page('sweepstakes-terms-conditions') || is_page('register') || is_page('shipshape') || is_page('welcome-sweeps')) ? 'true' : null;
$sidebar = discussion_sidebar_layout(); ?>
<?php get_header(); ?>
<style>
/* Start Custom layouts from MIC */
.page-template-template-page-white-bgnd { background-color: #ffffff; }
.page-template-template-page-white-bgnd .mkd-title-breadcrumb-holder { display:none !important; }
.page-template-template-page-white-bgnd .mkd-content { background-color: #ffffff; }
.page-template-template-page-white-bgnd .mkd-content .mkd-container .mkd-container-inner {<?php echo $centered; ?> }
.page-template-template-page-white-bgnd .mkd-content .mkd-container .page-feature-image img { 
	border-top-right-radius: 60px; 
	border-bottom-left-radius: 60px;  
}
.page-template-template-page-white-bgnd .mkd-title .mkd-title-holder { height:auto; }

/*Register Page Styles*/
h3 { font-family: 'Roboto', sans-serif; font-weight:bold; color:#6c6b6b; font-size:1.733em; padding-top:1em;}
p { font-family: 'Roboto', sans-serif; font-weight: normal; color: #6c6b6b; font-size: 1em; }
.join-content ul li{ list-style-type: disc !important; }
.join-content { padding: 0% 21% 0% 7%; }
.sign-up-text { 
	text-align: center; 
	color: #f79c49; 
	font-size:3.200em; 
	font-family: 'Roboto', sans-serif; 
	font-weight:bold;
	padding: 15% 10% 0%; 
}
.tooltip{ display: inline; position: relative; }
.tooltip:hover:after{
    background: #333;
    background: rgba(0,0,0,.8);
    border-radius: 5px;
    bottom: 26px;
    color: #fff;
    content: attr(title);
    left: 20%;
    padding: 5px 15px;
    position: absolute;
    z-index: 98;
    width: 220px;
}
.tooltip:hover:before{
    border: solid;
    border-color: #333 transparent;
    border-width: 6px 6px 0 6px;
    bottom: 20px;
    content: "";
    left: 50%;
    position: absolute;
    z-index: 99;
}

.disclosure-text { font-size: .7em; }
/* End Custom layouts from MIC */
</style>
	<?php discussion_get_title(); ?>
	<?php get_template_part('slider'); ?>
	<div class="mkd-container">
		<?php do_action('discussion_after_container_open'); ?>
		<div class="mkd-container-inner clearfix">
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				<?php if(($sidebar == 'default')||($sidebar == '')) : ?>

					<?php if ( has_post_thumbnail() ) : ?>
						<div class="page-feature-image">
							<?php the_post_thumbnail('full'); ?>
						</div>
					<?php endif; ?>
					
					<?php 

						if (is_page('sweepstakes-terms-conditions') || is_page('register') || is_page('shipshape')) {
							
						}
						else {
							the_title( '<h2 class="page-title">', '</h2>' ); 
						}

						the_content();
						//do_action('discussion_page_after_content');

						?>


				<?php elseif($sidebar == 'sidebar-33-right' || $sidebar == 'sidebar-25-right'): ?>
					<div <?php echo discussion_sidebar_columns_class(); ?>>
						<div class="mkd-column1 mkd-content-left-from-sidebar">
							<div class="mkd-column-inner">

							<?php if ( has_post_thumbnail() ) : ?>
								<div class="page-feature-image">
									<?php the_post_thumbnail('full'); ?>
								</div>
							<?php endif; ?>

								<?php the_title( '<h2 class="page-title">', '</h2>' ); ?>
								<?php the_content(); ?>
								<?php //do_action('discussion_page_after_content'); ?>
							</div>
						</div>
						<div class="mkd-column2">
							<?php get_sidebar(); ?>
						</div>
					</div>
				<?php elseif($sidebar == 'sidebar-33-left' || $sidebar == 'sidebar-25-left'): ?>
					<div <?php echo discussion_sidebar_columns_class(); ?>>
						<div class="mkd-column1">
							<?php get_sidebar(); ?>
						</div>
						<div class="mkd-column2 mkd-content-right-from-sidebar">
							<div class="mkd-column-inner">
								<?php if ( has_post_thumbnail() ) : ?>
									<div class="page-feature-image">
										<?php the_post_thumbnail('full'); ?>
									</div>
								<?php endif; ?>

								<?php the_title( '<h2 class="page-title">', '</h2>' ); ?>
								<?php the_content(); ?>
								<?php //do_action('discussion_page_after_content'); ?>
							</div>
						</div>
					</div>
				<?php endif; ?>

			<?php endwhile; ?>
			<?php endif; ?>
		</div>
		<?php do_action('discussion_before_container_close'); ?>
	</div>
<?php get_footer(); ?>