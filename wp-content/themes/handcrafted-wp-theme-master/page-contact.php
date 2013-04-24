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

				
				<div id="contact-wrapper">
					<form method="post" action="<?php echo get_template_directory_uri() . '/mail.php'; ?>" id="contactform">
						<div>
							<label for="name">Name</label>
							<input type="text" placeholder="You Name" class="required" size="50" name="contactname" id="contactname" value="" />
						</div>
				
						<div>
							<label for="email">Email</label>
							<input type="text" placeholder="You Email" class="required email" size="50" name="email" id="email" value="" />
						</div>
						
						<div>
							<select required id="subject">
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