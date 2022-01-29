@extends('layouts.login')

  <div class="login-page-wrap">
    <a class="login-page-logo">
      <img src="https://exceleratecapital.com/wp-content/themes/ec_theme/resources/assets/images/logo_blue.svg" class="img-fluid" alt="" />
    </a>
    <div class="login-page-form p-5">
    <?php
    $login  = (isset($_GET['login']) ) ? $_GET['login'] : 0;

    if ( $login === "failed" ) {
      echo '<p class="alert alert-primary">Invalid username and/or password.</p>';
    } elseif ( $login === "empty" ) {
      echo '<p class="alert alert-primary"><Username and/or Password is empty.</p>';
    } elseif ( $login === "false" ) {
      echo '<p class="alert alert-primary">You are logged out.</p>';
    }

    if ( ! is_user_logged_in() ) { // Display WordPress login form:
        $args = array(
            'redirect' => admin_url(),
            'form_id' => 'loginform-custom',
            'label_username' => __( 'Email' ),
            'label_password' => __( 'Password' ),
            'label_remember' => __( 'Remember Me' ),
            'label_log_in' => __( 'Log In' ),
            'remember' => true
        );
        wp_login_form( $args );
    } else {
      echo '<div class="log-out mb-5">';
        wp_loginout( home_url() ); // Display "Log Out" link.

      echo '</div>';
    }
    ?>
    <p class="small">The use of this system may be monitored for computer security purposes.  Any unauthorized access to this system is prohibited and is subject to criminal and civil penalties under Federal Laws including, but not limited to, the Computer Fraud and Abuse Act and the National Information Infrastructure Protection Act.</p>
    </div>
    <img src="https://exceleratecapital.com/wp-content/themes/ec_theme/resources/assets/images/icon.svg" class="img-fluid ec-icon">
  </div>
