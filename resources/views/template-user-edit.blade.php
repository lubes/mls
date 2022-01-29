{{--
  Template Name: User Edit Template
--}}

@extends('layouts.app')

@section('content')

<?php $current_user = wp_get_current_user();?>

    <nav class="user-nav mb-3">
      <div class="nav nav-pills nav-fill" id="nav-tab" role="tablist">
        <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Your Profile</button>
        <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Services</button>
        <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">Favorites</button>
      </div>
    </nav>
    <div class="tab-content alt" id="nav-tabContent">
      <div class="tab-pane p-5 fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
        <!-- General Info -->
        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
            <div id="post-<?php the_ID(); ?>">
                <div class="entry-content entry">
                  <div class="user-welcome mb-3">
                    <div class="row align-items-center">
                      <div class="col-md-2">
                        <img src="<?php $img=get_field('profile_image', $current_user); echo $img['url'];?>" class="img-fluid rounded-circle" alt="" />
                      </div>
                      <div class="col-md-10">
                        <h1 class="mb-1"><?php echo $current_user->display_name;?></h1>
                        <p class="muted"><?php echo the_field('position', $current_user);?></p>
                      </div>
                    </div>
                  </div>
                    <?php the_content(); ?>
                    <?php if ( !is_user_logged_in() ) : ?>
                            <p class="warning">
                                <?php _e('You must be logged in to edit your profile.', 'profile'); ?>
                            </p><!-- .warning -->
                    <?php else : ?>
                        <?php if ( count($error) > 0 ) echo '<p class="error">' . implode("<br />", $error) . '</p>'; ?>
                        <form method="post" id="adduser" action="<?php the_permalink(); ?>">

                          <div class="row">
                            <div class="col-md-5">
                              <p class="form-label form-username">
                                  <label for="first-name"><?php _e('First Name', 'profile'); ?></label>
                                  <input class="text-input" name="first-name" type="text" id="first-name" value="<?php the_author_meta( 'first_name', $current_user->ID ); ?>" />
                              </p><!-- .form-label form-username -->
                              <p class="form-label form-username">
                                  <label for="last-name"><?php _e('Last Name', 'profile'); ?></label>
                                  <input class="text-input" name="last-name" type="text" id="last-name" value="<?php the_author_meta( 'last_name', $current_user->ID ); ?>" />
                              </p><!-- .form-label form-username -->
                              <p class="form-label form-email">
                                  <label for="email"><?php _e('E-mail *', 'profile'); ?></label>
                                  <input class="text-input" name="email" type="text" id="email" value="<?php the_author_meta( 'user_email', $current_user->ID ); ?>" />
                              </p><!-- .form-label form-email -->
                              <p class="form-label form-url">
                                  <label for="url"><?php _e('Website', 'profile'); ?></label>
                                  <input class="text-input" name="url" type="text" id="url" value="<?php the_author_meta( 'user_url', $current_user->ID ); ?>" />
                              </p><!-- .form-label form-url -->
                              <p class="form-label form-password">
                                  <label for="pass1"><?php _e('Password *', 'profile'); ?> </label>
                                  <input class="text-input" name="pass1" type="password" id="pass1" />
                              </p><!-- .form-label form-password -->
                              <p class="form-label form-password">
                                  <label for="pass2"><?php _e('Repeat Password *', 'profile'); ?></label>
                                  <input class="text-input" name="pass2" type="password" id="pass2" />
                              </p><!-- .form-label form-password -->
                              <p class="form-label form-textarea">
                                  <label for="description"><?php _e('Biographical Information', 'profile') ?></label>
                                  <textarea name="description" id="description" rows="3" cols="50"><?php the_author_meta( 'description', $current_user->ID ); ?></textarea>
                              </p><!-- .form-label form-textarea -->
                              <p class="form-label form-submit">
                                  <?php echo $referer; ?>
                                  <input name="updateuser" type="submit" id="updateuser" class="submit button" value="<?php _e('Update', 'profile'); ?>" />
                                  <?php wp_nonce_field( 'update-user' ) ?>
                                  <input name="action" type="hidden" id="action" value="update-user" />
                              </p>
                            </div>
                            <div class="col-md-5 offset-md-1">
                              <h2>Additional Information</h2>
                              <?php // echo do_shortcode('[my_acf_user_form field_group="10"]');?>
                              <?php
                                  do_action('edit_user_profile',$current_user);
                              ?>

                            </div>
                          </div>







                        </form><!-- #adduser -->
                    <?php endif; ?>
                </div><!-- .entry-content -->
            </div><!-- .hentry .post -->
            <?php endwhile; ?>
        <?php else: ?>
            <p class="no-data">
                <?php _e('Sorry, no page matched your criteria.', 'profile'); ?>
            </p><!-- .no-data -->
        <?php endif; ?>

      </div>
      <div class="tab-pane p-5 fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
        <div class="row">
          <div class="col-md-5">
            <h2>Services</h2>
            <?php // echo do_shortcode('[my_acf_user_form field_group="25"]');?>
          </div>
        </div>
      </div>
      <div class="tab-pane p-5 fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
        <h2>Favorites</h2>
      </div>
    </div>

    @while(have_posts()) @php the_post() @endphp

    @include('partials.content-page')

    <?php
    /**
     * Template Name: User Profile
     *
     * Allow users to update their profiles from Frontend.
     *
     */

    /* Get user info. */
    global $current_user, $wp_roles;
    //get_currentuserinfo(); //deprecated since 3.1

    /* Load the registration file. */
    //require_once( ABSPATH . WPINC . '/registration.php' ); //deprecated since 3.1
    $error = array();
    /* If profile was saved, update profile. */
    if ( 'POST' == $_SERVER['REQUEST_METHOD'] && !empty( $_POST['action'] ) && $_POST['action'] == 'update-user' ) {

        /* Update user password. */
        if ( !empty($_POST['pass1'] ) && !empty( $_POST['pass2'] ) ) {
            if ( $_POST['pass1'] == $_POST['pass2'] )
                wp_update_user( array( 'ID' => $current_user->ID, 'user_pass' => esc_attr( $_POST['pass1'] ) ) );
            else
                $error[] = __('The passwords you entered do not match.  Your password was not updated.', 'profile');
        }

        /* Update user information. */
        if ( !empty( $_POST['url'] ) )
            wp_update_user( array( 'ID' => $current_user->ID, 'user_url' => esc_url( $_POST['url'] ) ) );
        if ( !empty( $_POST['email'] ) ){
            if (!is_email(esc_attr( $_POST['email'] )))
                $error[] = __('The Email you entered is not valid.  please try again.', 'profile');
            elseif(email_exists(esc_attr( $_POST['email'] )) != $current_user->id )
                $error[] = __('This email is already used by another user.  try a different one.', 'profile');
            else{
                wp_update_user( array ('ID' => $current_user->ID, 'user_email' => esc_attr( $_POST['email'] )));
            }
        }

        if ( !empty( $_POST['first-name'] ) )
            update_user_meta( $current_user->ID, 'first_name', esc_attr( $_POST['first-name'] ) );
        if ( !empty( $_POST['last-name'] ) )
            update_user_meta($current_user->ID, 'last_name', esc_attr( $_POST['last-name'] ) );
        if ( !empty( $_POST['description'] ) )
            update_user_meta( $current_user->ID, 'description', esc_attr( $_POST['description'] ) );

        /* Redirect so the page will show updated info.*/
      /*I am not Author of this Code- i dont know why but it worked for me after changing below line to if ( count($error) == 0 ){ */
        if ( count($error) == 0 ) {
            //action hook for plugins and extra fields saving
            do_action('edit_user_profile_update', $current_user->ID);
            wp_redirect( get_permalink() );
            exit;
        }
    }
    ?>

  @endwhile


@endsection
