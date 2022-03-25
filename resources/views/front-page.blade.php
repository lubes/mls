@extends('layouts.app')

@section('content')

  <div class="db-content-inner p-0 p-md-5">
  <!--<div class="alert alert-info" role="alert"><p style="margin:0;"><?php if(empty($_SESSION["data"])) {  echo "No Results Found"; } else { echo count($_SESSION["data"]) . " records found."; } ?>-->

  <div class="table-key d-flex justify-content-between">
    <div class="table-key-item d-flex align-items-center">
      <span class="key-block" style="background:#EEEEEE"></span>
      <span class="key-name">Cancelled / Withdrawn</span>
    </div>
    <div class="table-key-item d-flex align-items-center">
      <span class="key-block" style="background:#fff"></span>
      <span class="key-name">Unassigned</span>
    </div>
    <div class="table-key-item d-flex align-items-center">
      <span class="key-block" style="background:#C4FFCF"></span>
      <span class="key-name">Non-QM Purchase</span>
    </div>
    <div class="table-key-item d-flex align-items-center">
      <span class="key-block" style="background:#C4FFFF"></span>
      <span class="key-name">Non-QM Other</span>
    </div>
    <div class="table-key-item d-flex align-items-center">
      <span class="key-block" style="background:#C4CEFF"></span>
      <span class="key-name">Jumbo Loan</span>
    </div>
    <div class="table-key-item d-flex align-items-center">
      <span class="key-block" style="background:#EAC4FF"></span>
      <span class="key-name">Heloc</span>
    </div>
    <div class="table-key-item d-flex align-items-center">
      <span class="key-block" style="background:#FDFFC4"></span>
      <span class="key-name">Conventional / VA / FHA</span>
    </div>
  </div>


  <ul class="nav nav-tabs mt-4" id="myTab" role="tablist">
    <li class="nav-item" role="presentation">
      <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">All Reports</button>
    </li>
    <li class="nav-item" role="presentation">
      <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">My Reports</button>
    </li>
  </ul>

    <div class="tab-content" id="myTabContent">
      <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
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
                <table id="example" class="report-table table">
                  <thead>
                    <tr class="table-header">
                      <th></th>
                    </tr>
                 </thead>
                 <tbody class="table-body list">
                   <tr>
                     <td></td>
                   </tr>
                 </tbody>
                </table>
              </div>
            </div>
          </div>
      </div>
      <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">

          <div class="table-wrapper">
            <table class="table report-table table-responsive" id="userTable">
                 <thead>
                   <tr class="table-header">
                     <th></th>
                   </tr>
                </thead>
                <tbody class="table-body list">
                  <tr>
                    <td></td>
                  </tr>
                </tbody>
             </table>
        </div>

      </div>
    </div>
  </div>

  <!--Assign Modal -->
  <div class="modal fade" id="assignModal" tabindex="-1" aria-labelledby="assignModal" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header"><h5 class="modal-title assign-loan">Confirm</h5>
          <button type="button" class="btn-close assign-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body pt-5 pb-5 text-center"><h3 class="modal-title">Are you sure you want to assign yourself to this loan?</h3>

        </div>
        <div class="modal-footer d-flex justify-content-center">
          <button type="button" class="btn btn-primary assign-confirm" data-ln="">Confirm</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        </div>
      </div>
    </div>
  </div>

@endsection
