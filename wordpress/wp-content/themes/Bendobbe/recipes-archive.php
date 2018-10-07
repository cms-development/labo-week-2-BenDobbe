<?php
/* 
Template Name: Recipes Archives
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
<?php wp_reset_postdata(); ?>
<?php get_footer(); ?>