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
					<div class="content-holder">
						<div class="lead-img">
						<?php if(has_post_thumbnail()){
									$thumb_id = get_post_thumbnail_id(get_the_ID());
									$img = wp_get_attachment_image_src($thumb_id , 'tg-leadimg');
									echo '<img src="' . $img[0] . '" class="single-leadimg" />';
								} ?>
						</div><!--.lead-image-->
						<div class="entry-content">
							<?php the_content(); ?>
						</div><!-- .entry-content -->
						<?php tg_nav_below(); ?>
					</div><!--.content-holder-->
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
			<?php endwhile; // end of the loop. ?>
			</div><!-- #content -->
		</div><!-- #primary -->

<?php get_footer(); ?>