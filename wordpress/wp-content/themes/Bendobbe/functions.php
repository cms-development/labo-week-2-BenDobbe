<?php 
/**
 * bendobbe's functions and definitions
 *
 * @package bendobbe
 * @since bendobbe 1.0
 */
 
/**
 * First, let's set the maximum content width based on the theme's design and stylesheet.
 * This will limit the width of all uploaded images and embeds.
 */
if ( ! isset( $content_width ) )
    $content_width = 800; /* pixels */
 
if ( ! function_exists( 'bendobbe_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 */
function bendobbe_setup() {
 
    /**
     * Make theme available for translation.
     * Translations can be placed in the /languages/ directory.
     */
    load_theme_textdomain( 'bendobbe', get_template_directory() . '/languages' );
 
    /**
     * Add default posts and comments RSS feed links to <head>.
     */
    add_theme_support( 'automatic-feed-links' );
 
    /**
     * Enable support for post thumbnails and featured images.
     */
    add_theme_support( 'post-thumbnails' );
 
    /**
     * Add support for two custom navigation menus.
     */
    register_nav_menus( array(
        'primary'   => __( 'Primary Menu', 'bendobbe' ),
        'secondary' => __('Secondary Menu', 'bendobbe' ),
        'footer-menu' => __('Footer Menu', 'bendobbe')
    ) );
 
    /**
     * Enable support for the following post formats:
     * aside, gallery, quote, image, and video
     */
    add_theme_support( 'post-formats', array ( 'aside', 'gallery', 'quote', 'image', 'video' ) );
}
endif; // bendobbe_setup
add_action( 'after_setup_theme', 'bendobbe_setup' );

/**
 * Proper way to enqueue scripts and styles
 */
function Bendobbe_scripts() {
    wp_enqueue_style( 'material-style', get_template_directory_uri() . '/css/materialize.css' );
    wp_enqueue_style( 'style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_script( 'bendobbe-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );
    wp_enqueue_script( 'main', get_template_directory_uri() . '/js/main.js');
    //wp_enqueue_script( 'script-name', get_template_directory_uri() . '/js/example.js', array(), '1.0.0', true );
}
add_action( 'wp_enqueue_scripts', 'Bendobbe_scripts' );



//function add_filter( 'the_title', function( $title ) { return '<span class="awesome-title">' . $title . '</span>'; } );

/*add_filter('the_title', 'new_title', 10, 2);
function new_title($title, $id) {
    if('custom_version' == get_post_type($id))
        $title = '<span class="awesome-title">' . $title . '</span>';
    return $title;
}*/

/*function scratch_filter_title($title) {
    return '<span class="awesome-title">' . $title . '</span>';
}
add_filter('the_title', 'scratch_filter_title');

function scratch_filter_body($classes) {
    $classes[] = 'awesomeness';
    return $classes;
}
add_filter('body_class', 'scratch_filter_body');*/

function custom_meta_box_markup($object)
{
    wp_nonce_field(basename(__FILE__), "meta-box-nonce");

    ?>
        <div>
            <label for="meta-box-text">Text</label>
            <input name="meta-box-text" type="text" value="<?php echo get_post_meta($object->ID, "meta-box-text", true); ?>">

            <br>
        </div>
    <?php  
}

function add_custom_meta_box()
{
    add_meta_box("demo-meta-box", "Subtitel", "custom_meta_box_markup", "recipes", "side", "high", null);
}

add_action("add_meta_boxes", "add_custom_meta_box");

function save_custom_meta_box($post_id, $post, $update)
{
    if (!isset($_POST["meta-box-nonce"]) || !wp_verify_nonce($_POST["meta-box-nonce"], basename(__FILE__)))
        return $post_id;

    if(!current_user_can("edit_post", $post_id))
        return $post_id;

    if(defined("DOING_AUTOSAVE") && DOING_AUTOSAVE)
        return $post_id;

    $slug = "recipes";
    if($slug != $post->post_type)
        return $post_id;

    $meta_box_text_value = "";

    if(isset($_POST["meta-box-text"]))
    {
        $meta_box_text_value = $_POST["meta-box-text"];
    }   
    update_post_meta($post_id, "meta-box-text", $meta_box_text_value);
}

add_action("save_post", "save_custom_meta_box", 10, 3);

function add_custom_meta_box_before_post( $content ) {

    global $post;

    // retrieve the global notice for the current post
    $add_custom_meta_box = esc_attr( get_post_meta( $post->ID, 'meta-box-text', true ) );

    $notice = "<div class='sp_meta-box-text'>$add_custom_meta_box</div>";

    return $notice . $content;

}

add_filter( 'the_content', 'add_custom_meta_box_before_post' );

function ingredients_meta_box_markup($object)
{
    wp_nonce_field(basename(__FILE__), "meta-box-nonce");

    ?>
        <div>
            <label for="meta-box-ingredients">Text</label>
            <textarea style="width:100%" name="meta-box-ingredients" type="text" value="<?php echo get_post_meta($object->ID, "meta-box-ingredients", true); ?>"><?php echo get_post_meta($object->ID, "meta-box-ingredients", true); ?></textarea>

            <br>
        </div>
    <?php  
}

function add_ingredients_meta_box()
{
    add_meta_box("ingredients-meta-box", "Ingredients", "ingredients_meta_box_markup", "recipes", "side", "high", null);
}

add_action("add_meta_boxes", "add_ingredients_meta_box");

function save_ingredients_meta_box($post_id, $post, $update)
{
    if (!isset($_POST["meta-box-nonce"]) || !wp_verify_nonce($_POST["meta-box-nonce"], basename(__FILE__)))
        return $post_id;

    if(!current_user_can("edit_post", $post_id))
        return $post_id;

    if(defined("DOING_AUTOSAVE") && DOING_AUTOSAVE)
        return $post_id;

    $slug = "recipes";
    if($slug != $post->post_type)
        return $post_id;

    $meta_box_ingredients_value = "";

    if(isset($_POST["meta-box-ingredients"]))
    {
        $meta_box_ingredients_value = $_POST["meta-box-ingredients"];
    }   
    update_post_meta($post_id, "meta-box-ingredients", $meta_box_ingredients_value);
}

add_action("save_post", "save_ingredients_meta_box", 10, 3);

function add_ingredients_meta_box_before_post( $content ) {

    global $post;

    // retrieve the global notice for the current post
    $add_ingredients_meta_box = esc_attr( get_post_meta( $post->ID, 'meta-box-ingredients', true ) );

    $notice = "<div class='sp_meta-box-ingredients'>$add_ingredients_meta_box</div>";

    return $notice . $content;

}

add_filter( 'the_content', 'add_ingredients_meta_box_before_post' );

function difficulty_meta_box_markup($object)
{
    wp_nonce_field(basename(__FILE__), "meta-box-nonce");
    $difficulties = get_terms( array(
        'taxonomy' => 'Difficulty', 'hide_empty' => false));

    foreach ( $difficulties as $difficulty) {
    ?>
        <div>
            <label title='<?php esc_attr_e( $difficulty->name ); ?>' for="meta-box-difficulty">
                <input name="meta-box-difficulty" type="radio" value="<?php esc_attr_e( $difficulty->name ); ?>" <?php checked( $difficulty->name ); ?>>
                <span><?php esc_html_e( $difficulty->name ); ?></span>
            </label>
            <br>
        </div>
    <?php  
    }
}

function add_difficulty_meta_box()
{
    add_meta_box("difficulty-meta-box", "difficulty", "difficulty_meta_box_markup", "recipes", "side", "high", null);
}

add_action("add_meta_boxes", "add_difficulty_meta_box");

function save_difficulty_meta_box($post_id, $post, $update)
{
    if (!isset($_POST["meta-box-nonce"]) || !wp_verify_nonce($_POST["meta-box-nonce"], basename(__FILE__)))
        return $post_id;

    if(!current_user_can("edit_post", $post_id))
        return $post_id;

    if(defined("DOING_AUTOSAVE") && DOING_AUTOSAVE)
        return $post_id;

    $slug = "recipes";
    if($slug != $post->post_type)
        return $post_id;

    $meta_box_difficulty_value = "";

    if(isset($_POST["meta-box-difficulty"]))
    {
        $meta_box_difficulty_value = $_POST["meta-box-difficulty"];
    }   
    update_post_meta($post_id, "meta-box-difficulty", $meta_box_difficulty_value);
}

add_action("save_post", "save_difficulty_meta_box", 10, 3);

function add_difficulty_meta_box_before_post( $content ) {

    global $post;

    // retrieve the global notice for the current post
    $add_difficulty_meta_box = esc_attr( get_post_meta( $post->ID, 'meta-box-difficulty', true ) );

    $notice = "<div class='sp_meta-box-difficulty'>$add_difficulty_meta_box</div>";

    return $notice . $content;

}

add_filter( 'the_content', 'add_difficulty_meta_box_before_post' );



function custom_post_type_recipes() {
    $labels = array(
      'name'               => _x( 'recipes', 'post type general name' ),
      'singular_name'      => _x( 'recipe', 'post type singular name' ),
      'add_new'            => _x( 'Add New recipe', 'recipe' ),
      'add_new_item'       => __( 'Add New recipes item' ),
      'edit_item'          => __( 'Edit recipes item' ),
      'new_item'           => __( 'New recipes item' ),
      'all_items'          => __( 'All recipes items' ),
      'view_item'          => __( 'View recipes item' ),
      'search_items'       => __( 'Search recipes items' ),
      'not_found'          => __( 'No recipes item found' ),
      'not_found_in_trash' => __( 'No recipes item found in the Trash' ),
      'parent_item_colon'  => '',
      'menu_name'          => 'recipes'
    );
    $args = array(
      'labels'        => $labels,
      'description'   => 'Holds our recipes items specific data',
      'public'        => true,
      'publicity_queryable' => true,
      'query_var' => true,
      'rewrite' => array('slug' => 'recipes'),
      'capability_type' => 'post',
      'menu_position' => 5,
          'menu_icon'     => 'dashicons-carrot',
      'supports'      => array( 'title', 'editor', 'thumbnail', 'excerpt', 'comments', 'revisions', 'custom-fields'),
      'has_archive'   => true,
      'taxonomies' => array(
          'category', 'post_tag'
      ),
      'meta_box_cb' => array(
          'add_custom_meta_box', 'add_ingredients_meta_box'
        ),
    );
    register_post_type( 'recipes', $args );
  }
  
add_action( 'init', 'custom_post_type_recipes' );

function taxonomies_recipes() {
    $labels = array(
      'name'              => _x( 'allergenen', 'taxonomy general name' ),
      'singular_name'     => _x( 'allergenen', 'taxonomy singular name' ),
      'search_items'      => __( 'Search allergenen' ),
      'all_items'         => __( 'All allergenen' ),
      'parent_item'       => __( 'Parent allergenen' ),
      'parent_item_colon' => __( 'Parent allergenen:' ),
      'edit_item'         => __( 'Edit allergenen' ),
      'update_item'       => __( 'Update allergenen' ),
      'add_new_item'      => __( 'Add New allergenen' ),
      'new_item_name'     => __( 'New allergenen' ),
      'menu_name'         => __( 'allergenen' )
    );
    $args = array(
      'labels' => $labels,
      'hierarchical' => true,
    );
    register_taxonomy( 'allergenen', 'recipes', $args );

    $labels = array(
        'name'              => _x( 'Difficulty', 'taxonomy general name' ),
        'singular_name'     => _x( 'Difficulty', 'taxonomy singular name' ),
        'search_items'      => __( 'Search Difficulty' ),
        'all_items'         => __( 'All Difficulty' ),
        'parent_item'       => __( 'Parent Difficulty' ),
        'parent_item_colon' => __( 'Parent Difficulty:' ),
        'edit_item'         => __( 'Edit Difficulty' ),
        'update_item'       => __( 'Update Difficulty' ),
        'add_new_item'      => __( 'Add New Difficulty' ),
        'new_item_name'     => __( 'New Difficulty' ),
        'menu_name'         => __( 'Difficulty' ),
      );
      $args = array(
        'labels' => $labels,
        'hierarchical' => true,
        'meta_box_cb'       => 'add_difficulty_meta_box',
      );
      register_taxonomy( 'Difficulty', 'recipes', $args );  

      $labels = array(
        'name'              => _x( 'Recipe categories', 'taxonomy general name' ),
        'singular_name'     => _x( 'Recipe categories', 'taxonomy singular name' ),
        'search_items'      => __( 'Search Recipe categories' ),
        'all_items'         => __( 'All Recipe categories' ),
        'parent_item'       => __( 'Parent Recipe categories' ),
        'parent_item_colon' => __( 'Parent Recipe categories:' ),
        'edit_item'         => __( 'Edit Recipe categories' ),
        'update_item'       => __( 'Update Recipe categories' ),
        'add_new_item'      => __( 'Add New Recipe categories' ),
        'new_item_name'     => __( 'New Recipe categories' ),
        'menu_name'         => __( 'Recipe categories' )
      );
      $args = array(
        'labels' => $labels,
        'hierarchical' => true,
      );
      register_taxonomy( 'Recipe_categories', 'recipes', $args );  

  }
add_action( 'init', 'taxonomies_recipes', 0 );


function custom_post_type_events() {
    $labels = array(
      'name'               => _x( 'events', 'post type general name' ),
      'singular_name'      => _x( 'events item', 'post type singular name' ),
      'add_new'            => _x( 'Add New events', 'events' ),
      'add_new_item'       => __( 'Add New events item' ),
      'edit_item'          => __( 'Edit events item' ),
      'new_item'           => __( 'New events item' ),
      'all_items'          => __( 'All events items' ),
      'view_item'          => __( 'View events item' ),
      'search_items'       => __( 'Search events items' ),
      'not_found'          => __( 'No events item found' ),
      'not_found_in_trash' => __( 'No events item found in the Trash' ),
      'parent_item_colon'  => '',
      'menu_name'          => 'events'
    );
    $args = array(
      'labels'        => $labels,
      'description'   => 'Holds our events items specific data',
      'public'        => true,
      'publicity_queryable' => true,
      'query_var' => true,
      'rewrite' => array('slug' => 'videos'),
      'capability_type' => 'post',
      'menu_position' => 5,
          'menu_icon'     => 'dashicons-megaphone',
      'supports'      => array( 'title', 'editor', 'thumbnail', 'excerpt', 'comments', 'revisions', 'custom-fields'),
      'has_archive'   => true,
      'taxonomies' => array(
          'category', 'post_tag'
      )
    );
    register_post_type( 'events', $args );
  }
  
add_action( 'init', 'custom_post_type_events' );

function taxonomies_events() {
    $labels = array(
        'name'              => _x( 'Provincie', 'taxonomy general name' ),
        'singular_name'     => _x( 'Provincies', 'taxonomy singular name' ),
        'search_items'      => __( 'Search Provincie' ),
        'all_items'         => __( 'All Provincie' ),
        'parent_item'       => __( 'Parent Provincie' ),
        'parent_item_colon' => __( 'Parent Provincie:' ),
        'edit_item'         => __( 'Edit Provincie' ),
        'update_item'       => __( 'Update Provincie' ),
        'add_new_item'      => __( 'Add New Provincie' ),
        'new_item_name'     => __( 'New Provincie' ),
        'menu_name'         => __( 'Provincie' )
      );
      $args = array(
        'labels' => $labels,
        'hierarchical' => true,
      );
      register_taxonomy( 'Provincie', 'events', $args ); 

      $labels = array(
        'name'              => _x( 'tags', 'taxonomy general name' ),
        'singular_name'     => _x( 'tags', 'taxonomy singular name' ),
        'search_items'      => __( 'Search tags' ),
        'all_items'         => __( 'All tags' ),
        'parent_item'       => __( 'Parent tags' ),
        'parent_item_colon' => __( 'Parent tags:' ),
        'edit_item'         => __( 'Edit tags' ),
        'update_item'       => __( 'Update tags' ),
        'add_new_item'      => __( 'Add New tags' ),
        'new_item_name'     => __( 'New tags' ),
        'menu_name'         => __( 'tags' )
      );
      $args = array(
        'labels' => $labels,
        'hierarchical' => true,
      );
      register_taxonomy( 'tags', 'events', $args ); 

      $labels = array(
        'name'              => _x( 'setting', 'taxonomy general name' ),
        'singular_name'     => _x( 'setting', 'taxonomy singular name' ),
        'search_items'      => __( 'Search setting' ),
        'all_items'         => __( 'All setting' ),
        'parent_item'       => __( 'Parent setting' ),
        'parent_item_colon' => __( 'Parent setting:' ),
        'edit_item'         => __( 'Edit setting' ),
        'update_item'       => __( 'Update setting' ),
        'add_new_item'      => __( 'Add New setting' ),
        'new_item_name'     => __( 'New setting' ),
        'menu_name'         => __( 'setting' )
      );
      $args = array(
        'labels' => $labels,
        'hierarchical' => true,
      );
      register_taxonomy( 'setting', 'events', $args ); 
  }
  add_action( 'init', 'taxonomies_events', 0 );

function custom_post_type_games() {
    $labels = array(
      'name'               => _x( 'games', 'post type general name' ),
      'singular_name'      => _x( 'games item', 'post type singular name' ),
      'add_new'            => _x( 'Add New games', 'games' ),
      'add_new_item'       => __( 'Add New games item' ),
      'edit_item'          => __( 'Edit games item' ),
      'new_item'           => __( 'New games item' ),
      'all_items'          => __( 'All games items' ),
      'view_item'          => __( 'View games item' ),
      'search_items'       => __( 'Search games items' ),
      'not_found'          => __( 'No games item found' ),
      'not_found_in_trash' => __( 'No games item found in the Trash' ),
      'parent_item_colon'  => '',
      'menu_name'          => 'games'
    );
    $args = array(
      'labels'        => $labels,
      'description'   => 'Holds our games items specific data',
      'public'        => true,
      'publicity_queryable' => true,
      'query_var' => true,
      'rewrite' => array('slug' => 'videos'),
      'capability_type' => 'post',
      'menu_position' => 5,
          'menu_icon'     => 'dashicons-smiley',
      'supports'      => array( 'title', 'editor', 'thumbnail', 'excerpt', 'comments', 'revisions', 'custom-fields'),
      'has_archive'   => true,
      'taxonomies' => array(
          'category', 'post_tag'
      )
    );
    register_post_type( 'games', $args );
  }
  
add_action( 'init', 'custom_post_type_games' );






function bendobbe_widgets_init() {
    register_sidebar( array(
        'name'          => __( 'Primary Sidebar', 'bendobbe' ),
        'id'            => 'sidebar-1',
        'before_widget' => '<aside id="%1$s" class="widget %2$s wow fadeInDown animated" data-wow-delay="0.4s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<div class="section-header wow fadeInDown animated" data-wow-delay="0.4s"><h3 class="widget-title">',
        'after_title'   => '</h3></div>',
    ) );
 
    register_sidebar( array(
        'name'          => __( 'Secondary Sidebar', 'bendobbe' ),
        'id'            => 'sidebar-2',
        'before_widget' => '<ul><li id="%1$s" class="widget %2$s">',
        'after_widget'  => '</li></ul>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );

    register_sidebar( array(
        'name'          => __( 'Filtering sidebar', 'bendobbe' ),
        'id'            => 'filterbar',
        'before_widget' => '<ul><li id="%1$s" class="widget %2$s">',
        'after_widget'  => '</li></ul>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );
}
add_action( 'widgets_init', 'bendobbe_widgets_init' );

?>