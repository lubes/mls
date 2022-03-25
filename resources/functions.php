<?php

/**
 * Do not edit anything in this file unless you know what you're doing
 */

use Roots\Sage\Config;
use Roots\Sage\Container;

/**
 * Helper function for prettying up errors
 * @param string $message
 * @param string $subtitle
 * @param string $title
 */
$sage_error = function ($message, $subtitle = '', $title = '') {
    $title = $title ?: __('Sage &rsaquo; Error', 'sage');
    $footer = '<a href="https://roots.io/sage/docs/">roots.io/sage/docs/</a>';
    $message = "<h1>{$title}<br><small>{$subtitle}</small></h1><p>{$message}</p><p>{$footer}</p>";
    wp_die($message, $title);
};

/**
 * Ensure compatible version of PHP is used
 */
if (version_compare('7.1', phpversion(), '>=')) {
    $sage_error(__('You must be using PHP 7.1 or greater.', 'sage'), __('Invalid PHP version', 'sage'));
}

/**
 * Ensure compatible version of WordPress is used
 */
if (version_compare('4.7.0', get_bloginfo('version'), '>=')) {
    $sage_error(__('You must be using WordPress 4.7.0 or greater.', 'sage'), __('Invalid WordPress version', 'sage'));
}

/**
 * Ensure dependencies are loaded
 */
if (!class_exists('Roots\\Sage\\Container')) {
    if (!file_exists($composer = __DIR__.'/../vendor/autoload.php')) {
        $sage_error(
            __('You must run <code>composer install</code> from the Sage directory.', 'sage'),
            __('Autoloader not found.', 'sage')
        );
    }
    require_once $composer;
}

/**
 * Sage required files
 *
 * The mapped array determines the code library included in your theme.
 * Add or remove files to the array as needed. Supports child theme overrides.
 */
array_map(function ($file) use ($sage_error) {
    $file = "../app/{$file}.php";
    if (!locate_template($file, true, true)) {
        $sage_error(sprintf(__('Error locating <code>%s</code> for inclusion.', 'sage'), $file), 'File not found');
    }
}, ['helpers', 'setup', 'filters', 'admin', 'login']);

/**
 * Here's what's happening with these hooks:
 * 1. WordPress initially detects theme in themes/sage/resources
 * 2. Upon activation, we tell WordPress that the theme is actually in themes/sage/resources/views
 * 3. When we call get_template_directory() or get_template_directory_uri(), we point it back to themes/sage/resources
 *
 * We do this so that the Template Hierarchy will look in themes/sage/resources/views for core WordPress themes
 * But functions.php, style.css, and index.php are all still located in themes/sage/resources
 *
 * This is not compatible with the WordPress Customizer theme preview prior to theme activation
 *
 * get_template_directory()   -> /srv/www/example.com/current/web/app/themes/sage/resources
 * get_stylesheet_directory() -> /srv/www/example.com/current/web/app/themes/sage/resources
 * locate_template()
 * ├── STYLESHEETPATH         -> /srv/www/example.com/current/web/app/themes/sage/resources/views
 * └── TEMPLATEPATH           -> /srv/www/example.com/current/web/app/themes/sage/resources
 */
array_map(
    'add_filter',
    ['theme_file_path', 'theme_file_uri', 'parent_theme_file_path', 'parent_theme_file_uri'],
    array_fill(0, 4, 'dirname')
);
Container::getInstance()
    ->bindIf('config', function () {
        return new Config([
            'assets' => require dirname(__DIR__).'/config/assets.php',
            'theme' => require dirname(__DIR__).'/config/theme.php',
            'view' => require dirname(__DIR__).'/config/view.php',
        ]);
    }, true);



function admin_default_page() {
  return '/home';
}

add_filter('login_redirect', 'admin_default_page');

function my_login_redirect( $redirect_to, $request, $user ) {
    //is there a user to check?
    global $user;
    if ( isset( $user->roles ) && is_array( $user->roles ) ) {

        if ( in_array( 'subscriber', $user->roles ) ) {
            // redirect them to the default place
            $data_login = get_option('axl_jsa_login_wid_setup');

            return get_permalink($data_login[0]);
        } else {
            return home_url();
        }
    } else {
        return $redirect_to;
    }
}
add_filter( 'login_redirect', 'my_login_redirect', 10, 3 );


