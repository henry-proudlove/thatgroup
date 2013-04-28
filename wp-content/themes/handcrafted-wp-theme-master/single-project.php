<?php
/**
 * @package WordPress
 * @subpackage themename
 */

get_header(); ?>

		<div id="primary">
			<div id="content">

			<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
				<div id="carousel-holder">
					<div class="gradient"></div>
					<div id="carousel-images">
						<?php img_fecther() ?>
					</div><!--#carousel-images-->
				</div><!--#carousel-->
				<article id="post-<?php the_ID(); ?>" <?php post_class('main-article'); ?> role="article">
					<header class="entry-header">
						<h1 class="entry-title"><?php echo the_title(); ?></h1>
						<h2 class="entry-location"><?php echo $post->location; ?></h2>
					</header><!-- .entry-header -->
					<div class="lead-img">
						<?php if ( has_post_thumbnail() ) { 
								  the_post_thumbnail('tg-leadimg');
								} 
						?>
					</div><!--.lead-image-->
					<div class="entry-content">
						<?php the_content(); ?>
						<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'themename' ), 'after' => '</div>' ) ); ?>
					</div><!-- .entry-content -->
				<footer class="entry-meta">
					<?php edit_post_link( __( 'Edit', 'themename' ), '<span class="edit-link">', '</span>' ); ?>
				</footer><!-- .entry-meta -->
				</article><!-- #post-<?php the_ID(); ?> -->
				<nav id="nav-below" role="article">
					<div class="nav-previous"><?php previous_post_link( '%link', '<span class="meta-nav"></span><span class="nav-text">' . _x( '', 'Previous post link', 'themename' ) . '%title</span>' ); ?></div>
					<div class="nav-next"><?php next_post_link( '%link', '<span class="nav-text"> %title ' . _x( '', 'Next post link', 'themename' ) . '</span><span class="meta-nav"></span>' ); ?></div>
				</nav><!-- #nav-below -->
			<?php endwhile; // end of the loop. ?>

			</div><!-- #content -->
		</div><!-- #primary -->

<?php get_footer(); ?>