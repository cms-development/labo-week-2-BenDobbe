<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package WordPress
 * @subpackage Bendobbe
 * @since Bendobbe 1.0
 */

get_header(); ?>
<div class="page-seperate"></div>

<div id="primary" class="container">
	<div class="row">
		<div class="col s8">
		<?php
		while ( have_posts() ) : the_post(); ?>

            <h1 class=""><?php the_title(); ?></h1>

            <div> 
                <p><?php the_content(); ?></p>
            </div>
        <?php
			if ( is_singular( 'attachment' ) ) {
				the_post_navigation( array(
					'prev_text' => _x( '<span class="meta-nav">Published in</span><span class="post-title">%title</span>', 'Parent post link', 'bendobbe' ),
				) );
			} elseif ( is_singular( 'post' ) ) {
				the_post_navigation( array(
					'next_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Next', 'bendobbe' ) . '</span> ' .
						'<span class="screen-reader-text">' . __( 'Next post:', 'bendobbe' ) . '</span> ' .
						'<span class="post-title">%title</span>',
					'prev_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Previous', 'bendobbe' ) . '</span> ' .
						'<span class="screen-reader-text">' . __( 'Previous post:', 'bendobbe' ) . '</span> ' .
						'<span class="post-title">%title</span>',
				) );
			}

		endwhile;
		?>
		</div>

            <div class="col s4">
                <div class="sidebar"> 
                    <div class="section-header">
                        <?php get_sidebar('sidebar-1'); ?> 
                    </div>
                </div>
            </div>
	</div>

<?php wp_reset_postdata(); ?>
<?php get_footer(); ?>
</div>


