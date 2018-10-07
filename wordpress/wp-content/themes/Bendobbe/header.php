<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://unpkg.com/scrollreveal"></script>
    <script>
        ScrollReveal({ reset: true });
    </script>
    <title>Document</title>
    <?php wp_head(); ?>
</head>
<body <?php echo body_class();?> >

		<nav id="site-navigation" class="main-navigation" role="navigation">
			
			<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
		</nav><!-- #site-navigation -->
        