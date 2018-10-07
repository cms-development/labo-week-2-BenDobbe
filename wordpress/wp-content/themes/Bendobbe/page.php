<?php 
/*
* Template Name: Page template
*/
?>

<?php get_header(); ?>
<h1><?php bloginfo(); ?></h1>

<div class="container">
            <h1 class=""><?php the_title(); ?></h1>

            <div>
                <p><?php the_content(); ?></p>
            </div>

</div>

<?php wp_reset_postdata(); ?>

<?php get_footer(); ?>
<?php get_sidebar('sidebar-2'); ?>