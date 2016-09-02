<?php $sidebar = discussion_sidebar_layout(); ?>
<?php get_header(); ?>
<?php 
$blog_page_range = discussion_get_blog_page_range();
$max_number_of_pages = discussion_get_max_number_of_pages();

if ( get_query_var('paged') ) { $paged = get_query_var('paged'); }
elseif ( get_query_var('page') ) { $paged = get_query_var('page'); }
else { $paged = 1; }

$enable_search_page_sidebar = true;
if(discussion_options()->getOptionValue('enable_search_page_sidebar') === "no"){
	$enable_search_page_sidebar = false;
}
?>
<?php discussion_get_title(); ?>
	<div class="mkd-container">
		<?php do_action('discussion_after_container_open'); ?>
		<div class="mkd-container-inner clearfix">
			<div class="mkd-container">
				<?php do_action('discussion_after_container_open'); ?>
				<div class="mkd-container-inner">
					<?php if($enable_search_page_sidebar) { ?>
					<div class="mkd-two-columns-75-25 mkd-content-has-sidebar clearfix">
						<div class="mkd-column1 mkd-content-left-from-sidebar">
							<div class="mkd-column-inner">
					<?php } ?>		
								<div class="mkd-search-page-holder">

									<div class="mkd-search-top-holder">
										<h1 class="mkd-search-results-holder"><?php echo get_search_query() . esc_html__(' - Search Results', 'discussionwp') ?></h1>
										<form action="<?php echo esc_url(home_url('/')); ?>" class="mkd-search-page-form" method="get">
											<div class="mkd-form-holder">
												<div class="mkd-column-left">
													<input type="text"  name="s" class="mkd-search-field" autocomplete="off" placeholder="<?php esc_html_e('Search','discussionwp');?>"/>
												</div>
												<div class="mkd-column-right">
													<button class="mkd-search-submit" type="submit" value="Search"><span class="ion-ios-search"></span></button>
												</div>
											</div>
										</form>
									</div>

									<?php if(have_posts()) : while ( have_posts() ) : the_post(); ?>
										<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
											<div class="mkd-post-content">
												<div class="mkd-pt-two-item mkd-post-item">
													<div class="mkd-pt-two-item-inner">
														<?php if(has_post_thumbnail()){ ?>
															<div class="mkd-pt-two-image-holder">
																<?php
                                                                                                                                if(!empty(get_the_category())) {
                                                                                                                                    discussion_post_info_category(array(
                                                                                                                                            'category' => 'yes'
                                                                                                                                    )); 
                                                                                                                                }?>
																<a itemprop="url" class="mkd-pt-two-link mkd-image-link" href="<?php echo esc_url(get_permalink()); ?>" target="_self">
																	<?php
																		echo discussion_generate_thumbnail(get_post_thumbnail_id(get_the_ID()),null,'273','171');
																	?>
																</a>
															</div>
														<?php } ?>
														<div class="mkd-pt-two-content-holder">
															<div class="mkd-pt-two-content-holder-inner">
																<div class="mkd-pt-two-content-top-holder">
																	<div class="mkd-pt-two-content-top-holder-cell">
																		<h4 class="mkd-pt-two-title">
																			<a itemprop="url" class="mkd-pt-link" href="<?php echo esc_url(get_permalink()) ?>" target="_self">
																				<?php the_title(); ?>
																			</a>
																		</h4>
																		<div class="mkd-pt-two-excerpt">
																			<?php custom_discussion_excerpt('20'); ?>
																		</div>
																	</div>
																</div>
																<div class="mkd-pt-two-content-bottom-holder">
																	<div class="mkd-pt-info-section clearfix">
																		<div>
																			<?php discussion_post_info_share(array(
																				'share' => 'yes'
																			));
																			discussion_post_info_comments(array(
																				'comments' => 'yes'
																			));
																			discussion_post_info_count(array(
																				'count' => 'yes'
																			)); ?>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>

											</div>
										</article>
									<?php endwhile; ?>
									<?php
										if(discussion_options()->getOptionValue('pagination') == 'yes') {
											discussion_pagination($max_number_of_pages, $blog_page_range, $paged);
										}
									?>
									<?php else: ?>
									<div class="entry">
										<p><?php esc_html_e('No posts were found.', 'discussionwp'); ?></p>
									</div>
									<?php endif; ?>
								</div>
								<?php do_action('discussion_page_after_content'); ?>
					<?php if($enable_search_page_sidebar) { ?>			
							</div>
						</div>
						<div class="mkd-column2">
							<?php get_sidebar(); ?>
						</div>
					</div>
					<?php } ?>
				<?php do_action('discussion_before_container_close'); ?>
				</div>
			</div>
		</div>
		<?php do_action('discussion_before_container_close'); ?>
	</div>
<?php get_footer(); ?>