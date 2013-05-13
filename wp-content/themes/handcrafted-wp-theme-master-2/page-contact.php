<?php
/**
 * Template Name: Contact Page
 * Description: Holder for Contact Page
 *
 * @package WordPress
 * @subpackage themename
 */
 
if(isset($_POST['submit'])) {
	if(trim($_POST['contactname']) == '') {
		$hasError = true;
	} else {
		$name = trim($_POST['contactname']);
	}

	if(trim($_POST['subject']) == '') {
		$hasError = true;
	} else {
		$subject = trim($_POST['subject']);
	}

	if(trim($_POST['email']) == '')  {
		$hasError = true;
	} else if (!eregi("^[A-Z0-9._%-]+@[A-Z0-9._%-]+\.[A-Z]{2,4}$", trim($_POST['email']))) {
		$hasError = true;
	} else {
		$email = trim($_POST['email']);
	}

	if(trim($_POST['message']) == '') {
		$hasError = true;
	} else {
		if(function_exists('stripslashes')) {
			$comments = stripslashes(trim($_POST['message']));
		} else {
			$comments = trim($_POST['message']);
		}
	}

	if(!isset($hasError)) {
		$emailTo = get_option('tz_email');
		if (!isset($emailTo) || ($emailTo == '') ){
			$emailTo = get_option('admin_email');
		}
		$subject = $subject . ':  ' .$name;
		$body = "Name: $name \n\nEmail: $email \n\nComments: $comments";
		$headers = 'From: '.$name.' <'.$emailTo.'>' . "\r\n" . 'Reply-To: ' . $email;

		wp_mail($emailTo, $subject, $body, $headers);
		$emailSent = true;
	}

}

get_header(); ?>

		<div id="primary">
				<div id="content" class="contact-page">
				
				<?php the_post(); ?>
				
				<section id="load">
					<div id="contact">
						<address>
							<span class="co-name">THAT Group</span></br>
							6a St Pancras Way</br>
							London</br>
							NW1 0TB</br>
							<a class="tel" href="tel:+4402035442696">0203 544 2696</a></br>
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
							<a class="twitter" target="_blank"><span class="ico"><?php echo $ico; ?></span><span class="txt">Twitter</span></a>
							<?php 
								$ico = file_get_contents(get_template_directory_uri() . '/images/ico-in.svg');
							?>
							<a class="linkedin" target="_blank"><span class="ico"><?php echo $ico; ?></span><span class="txt">LinkedIn</span></a>
							<?php 
								$ico = file_get_contents(get_template_directory_uri() . '/images/ico-fb.svg');
							?>
							<a class="facebook " href="#" target="_blank"><span class="ico"><?php echo $ico; ?></span><span class="txt">Facebook</span></a>
						</nav>
					</div><!--#contact-->
				</section><!--#load-->
				<article id="post-<?php the_ID(); ?>" <?php post_class('main-article'); ?> role="article">
						<header class="entry-header">
								<h1 class="entry-title">Email Us <a href="#" class="back">
									<?php echo file_get_contents(get_template_directory_uri() . '/images/close.svg'); ?>
								</a></h1>
							</header><!-- .entry-header -->
						<div id="contact-wrapper" class="<?php if(isset($emailSent) && $emailSent == true)echo success; ?>">
							<form method="post" action="<?php the_permalink() ?>" id="contactform">
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
									  <option value="general">Other</option>
									</select>
								</div>
								<div class="input">
									<label for="message">Message</label>
									<textarea rows="3" cols="80" placeholder="Your message" class="required" name="message" id="message"></textarea>
								</div>
								<input type="submit" value="Send Email" name="submit" />
							</form>
							<?php if(isset($hasError)) { //If errors are found ?>
								<div id="form-response" class="error">Error! Please check you've filled in everything correctly</div>
							<?php } ?>
							
							<?php if(isset($emailSent) && $emailSent == true) { //If email is sent ?>
								<div id="form-response" class="success">Thanks <?php echo $name ?>! your email has been sent</div>
								<a href="#" class="contact-back">Back to Previous Page</a>
							<?php } ?>
						</div>
					</article>
			</div><!-- #content -->
		</div><!-- #primary -->

<?php get_footer(); ?>