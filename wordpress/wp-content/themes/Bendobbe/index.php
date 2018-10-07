<?php get_header(); ?>
<div class="page-seperate"></div>
<div class="container">
    <div class="row">
        <div class="col s8">
            <h1>Blog</h1>

            <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

                <h1 class=""><a href="<?php echo get_permalink() ?>"><?php the_title(); ?></a></h1>

                <div>
                    <p><?php the_content(); ?></p>
                </div>

            <?php endwhile; ?>

            <?php else : ?>

            <?php endif; ?>

                <div>
                    <?php $mycustomquery = new WP_Query(array('category_name' => 'algemeen', 'posts_per_page' => '2')); ?>
                    <?php if ( $mycustomquery->have_posts() ) : while ( $mycustomquery->have_posts() ) : $mycustomquery->the_post(); ?>
                    <h1 class=""><a href="<?php get_permalink() ?>"><?php the_title(); ?></a></h1>

                        <div>
                            <p><?php the_content(); ?></p>
                        </div>

                    <?php endwhile; ?>
                    
                    <?php else : ?>

                    <?php endif; ?>

                </div>
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
        <div class='post-filters'>
        <form action="">
        <div class="input-field col s12">
                <select name="recipes">
                    <?php $args = array(
                        'post_type' => 'recipes',
                        'meta_query' => 'difficulty'
                    );
                    $filters = new WP_Query( $args ); ?>
                    <?php if ( $filters->have_posts() ) : while ( $filters->have_posts() ) : $filters->the_post(); ?>
                    <option value='<?php echo get_post_meta(get_the_ID(), 'meta-box-difficulty', TRUE); ?>'><?php echo get_post_meta(get_the_ID(), 'meta-box-difficulty', TRUE); ?></option> 
                            
                        <option value='<?php echo get_post_meta(get_the_ID(), 'category_name', TRUE); ?>'><?php echo get_post_meta(get_the_ID(), 'category_name', TRUE); ?></option>
                    <?php endwhile; ?>
                            
                    <?php else : ?>
                            
                    <?php endif; ?>
                </select>
                
                <input type='submit' value='Filter'>
            </div>
        </form>


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
                            <h3 class=""><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                        </div>
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
                    </div>
                </div>
                <hr class="recipe-line">
                
            </div>
            <?php endwhile; ?>
                            
            <?php else : ?>
            
            <?php endif; ?>
        </div>
    </div>
    <div class="row">
        [leaflet-map height=250 width=250 lat=44.67 lng=-63.61 zoom=5]
    </div>
</div>
<?php wp_reset_postdata(); ?>
<?php get_footer(); ?>
