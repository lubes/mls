<!doctype html>
<html {!! get_language_attributes() !!}>
  @include('partials.head')
  <body @php body_class() @endphp>
    @php do_action('get_header') @endphp

  <?php
    $current_user = wp_get_current_user();
    //echo 'Username: ' . $current_user->user_login . '<br />';
    //echo 'User email: ' . $current_user->user_email . '<br />';
    //echo 'User first name: ' . $current_user->user_firstname . '<br />';
    //echo 'User last name: ' . $current_user->user_lastname . '<br />';
    //echo 'User display name: ' . $current_user->display_name . '<br />';
  ?>

    <div class="wrap" role="document">
      <div class="content">
        <main class="main d-flex">

          <div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark main-sidebar" style="width: 280px;">
              <a href="<?php echo site_url();?>/home" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none sb-logo">
                <img src="https://exceleratecapital.com/wp-content/themes/ec_theme/resources/assets/images/logo.svg" class="img-fluid" alt="" />
              </a>
              <!--<div class="loan-search">
                <select class="form-select" aria-label="Default select example">
                  <option selected>Loan #</option>
                  <option value="1">One</option>
                  <option value="2">Two</option>
                  <option value="3">Three</option>
                </select>
              </div>
              <?php echo get_search_form();?>-->

              <ul class="list-unstyled ps-0">
                    <li class="mb-1">
                      <button class="btn btn-toggle align-items-center link-light" data-bs-toggle="collapse" data-bs-target="#home-collapse" aria-expanded="false">
                        <i class="fas fa-cog"></i> Settings
                      </button>
                      <div class="collapse show" id="home-collapse" style="">
                        <ul class="btn-toggle-nav sub-menu list-unstyled fw-normal pb-1 small">
                          <li><a href="#" class="link-light">Overview</a></li>
                          <li><a href="#" class="link-light">Updates</a></li>
                          <li><a href="#" class="link-light">Reports</a></li>
                        </ul>
                      </div>
                    </li>
                    <li class="mb-1">
                      <button class="btn btn-toggle align-items-center rounded collapsed text-white" data-bs-toggle="collapse" data-bs-target="#reporting-collapse" aria-expanded="false">
                        <i class="fas fa-pencil"></i> Reporting
                      </button>
                      <div class="collapse" id="reporting-collapse">
                        <ul class="btn-toggle-nav sub-menu list-unstyled fw-normal pb-1 small">
                          <li><a href="#" class="link-light">Custom Reports</a></li>
                          <li><a href="#" class="link-light">Scheduled Reports</a></li>
                          <li><a href="#" class="link-light">Published Reports</a></li>
                          <li><a href="#" class="link-light">Batch Reports</a></li>
                          <li><a href="#" class="link-light">Report Download</a></li>
                        </ul>
                      </div>
                    </li>
                    <li class="mb-1">
                      <button class="btn btn-toggle align-items-center rounded collapsed text-white" data-bs-toggle="collapse" data-bs-target="#loans-collapse" aria-expanded="false">
                        <i class="far fa-check-circle"></i> Test Loans
                      </button>
                      <div class="collapse" id="loans-collapse">
                        <ul class="btn-toggle-nav sub-menu list-unstyled fw-normal pb-1 small">
                          <li><a href="#" class="link-light">Create Purchase Test Loan</a></li>
                          <li><a href="#" class="link-light">Create Refinance Test Loan</a></li>
                          <li><a href="#" class="link-light">Find Test Loan</a></li>
                        </ul>
                      </div>
                    </li>
                  </ul>


              <ul class="nav nav-pills flex-column mb-auto"></ul>
              <div class="dropdown">
                <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                  <img src="<?php $img=get_field('profile_image', $current_user); echo $img['url'];?>" alt="" width="32" height="32" class="rounded-circle me-2">
                  <strong><?php echo $current_user->display_name;?></strong>
                </a>
                <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownUser1" style="">
                  <li><a class="dropdown-item" href="<?php echo site_url();?>/profile">Profile</a></li>
                  <li><a class="dropdown-item" href="<?php echo site_url();?>/wp-login.php?action=logout">Log Out</a></li>

                </ul>
              </div>
            </div>

            <div class="db-content m-4">

              <div class="page-header ps-5 mb-4">
                <?php if(is_front_page()):?>
                  <h1>Hi <?php echo $current_user->user_firstname;?> - <small>(<?php $user_id = "user_" . get_current_user_id();  the_field('role', $user_id); ?>)</small></h1>
                <?php endif;?>
                <!-- <h1>{!! App::title() !!}</h1>-->
              </div>


              @yield('content')
            </div>

        </main>
      </div>
    </div>
    @php do_action('get_footer') @endphp
    @include('partials.footer')
    @php wp_footer() @endphp
  </body>
</html>
