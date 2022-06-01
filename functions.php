<?php
require get_template_directory() . '/includes/hello.php';
function create_posttype()
{
    register_post_type(
        'book',
        // CPT Options
        array(
            'labels' => array(
                'name' => __('book'),
                'singular_name' => __('Book')
            ),
            'public' => true,
            'has_archive' => false,
            'rewrite' => array('slug' => 'book'),
        )
    );
}
// Hooking up our function to theme setup
add_action('init', 'create_posttype');
/* Custom Post Type End */


function first_taxonomy()
{

    $args = array(

        'labels' => array(
            'name' => 'book category',
            'singular_name' => 'category',
        ),

        'public' => true,
        'hierarchical' => true,

    );


    register_taxonomy('book title', array('book'), $args);
}
add_action('init', 'first_taxonomy');

// second taxonomy

function second_taxonomy()
{

    $args = array(

        'labels' => array(
            'name' => 'book tags',
            'singular_name' => 'tags',
        ),

        'public' => true,
        'hierarchical' => true,

    );


    register_taxonomy('book topic', array('book'), $args);
}
add_action('init', 'second_taxonomy');

//menu
function custom_new_menu() {
    register_nav_menus(
        array(
            'header' =>'Header Menu',
            'footer' =>'Footer Menu',
        )
        );

  }
  add_action( 'init', 'custom_new_menu' );

  //adding ne post type
  add_action('pre_get_posts', 'add_my_post_types_to_query');
function add_my_post_types_to_query($query)
{
    if (is_home() && $query->is_main_query())
        $query->set('post_type', array('post', 'book'));
    return $query;
}