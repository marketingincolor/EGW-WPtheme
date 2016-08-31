<?php
/*
 * Author - MIC
 * Date - 13-06-2016
 * Purpose - For displaying Sweeps Landing page with a white background 
 * Template Name: Welcome Sweeps
 *
*/ 

/* add centered text to entire page by slug */
//$centered = ( is_page('welcome') || is_page('welcome-sweeps-success') ) ? 'text-align:center;' : '' ;
/* add margins to paragraphs in the_content by slug */
//$margined = ( is_page('welcome') ) ? ' margin:2% 14%;' : null;
/* show the_title by slug */
$listed = (is_page('welcome')) ? 'true' : null;

$sidebar = discussion_sidebar_layout(); ?>
<?php get_header(); ?>
<style>
/* Start Custom layouts from MIC */
.page-template-template-page-welcome-sweeps { background-color: #ffffff; }
.page-template-template-page-welcome-sweeps .mkd-title-breadcrumb-holder { display:none !important; }
.page-template-template-page-welcome-sweeps .mkd-content { background-color: #ffffff; padding-top:1.3em;}
.page-template-template-page-welcome-sweeps .mkd-content .mkd-container .mkd-container-inner {<?php echo $centered; ?> }
.page-template-template-page-welcome-sweeps .mkd-content .mkd-container .page-feature-image img { 
	border-top-right-radius: 60px; 
	border-bottom-left-radius: 60px;  
}
.page-template-template-page-welcome-sweeps .mkd-title .mkd-title-holder { height:auto; }

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

						if ($listed) { ?>

						<h2 class="page-title" style="display:none;">Welcome Sweeps</h2>
			<div class="mkd-content">
				<div class="mkd-two-columns-50-50 clearfix">
					<div class="mkd-two-columns-50-50-inner">
						<div class="mkd-column">
							<div class="mkd-column-inner" style="padding:0 5%; margin: 0 8%">
								<h4 style="font-weight:bold;">Welcome to The Villages branch of MyEvergreenWellness.com</h4>
								<p>As a resident of The Villages, you can now access your local online page with stories and events exclusively for you. Plus save, share, and comment on articles and videos. We’re so happy that you joined and look forward to your feedback and involvement.</p>
								<p>A healthier happier you begins now!</p>
								<p>But first, as a thank you for joining, be sure to enter for your chance to win the ShipShape Cruise&trade; Giveaway by submitting the entry form!<br>
								<img width="465" height="161" alt="sweestakes-welcome_07" src="https://myevergreenwellness.com/wp-content/uploads/2016/07/sweestakes-welcome_07.jpg" style="padding-top: 3.2em;" class="alignnone size-full wp-image-1145"></p>
								<div class="giveaway-text">
									<h4>ShipShape Cruise&trade; Giveaway Package Includes:</h4>
										<ul>
											<li>4-night Royal Caribbean International&reg; cruise to The Bahamas for two people</li>
											<li>$200 toward your choice of fee-based cruise amenities*, which may include:
												<ul>
													<li>Private group snorkeling excursion at Rainbow Reef, one of<br>
													The Bahamas' most beautiful coral reefs</li>
													<li>Revitalizing, holistic spa treatment at VitalitySM Spa</li>
													<li>Personal training session or specialty group fitness class</li>
												</ul>
											</li>
										</ul>
								</div>
								<p class="disclosure-text">*Amenity options may vary according to cruise booked. Includes cruise fare, taxes and fees, and standard recommended gratuities. NO PURCHASE NECESSARY. A PURCHASE WILL NOT INCREASE YOUR CHANCES OF WINNING. Must be legal resident of the U.S. (D.C.) and a current resident of The Villages, FL, who is 55 years of age or older as of the date of entry. Sweepstakes ends 9/20/16. Travel restrictions apply. For entry and official rules with complete eligibility, prize descriptions, odds disclosure, and other details, <a target="_blank" href="http://myevergreenwellness.com/sweepstakes-terms-conditions/"><strong>see complete terms and conditions.</strong></a> Sponsored by Evergreen Wellness. Void where prohibited.</p>
								<p><img alt="blue-banner" src="https://myevergreenwellness.com/thevillages/wp-content/uploads/sites/2/2016/07/blue-banner.png"></p>
							</div>
						</div>
					</div>
					<div class="mkd-two-columns-50-50-inner">
						<div class="mkd-column">
							<div class="mkd-column-inner" style="padding:0 5%; margin: 0 8%">
								<h1 class="enter-to-win-text" style="text-align: center;">Enter to win!</h1>
								<!-- SharpSpring Form for Villages FT Welcome Sweeps Entry -->
								<script type="text/javascript">// <![CDATA[
								var ss_form = {'account': 'MzawMDG2NDQxAwA', 'formID': 'M01NNTZJSUrRTTG0NNc1MTdP1k0yMbTUNTEwsTBNtkhJNk2zAAA'}; ss_form.width = '100%'; ss_form.height = '1000'; ss_form.domain = 'app-3QMYANU21K.marketingautomation.services'; // ss_form.hidden = {'Company': 'Anon'}; // Modify this for sending hidden variables, or overriding values
								// ]]></script>
								<script src="https://koi-3QMYANU21K.marketingautomation.services/client/form.js?ver=1.1.1" type="text/javascript"></script>
								<br />
								<p style="font-size:0.75em; line-height:1.5em;">We ask for your street address to verify that you are a resident of The Villages, who are solely eligible to win this giveaway.</p>
								<br /><br />
								<p>Not interested in entering the giveaway? <a href="https://myevergreenwellness.com/thevillages">Click here to visit The Villages branch of Evergreen Wellness.</a></p>
								<br /><br />
								<p style="text-align: center;">Sponsored by AAA Travel</p>
								<p><img width="117" height="78" alt="AAA logo" src="https://myevergreenwellness.com/thevillages/wp-content/uploads/sites/2/2016/08/AAALogo.png" class="aligncenter size-full wp-image-3487"></p>
							</div>
						</div>
					</div>
				</div>
			</div>

					<?php }
						else {
							the_title( '<h2 class="page-title">', '</h2>' ); 
							the_content();
						}

						//the_content();
						//do_action('discussion_page_after_content');

						?>


			<?php endif; ?>
			<?php endwhile; ?>
			<?php endif; ?>
		</div>
		<?php do_action('discussion_before_container_close'); ?>
	</div>
<?php get_footer(); ?>