add_action('after_setup_theme', 'remove_admin_bar');
function remove_admin_bar() {
if (!current_user_can('administrator') && !is_admin()) {
  show_admin_bar(false);
}
}














function my_acf_user_form_func( $atts ) {

  $a = shortcode_atts( array(
    'field_group' => ''
  ), $atts );

  $uid = get_current_user_id();

  if ( ! empty ( $a['field_group'] ) && ! empty ( $uid ) ) {
    $options = array(
      'post_id' => 'user_'.$uid,
      'field_groups' => array( intval( $a['field_group'] ) ),
      'return' => add_query_arg( 'updated', 'true', get_permalink() )
    );

    ob_start();

    acf_form( $options );
    $form = ob_get_contents();

    ob_end_clean();
  }

    return $form;
}

add_shortcode( 'my_acf_user_form', 'my_acf_user_form_func' );



//adding AFC form head
function add_acf_form_head(){
    global $post;

  if ( !empty($post) && has_shortcode( $post->post_content, 'my_acf_user_form' ) ) {
        acf_form_head();
    }
}
add_action( 'wp_head', 'add_acf_form_head', 7 );











/* Main redirection of the default login page */
function redirect_login_page() {
  $login_page  = home_url( '/login/' );
  $page_viewed = basename($_SERVER['REQUEST_URI']);

  if( $page_viewed == "wp-login.php" && $_SERVER['REQUEST_METHOD'] == 'GET') {
    wp_redirect($login_page);
    exit;
  }
}
add_action('init','redirect_login_page');

function login_failed() {
  $login_page  = home_url( '/login/' );
  wp_redirect( $login_page . '?login=failed' );
  exit;
}
add_action( 'wp_login_failed', 'login_failed' );

/*function verify_username_password( $user, $username, $password ) {
  $login_page  = home_url( '/login/' );
    if( $username == "" || $password == "" ) {
        wp_redirect( $login_page . "?login=empty" );
        exit;
    }
}
add_filter( 'authenticate', 'verify_username_password', 1, 3);*/

function logout_page() {
  $login_page  = home_url( '/login/' );
  wp_redirect( $login_page . "?login=false" );
  exit;
}
add_action('wp_logout','logout_page');

if (!session_id()) {
    session_start();
}

function init_query() {
  global $current_user;
  $current_user = wp_get_current_user();
  $user_email = $current_user->user_email;
  $user_id = "user_" . get_current_user_id();
  $_SESSION["role"] = get_field('role', $user_id);

  /*if($_SESSION["data"] == "") {
    $url_path = 'https://w2dufry7w8.execute-api.us-west-2.amazonaws.com/test';

    // Data is an array of key value pairs
    // to be reflected on the site

    $data = array("role" => $_POST["role"],   "email" => $user_email,  "recordRequest" => $_POST["rr"]);

    $result = CallAPI("GET", $url_path, $data);

    $decoded_json = json_decode($result, true);
    $_SESSION["data"] = $decoded_json["data"];

  }*/
  // Setup Views Drop Down
/*
$_SESSION["rr_view"] = record_views($_SESSION["role"]);

$url_path = 'https://w2dufry7w8.execute-api.us-west-2.amazonaws.com/controller';

if((isset($_POST["admin_role"])) && ($_SESSION["role"] == "ADMIN")){
  $_SESSION["data"] = array();

  // Get Record Request Type by Role
  $_SESSION["rr_view"] = record_views($_POST["admin_role"]);
  if($_POST["rr"] != ""){
    $_SESSION["rr"] = $_POST["rr"];
} else {
  $_SESSION["rr"] = $_SESSION['rr_view']['records'][0];

}
  $_SESSION["admin_role"] = $_POST["admin_role"];

  $data = array("role" => $_SESSION["role"],   "email" => $user_email,  "recordRequest" => $_SESSION["rr"] );

  $result = CallAPI("POST", $url_path, $data);
  $decoded_json = json_decode($result, true);
  // Set Session Variables
  //$_SESSION["data"] = $decoded_json["data"];

  $order = $decoded_json["order"];
  $temp_data = $decoded_json["data"];
  foreach($temp_data as $key => $value){
    $value = array_merge(array_flip($order), $value);
    $_SESSION["data"][] = $value;
  }

} else if(($_POST["refresh"] == "true") && ($_POST["rr"] != "")){
  $_SESSION["data"] = array();

    $data = array("role" => $_SESSION["role"],   "email" => $user_email,  "recordRequest" => $_POST["rr"]);
    $result = CallAPI("POST", $url_path, $data);
    $decoded_json = json_decode($result, true);

    // Set Session Variables
    $_SESSION["rr"] = $_POST["rr"];

    $order = $decoded_json["order"];
    $temp_data = $decoded_json["data"];
    foreach($temp_data as $key => $value){
      $value = array_merge(array_flip($order), $value);
      $_SESSION["data"][] = $value;
    }
  }
*/
}
// PHP endpoint call
init_query();
/*
function record_views($role){
  $url_path = 'https://w2dufry7w8.execute-api.us-west-2.amazonaws.com//records?role=' . $role;
  $result = CallAPI("GET", $url_path, $data);
  $decoded_json = json_decode($result, true);
  // Set Session Variables
  return $decoded_json;

}

// Method: POST, PUT, GET etc
// Data: array("param" => "value") ==> index.php?param=value

function CallAPI($method, $url, $data = false){

  $postdata = json_encode($data);

  $ch = curl_init($url);

  switch ($method)
   {
       case "POST":
       curl_setopt($ch, CURLOPT_POST, 1);
       curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
       break;
       case "PUT":
           curl_setopt($curl, CURLOPT_PUT, 1);
           break;
       default:
           if ($data)
               $url = sprintf("%s?%s", $url, http_build_query($data));
   }


  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
  $result = curl_exec($ch);
  curl_close($ch);
      curl_close($curl);

      return $result;
} */

