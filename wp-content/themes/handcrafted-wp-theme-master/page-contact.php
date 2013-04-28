<?php
/**
 * Template Name: Contact Page
 * Description: Holder for Contact Page
 *
 * @package WordPress
 * @subpackage themename
 */

get_header(); ?>

		<div id="primary">
			<div id="content">

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
							<a href="http://goo.gl/maps/K2UkO" target="_blank">Find Us</a>
							<a href="#">Email Us</a>
							<a href="#" target="_blank">Twitter</a>
							<a href="#" target="_blank">LinkedIn</a>
							<a href="#" target="_blank">Facebook</a>
						</nav>
					</div><!--#contact-->
				</section><!--#load-->
				
				<div id="contact-wrapper">
					<form method="post" action="mail.php" id="contactform">
						<div>
							<label for="name">Name</label>
							<input type="text" placeholder="You Name" class="required" size="50" name="contactname" id="contactname" value="" />
						</div>
				
						<div>
							<label for="email">Email</label>
							<input type="text" placeholder="You Email" class="required email" size="50" name="email" id="email" value="" />
						</div>
						
						<div>
							<select required id="subject" name="subject">
							  <option value="">What is the nature of your contact</label>
							  <option value="neighbour">Neighbour</option>
							  <option value="supplier">Supplier</option>
							  <option value="professional">Professional</option>
							  <option value="investor">Investor</option>
							  <option value="general">General</option>
							</select>
						<div>
							<label for="message">Message</label>
							<textarea rows="5" cols="50" class="required" name="message" id="message"></textarea>
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
				
				<?php the_post(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> role="article">
					<header class="entry-header">
						<h1 class="entry-title"><?php the_title(); ?></h1>
					</header><!-- .entry-header -->

					<div class="entry-content">
						<?php the_content(); ?>
						<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'themename' ), 'after' => '</div>' ) ); ?>
						<?php edit_post_link( __( 'Edit', 'themename' ), '<span class="edit-link">', '</span>' ); ?>
					</div><!-- .entry-content -->
				</article><!-- #post-<?php the_ID(); ?> -->
			</div><!-- #content -->
		</div><!-- #primary -->

<?php get_footer(); ?>