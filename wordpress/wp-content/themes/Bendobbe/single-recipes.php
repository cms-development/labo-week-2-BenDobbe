<?php
/**
 * The template for displaying recipe posts and attachments
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
        	<?php while ( have_posts() ) : the_post(); ?>
			<h1 class=""><a href="<?php get_post_permalink() ?>"><?php the_title(); ?></a></h1>
                        <div class="col s3">
                            <p><?php echo get_post_meta(get_the_ID(), 'introtekst', TRUE); ?></p>
                        </div>
                        <div class="col s2">
                            <h4><?php echo get_post_meta(get_the_ID(), 'meta-box-text', TRUE); ?></h4>
                        </div>
                        <div class="col s1">
                            <p><?php echo get_post_meta(get_the_ID(), 'meta-box-difficulty', TRUE); ?></p>
                        </div>
                        <div class="col s3">
                            <span class="recipe-image"><?php get_post_meta(get_the_ID(), the_post_thumbnail(), TRUE); ?></span>
                        </div>
						<div class="col s8">
							<p><?php echo get_post_meta(get_the_ID(), 'meta-box-ingredients', TRUE); ?></p>
						</div>
						<div class="col s2">
							<p><?php echo get_post_meta(get_the_ID(), 'bevat_alcohol', TRUE); ?></p>
						</div>
						<div class="col s2">
							<p><?php echo get_post_meta(get_the_ID(), 'extra_tips', TRUE); ?></p>
						</div>
                <hr class="recipe-line">
            <?php endwhile; ?>
		</div>

            <div class="col s4">
                <div class="sidebar"> 
                    <div class="section-header">
                        <?php get_sidebar('sidebar-1'); ?> 
                    </div>
                </div>
            </div>
	</div>
	<div class="row">
		<div class="col s6">
		<span class="recipe-image"><?php get_post_meta(get_the_ID(), 'twee_extra_afbeeldingen', TRUE); ?></span>
		</div>
		<div class="col s6">
		<span class="recipe-image"><?php get_post_meta(get_the_ID(), 'twee_extra_afbeeldingen_copy', TRUE); ?></span>
		</div>
	</div>

<?php wp_reset_postdata(); ?>
</div>

<?php get_footer(); ?>


