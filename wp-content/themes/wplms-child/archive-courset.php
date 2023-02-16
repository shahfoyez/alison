<?php 

if ( !defined( 'ABSPATH' ) ) exit;
do_action('wplms_before_course_directory');

get_header( vibe_get_header() ); 

$directory_layout = vibe_get_customizer('directory_layout');





// $args = array(
//     'post_type' => 'course',
//     'post_status' => 'publish',
//     'order' => 'ASC',
//     'posts_per_page' => 2,
// );

// $the_query = new WP_Query( $args );

global $wp_query;

// Modify the query to exclude courses with certain categories
$wp_query->set( 
    'tax_query', array(
    array(
        'taxonomy' => 'course-cat',
        'field' => 'term_id',
        'terms' => array( 46 ),
        'operator' => 'NOT IN',

    ),
) );

vibe_include_template("directory/course/index$directory_layout.php", array( 'the_query' => $the_query ));  

get_footer( vibe_get_footer() ); 
