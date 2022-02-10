<?php
// Removes the back link in a function

function custom_login() {
  $files = '<link rel="stylesheet" href="'.get_bloginfo('template_directory').'/login.css" />';
  echo $files;
}
add_action('login_head', 'custom_login')
;

function my_login_page_remove_back_to_link() { ?>
<style type="text/css">

</style>



<?php }
add_action( 'login_enqueue_scripts', 'my_login_page_remove_back_to_link' );


//If you're using this in your functions.php file, remove the opening <?php

//Replace style-login.css with the name of your custom CSS file
function my_custom_login_stylesheet() {
    wp_enqueue_style( 'custom-login', get_stylesheet_directory_uri() . '/style-login.css' );
}

//This loads the function above on the login page
add_action( 'login_enqueue_scripts', 'my_custom_login_stylesheet' );





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
