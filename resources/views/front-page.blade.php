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


     <div class="d-flex justify-content-between align-items-center mb-3">

       <form method="post" class="view-form d-flex align-items-center">
        <?php if($_SESSION["role"] == "ADMIN"){ ?>
         <select class="admin_view form-select" name="admin_view">
           <option>Select Admin Role</option>
         </select>
         <?php } ?>

       <!--
         <div class="dropdown">
           <button class="btn btn-danger dropdown-toggle btn-lg" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
             Select Record Request
           </button>
           <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
             <li class="dropdown-item">
               <div class="radio-btn">
                 <input type="radio" class="btn-check loan-type-filter" id="ae_1" autocomplete="off" name="rr" value="approved/suspended" <?php if($_SESSION["rr"] == "approved/suspended"){ echo "checked"; } ?>>
                 <label class="btn w-100 <?php if($_SESSION["rr"] == "approved/suspended"){ echo "active"; } ?>" for="ae_1"><i class="fal fa-check"></i> Approved/Suspended</label>
               </div>
             </li>
             <li class="dropdown-item">
               <div class="radio-btn">
                 <input type="radio" class="btn-check loan-type-filter" id="ae_2" autocomplete="off" name="rr" value="ctcDocsOutBack" <?php if($_SESSION["rr"] == "ctcDocsOutBack"){ echo "checked"; } ?>>
                 <label class="btn w-100 <?php if($_SESSION["rr"] == "ctcDocsOutBack"){ echo "active"; } ?>" for="ae_2"><i class="fal fa-file-spreadsheet"></i> ctc Docs Out Back</label>
               </div>
             </li>
             <li class="dropdown-item">
               <div class="radio-btn">
                 <input type="radio" class="btn-check loan-type-filter" id="ae_3" autocomplete="off" name="rr" value="fundedLastMonth" <?php if($_SESSION["rr"] == "fundedLastMonth"){ echo "checked"; } ?>>
                 <label class="btn w-100 <?php if($_SESSION["rr"] == "fundedLastMonth"){ echo "active"; } ?>" for="ae_3"><i class="fal fa-calendar-alt"></i> Funded Last Month</label>
               </div>
             </li>
             <li class="dropdown-item">
               <div class="radio-btn">
                 <input type="radio" class="btn-check loan-type-filter" id="ae_4" autocomplete="off" name="rr" value="fundedMonthly" <?php if($_SESSION["rr"] == "fundedMonthly"){ echo "checked"; } ?>>
                 <label class="btn w-100 <?php if($_SESSION["rr"] == "fundedMonthly"){ echo "active"; } ?>" for="ae_4"><i class="fal fa-calendar-week"></i> Funded Monthly</label>
               </div>
             </li>
             <li class="dropdown-item">
               <div class="radio-btn">
                 <input type="radio" class="btn-check loan-type-filter" id="ae_5" autocomplete="off" name="rr" value="locked" <?php if($_SESSION["rr"] == "locked"){ echo "checked"; } ?>>
                 <label class="btn w-100 <?php if($_SESSION["rr"] == "locked"){ echo "active"; } ?>" for="ae_5"><i class="fal fa-lock"></i> Locked</label>
               </div>
             </li>
             <li class="dropdown-item">
               <div class="radio-btn">
                 <input type="radio" class="btn-check loan-type-filter" id="ae_6" autocomplete="off" name="rr" value="open/registered" <?php if($_SESSION["rr"] == "open/registered"){ echo "checked"; } ?>>
                 <label class="btn w-100 <?php if($_SESSION["rr"] == "open/registered"){ echo "active"; } ?>" for="ae_6"><i class="fal fa-unlock"></i> Open/Registered</label>
               </div>
             </li>
             <li class="dropdown-item">
               <div class="radio-btn">
                 <input type="radio" class="btn-check loan-type-filter" id="ae_7" autocomplete="off" name="rr" value="resubmissionQuery" <?php if($_SESSION["rr"] == "resubmissionQuery"){ echo "checked"; } ?>>
                 <label class="btn w-100 <?php if($_SESSION["rr"] == "resubmissionQuery"){ echo "active"; } ?>" for="ae_7"><i class="fal fa-paper-plane"></i> Resubmission Query</label>
               </div>
             </li>
             <li class="dropdown-item">
               <div class="radio-btn">
                 <input type="radio" class="btn-check loan-type-filter" id="ae_8" autocomplete="off" name="rr" value="setup/processing" <?php if($_SESSION["rr"] == "setup/processing"){ echo "checked"; } ?>>
                 <label class="btn w-100 <?php if($_SESSION["rr"] == "setup/processing"){ echo "active"; } ?>" for="ae_8"><i class="fal fa-history"></i> Setup/Processing</label>
               </div>
             </li>
             <li class="dropdown-item">
               <div class="radio-btn">
                 <input type="radio" class="btn-check loan-type-filter" id="ae_9" autocomplete="off" name="rr" value="submitted" <?php if($_SESSION["rr"] == "submitted"){ echo "checked"; } ?>>
                 <label class="btn w-100 <?php if($_SESSION["rr"] == "submitted"){ echo "active"; } ?>" for="ae_9"><i class="fal fa-tasks"></i> Submitted</label>
               </div>
             </li>
           </ul>
         </div>
       -->

         <p class="ms-3 mb-3 mb-md-0">Currently Viewing: <span id="current_view"></span></p>
         <select class="rr_view form-select btn btn-danger" name="rr_view">
           <option>Select Record Request</option>
         </select>
         <input type="hidden" name="refresh" value="true">
       </form>


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
