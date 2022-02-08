@extends('layouts.app')

@section('content')

  <div class="db-content-inner p-5">

  <div class="alert alert-info" role="alert"><p style="margin:0;"><?php if(empty($_SESSION["data"])) {  echo "No Results Found"; } else { echo count($_SESSION["data"]) . " records found."; } ?></p></div>

  <div class="tab-content" id="nav-tabContent">
    <div class="tab-pane fade" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
      <h1>Your Pipeline</h1>
    </div>
    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
      <div class="table-responsive">
        <!--
      <table class="report-table table table-striped" id="tasks">
          <thead>
        <tr>
          <th scope="col"></th>
          <th scope="col">Task</th>
          <th scope="col">Subject</th>
          <th scope="col">Status</th>
          <th scope="col">Loan Number</th>
          <th scope="col">Borrower</th>
          <th scope="col">Due Date</th>
          <th scope="col">Last Update</th>
          <th scope="col">Assigned</th>
          <th scope="col">Owner</th>
        </tr>
      </thead>
      <tbody>

        <?php for ($x = 0; $x <= 50; $x++) { ?>
          <tr>
            <th scope="row">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                <label class="form-check-label" for="flexCheckDefault">

                </label>
              </div>
            </th>
            <td>XX<?php echo $x;?></td>
            <td>Lorem ipsum dolor sit amet, consectetur adipiscing elit</td>
            <td>Active</td>
            <td>XXXXXXXXXX</td>
            <td>Lorem Ipsum</td>
            <td>xx/xx/xxxx</td>
            <td>xx/xx/xxxx</td>
            <td>Lorem Ipsum</td>
            <td>Lorem Ipsum</td>
          </tr>
        <?php } ?>

      </tbody>

      </table>
      -->
    </div>

    </div>
    <div class="tab-pane fade show active" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">




      <?php
      $loan_type = array("Loan Type");
      foreach($_SESSION["data"] as $entry) {
        $type = $entry["Loan Purpose"];
        if(!in_array($type, $loan_type) && $type != ""){
          $loan_type[] = $type;
        }
      }
     ?>

     <div class="card p-3 bg-light mb-3">

       <form method="post" class="">
         <?php if(($_SESSION["role"] == "AE") || ($_SESSION["role"] == "AM")) { ?>

           <!--
           <ul class="nav nav-pills nav-fill">
             <li class="nav-item">
               <div class="radio-btn">
                 <input type="radio" class="btn-check loan-type-filter" id="ae_1" autocomplete="off" name="rr" value="approved/suspended" <?php if($_SESSION["rr"] == "approved/suspended"){ echo "checked"; } ?>>
                 <label class="btn btn-primary w-100" for="ae_1">Approved/Suspended</label>
               </div>
             </li>
             <li class="nav-item ms-2">
               <div class="radio-btn">
                 <input type="radio" class="btn-check loan-type-filter" id="ae_2" autocomplete="off" name="rr" value="ctcDocsOutBack" <?php if($_SESSION["rr"] == "ctcDocsOutBack"){ echo "checked"; } ?>>
                 <label class="btn btn-primary w-100" for="ae_2">ctc Docs Out Back</label>
               </div>
             </li>
             <li class="nav-item ms-2">
               <div class="radio-btn">
                 <input type="radio" class="btn-check loan-type-filter" id="ae_3" autocomplete="off" name="rr" value="fundedLastMonth" <?php if($_SESSION["rr"] == "fundedLastMonth"){ echo "checked"; } ?>>
                 <label class="btn btn-primary w-100" for="ae_3">Funded Last Month</label>
               </div>
             </li>
             <li class="nav-item ms-2">
               <div class="radio-btn">
                 <input type="radio" class="btn-check loan-type-filter" id="ae_4" autocomplete="off" name="rr" value="fundedMonthly" <?php if($_SESSION["rr"] == "fundedMonthly"){ echo "checked"; } ?>>
                 <label class="btn btn-primary w-100" for="ae_4">Funded Monthly</label>
               </div>
             </li>
             <li class="nav-item ms-2">
               <div class="radio-btn">
                 <input type="radio" class="btn-check loan-type-filter" id="ae_5" autocomplete="off" name="rr" value="locked" <?php if($_SESSION["rr"] == "locked"){ echo "checked"; } ?>>
                 <label class="btn btn-primary w-100" for="ae_5">Locked</label>
               </div>
             </li>
             <li class="nav-item ms-2">
               <div class="radio-btn">
                 <input type="radio" class="btn-check loan-type-filter" id="ae_6" autocomplete="off" name="rr" value="open/registered" <?php if($_SESSION["rr"] == "open/registered"){ echo "checked"; } ?>>
                 <label class="btn btn-primary w-100" for="ae_6">Open/Registered</label>
               </div>
             </li>
             <li class="nav-item ms-2">
               <div class="radio-btn">
                 <input type="radio" class="btn-check loan-type-filter" id="ae_7" autocomplete="off" name="rr" value="resubmissionQuery" <?php if($_SESSION["rr"] == "resubmissionQuery"){ echo "checked"; } ?>>
                 <label class="btn btn-primary w-100" for="ae_7">Resubmission Query</label>
               </div>
             </li>
             <li class="nav-item ms-2">
               <div class="radio-btn">
                 <input type="radio" class="btn-check loan-type-filter" id="ae_8" autocomplete="off" name="rr" value="setup/processing" <?php if($_SESSION["rr"] == "setup/processing"){ echo "checked"; } ?>>
                 <label class="btn btn-primary w-100" for="ae_8">Setup/Processing</label>
               </div>
             </li>
             <li class="nav-item ms-2">
               <div class="radio-btn">
                 <input type="radio" class="btn-check loan-type-filter" id="ae_9" autocomplete="off" name="rr" value="submitted" <?php if($_SESSION["rr"] == "submitted"){ echo "checked"; } ?>>
                 <label class="btn btn-primary w-100" for="ae_9">Submitted</label>
               </div>
             </li>
           </ul>
         -->




         <select name="rr"  class="form-select">
           <option>Record Request</option>
           <option value="approved/suspended" <?php if($_SESSION["rr"] == "approved/suspended"){ echo "selected"; } ?>>Approved/Suspended</option>
           <option value="ctcDocsOutBack" <?php if($_SESSION["rr"] == "ctcDocsOutBack"){ echo "selected"; } ?>>ctc Docs Out Back</option>
           <option value="fundedLastMonth" <?php if($_SESSION["rr"] == "fundedLastMonth"){ echo "selected"; } ?>>Funded Last Month</option>
           <option value="fundedMonthly" <?php if($_SESSION["rr"] == "fundedMonthly"){ echo "selected"; } ?>>Funded Monthly</option>
           <option value="locked" <?php if($_SESSION["rr"] == "locked"){ echo "selected"; } ?>>Locked</option>
           <option value="open/registered" <?php if($_SESSION["rr"] == "open/registered"){ echo "selected"; } ?>>Open/Registered</option>
           <option value="resubmissionQuery" <?php if($_SESSION["rr"] == "resubmissionQuery"){ echo "selected"; } ?>>Resubmission Query</option>
           <option value="setup/processing" <?php if($_SESSION["rr"] == "setup/processing"){ echo "selected"; } ?>>Setup/Processing</option>
           <option value="submitted" <?php if($_SESSION["rr"] == "submitted"){ echo "selected"; } ?>>Submitted</option>
         </select>


       <?php } ?>
       <?php if(($_SESSION["role"] == "SETUP")) { ?>
         <select name="rr"  class="form-select">
           <option>Record Request</option>
           <option value="open" <?php if($_SESSION["rr"] == "open"){ echo "selected"; } ?>>Open</option>
           <option value="registered" <?php if($_SESSION["rr"] == "registered"){ echo "selected"; } ?>>Registered</option>
           <option value="submitted" <?php if($_SESSION["rr"] == "submitted"){ echo "selected"; } ?>>Submitted</option>
           <option value="underwritersSubmitted" <?php if($_SESSION["rr"] == "underwritersSubmitted"){ echo "selected"; } ?>>Underwriters Submitted</option>
         </select>
       <?php } ?>
       <?php if(($_SESSION["role"] == "UND")) { ?>
         <select name="rr"  class="form-select">
           <option>Record Request</option>
           <option value="approved" <?php if($_SESSION["rr"] == "approved"){ echo "selected"; } ?>>Approved</option>
           <option value="finalUnderwriting" <?php if($_SESSION["rr"] == "finalUnderwriting"){ echo "selected"; } ?>>Final Underwriting</option>
           <option value="underwritersSubmitted" <?php if($_SESSION["rr"] == "underwritersSubmitted"){ echo "selected"; } ?>>Underwriters Submitted</option>
         </select>
       <?php } ?>
       <?php if(($_SESSION["role"] == "FUND")) { ?>
         <select name="rr"  class="form-select">
           <option>Record Request</option>
           <option value="ctcDocsOutBack" <?php if($_SESSION["rr"] == "ctcDocsOutBack"){ echo "selected"; } ?>>ctc Docs Out Back</option>
         </select>
       <?php } ?>

         <input type="hidden" name="refresh" value="true">
         <input type="submit" class="data-refresh btn btn-primary" id="nav-contact-tab" value="Refresh Data">
      
     </form>
               <!-- Form for ADMIN VIEW
               <form method="post" class="row align-items-center">
                 <?php //if(is_admin()){ ?>
                 <div class="col-12 col-sm-3 col-lg-2">
                 <select name="role" class="form-select">
                   <option>Role</option>
                   <option value="AE" <?php if($_SESSION["role"] == "AE"){ echo "selected"; } ?>>AE</option>
               		<option value="AM" <?php if($_SESSION["role"] == "AM"){ echo "selected"; } ?>>AM</option>
               		<option value="UND" <?php if($_SESSION["role"] == "UND"){ echo "selected"; } ?>>UND</option>
               		<option value="SETUP" <?php if($_SESSION["role"] == "SETUP"){ echo "selected"; } ?>>SETUP</option>
               	   <option value="FUND" <?php if($_SESSION["role"] == "FUND"){ echo "selected"; } ?>>FUND</option>
                 </select>
               </div>
               <?php //} ?>
               <div class="col-12 col-sm-5 col-lg-4">
                 <?php if(($_SESSION["role"] == "AE") || ($_SESSION["role"] == "AM")) { ?>
                 <select name="rr"  class="form-select">
                   <option>Record Request</option>
                   <option value="approved/suspended" <?php if($_SESSION["rr"] == "approved/suspended"){ echo "selected"; } ?>>Approved/Suspended</option>
                   <option value="ctcDocsOutBack" <?php if($_SESSION["rr"] == "ctcDocsOutBack"){ echo "selected"; } ?>>ctc Docs Out Back</option>
                   <option value="fundedLastMonth" <?php if($_SESSION["rr"] == "fundedLastMonth"){ echo "selected"; } ?>>Funded Last Month</option>
                   <option value="fundedMonthly" <?php if($_SESSION["rr"] == "fundedMonthly"){ echo "selected"; } ?>>Funded Monthly</option>
                   <option value="locked" <?php if($_SESSION["rr"] == "locked"){ echo "selected"; } ?>>Locked</option>
                   <option value="open/registered" <?php if($_SESSION["rr"] == "open/registered"){ echo "selected"; } ?>>Open/Registered</option>
                   <option value="resubmissionQuery" <?php if($_SESSION["rr"] == "resubmissionQuery"){ echo "selected"; } ?>>Resubmission Query</option>
                   <option value="setup/processing" <?php if($_SESSION["rr"] == "setup/processing"){ echo "selected"; } ?>>Setup/Processing</option>
                   <option value="submitted" <?php if($_SESSION["rr"] == "submitted"){ echo "selected"; } ?>>Submitted</option>
                 </select>
               <?php } ?>
               <?php if(($_SESSION["role"] == "SETUP")) { ?>
                 <select name="rr"  class="form-select">
                   <option>Record Request</option>
                   <option value="open" <?php if($_SESSION["rr"] == "open"){ echo "selected"; } ?>>Open</option>
                   <option value="registered" <?php if($_SESSION["rr"] == "registered"){ echo "selected"; } ?>>Registered</option>
                   <option value="submitted" <?php if($_SESSION["rr"] == "submitted"){ echo "selected"; } ?>>Submitted</option>
                   <option value="underwritersSubmitted" <?php if($_SESSION["rr"] == "underwritersSubmitted"){ echo "selected"; } ?>>Underwriters Submitted</option>
                 </select>
               <?php } ?>
               <?php if(($_SESSION["role"] == "UND")) { ?>
                 <select name="rr"  class="form-select">
                   <option>Record Request</option>
                   <option value="approved" <?php if($_SESSION["rr"] == "approved"){ echo "selected"; } ?>>Approved</option>
                   <option value="finalUnderwriting" <?php if($_SESSION["rr"] == "finalUnderwriting"){ echo "selected"; } ?>>Final Underwriting</option>
                   <option value="underwritersSubmitted" <?php if($_SESSION["rr"] == "underwritersSubmitted"){ echo "selected"; } ?>>Underwriters Submitted</option>
                 </select>
               <?php } ?>
               <?php if(($_SESSION["role"] == "FUND")) { ?>
                 <select name="rr"  class="form-select">
                   <option>Record Request</option>
                   <option value="ctcDocsOutBack" <?php if($_SESSION["rr"] == "ctcDocsOutBack"){ echo "selected"; } ?>>ctc Docs Out Back</option>
                 </select>
               <?php } ?>
               </div>
               <div class="col">
                 <input type="hidden" name="refresh" value="true">
                 <input type="submit" class="data-refresh btn btn-primary" id="nav-contact-tab" value="Refresh Data">
               </div>
             </form>
              -->

     </div>



     <div id="report_1">
       <div class="d-flex justify-content-between border-bottom">
         <button class="btn btn-default mb-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
           Filter Table <i class="fa fa-angle-down"></i>
         </button>
         <div class="shit">
           <a class="btn btn-outline-primary ms-auto me-0" id="newWindow">New Window <i class="fal fa-window"></i></a>
           <button class="btn btn-outline-primary ms-3" id="csv">Download CSV <i class="fas fa-file-download"></i></button>
         </div>
       </div>


       <div class="collapse" id="collapseExample">
         <div class="card card-body bg-light">
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






      <div class="table-responsive">

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
             echo "<tr style='border: 1px solid #cecece; padding:15px; margin:15px;' class='loan-details all " . preg_replace('/[[:space:]]+/', '-', $entry["Loan Purpose"]) . " ln" . preg_replace('/[[:space:]]+/', '-', $entry["Loan Number"]) . "'>";
             foreach($entry as $key => $value){
               if($key == "Loan Number"){
                 echo "<td class='".$key."'><a href='https://excelerate-dev.bluesageusa.com/lp/index.html#/loan/$value/loan-action?section=0' target='_blank'>" . $value . "</a></td>";
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

@endsection
