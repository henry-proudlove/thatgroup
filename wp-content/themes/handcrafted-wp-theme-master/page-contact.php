<?php
/**
 * Template Name: Contact Page
 * Description: Holder for Contact Page
 *
 * @package WordPress
 * @subpackage themename
 */

get_header(); ?>

		
				<?php the_post(); ?>
				<section id="load">
					<div id="contact">
						<address>
							<span class="co-name">THAT Group</span></br>
							6a St Pancras Way</br>
							London</br>
							NW1 0TB</br>
							<a href="tel:+4402035442696">0203 544 2696</a></br>
						</address>
						<nav id="contact-nav">
							<?php 
								$ico = file_get_contents(get_template_directory_uri() . '/images/ico-map.svg');
							?>
							<a class="map" href="http://goo.gl/maps/K2UkO" target="_blank"><span class="ico"><?php echo $ico; ?></span><span class="txt">Find Us</span></a>
							<?php 
								$ico = file_get_contents(get_template_directory_uri() . '/images/ico-mail.svg');
							?>
							<a class="email" href="<?php the_permalink($page->ID); ?>"><span class="ico"><?php echo $ico; ?></span><span class="txt">Email Us</span></a>
							<?php 
								$ico = file_get_contents(get_template_directory_uri() . '/images/ico-tw.svg');
							?>
							<a class="twitter" href="#" target="_blank"><span class="ico"><?php echo $ico; ?></span><span class="txt">Twitter</span></a>
							<?php 
								$ico = file_get_contents(get_template_directory_uri() . '/images/ico-in.svg');
							?>
							<a class="linkedin" href="#" target="_blank"><span class="ico"><?php echo $ico; ?></span><span class="txt">LinkedIn</span></a>
							<?php 
								$ico = file_get_contents(get_template_directory_uri() . '/images/ico-fb.svg');
							?>
							<a class="facebook " href="#" target="_blank"><span class="ico"><?php echo $ico; ?></span><span class="txt">Facebook</span></a>
						</nav>
					</div><!--#contact-->
				</section><!--#load-->
				<div id="primary">
				<div id="content" class="contact-page">
				<article id="post-<?php the_ID(); ?>" <?php post_class('main-article'); ?> role="article">
						<header class="entry-header">
								<h1 class="entry-title">Email Us</h1>
							</header><!-- .entry-header -->
						<div id="contact-wrapper">
							<form method="post" action="mail.php" id="contactform">
								<div class="input">
									<label for="name">Name</label>
									<input type="text" placeholder="Your name" class="required" name="contactname" id="contactname" value="" />
								</div>
						
								<div class="input">
									<label for="email">Email</label>
									<input type="text" placeholder="Your email address" class="required email" name="email" id="email" value="" />
								</div>
								
								<div class="input">
									<select required id="subject" name="subject">
									  <option value="">What is the nature of your contact</label>
									  <option value="neighbour">Neighbour</option>
									  <option value="supplier">Supplier</option>
									  <option value="professional">Professional</option>
									  <option value="investor">Investor</option>
									  <option value="general">General</option>
									</select>
								</div>
								<div class="input">
									<label for="message">Message</label>
									<textarea rows="3" cols="80" placeholder="Your message" class="required" name="message" id="message"></textarea>
								</div>
								<input type="submit" value="Send Message" name="submit" />
							</form>
							<?php if(isset($hasError)) { //If errors are found ?>
								<p>Please check if you've filled all the fields with valid information. Thank you.</p>
							<?php } ?>
							
							<?php if(isset($emailSent) && $emailSent == true) { //If email is sent ?>
								<p><strong>Email Successfully Sent!</strong></p>
								<p>Thank you <strong><?php echo $name;?></strong> for using my contact form! Your email was successfully sent and I will be in touch with you soon.</p>
							<?php } ?>
						</div>
					</article>
			</div><!-- #content -->
		</div><!-- #primary -->

<?php get_footer(); ?>