function destroy_sessions() {
   $sessions->destroy_all();//destroys all sessions
   wp_clear_auth_cookie();//clears cookies regarding WP Auth
}
add_action('wp_logout', 'destroy_sessions');

function ajax_scripts() {
   global $current_user;
   $current_user = wp_get_current_user();
   $username = get_field('ec_user_name', 'user_' . $current_user->ID);
   $user_id = $current_user->user_login;
   $token = get_field("token",  'option');
   wp_enqueue_script( 'ajax-script', get_template_directory_uri() . '/js/functions.js', array( 'jquery' ), '', true );
   wp_localize_script( 'ajax-script', 'theUser', array (
      'username' => $username,
      'user_id' => $user_id,
      'role' => $_SESSION["role"],
      'email' => $current_user->user_email,
      'token' => htmlentities($token)
   ) );


}
add_action( 'wp_enqueue_scripts', 'ajax_scripts' );

class JPB_User_Caps {

  // Add our filters
  function JPB_User_Caps(){
    add_filter( 'editable_roles', array(&$this, 'editable_roles'));
    add_filter( 'map_meta_cap', array(&$this, 'map_meta_cap'),10,4);
  }

  // Remove 'Administrator' from the list of roles if the current user is not an admin
  function editable_roles( $roles ){
    if( isset( $roles['administrator'] ) && !current_user_can('administrator') ){
      unset( $roles['administrator']);
    }
    return $roles;
  }

  // If someone is trying to edit or delete and admin and that user isn't an admin, don't allow it
  function map_meta_cap( $caps, $cap, $user_id, $args ){

    switch( $cap ){
        case 'edit_user':
        case 'remove_user':
        case 'promote_user':
            if( isset($args[0]) && $args[0] == $user_id )
                break;
            elseif( !isset($args[0]) )
                $caps[] = 'do_not_allow';
            $other = new WP_User( absint($args[0]) );
            if( $other->has_cap( 'administrator' ) ){
                if(!current_user_can('administrator')){
                    $caps[] = 'do_not_allow';
                }
            }
            break;
        case 'delete_user':
        case 'delete_users':
            if( !isset($args[0]) )
                break;
            $other = new WP_User( absint($args[0]) );
            if( $other->has_cap( 'administrator' ) ){
                if(!current_user_can('administrator')){
                    $caps[] = 'do_not_allow';
                }
            }
            break;
        default:
            break;
    }
    return $caps;
  }

}

$jpb_user_caps = new JPB_User_Caps();

