@extends('layouts.app')

@section('content')


  <div class="db-content-inner p-5">
  <nav class="user-nav mb-3">
    <div class="row">
      <div class="col-12 alert alert-info" role="alert"><p style="margin:0;"><?php if(empty($_SESSION["data"])) {  echo "No Results Found"; } else { echo count($_SESSION["data"]) . " records found."; } ?></p></div>
      <div class="col-md-9">
        <div class="nav nav-pills" id="nav-tab" role="tablist">
          <form method="post" class="row row-cols-lg-auto g-3 align-items-center">
            <?php //if(is_admin()){ ?>
            <div class="col-12 col-sm-3">
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
          <div class="col-12 col-sm-3">
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
          <div class="col-12 col-sm-3">

            <input type="hidden" name="refresh" value="true">
            <input type="submit" class="nav-link active data-refresh" id="nav-contact-tab" value="Refresh Data">
          </div></form>
          <!--<a class="btn btn-danger disabled btn-circle" href="#"><i class="fal fa-plus"></i></a>-->
        </div>
      </div>
      <div class="col-md-3">
        <div class="mb-3 mb-lg-0">
          <!--<input type="text"  id="taskSearch" class="form-control" id="floatingInput" placeholder="Task # Search">-->
        </div>
      </div>
    </div>



  </nav>
  <div class="tab-content" id="nav-tabContent">
    <div class="tab-pane fade" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
      <h1>Your Pipeline</h1>
    </div>
    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
      <div class="table-responsive">
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


       <hr>
       <div class="row">
         <div class="col-md-4">
           <select name="loan_type" class="form-control loan_filter">
             <?php foreach($loan_type as $type){
               $dashed = preg_replace('/[[:space:]]+/', '-', $type);
               echo "<option value='$dashed'>$type</option>";
             }?>
           </select>
         </div>
         <div class="col-md-8">
           <a class="btn btn-primary ms-auto me-0" id="newWindow">New Window <i class="fal fa-external-link"></i></a>
         </div>

       </div>

      <div class="table-responsive">
        <div id="report_1">
      <table class="report-table table table-striped">
         <thead>
           <tr>
             <?php foreach($_SESSION["data"][0] as $key => $value){
               echo "<th scope=\"col\">$key</th>";
             }

          ?>
           </tr>
         </thead>
         <tbody>

           <?php foreach($_SESSION["data"] as $entry) {
             echo "<tr style='border: 1px solid #cecece; padding:15px; margin:15px;' class='all " . preg_replace('/[[:space:]]+/', '-', $entry["Loan Purpose"]) . "'>";
             foreach($entry as $key => $value){
               if($key == "Loan Number"){
                 echo "<td><a href='https://excelerate-dev.bluesageusa.com/lp/index.html#/loan/$value/loan-action?section=0' target='_blank'>" . $value . "</a></td>";
               } else {
                 echo "<td>" . $value . "</td>";
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
