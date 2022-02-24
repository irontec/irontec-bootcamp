<?php
define('AVADA_CHILD_THEME_URL', esc_url(trailingslashit( get_stylesheet_directory_uri() )));
define('AVADA_CHILD_THEME_DIRECTORY', get_template_directory().'-Child-Theme');

function theme_enqueue_styles() {
    wp_enqueue_style('theme-override', get_stylesheet_directory_uri() . '/css/course.css', array(), '0.1.0', 'all');
    wp_enqueue_script( 'bootcamp_jquery_migrate',get_stylesheet_directory_uri() . '/js/jquery-migrate-3.3.2-wp.js', array( 'jquery' ), '1.0' );
}
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );

/**
 * Bootcamp Course
 */

/*require AVADA_CHILD_THEME_DIRECTORY . '/inc/tax-course.php';*/
require AVADA_CHILD_THEME_DIRECTORY . '/inc/course-template.php';


/**
 * Bootcamp Job Form
 */
require AVADA_CHILD_THEME_DIRECTORY . '/inc/job-form.php';

/**
 * Bootcamp Login
 */
require AVADA_CHILD_THEME_DIRECTORY . '/inc/login-form.php';

/**
 * Bootcamp Account Tab
 */
require AVADA_CHILD_THEME_DIRECTORY . '/inc/account-tab.php';