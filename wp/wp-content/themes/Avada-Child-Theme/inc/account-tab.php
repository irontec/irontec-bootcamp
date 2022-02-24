<?php

function account_job_tab_form($tabs) {
    $user_id = get_current_user_id();

    if (!$user_id) {
        return $tabs;
    }
    
    $user = get_userdata( $user_id );

    if ( in_array( 'employer', $user->roles) || in_array( 'administrator', $user->roles)) {
        $tabs['jobs_list'] = array(
            'title'    => esc_html__( 'Jobs', 'bootcamp' ),
            'slug'     => esc_html__( 'job-general', 'bootcamp' ),
            'callback' => 'tab_jobs_list',
            'sections' => array(
                'jobs_list' => array(
                    'title'    => esc_html__( 'Jobs list', 'bootcamp' ),
                    'slug'     => esc_html__( 'job-list', 'bootcamp' ),
                    'callback' => 'tab_jobs_list',
                    'priority' => 10
                ),
                'job_add'   => array(
                    'title'    => esc_html__( 'Jobs add', 'bootcamp' ),
                    'slug'     => esc_html__( 'job-add', 'bootcamp' ),
                    'callback' => 'tab_jobs_create_form',
                    'priority' => 15,
                ),
            ),
            'priority' => 36,
            'icon'     => '<i class="fas fa-building"></i>'
        );
    }

    if ( !in_array( 'administrator', $user->roles) && !in_array( 'lp_teacher', $user->roles)) {
        $tabs['become_a_teacher'] = array(
            'title'    => esc_html__( 'Become a Teacher', 'learnpress' ),
            'slug'     => esc_html__( 'become-a-teacher', 'bootcamp' ),
            'callback' => 'tab_become_a_teacher',
            'priority' => 35,
            'icon'     => '<i class="fas fa-chalkboard-teacher"></i>',
        );
    }

    return $tabs;
}

add_filter('learn-press/profile-tabs', 'account_job_tab_form');

function tab_jobs_list() {
    echo do_shortcode('[job_dashboard]');
}

function tab_jobs_create_form() {
    echo do_shortcode('[submit_job_form]');
}

function bootcamp_job_manager_enqueue_frontend_style($valid) {
    if (learn_press_get_page_id( 'profile' ) == get_the_ID()) {
        $valid = true;
    }
    return $valid;
}

add_filter('job_manager_enqueue_frontend_style', 'bootcamp_job_manager_enqueue_frontend_style');

function tab_become_a_teacher() {
    echo do_shortcode('[learn_press_become_teacher_form]');
}