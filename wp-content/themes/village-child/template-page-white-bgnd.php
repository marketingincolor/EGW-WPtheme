<?php
/*
 * Author - MIC
 * Date - 13-06-2016
 * Purpose - For displaying specific pages and landing pages with a white background 
 * Template Name: White Background
 *
*/ 

$custom_fields = get_post_custom();
$hide_title = $custom_fields['hide_title'];
$center_page = $custom_fields['center_page'];
/* add centered text to entire page by slug */
$centered = ( is_page('welcome') || is_page('welcome-sweeps-success') ) ? 'text-align:center;' : '' ;
/* add margins to paragraphs in the_content by slug */
$margined = ( is_page('welcome') ) ? ' margin:2% 14%;' : null;
/* show the_title by slug */
$listed = (  $hide_title || is_page('welcome-sweeps')) ? 'true' : null;

$sidebar = discussion_sidebar_layout(); ?>
<?php get_header(); ?>
<style>
/* Start Custom layouts from MIC */
.page-template-template-page-white-bgnd { background-color: #ffffff; }
.page-template-template-page-white-bgnd .mkd-title-breadcrumb-holder { display:none !important; }
.page-template-template-page-white-bgnd .mkd-content { background-color: #ffffff; padding-top:1.3em;}
.page-template-template-page-white-bgnd .mkd-content .mkd-container .mkd-container-inner {<?php echo $centered; ?> }
.page-template-template-page-white-bgnd .mkd-content .mkd-container .page-feature-image img { 
	border-top-right-radius: 60px; 
	border-bottom-left-radius: 60px;  
}
.page-template-template-page-white-bgnd .mkd-title .mkd-title-holder { height:auto; }

/*Register Page Styles*/
h3 { font-family: 'Roboto', sans-serif; font-weight:bold; color:#6c6b6b; font-size:1.733em; padding-top:1rem;}
p { font-family: 'Roboto', sans-serif; font-weight: normal; color: #6c6b6b; font-size: 1em; <?php echo $margined; ?> }
.join-content ul li{ list-style-type: disc !important; }
.join-content { padding: 0% 21% 0% 7%; }
.sign-up-text { 
	text-align: center; 
	color: #f79c49; 
	font-size:3.200em; 
	font-family: 'Roboto', sans-serif; 
	font-weight:bold; 
	padding-top:1rem;
}
.enter-to-win-text { 
	text-align: left; 
	color: #f79c49; 
	font-size:3.200em; 
	font-family: 'Roboto', sans-serif; 
	font-weight:bold; 
	padding-top:1rem;
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

.page-template-template-page-white-bgnd .page-id-2981 h4 { font-size: 1.4em !important; padding-top: .5em; font-weight:bold; font-color: #6c6b6b; }
.page-template-template-page-white-bgnd .mkd-content .mkd-container .get-involved-button { 
	background-color: #f79c49; 
	color: white; 
	padding: .5em !important; 
	text-align: center; 
	font-weight: 500;
	display:inline-block;
}
.page-template-template-page-white-bgnd .mkd-content .mkd-container .get-involved-button a,.get-involved-button a:hover { color: white; }
.page-template-template-page-white-bgnd .mkd-content .mkd-container .story-box { height: 20%; margin-bottom: 1.5em; }

.login-container { background-color: #edebeb; }

.giveaway-text ul li { list-style-type: disc !important; }
.disclosure-text { font-size: .7em; }
.v-link { color:#fff; font-size:1.25em; font-weight:bold; text-transform:uppercase; }

/*SharpSpring Form Styles*/
input:focus, textarea:focus { width: 75% !important; }


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

						if ($listed) {
							
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