<?php

function job_application_form($template) {
    if(strpos($template, 'job-application-email.php') !== false){
        $template = AVADA_CHILD_THEME_DIRECTORY . '/templates/job-contact-form.php';
    }
    return $template;
}

add_filter('job_manager_locate_template', 'job_application_form');


function bootcamp_wpcf7_mail_components( $components ) {
    $submission = WPCF7_Submission::get_instance();

    if ($submission) {
        $post_id = (int) $submission->get_meta( 'container_post_id' );

        if ($post_id && get_post_type($post_id) == 'job_listing' && $email_company = is_email(get_post_meta($post_id,'_application',true))) {
            $components['recipient'] = $email_company;
        }
    }

    return $components;
}
add_filter( 'wpcf7_mail_components', 'bootcamp_wpcf7_mail_components');

function bootcamp_flamingo_add_inbound($args) {
    $submission = WPCF7_Submission::get_instance();

    if ($submission) {
        $post_id = (int)$submission->get_meta( 'container_post_id' );

        if ($post_id && get_post_type($post_id) == 'job_listing' && $args['subject'] == '[your-subject]') {
            $args['subject'] = isset($args['meta']['post_title']) ? $args['meta']['post_title'] : $args['subject'];
            $args['from'] = isset($args['fields']['job-user-firstname']) ? ($args['fields']['job-user-firstname'].' '.$args['fields']['job-user-lastname'].' <'.$args['fields']['job-user-email'].'>') : $args['from'];
            $args["from_name"] = isset($args['fields']['job-user-firstname']) ? ($args['fields']['job-user-firstname'].' '.$args['fields']['job-user-lastname']) : $args['from_name'];
            $args["from_email"] = isset($args['fields']['job-user-email']) ? ($args['fields']['job-user-email']) : $args['from_email'];
        }
    }

    return $args;
}
add_filter( 'flamingo_add_inbound', 'bootcamp_flamingo_add_inbound');


function bootcamp_wpcf7_before_send_mail( $contact_form ) {

    $submission = WPCF7_Submission::get_instance();

    if ($submission) {
        $post_id = (int) $submission->get_meta( 'container_post_id' );
        var_dump($post_id,get_the_ID(),$contact_form,$contact_form->get_properties(),$_POST);
        exit;
    }




    $post = get_post();
    var_dump($contact_form,$post);
    exit;
    // make action magic happen here...
};
//add_action( 'wpcf7_before_send_mail', 'bootcamp_wpcf7_before_send_mail', 10, 1 );