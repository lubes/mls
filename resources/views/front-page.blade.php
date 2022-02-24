@extends('layouts.app')

@section('content')

  <div class="db-content-inner p-0 p-md-5">

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


     <div class="row align-items-center mb-3">

       <div class="col-md-5">
         <form method="post" class="view-form d-flex align-items-center">
          <?php if($_SESSION["role"] == "ADMIN"){ ?>
           <select class="admin_view form-select" name="admin_view">
             <option>Select Admin Role</option>
           </select>
           <?php } ?>
           <p class="ms-3 mb-3 mb-md-0">Currently Viewing: <span id="current_view"></span></p>
           <p class="ms-3 mb-3 mb-md-0">Update View:
             <select class="rr_view form-select" name="rr_view">
               <option>Select Record Request</option>
             </select>
           </p>
           <input type="hidden" name="refresh" value="true">
         </form>
       </div>
       <div class="col-md-7">
         <div class="row dash-header">
           <!--
           <div class="col-md-4">
             <div class="dash-info dash-summary" id="loan_sum">
               <span class="dash-info-text">Total Loan Amount</span>
               <div class="dash-info-card">
                 <span class="dash-info-value" id="loan_sum_val"></span>
               </div>
             </div>
           </div>
           <div class="col-md-4">
             <div class="dash-info dash-summary" id="loan_avg">
               <span class="dash-info-text">Total Loan Amount</span>
               <div class="dash-info-card">
                 <span class="dash-info-value" id="loan_avg_val"></span>
               </div>
             </div>
           </div>
           <div class="col-md-4">
             <div class="dash-info dash-summary" id="loan_no">
               <span class="dash-info-text">Total Loan Amount</span>
               <div class="dash-info-card">
                 <span class="dash-info-value" id="loan_no_val"></span>
               </div>
             </div>
           </div>
          -->
         </div>
       </div>



     <!--<a class="btn btn-default ms-auto me-0" id="newWindow">New Window <i class="fal fa-window"></i></a>-->


     </div>



     <div id="report_1">

       <div id="loader">
         <div class="loader">
           <div class="triangle_wrap">
             <div class="pyramid">
               <div class="square">
                 <div class="triangle"></div>
                 <div class="triangle"></div>
                 <div class="triangle"></div>
                 <div class="triangle"></div>
               </div>
             </div>
           </div>
         </div>
       </div>

       <div class="table-wrapper">
      <div class="table-responsive" id="data-table-id">


         <table id="example" class="report-table table table-striped">
           <thead>
             <tr class="table-header">
               <th>hi</th>
             </tr>
          </thead>
          <tbody class="table-body list">
            <tr>
              <td>hello</td>
            </tr>
          </tbody>
         </table>

       </div>
     </div>
       </div>
    </div>
  </div>
  </div>

@endsection
