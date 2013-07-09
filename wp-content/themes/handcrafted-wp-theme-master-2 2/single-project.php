<?php
/**
 * @package WordPress
 * @subpackage themename
 */

get_header(); ?>

		<div id="primary">
			<div id="content" class="project">

			<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
				<?php img_fecther() ?>
				<article id="post-<?php the_ID(); ?>" <?php post_class('main-article'); ?> role="article">
					<header class="entry-header">
						<h1 class="entry-title"><?php echo the_title(); ?></h1>
						<h2 class="entry-location"><?php echo $post->location; ?></h2>
					</header><!-- .entry-header -->
					<div class="content-holder">
						<div class="entry-content">
							<?php the_content(); ?>
						</div><!-- .entry-content -->
						<?php tg_nav_below(); ?>
					</div><!--.entry-holder-->
				<footer class="entry-meta">
					<?php edit_post_link( __( 'Edit', 'themename' ), '<span class="edit-link">', '</span>' ); ?>
				</footer><!-- .entry-meta -->
				</article><!-- #post-<?php the_ID(); ?> -->
				<?php
					tg_rel_posts($post->project_cat, 'Related News');
				?>
			<?php endwhile; // end of the loop. ?>

			</div><!-- #content -->
		</div><!-- #primary -->

<?php get_footer(); ?>