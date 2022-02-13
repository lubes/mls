@extends('layouts.app')

@section('content')

  <div class="db-content-inner p-5">

  <!--<div class="alert alert-info" role="alert"><p style="margin:0;"><?php if(empty($_SESSION["data"])) {  echo "No Results Found"; } else { echo count($_SESSION["data"]) . " records found."; } ?>-->

  <div class="tab-content" id="nav-tabContent">
    <div class="tab-pane fade" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
      <h1>Your Pipeline</h1>
    </div>
    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
      <div class="table-responsive">
    </div>

    </div>
    <div class="tab-pane fade show active" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">

      <?php /*
      $loan_type = array("Loan Type");
      foreach($_SESSION["data"] as $entry) {
        $type = $entry["Loan Purpose"];
        if(!in_array($type, $loan_type) && $type != ""){
          $loan_type[] = $type;
        }
      } */
     ?>

     <div class="">

       <form method="post" class="view-form d-flex align-items-center mb-3 pb-3">

         <div class="dropdown">
           <button class="btn btn-primary dropdown-toggle btn-lg" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
             Change Loan View
           </button>
           <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
             <li class="dropdown-item">
               <div class="radio-btn">
                 <input type="radio" class="btn-check loan-type-filter" id="ae_1" autocomplete="off" name="rr" value="approved/suspended" <?php if($_SESSION["rr"] == "approved/suspended"){ echo "checked"; } ?>>
                 <label class="btn w-100" for="ae_1"><i class="fal fa-check"></i> Approved/Suspended</label>
               </div>
             </li>
             <li class="dropdown-item">
               <div class="radio-btn">
                 <input type="radio" class="btn-check loan-type-filter" id="ae_2" autocomplete="off" name="rr" value="ctcDocsOutBack" <?php if($_SESSION["rr"] == "ctcDocsOutBack"){ echo "checked"; } ?>>
                 <label class="btn w-100" for="ae_2"><i class="fal fa-file-spreadsheet"></i> ctc Docs Out Back</label>
               </div>
             </li>
             <li class="dropdown-item">
               <div class="radio-btn">
                 <input type="radio" class="btn-check loan-type-filter" id="ae_3" autocomplete="off" name="rr" value="fundedLastMonth" <?php if($_SESSION["rr"] == "fundedLastMonth"){ echo "checked"; } ?>>
                 <label class="btn w-100" for="ae_3"><i class="fal fa-calendar-alt"></i> Funded Last Month</label>
               </div>
             </li>
             <li class="dropdown-item">
               <div class="radio-btn">
                 <input type="radio" class="btn-check loan-type-filter" id="ae_4" autocomplete="off" name="rr" value="fundedMonthly" <?php if($_SESSION["rr"] == "fundedMonthly"){ echo "checked"; } ?>>
                 <label class="btn w-100" for="ae_4"><i class="fal fa-calendar-week"></i> Funded Monthly</label>
               </div>
             </li>
             <li class="dropdown-item">
               <div class="radio-btn">
                 <input type="radio" class="btn-check loan-type-filter" id="ae_5" autocomplete="off" name="rr" value="locked" <?php if($_SESSION["rr"] == "locked"){ echo "checked"; } ?>>
                 <label class="btn w-100" for="ae_5"><i class="fal fa-lock"></i> Locked</label>
               </div>
             </li>
             <li class="dropdown-item">
               <div class="radio-btn">
                 <input type="radio" class="btn-check loan-type-filter" id="ae_6" autocomplete="off" name="rr" value="open/registered" <?php if($_SESSION["rr"] == "open/registered"){ echo "checked"; } ?>>
                 <label class="btn w-100" for="ae_6"><i class="fal fa-unlock"></i> Open/Registered</label>
               </div>
             </li>
             <li class="dropdown-item">
               <div class="radio-btn">
                 <input type="radio" class="btn-check loan-type-filter" id="ae_7" autocomplete="off" name="rr" value="resubmissionQuery" <?php if($_SESSION["rr"] == "resubmissionQuery"){ echo "checked"; } ?>>
                 <label class="btn w-100" for="ae_7"><i class="fal fa-paper-plane"></i> Resubmission Query</label>
               </div>
             </li>
             <li class="dropdown-item">
               <div class="radio-btn">
                 <input type="radio" class="btn-check loan-type-filter" id="ae_8" autocomplete="off" name="rr" value="setup/processing" <?php if($_SESSION["rr"] == "setup/processing"){ echo "checked"; } ?>>
                 <label class="btn w-100" for="ae_8"><i class="fal fa-history"></i> Setup/Processing</label>
               </div>
             </li>
             <li class="dropdown-item">
               <div class="radio-btn">
                 <input type="radio" class="btn-check loan-type-filter" id="ae_9" autocomplete="off" name="rr" value="submitted" <?php if($_SESSION["rr"] == "submitted"){ echo "checked"; } ?>>
                 <label class="btn w-100" for="ae_9"><i class="fal fa-tasks"></i> Submitted</label>
               </div>
             </li>
           </ul>
         </div>
         <p class="ms-3">Currently Viewing: <span><?php print_r($_SESSION['rr']); ?></span></p>
         <input type="hidden" name="refresh" value="true">
     </form>



















       <!--<p class="mb-3 mb-md-0">Currently Viewing <?php echo $_SESSION['rr_view'];?></p>-->
       <?php /* if($_SESSION["role"] == "ADMIN") { ?>
         <form method="post" class="view-param d-flex mb-3 border-bottom pb-3">

         <select name="admin_role"  class="form-select">
           <option>Change Role View</option>
           <option value="AE" <?php if($_SESSION["admin_role"] == "AE"){ echo "selected"; } ?>>AE</option>
           <option value="AM" <?php if($_SESSION["admin_role"] == "AM"){ echo "selected"; } ?>>AM</option>
           <option value="FUND" <?php if($_SESSION["admin_role"] == "FUND"){ echo "selected"; } ?>>FUND</option>
           <option value="SETUP" <?php if($_SESSION["admin_role"] == "SETUP"){ echo "selected"; } ?>>SETUP</option>
           <option value="UND" <?php if($_SESSION["admin_role"] == "UND"){ echo "selected"; } ?>>UND</option>
         </select>

         <?php
           if(!empty($_SESSION['rr_view'])){ ?>

                  <select name="rr"  class="form-select ms-3">
                    <option>Record Request</option>
                    <?php foreach($_SESSION['rr_view']['records'] as $key => $value){ ?>
                      <option value="<?php echo $value; ?>" <?php if($_SESSION["rr"] == $value){ echo "selected"; } ?>><?php echo $value; ?></option>
                    <?php } ?>
                  </select>

                <div class="ms-3">
                  <input type="hidden" name="refresh" value="true">
                  <input type="submit" class="data-refresh btn btn-primary" id="nav-contact-tab" value="Change Role">
                </div>
            <?php } ?>

       </form>
      <?php } else if(!empty($_SESSION['rr_view'])){ ?>
       <form method="post" c class="view-param d-flex mb-3 border-bottom pb-3">
         <!--
         <select name="rr"  class="form-select">
           <option>Record Request</option>
           <?php foreach($_SESSION['rr_view']['records'] as $key => $value){ ?>
             <option value="<?php echo $value; ?>" <?php if($_SESSION["rr"] == $value){ echo "selected"; } ?>><?php echo $value; ?></option>
           <?php } ?>
         </select>
       -->
         <div class="ms-3">

           <input type="hidden" name="refresh" value="true">
           <input type="submit" class="data-refresh btn btn-primary" id="nav-contact-tab" value="Refresh Data">

         </div>

     </form>
     <?php } */ ?>



     </div>



     <div id="report_1">

       <!--
       <div class="d-flex justify-content-between border-bottom ">
         <button class="btn btn-default mb-3 filter-toggle active" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="true" aria-controls="collapseExample">
           Hide Filters <i class="fal fa-angle-up"></i>
         </button>
         <div class="shit">
           <a class="btn btn-outline-primary ms-auto me-0" id="newWindow">New Window <i class="fal fa-window"></i></a>
           <button class="btn btn-outline-primary ms-3" id="csv">CSV <i class="fas fa-file-download"></i></button>
           <button id="pdf_export" class="btn btn-outline-primary ms-3">PDF  <i class="fas fa-file-download"></i></button>
         </div>
       </div>



       <div class="collapse show" id="collapseExample">
         <div class="card card-body bg-light mb-3">
           <ul class="nav nav-pills nav-fill">
             <li class="nav-item">
               <input class="search form-control" placeholder="Search by Loan #" />
             </li>
             <li class="nav-item ms-3">
               <select name="loan_type" class="form-control loan_filter">
                 <?php foreach($loan_type as $type){
                   $dashed = preg_replace('/[[:space:]]+/', '-', $type);
                   echo "<option value='$dashed'>$type</option>";
                 }?>
               </select>
             </li>
             <li class="nav-item ms-3">
               <button class="sort nav-link" data-sort="Loan Number">Loan #</button>
             </li>
             <li class="nav-item ms-3">
               <button class="sort nav-link" data-sort="Loan Status Date">Loan Status Date</button>
             </li>
             <li class="nav-item ms-3">
               <button class="sort nav-link" data-sort="Borr Last Name">Borrower Name</button>
             </li>
           </ul>
         </div>
       </div>
      -->

      <div class="table-filters"></div>


       <div class="table-wrapper">
      <div class="table-responsive" id="data-table-id">






              <!--
              <div>
        				Toggle column: <a class="toggle-vis" data-column="0">Loan Number</a> - <a class="toggle-vis" data-column="1">Position</a> - <a class="toggle-vis" data-column="2">Office</a> - <a class="toggle-vis" data-column="3">Age</a> - <a class="toggle-vis" data-column="4">Start date</a> - <a class="toggle-vis" data-column="5">Salary</a>
        			</div>
              -->

        <table class="report-table table table-striped" id="data-table">
         <thead>
           <tr>
             <?php foreach($_SESSION["data"][0] as $key => $value){
               echo "<th scope=\"col\">$key</th>";
             }
             ?>
           </tr>
         </thead>
         <tbody class="list">

           <?php foreach($_SESSION["data"] as $entry) {
             echo "<tr style='border: 1px solid #cecece; padding:15px; margin:15px;' class='loan-details all " . preg_replace('/[[:space:]]+/', '-', $entry["Loan Purpose"]) . " ln" . preg_replace('/[[:space:]]+/', '-', $entry["Loan Number"]) . " ln" . preg_replace('/[[:space:]]+/', '-', $entry["Borr Last Name"]). "'>";
             foreach($entry as $key => $value){
               if($key == "Loan Number"){
                 echo "<td class='".$key."'><a href='https://excelerate-dev.bluesageusa.com/lp/index.html#/loan/$value/loan-action?section=0' target='_blank' class='btn btn-default'>" . $value . "</a></td>";
               } else {
                 echo "<td class='".$key."'>" . $value . "</td>";
               }

                 // echo "<li>" . $key . ": " . $value . "</li>";
                 }
             echo "</tr>";
           } ?>

         </tbody>

         </table>


















       </div>
     </div>
       </div>
    </div>
  </div>
  </div>

@endsection
