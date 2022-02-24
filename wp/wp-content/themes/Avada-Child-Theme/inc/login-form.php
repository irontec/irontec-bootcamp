<?php

function bootcamp_login() {
    wp_enqueue_style( 'custom-bootcamp-login', AVADA_CHILD_THEME_URL . 'css/login.css' );
}

//add_action( 'login_enqueue_scripts', 'bootcamp_login' );

function bootcamp_login_redirect( $redirect_to, $request, $user ) {
    if ( isset( $user->roles ) && is_array( $user->roles ) && function_exists('learn_press_get_page_id')) {

        $id_page_profile = learn_press_get_page_id( 'profile' );

        if ( !in_array( 'administrator', $user->roles ) && $id_page_profile) {
            return get_permalink($id_page_profile);
        }
    }

    return $redirect_to;
}

add_filter( 'login_redirect', 'bootcamp_login_redirect', 10, 3 );

function bootcamp_hide_admin_bar($show) {
    $user_id = get_current_user_id();

    if (!$user_id) {
        return $show;
    }

    $user = get_userdata( $user_id );

    if (in_array( 'administrator', $user->roles )) {
        return $show;
    }

    return false;
}
add_filter( 'show_admin_bar', 'bootcamp_hide_admin_bar' );

function bootcamp_profile_redirect_to_page() {
    if (!function_exists('learn_press_get_page_id')) {
        return false;
    }

    $user_id = get_current_user_id();

    if (!$user_id) {
        return false;
    }

    $user = get_userdata( $user_id );

    if (in_array( 'administrator', $user->roles )) {
        return false;
    }

    $id_page_profile = learn_press_get_page_id( 'profile' );

    exit( wp_safe_redirect( get_permalink($id_page_profile) ) );
}

add_action( 'load-profile.php', 'bootcamp_profile_redirect_to_page' );

function bootcamp_remove_adminbar() {
    if( !current_user_can( 'administrator' ) ) {
        remove_menu_page( 'edit-comments.php' );
        remove_menu_page( 'edit.php' );
        remove_menu_page( 'tools.php' );
        remove_menu_page( 'upload.php' );
        remove_menu_page( 'profile.php' );
    }
}

add_action( 'admin_menu', 'bootcamp_remove_adminbar' );

function bootcamp_remove_logo_wp_admin() {
    global $wp_admin_bar;
    $wp_admin_bar->remove_menu( 'wp-logo' );
}
add_action( 'wp_before_admin_bar_render', 'bootcamp_remove_logo_wp_admin', 0 );

add_filter( 'admin_footer_text', '__return_empty_string', 11 );
add_filter( 'update_footer',     '__return_empty_string', 11 );

function bootcamp_form_account_template($location) {
    if (strpos($location, 'global/form-login.php') !== false) {
        $location = AVADA_CHILD_THEME_DIRECTORY.'/templates/global/form-login.php';
    }

    if (strpos($location, 'global/form-register.php') !== false) {
        $location = AVADA_CHILD_THEME_DIRECTORY.'/templates/global/form-register.php';
    }

    return $location;
}

add_filter( 'learn_press_get_template', 'bootcamp_form_account_template');