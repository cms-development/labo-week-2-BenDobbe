<?php 
/*
* Template Name: Home
*/
?>

<?php get_header(); ?>
<div class="page-seperate"></div>
<div class="container">
	<div class="row">
            <div class='col s8'>
                    <h1><?php bloginfo(); ?></h1>
                    <h3>Most recent news</h3>
                    <?php $recentstePosts = new WP_Query(array('order_by' => 'post_date', 'order' => 'DESC', 'posts_per_page' => '2')); ?>
                    <?php if ( $recentstePosts->have_posts() ) : while ( $recentstePosts->have_posts() ) : $recentstePosts->the_post(); ?>
                        <h4 class=""><a href="<?php get_permalink() ?>"><?php the_title(); ?></a></h4>

                        <div> 
                            <p><?php the_content(); ?></p>
                        </div>

                    <?php endwhile; ?>
                    
                    <?php else : ?>

                    <?php endif; ?>

            <h2>Did you know?</h2>
                    <?php $mycustomquery = new WP_Query(array('category_name' => 'weetjes', 'posts_per_page' => '2')); ?>
                    <?php if ( $mycustomquery->have_posts() ) : while ( $mycustomquery->have_posts() ) : $mycustomquery->the_post(); ?>
                        <h4 class=""><a href="<?php get_permalink() ?>"><?php the_title(); ?></a></h4>

                        <div>
                            <p><?php the_content(); ?></p>
                        </div>

                    <?php endwhile; ?>
                    
                    <?php else : ?>

                    <?php endif; ?>
            </div>
            <div class="col s4">
                <div class="sidebar"> 
                    <div class="section-header">
                        <?php get_sidebar('sidebar-1'); ?> 
                    </div>
                </div>
            </div>
    </div>
</div>

<?php wp_reset_postdata(); ?>



<?php get_footer(); ?>
</div>