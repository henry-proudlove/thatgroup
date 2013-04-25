<?php
/**
 * Template Name: Home Page
 * Description: Holder for Home Page
 *
 * @package WordPress
 * @subpackage themename
 */

get_header(); ?>

		<div id="primary">
			<div id="content">

				<?php the_post(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> role="article">
					<div class="entry-content">
						<?php the_content(); ?>
						<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'themename' ), 'after' => '</div>' ) ); ?>
						<?php edit_post_link( __( 'Edit', 'themename' ), '<span class="edit-link">', '</span>' ); ?>
					</div><!-- .entry-content -->
				</article><!-- #post-<?php the_ID(); ?> -->
			</div><!-- #content -->
		</div><!-- #primary -->

<?php get_footer(); ?>