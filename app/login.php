<?php
// Removes the back link in a function

function custom_login() {
  $files = '<link rel="stylesheet" href="'.get_bloginfo('template_directory').'/login.css" />';
  echo $files;
}
add_action('login_head', 'custom_login');


add_action('login_footer', 'add_text_forgot_pass');
function add_text_forgot_pass(){
    echo "<p class='login-text'>The use of this system may be monitored for computer security purposes. Any unauthorized access to this system is prohibited and is subject to criminal and civil penalties under Federal Laws including, but not limited to, the Computer Fraud and Abuse Act and the National Information Infrastructure Protection Act.</p>";
}



//remove <?php when you paste into your functions.php file

function login_error_override()
{
    return 'Incorrect login details.';
}
add_filter('login_errors', 'login_error_override');



/*
function smallenvelop_login_message( $message ) {
  if ( empty($message) ){
      return "<p>The use of this system may be monitored for computer security purposes. Any unauthorized access to this system is prohibited and is subject to criminal and civil penalties under Federal Laws including, but not limited to, the Computer Fraud and Abuse Act and the National Information Infrastructure Protection Act.</p>";
  } else {
      return $message;
  }
}
add_filter( 'login_message', 'smallenvelop_login_message' );
*/

// Redirect URL
/*
function admin_login_redirect( $redirect_to, $request, $user ) {
   global $user;

   if( isset( $user->roles ) && is_array( $user->roles ) ) {
      if( in_array( "administrator", $user->roles ) ) {
      return $redirect_to;
      }
      else {
      return home_url();
      }
   }
   else {
   return $redirect_to;
   }
}

add_filter("login_redirect", "admin_login_redirect", 10, 3);
*/
