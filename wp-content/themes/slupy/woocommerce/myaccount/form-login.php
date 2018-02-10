<?php
/**
 * Login Form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.2.6
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

wp_enqueue_script('wc-single-product');

?>

<?php wc_print_notices(); ?>

<?php do_action( 'woocommerce_before_customer_login_form' ); ?>

<div class="row" id="customer_login">

	<div class="woocommerce-tabs vertical-tab">

		<div class="col-sm-4 col-md-3 col-lg-3">

		<ul class="tabs">
			<li class="login_tab"><a href="#tab-login"><?php _e( 'Login', 'woocommerce' ); ?></a></li>
			<?php if ( get_option( 'woocommerce_enable_myaccount_registration' ) === 'yes' ) : ?>
			<li class="register_tab"><a href="#tab-register"><?php _e( 'Register', 'woocommerce' ); ?></a></li>
			<?php endif; ?>
			<li class="recovery_pass_tab"><a href="#tab-lostpassword">Recovery Password</a></li>
		</ul>

		</div>

		<div class="col-sm-8 col-md-9 col-lg-9">
	
		<div class="panel" id="tab-login">
			<form method="post" class="login">

				<?php do_action( 'woocommerce_login_form_start' ); ?>

				<p class="form-row form-row-wide">
					<label for="username"><?php _e( 'Username or email address', 'woocommerce' ); ?> <span class="required">*</span></label>
					<input type="text" class="input-text" name="username" id="username" />
				</p>
				<p class="form-row form-row-wide">
					<label for="password"><?php _e( 'Password', 'woocommerce' ); ?> <span class="required">*</span></label>
					<input class="input-text" type="password" name="password" id="password" />
				</p>

				<?php do_action( 'woocommerce_login_form' ); ?>

				<p class="form-row">
					<?php wp_nonce_field( 'woocommerce-login' ); ?>
					<button type="submit" class="button login-form-button" name="login" value="<?php esc_attr_e( 'Login', 'woocommerce' ); ?>"><span class="button-color"><?php _e( 'Login', 'woocommerce' ); ?></span></button> 
					<label for="rememberme" class="inline">
						<input name="rememberme" type="checkbox" id="rememberme" value="forever" /> <?php _e( 'Remember me', 'woocommerce' ); ?>
					</label>
					<span class="login-form-lost-pass"><a href="<?php echo esc_url( wc_lostpassword_url() ); ?>"><?php _e( 'Lost your password?', 'woocommerce' ); ?></a></span>
				</p>

				<?php do_action( 'woocommerce_login_form_end' ); ?>

			</form>
		</div>

		<?php if ( get_option( 'woocommerce_enable_myaccount_registration' ) === 'yes' ) : ?>
		<div class="panel" id="tab-register">
			<form method="post" class="register">

				<?php do_action( 'woocommerce_register_form_start' ); ?>

				<?php if ( get_option( 'woocommerce_registration_generate_username' ) === 'no' ) : ?>

					<p class="form-row form-row-wide">
						<label for="reg_username"><?php _e( 'Username', 'woocommerce' ); ?> <span class="required">*</span></label>
						<input type="text" class="input-text" name="username" id="reg_username" value="<?php if ( ! empty( $_POST['username'] ) ) echo esc_attr( $_POST['username'] ); ?>" />
					</p>

				<?php endif; ?>

				<p class="form-row form-row-wide">
					<label for="reg_email"><?php _e( 'Email address', 'woocommerce' ); ?> <span class="required">*</span></label>
					<input type="email" class="input-text" name="email" id="reg_email" value="<?php if ( ! empty( $_POST['email'] ) ) echo esc_attr( $_POST['email'] ); ?>" />
				</p>

				<p class="form-row form-row-wide">
					<label for="reg_password"><?php _e( 'Password', 'woocommerce' ); ?> <span class="required">*</span></label>
					<input type="password" class="input-text" name="password" id="reg_password" value="<?php if ( ! empty( $_POST['password'] ) ) echo esc_attr( $_POST['password'] ); ?>" />
				</p>

				<!-- Spam Trap -->
				<div style="left:-999em; position:absolute;"><label for="trap"><?php _e( 'Anti-spam', 'woocommerce' ); ?></label><input type="text" name="email_2" id="trap" tabindex="-1" /></div>

				<?php do_action( 'woocommerce_register_form' ); ?>
				<?php do_action( 'register_form' ); ?>

				<p class="form-row">
					<?php wp_nonce_field( 'woocommerce-register', 'register' ); ?>
					<button type="submit" class="button" name="register" value="<?php esc_attr_e( 'Register', 'woocommerce' ); ?>"><?php _e( 'Register', 'woocommerce' ); ?></button>
				</p>

				<?php do_action( 'woocommerce_register_form_end' ); ?>

			</form>
		</div>
		<?php endif; ?>

		<div class="panel" id="tab-lostpassword">
			<?php
				WC_Shortcode_My_Account::lost_password();
			?>
		</div>

		</div>

	</div>

</div>

<?php do_action( 'woocommerce_after_customer_login_form' ); ?>