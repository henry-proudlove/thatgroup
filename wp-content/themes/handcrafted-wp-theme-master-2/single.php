<?php
/**
 * @package WordPress
 * @subpackage themename
 */

get_header(); ?>

		<div id="primary">
			<div id="content" class="single">

			<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class('main-article'); ?> role="article">
					<header class="entry-header">
						<h1 class="entry-title"><?php the_title(); ?></h1>
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
						<time class="entry-date">Posted on <?php the_date('d.m.y'); ?></time>
						<?php edit_post_link( __( 'Edit', 'themename' ), '<span class="edit-link">', '</span>' ); ?>
					</footer><!-- .entry-meta -->
				</article><!-- #post-<?php the_ID(); ?> -->
				<?php 
					$cats = get_the_category();
					$cat_arr = array();
					foreach($cats as $cat){
						$cat_arr[] = $cat->term_id;
					}
					tg_rel_posts($cat_arr, 'Related News', $post->ID);
				?>
				<?php tg_nav_below(); ?>
			<?php endwhile; // end of the loop. ?>
			</div><!-- #content -->
		</div><!-- #primary -->

<?php get_footer(); ?>