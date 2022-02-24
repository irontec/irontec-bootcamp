<?php

function bootcamp_width_course($value) {
    if (get_post_type() == 'lp_course') {
        return true;
    }

    return $value;
}
add_filter( 'fusion_is_hundred_percent_template', 'bootcamp_width_course',15);

function jobs_rel_course() {
    $post_id = get_the_ID();
    $job_offers = get_field('job_offers', $post_id);

    $list = '';

    if ($job_offers) {
        foreach ($job_offers as $id) {
            $url = get_permalink($id);
            $title = get_the_title($id);

            $list .= '<li><a href="'.$url.'" target="_blank">'.$title.'</a></li>';
        }
    }

    if (empty($list)) {
        echo '<p>'.__( 'None', 'bootcamp' ).'</p>';
    } else {
        echo '<ul>'.$list.'</ul>';
    }
}

function jobs_course_tabs($defaults) {
    $defaults['jobs_course'] = array(
        'title'    => __( 'Job offers', 'bootcamp' ),
        'priority' => 60,
        'callback' => 'jobs_rel_course',
    );

    return $defaults;
}
add_filter( 'learn-press/course-tabs', 'jobs_course_tabs', 60);

function lesson_comments_open($active) {
    $post_id = get_the_ID();
    $post_types = array('lp_course','lp_lesson');

    if ($post_id) {
        $post_type = get_post_type($post_id);

        if (in_array($post_type,$post_types)) {
            return false;
        }
    }

    return $active;
}
add_filter( 'comments_open', 'lesson_comments_open');

function bootcamp_theme_styles() {
    wp_enqueue_style( 'bootcamp-lesson-style', get_stylesheet_directory_uri() . '/css/course.css', array( 'bootcamp-stylesheet' ) );
}
add_action( 'wp_enqueue_scripts', 'bootcamp_theme_styles' );