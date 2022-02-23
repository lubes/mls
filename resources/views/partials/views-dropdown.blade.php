<div class="dropdown-group">
  <button class="dropdown-toggler dropdown-toggle" type="button" data-bs-toggle="collapse" data-bs-target="#userDropdown" aria-expanded="true" aria-controls="viewDropdown">
    <i class="fal fa-table"></i> Views
  </button>
  <div class="collapse show" id="userDropdown">
    <div class="card card-body">
      <form method="post" class="">
        <ul class="side-nav">
          <li class="nav-item">
            <div class="radio-btn">
              <input type="radio" class="btn-check loan-type-filter" id="ae_1" autocomplete="off" name="rr" value="approved/suspended" <?php if($_SESSION["rr"] == "approved/suspended"){ echo "checked"; } ?>>
              <label class="btn w-100 <?php if($_SESSION["rr"] == "approved/suspended"){ echo ""; } ?>" for="ae_1"><i class="fal fa-check"></i> Approved/Suspended</label>
            </div>
          </li>
          <li class="nav-item">
            <div class="radio-btn">
              <input type="radio" class="btn-check loan-type-filter" id="ae_2" autocomplete="off" name="rr" value="ctcDocsOutBack" <?php if($_SESSION["rr"] == "ctcDocsOutBack"){ echo "checked"; } ?>>
              <label class="btn w-100 <?php if($_SESSION["rr"] == "ctcDocsOutBack"){ echo ""; } ?>" for="ae_2"><i class="fal fa-file-spreadsheet"></i> ctc Docs Out Back</label>
            </div>
          </li>
          <li class="nav-item">
            <div class="radio-btn">
              <input type="radio" class="btn-check loan-type-filter" id="ae_3" autocomplete="off" name="rr" value="fundedLastMonth" <?php if($_SESSION["rr"] == "fundedLastMonth"){ echo "checked"; } ?>>
              <label class="btn w-100 <?php if($_SESSION["rr"] == "fundedLastMonth"){ echo ""; } ?>" for="ae_3"><i class="fal fa-calendar-alt"></i> Funded Last Month</label>
            </div>
          </li>
          <li class="nav-item">
            <div class="radio-btn">
              <input type="radio" class="btn-check loan-type-filter" id="ae_4" autocomplete="off" name="rr" value="fundedMonthly" <?php if($_SESSION["rr"] == "fundedMonthly"){ echo "checked"; } ?>>
              <label class="btn w-100 <?php if($_SESSION["rr"] == "fundedMonthly"){ echo ""; } ?>" for="ae_4"><i class="fal fa-calendar-week"></i> Funded Monthly</label>
            </div>
          </li>
          <li class="nav-item">
            <div class="radio-btn">
              <input type="radio" class="btn-check loan-type-filter" id="ae_5" autocomplete="off" name="rr" value="locked" <?php if($_SESSION["rr"] == "locked"){ echo "checked"; } ?>>
              <label class="btn w-100 <?php if($_SESSION["rr"] == "locked"){ echo ""; } ?>" for="ae_5"><i class="fal fa-lock"></i> Locked</label>
            </div>
          </li>
          <li class="nav-item">
            <div class="radio-btn">
              <input type="radio" class="btn-check loan-type-filter" id="ae_6" autocomplete="off" name="rr" value="open/registered" <?php if($_SESSION["rr"] == "open/registered"){ echo "checked"; } ?>>
              <label class="btn w-100 <?php if($_SESSION["rr"] == "open/registered"){ echo ""; } ?>" for="ae_6"><i class="fal fa-unlock"></i> Open/Registered</label>
            </div>
          </li>
          <li class="nav-item">
            <div class="radio-btn">
              <input type="radio" class="btn-check loan-type-filter" id="ae_7" autocomplete="off" name="rr" value="resubmissionQuery" <?php if($_SESSION["rr"] == "resubmissionQuery"){ echo "checked"; } ?>>
              <label class="btn w-100 <?php if($_SESSION["rr"] == "resubmissionQuery"){ echo ""; } ?>" for="ae_7"><i class="fal fa-paper-plane"></i> Resubmission Query</label>
            </div>
          </li>
          <li class="nav-item">
            <div class="radio-btn">
              <input type="radio" class="btn-check loan-type-filter" id="ae_8" autocomplete="off" name="rr" value="setup/processing" <?php if($_SESSION["rr"] == "setup/processing"){ echo "checked"; } ?>>
              <label class="btn w-100 <?php if($_SESSION["rr"] == "setup/processing"){ echo ""; } ?>" for="ae_8"><i class="fal fa-history"></i> Setup/Processing</label>
            </div>
          </li>
          <li class="nav-item">
            <div class="radio-btn">
              <input type="radio" class="btn-check loan-type-filter" id="ae_9" autocomplete="off" name="rr" value="submitted" <?php if($_SESSION["rr"] == "submitted"){ echo "checked"; } ?>>
              <label class="btn w-100 <?php if($_SESSION["rr"] == "submitted"){ echo ""; } ?>" for="ae_9"><i class="fal fa-tasks"></i> Submitted</label>
            </div>
          </li>
        </ul>
        <input type="hidden" name="refresh" value="true">
    </form>
    </div>
  </div>
</div>
