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

     <div class="card p-3 bg-light mb-3">
       <?php if($_SESSION["role"] == "ADMIN") { ?>
         <form method="post" class="col-3">

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

                  <select name="rr"  class="form-select">
                    <option>Record Request</option>
                    <?php foreach($_SESSION['rr_view']['records'] as $key => $value){ ?>
                      <option value="<?php echo $value; ?>" <?php if($_SESSION["rr"] == $value){ echo "selected"; } ?>><?php echo $value; ?></option>
                    <?php } ?>
                  </select> (Will make this dynamic next)


                  <input type="hidden" name="refresh" value="true">
                  <input type="submit" class="data-refresh btn btn-primary" id="nav-contact-tab" value="Change Role">

              <?php } ?>

       </form>
<?php } else if(!empty($_SESSION['rr_view'])){ ?>
       <form method="post" c class="col-3">

         <select name="rr"  class="form-select">
           <option>Record Request</option>
           <?php foreach($_SESSION['rr_view']['records'] as $key => $value){ ?>
             <option value="<?php echo $value; ?>" <?php if($_SESSION["rr"] == $value){ echo "selected"; } ?>><?php echo $value; ?></option>
           <?php } ?>
         </select>


         <input type="hidden" name="refresh" value="true">
         <input type="submit" class="data-refresh btn btn-primary" id="nav-contact-tab" value="Refresh Data">

     </form>
     <?php } ?>

     </div>



     <div id="report_1">
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
             <!--<li class="nav-item ms-3">
               <select name="loan_type" class="form-control loan_filter">
                 <?php foreach($loan_type as $type){
                   $dashed = preg_replace('/[[:space:]]+/', '-', $type);
                   echo "<option value='$dashed'>$type</option>";
                 }?>
               </select>
             </li>-->
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




       <div class="table-wrapper">


      <div class="table-responsive" id="data-table-id">

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
