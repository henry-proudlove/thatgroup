<?php
/**
 * Template Name: Projects Page
 * Description: Holder for Projects Page
 *
 * @package WordPress
 * @subpackage themename
 */
 
get_header(); ?>

		<div id="primary">
			<div id="content">
				<section id="load">
					<?php
					$args = array('post_type' => 'project' , 'posts_per_page' => '5');
					$wp_query = new WP_Query($args);
					if( $wp_query->have_posts() ): while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>
							<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article">
								<a class="thumb-box" href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'themename' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">
								<?php if(has_post_thumbnail()){
									$thumb_id = get_post_thumbnail_id( get_the_ID() );
									//$url = wp_get_attachment_thumb_url( $thumb_id );
									//the_post_thumbnail('tg-projectthumb');
									print_r(wp_get_attachment_image_src($thumb_id));
								} ?>
								<div class="thumb-content">
									<header class="entry-header">
										<h1 class="entry-title"><?php the_title(); ?></h1>
										<h2 class="entry-location"><?php echo $post->location; ?></h2>
									</header><!-- .entry-header -->
								</div><!--.thumb-content-->
								</a>
							</article><!-- #post-<?php the_ID(); ?> -->
					<?php endwhile; ?>
					<?php else: ?>
						<article id="no-shops-msg"><h1>Sorry, no posts</h1></article>
					<?php endif;?>
				</section><!--#load-->
			</div><!-- #content -->
		</div><!-- #primary -->
		<?php /* Display navigation to next/previous pages when applicable */ ?>
		<?php if (  $wp_query->max_num_pages > 1 ) : ?>
			<nav id="nav-below" role="article">
				<h1 class="section-heading"><?php _e( 'Post navigation', 'themename' ); ?></h1>
				<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'themename' ) ); ?></div>
				<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'themename' ) ); ?></div>
			</nav><!-- #nav-below -->
		<?php endif; ?>
<?php get_footer(); ?>