// Create options page
if( function_exists('acf_add_options_page') ) {

	acf_add_options_page();

}

function wpb_change_search_url() {
    if ( is_search() && ! empty( $_GET['s'] ) ) {
        wp_redirect( home_url( "/search/" ) . urlencode( get_query_var( 's' ) ) );
        exit();
    }
}
add_action( 'template_redirect', 'wpb_change_search_url' );

// New token
add_action( 'new_token', 'get_token' );

function get_token() {
  $new_date = date("Y-m-d H:i:s");
  //$old_date = get_field("date",  'option');
  update_field( "date", $new_date, 'option' );

  $curl = curl_init();

  curl_setopt_array($curl, array(
    CURLOPT_URL => "https://7ri4vh86qb.execute-api.us-west-2.amazonaws.com/get-token",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => array(
      "cache-control: no-cache"
    ),
  ));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);
$response = json_decode($response, true); //because of true, it's in an array


  update_field( "token",$response["token"] , 'option' );

}

// register the ajax action for authenticated users
add_action('wp_ajax_create_loan_post', 'create_loan_post');

// register the ajax action for unauthenticated users
add_action('wp_ajax_nopriv_create_loan_post', 'create_loan_post');

// handle the ajax request
function create_loan_post() {

    $loanNumber = $_REQUEST['loanNumber'];
    $username =  $_REQUEST['username'];

    $post_id = wp_insert_post(array (
       'post_type' => 'loans',
       'post_title' => $loanNumber,
       'post_status' => 'publish',
       'comment_status' => 'open',   // if you prefer
    ));

    if ($post_id) {
       // insert post meta
       $new_date = date("Y-m-d H:i:s");
       update_field( "date_assigned", $new_date, $post_id );
       update_field( "assigned_to", $username , $post_id );
       update_field( "loan_number", $loanNumber , $post_id );
       $status->message = "Success";

    }else {
      $status->message = "Error";
    }
    // add your logic here...
    $myStatus = json_encode($status);

    // in the end, returns success json data
    wp_send_json_success($myStatus);

    // or, on error, return error json data
    wp_send_json_error([/* some data here */]);
}

add_action('rest_api_init', 'ec_add_loans_fields');

function ec_add_loans_fields(){
  register_rest_field(
    'loans',
    'last_comment',
    array(
        'get_callback' => 'get_rest_comments',
        'update_callback' => null,
        'schema' => null,
    )
  );
}

function get_rest_comments($object){
  $comment = get_comments(array(
        'post_id' => $object["id"],
        'number' => '1' ));
  return $comment[0]->comment_content;


}


/*
// register the ajax action for authenticated users
add_action('wp_ajax_search_by_slug', 'search_by_slug');

// register the ajax action for unauthenticated users
add_action('wp_ajax_nopriv_search_by_slug', 'search_by_slug');

function search_by_slug(){
  $loanNumber = $_REQUEST['loanNumber'];
$args = array(
  'name'        => $loanNumber ,
  'post_type'   => 'loans',
  'post_status' => 'publish',
  'numberposts' => 1
);
$my_posts = get_posts($args);
if( $my_posts ) :
  $comment = get_comments( $args );
  $status->id = $my_posts[0]->ID;
  $status->date = get_field("date_assigned", $my_posts[0]->ID);
  $status->message = $comment[0]->comment_content;
  //echo 'ID on the first post found ' . $my_posts[0]->ID;
  else :
  $status->id = "N/A";
  $status->date = "N/A";
  $status->message = "";

endif;

$myStatus = json_encode($status);


wp_send_json_success($myStatus);

}


function get_loans( $data ) {

  $args = array(
    'post_type'         => 'loans',
    'post_status'       => 'publish',
    'posts_per_page'    => -1
  );
  $posts = get_posts($args);

  if (empty( $posts ) ) {
    return null;
  }

  $data = [];

  foreach ($posts as $post) {
    $date_assigned = get_field('date_assigned', $post->ID);
    $comments = get_comments( $args );
    $comment = $comments[0]->comment_content;

    $api_content = [
        'name'  => $post->post_title,
        'date_assigned'  => $date_assigned,
        'comment'  => $comment// ACF

    ];
    $data[] = $api_content;
  }

  return $data;
}*/
