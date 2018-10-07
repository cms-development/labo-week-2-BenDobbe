<?php
/*
Template Name: Recipes page template
Template Post Type: recipes
*/
?>

<?php get_header(); ?>
<div class="page-seperate"></div>
<div class="container">
    <div class="row">
        <div class="col s8">
            <h1>XDDDDDDDDDD</h1>
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
        <div class="col s12">
        <?php 
                $args = array(
                'post_type' => 'recipes',
                'post_status' => 'publish'
            );
            $recipes = new WP_Query( $args ); ?>
            <?php if ( $recipes->have_posts() ) : while ( $recipes->have_posts() ) : $recipes->the_post(); ?>
            <div class="recipe-wrapper">
                <div class="row">
                    <div class="recipe-item">
                        <div class="col s3">
                            <h3 class=""><a href="<?php get_permalink() ?>"><?php the_title(); ?></a></h3>
                        </div>
                        <div class="col s3">
                            <p><?php echo get_post_meta(get_the_ID(), 'introtekst', TRUE); ?></p>
                        </div>
                        <div class="col s2">
                            <h4><?php echo get_post_meta(get_the_ID(), 'meta-box-text', TRUE); ?></h4>
                        </div>
                        <div class="col s1">
                            <p><?php echo get_post_meta(get_the_ID(), 'difficulty', TRUE); ?></p>
                        </div>
                        <div class="col s3">
                            <span class="recipe-image"><?php get_post_meta(get_the_ID(), the_post_thumbnail(), TRUE); ?></span>
                        </div>
                    </div>
                </div>
                <hr class="recipe-line">
            </div>
            <?php endwhile; ?>
                            
            <?php else : ?>
            
            <?php endif; ?>
        </div>
    </div>
</div>
<?php wp_reset_postdata(); ?>
<?php get_footer(); ?>
