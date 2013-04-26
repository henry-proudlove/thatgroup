<?php
/**
 * @package WordPress
 * @subpackage themename
 */

get_header(); ?>

		<div id="primary">
			<div id="content">

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
				<?php
				$args = array('post_type' => 'people' , 'posts_per_page' => '-1');
				$wp_query
				= new WP_Query($args);
				if( $wp_query->have_posts() ): while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>
						<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> role="article">
							<a class="ajax-link" href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'themename' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">
							<?php if(has_post_thumbnail()){
								the_post_thumbnail('tg-projectthumb');
							}
							?>
							<header class="entry-header">
								<h1 class="entry-title">
									<span class="name"><?php the_title(); ?></span>
									<span class="quali">
										<?php echo implode( ',', clean_quali($post->quali) ); ?>
									</span>
								</h1>
								<h2 class="entry-role"><?php echo $post->jobtitle; ?></h2>
							</a>
						</article><!-- #post-<?php the_ID(); ?> -->
				<?php endwhile; ?>
				<?php else: ?>
					<article id="no-shops-msg"><h1>Sorry, no posts</h1></article>
				<?php endif;?>
			</div><!-- #content -->
		</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>