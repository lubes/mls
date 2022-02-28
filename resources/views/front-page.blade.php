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


     <div class="row align-items-top mb-3">
         <!--<div class="col-md-5">
         <form method="post" class="view-form d-flex align-items-center">

           <div class="col-md-6">
             <div class="dash-info dash-summary">
               <span class="dash-info-text">Currently Viewing:</span>
               <span id="current_view" class="dash-info-desc">Select a Report</span>
             </div>
           </div>
           <div class="col-md-6">
             <div class="dash-info dash-summary">
               <span class="dash-info-text">Update View:</span>
               <select class="rr_view form-select" name="rr_view">
                 <option>Select Record Request</option>
               </select>
             </div>
           </div>

           <input type="hidden" name="refresh" value="true">
         </form>
       </div>-->
       <div class="col-md-7">
         <div class="row dash-header" style="display:none;">
           <div class="col-md-6"><div class="dash-info dash-summary"><span class="dash-info-text">Total Loan Amount</span><div class="dash-info-card"><span class="dash-info-value" id="loan_sum">value</span></div></div></div>
           <div class="col-md-4"><div class="dash-info dash-summary" ><span class="dash-info-text">Total Loan Count</span><div class="dash-info-card"><span class="dash-info-value" id="loan_count">value</span></div></div></div>
         </div>
       </div>
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
