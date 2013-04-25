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
					<?php
						$args = array('post_type' => 'tg_project', 'posts_per_page' => '-1');
						$wp_query = new WP_Query($args);
						if( $wp_query->have_posts() ): while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>
								<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> role="article">
									<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'themename' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">
									<?php if(has_post_thumbnail()){
										the_post_thumbnail('tg-projectthumb');
									} ?>
									<header class="entry-header">
										<h1 class="entry-title"><?php the_title(); ?></h1>
										<h2 class="entry-location">
									</header><!-- .entry-header -->
									</a>
								</article><!-- #post-<?php the_ID(); ?> -->
						<?php endwhile; ?>
						<?php else: ?>
							<article id="no-shops-msg"><h1>Sorry, no posts</h1></article>
						<?php endif;?>
				</div><!-- #content -->
		</div><!-- #primary -->

<?php get_footer(); ?>