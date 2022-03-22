<div class="d-flex bg-dark main-sidebar active">
  <a class="btn btn-circle btn-danger sidebar-toggle close-sidebar" href="#"><i class="far fa-chevron-right"></i></a>
  <div class="d-flex main-toolbar flex-column flex-shrink-0 p-2 pb-3 text-white">
    <ul class="nav nav-pills flex-column mb-auto"></ul>
      <div class="bottom-nav">
      <a href="#" class="bottom-nav-item"><i class="fas fa-cog"></i></a>
      <div class="dropdown">
        <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle user-link" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
          <?php if(get_field('profile_image', $current_user)):?>
            <img src="<?php $img=get_field('profile_image', $current_user); echo $img['url'];?>" alt="" width="32" height="32" class="rounded-circle me-2">
          <?php endif;?>
        </a>
        <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownUser1" style="">
          <?php if( current_user_can('editor') ||  current_user_can('management') || current_user_can('administrator') ) {  ?>
            <li><a class="dropdown-item" href="<?php echo site_url();?>/wp-admin">Admin Dashboard</a></li>
          <?php } ?>
          <li><a class="dropdown-item" href="<?php echo site_url();?>/profile">Profile</a></li>
          <li><a class="dropdown-item" href="<?php echo site_url();?>/wp-login.php?action=logout">Log Out</a></li>
        </ul>
      </div>
      </div>
  </div>
  <div class="d-flex main-sidebar-inner  flex-column flex-shrink-0 p-3 text-white">
    <!--
    <a href="<?php echo site_url();?>/home" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none sb-logo">
      <img src="https://exceleratecapital.com/wp-content/themes/ec_theme/resources/assets/images/logo.svg" class="img-fluid" alt="" />
    </a>
    -->
    <?php if(is_front_page()):?>
      <h3>Hello <?php echo $current_user->user_firstname;?> - <small>(<?php $user_id = "user_" . get_current_user_id();  the_field('role', $user_id); ?>)</small></h3>
    <?php endif; /*?>
    <form method="post" class="view-form">
      @include('partials.views-dropdown')
      <input type="hidden" name="refresh" value="true">
    </form>
    <?php */
     if($_SESSION["role"] == "SETUP") { ?>
       <div class="dropdown-group">
         <button class="dropdown-toggler dropdown-toggle" type="button" data-bs-toggle="collapse" data-bs-target="#viewDropdown" aria-expanded="true" aria-controls="viewDropdown">
           <i class="fal fa-users"></i> Setup View
         </button>
         <div class="collapse show" id="viewDropdown">
           <div class="card card-body mt-1">
             <form method="post" class="view-param d-flex">
               <ul class="side-nav">
                 <li class="nav-item">
                   <div class="radio-btn">
                     <input type="radio" class="btn-check setup_view" id="am" autocomplete="off" name="setup_view" value="open" <?php if($_SESSION["role"] == "ctcDocsOutBack"){ echo "open"; } ?>>
                     <label class="btn w-100" for="am"><i class="fal fa-user"></i> Open</label>
                   </div>
                 </li>
                 <li class="nav-item">
                   <div class="radio-btn">
                     <input type="radio" class="btn-check setup_view" id="role_ae" autocomplete="off" name="setup_view" value="assigned" <?php if($_SESSION["role"] == "assigned"){ echo "checked"; } ?>>
                     <label class="btn w-100" for="role_ae"><i class="fal fa-user"></i> Assigned</label>
                   </div>
                 </li>
               </ul>

                <input type="hidden" name="refresh" value="true">
              </form>

           </div>
         </div>
       </div>
     <?php } ?>
  <?php
   if($_SESSION["role"] == "ADMIN") { ?>
    <div class="dropdown-group">
      <button class="dropdown-toggler dropdown-toggle" type="button" data-bs-toggle="collapse" data-bs-target="#viewDropdown" aria-expanded="true" aria-controls="viewDropdown">
        <i class="fal fa-users"></i> Change Role
      </button>
      <div class="collapse show" id="viewDropdown">
        <div class="card card-body mt-1">
          <form method="post" class="view-param d-flex">
            <ul class="side-nav">
              <li class="nav-item">
                <div class="radio-btn">
                  <input type="radio" class="btn-check admin_view" id="role_ae" autocomplete="off" name="admin_role" value="AE" <?php if($_SESSION["role"] == "AE"){ echo "checked"; } ?>>
                  <label class="btn w-100" for="role_ae"><i class="fal fa-user"></i> Account Executive</label>
                </div>
              </li>
              <li class="nav-item">
                <div class="radio-btn">
                  <input type="radio" class="btn-check admin_view" id="am" autocomplete="off" name="admin_role" value="AM" <?php if($_SESSION["role"] == "ctcDocsOutBack"){ echo "checked"; } ?>>
                  <label class="btn w-100" for="am"><i class="fal fa-user"></i> Account Manager</label>
                </div>
              </li>
              <li class="nav-item">
                <div class="radio-btn">
                  <input type="radio" class="btn-check admin_view" id="fund" autocomplete="off" name="admin_role" value="FUND" <?php if($_SESSION["role"] == "fundedLastMonth"){ echo "checked"; } ?>>
                  <label class="btn w-100" for="fund"><i class="fal fa-user"></i> Funder</label>
                </div>
              </li>
              <li class="nav-item">
                <div class="radio-btn">
                  <input type="radio" class="btn-check admin_view" id="setup" autocomplete="off" name="admin_role" value="SETUP" <?php if($_SESSION["role"] == "fundedMonthly"){ echo "checked"; } ?>>
                  <label class="btn w-100" for="setup"><i class="fal fa-user"></i> Setup Coordinator</label>
                </div>
              </li>
              <li class="nav-item">
                <div class="radio-btn">
                  <input type="radio" class="btn-check admin_view" id="qc" autocomplete="off" name="admin_role" value="QC" <?php if($_SESSION["role"] == "QC"){ echo "checked"; } ?>>
                  <label class="btn w-100" for="qc"><i class="fal fa-user"></i> QC</label>
                </div>
              </li>
              <li class="nav-item">
                <div class="radio-btn">
                  <input type="radio" class="btn-check admin_view" id="und" autocomplete="off" name="admin_role" value="UND" <?php if($_SESSION["role"] == "locked"){ echo "checked"; } ?>>
                  <label class="btn w-100" for="und"><i class="fal fa-user"></i> Underwriter</label>
                </div>
              </li>
              <li class="nav-item">
                <div class="radio-btn">
                  <input type="radio" class="btn-check admin_view" id="rachel" autocomplete="off" name="admin_role" value="RACHEL" <?php if($_SESSION["role"] == "rachel"){ echo "checked"; } ?>>
                  <label class="btn w-100" for="rachel"><i class="fal fa-user"></i> RACHEL</label>
                </div>
              </li>
            </ul>

             <input type="hidden" name="refresh" value="true">
           </form>

        </div>
      </div>
    </div>

   <?php } else if(!empty($_SESSION['rr_view'])){ ?>

   <?php } ?>





    <ul class="nav nav-pills flex-column mb-auto"></ul>

  </div>

  </div>
