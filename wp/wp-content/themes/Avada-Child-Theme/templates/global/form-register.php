<?php
/**
 * Template for displaying global login form.
 *
 * This template can be overridden by copying it to yourtheme/learnpress/global/form-register.php.
 *
 * @author   ThimPress
 * @package  Learnpress/Templates
 * @version  4.0.0
 */

defined( 'ABSPATH' ) || exit();
?>
<?php ob_start(); ?>
<div class="learn-press-form-register learn-press-form">

	<h3><?php echo esc_html_x( 'Register', 'register-heading', 'learnpress' ); ?></h3>

	<?php do_action( 'learn-press/before-form-register' ); ?>

	<form name="learn-press-register" method="post" action="">

		<ul class="form-fields">

			<?php do_action( 'learn-press/before-form-register-fields' ); ?>

			<li class="form-field">
				<label for="reg_email"><?php esc_html_e( 'Email address', 'learnpress' ); ?>&nbsp;<span class="required">*</span></label>
				<input id ="reg_email" name="reg_email" type="text" placeholder="<?php esc_attr_e( 'Email', 'learnpress' ); ?>" autocomplete="email" value="<?php echo ( ! empty( $_POST['reg_email'] ) ) ? esc_attr( LP_Helper::sanitize_params_submitted( $_POST['reg_email'] ) ) : ''; ?>">
			</li>
			<li class="form-field">
				<label for="reg_username"><?php esc_html_e( 'Username', 'learnpress' ); ?>&nbsp;<span class="required">*</span></label>
				<input id ="reg_username" name="reg_username" type="text" placeholder="<?php esc_attr_e( 'Username', 'learnpress' ); ?>" autocomplete="username" value="<?php echo ( ! empty( $_POST['reg_username'] ) ) ? esc_attr( LP_Helper::sanitize_params_submitted( $_POST['reg_username'] ) ) : ''; ?>">
			</li>
			<li class="form-field">
				<label for="reg_password"><?php esc_html_e( 'Password', 'learnpress' ); ?>&nbsp;<span class="required">*</span></label>
				<input id ="reg_password" name="reg_password" type="password" placeholder="<?php esc_attr_e( 'Password', 'learnpress' ); ?>" autocomplete="new-password">
			</li>
			<li class="form-field">
				<label for="reg_password2"><?php esc_html_e( 'Confirm Password', 'learnpress' ); ?>&nbsp;<span class="required">*</span></label>
				<input id ="reg_password2" name="reg_password2" type="password" placeholder="<?php esc_attr_e( 'Password', 'learnpress' ); ?>" autocomplete="off">
			</li>

			<?php do_action( 'learn-press/after-form-register-fields' ); ?>
		</ul>

		<?php do_action( 'register_form' ); ?>

		<p>
			<?php wp_nonce_field( 'learn-press-register', 'learn-press-register-nonce' ); ?>
			<button type="submit"><?php esc_html_e( 'Register', 'learnpress' ); ?></button>
		</p>

	</form>

	<?php do_action( 'learn-press/after-form-register' ); ?>

</div>
<?php $form_register = ob_get_clean(); ?>

<?php echo do_shortcode('[fusion_builder_column align_self="auto" content_layout="column" align_content="flex-start" valign_content="flex-start" content_wrap="wrap" spacing="" center_content="no" link="" target="_self" link_description="" min_height="" hide_on_mobile="small-visibility,medium-visibility,large-visibility" sticky_display="normal,sticky" class="" id="" type_medium="" type_small="" type="1_2" order_medium="0" order_small="0" dimension_spacing_medium="" dimension_spacing_small="" dimension_margin_medium="" dimension_margin_small="" padding_medium="" padding_small="" hover_type="none" border_sizes="" border_color="" border_style="solid" box_shadow="no" box_shadow_blur="0" box_shadow_spread="0" box_shadow_color="" box_shadow_style="" overflow="" gradient_start_color="" gradient_end_color="" gradient_start_position="0" gradient_end_position="100" gradient_type="linear" radial_direction="center center" linear_angle="180" background_color="" background_image="" background_image_id="" background_position="left top" background_repeat="no-repeat" background_blend_mode="none" render_logics="" filter_hue="0" filter_saturation="100" filter_brightness="100" filter_contrast="100" filter_invert="0" filter_sepia="0" filter_opacity="100" filter_blur="0" filter_hue_hover="0" filter_saturation_hover="100" filter_brightness_hover="100" filter_contrast_hover="100" filter_invert_hover="0" filter_sepia_hover="0" filter_opacity_hover="100" filter_blur_hover="0" animation_type="" animation_direction="left" animation_speed="0.3" animation_offset=""]'.$form_register.'[/fusion_builder_column]'); ?>