<!doctype html>
<html {!! get_language_attributes() !!}>
  @include('partials.head')
  <body @php body_class() @endphp>
    @php do_action('get_header') @endphp

  <?php
    $current_user = wp_get_current_user();
    //echo 'Username: ' . $current_user->user_login . '<br />';
    //echo 'User email: ' . $current_user->user_email . '<br />';
    //echo 'User first name: ' . $current_user->user_firstname . '<br />';
    //echo 'User last name: ' . $current_user->user_lastname . '<br />';
    //echo 'User display name: ' . $current_user->display_name . '<br />';
  ?>

    <div class="wrap" role="document">
      <div class="content">
        <main class="main d-block d-md-flex">

          <div class="d-flex bg-dark main-sidebar">
            <a class="btn btn-circle btn-danger sidebar-toggle close-sidebar" href="#"><i class="far fa-chevron-right"></i></a>
            <div class="d-flex main-sidebar-inner  flex-column flex-shrink-0 p-3 text-white">
              <a href="<?php echo site_url();?>/home" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none sb-logo">
                <img src="https://exceleratecapital.com/wp-content/themes/ec_theme/resources/assets/images/logo.svg" class="img-fluid" alt="" />
              </a>







              <?php /*
              if($_SESSION["role"] == "ADMIN") { ?>



                  <?php if(!empty($_SESSION['rr_view'])){ ?>



                   <?php } ?>

            <?php } else if(!empty($_SESSION['rr_view'])){ ?>

            <?php } */
            ?>































            <?php
             if($_SESSION["role"] == "AE") { ?>

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
                            <input type="radio" class="btn-check loan-type-filter" id="role_ae" autocomplete="off" name="admin_role" value="AE" <?php if($_SESSION["role"] == "AE"){ echo "checked"; } ?>>
                            <label class="btn w-100 <?php if($_SESSION["role"] == "AE"){ echo "active"; } ?>" for="role_ae"><i class="fal fa-user"></i> Account Executive</label>
                          </div>
                        </li>
                        <li class="nav-item">
                          <div class="radio-btn">
                            <input type="radio" class="btn-check loan-type-filter" id="am" autocomplete="off" name="admin_role" value="AM" <?php if($_SESSION["role"] == "ctcDocsOutBack"){ echo "checked"; } ?>>
                            <label class="btn w-100 <?php if($_SESSION["role"] == "AM"){ echo "active"; } ?>" for="ae_2"><i class="fal fa-user"></i> Account Manager</label>
                          </div>
                        </li>
                        <li class="nav-item">
                          <div class="radio-btn">
                            <input type="radio" class="btn-check loan-type-filter" id="fund" autocomplete="off" name="admin_role" value="FUND" <?php if($_SESSION["role"] == "fundedLastMonth"){ echo "checked"; } ?>>
                            <label class="btn w-100 <?php if($_SESSION["role"] == "FUND"){ echo "active"; } ?>" for="ae_3"><i class="fal fa-user"></i> Funder</label>
                          </div>
                        </li>
                        <li class="nav-item">
                          <div class="radio-btn">
                            <input type="radio" class="btn-check loan-type-filter" id="setup" autocomplete="off" name="admin_role" value="SETUP" <?php if($_SESSION["role"] == "fundedMonthly"){ echo "checked"; } ?>>
                            <label class="btn w-100 <?php if($_SESSION["role"] == "SETUP"){ echo "active"; } ?>" for="ae_4"><i class="fal fa-user"></i> Setup Coordinator</label>
                          </div>
                        </li>
                        <li class="nav-item">
                          <div class="radio-btn">
                            <input type="radio" class="btn-check loan-type-filter" id="und" autocomplete="off" name="admin_role" value="UND" <?php if($_SESSION["role"] == "locked"){ echo "checked"; } ?>>
                            <label class="btn w-100 <?php if($_SESSION["role"] == "UND"){ echo "active"; } ?>" for="ae_5"><i class="fal fa-user"></i> Underwriter</label>
                          </div>
                        </li>
                      </ul>

                       <input type="hidden" name="refresh" value="true">
                     </form>
                  </div>
                </div>
              </div>

              <?php if(!empty($_SESSION['rr_view'])){ ?>

                @include('partials.views-dropdown')

               <?php } ?>


             <?php } else if(!empty($_SESSION['rr_view'])){ ?>
               @include('partials.views-dropdown')
             <?php } ?>












              <!--
              <ul class="list-unstyled ps-0">
                    <li class="mb-1">
                      <button class="btn btn-toggle align-items-center link-light" data-bs-toggle="collapse" data-bs-target="#home-collapse" aria-expanded="false">
                        <i class="fas fa-cog"></i> Settings
                      </button>
                      <div class="collapse show" id="home-collapse" style="">
                        <ul class="btn-toggle-nav sub-menu list-unstyled fw-normal pb-1 small">
                          <li><a href="#" class="link-light">Overview</a></li>
                          <li><a href="#" class="link-light">Updates</a></li>
                          <li><a href="#" class="link-light">Reports</a></li>
                        </ul>
                      </div>
                    </li>
                    <li class="mb-1">
                      <button class="btn btn-toggle collapsed text-white" data-bs-toggle="collapse" data-bs-target="#reporting-collapse" aria-expanded="false">
                        <i class="fas fa-pencil"></i> Reporting
                      </button>
                      <div class="collapse" id="reporting-collapse">
                        <ul class="btn-toggle-nav sub-menu list-unstyled fw-normal pb-1 small">
                          <li><a href="#" class="link-light">Custom Reports</a></li>
                          <li><a href="#" class="link-light">Scheduled Reports</a></li>
                          <li><a href="#" class="link-light">Published Reports</a></li>
                          <li><a href="#" class="link-light">Batch Reports</a></li>
                          <li><a href="#" class="link-light">Report Download</a></li>
                        </ul>
                      </div>
                    </li>
                    <li class="mb-1">
                      <button class="btn btn-toggle collapsed text-white" data-bs-toggle="collapse" data-bs-target="#loans-collapse" aria-expanded="false">
                        <i class="far fa-check-circle"></i> Test Loans
                      </button>
                      <div class="collapse" id="loans-collapse">
                        <ul class="btn-toggle-nav sub-menu list-unstyled fw-normal pb-1 small">
                          <li><a href="#" class="link-light">Create Purchase Test Loan</a></li>
                          <li><a href="#" class="link-light">Create Refinance Test Loan</a></li>
                          <li><a href="#" class="link-light">Find Test Loan</a></li>
                        </ul>
                      </div>
                    </li>
                  </ul>
                  -->

              <ul class="nav nav-pills flex-column mb-auto"></ul>
              <div class="dropdown">
                <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                  <img src="<?php $img=get_field('profile_image', $current_user); echo $img['url'];?>" alt="" width="32" height="32" class="rounded-circle me-2">
                  <strong><?php echo $current_user->display_name;?></strong>
                </a>
                <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownUser1" style="">
                  <li><a class="dropdown-item" href="<?php echo site_url();?>/profile">Profile</a></li>
                  <li><a class="dropdown-item" href="<?php echo site_url();?>/wp-login.php?action=logout">Log Out</a></li>

                </ul>
              </div>
            </div>

            </div>

            <div class="db-content m-0 ms-md-4 mt-md-4">

              <div class="page-header pt-5 pt-md-0 ps-5 mb-4">
                <?php if(is_front_page()):?>
                  <h1>Hello <?php echo $current_user->user_firstname;?> - <small>(<?php $user_id = "user_" . get_current_user_id();  the_field('role', $user_id); ?>)</small></h1>
                <?php endif;?>
                <!-- <h1>{!! App::title() !!}</h1>-->
              </div>


              @yield('content')
            </div>

        </main>
      </div>
    </div>
    @php do_action('get_footer') @endphp
    @include('partials.footer')
    @php wp_footer() @endphp

    <!--
    <script src="//cdnjs.cloudflare.com/ajax/libs/list.js/1.5.0/list.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.6/jspdf.plugin.autotable.min.js"></script>
    -->

<script src="https://cdn.jsdelivr.net/npm/js-cookie@2/src/js.cookie.min.js"></script>

<!--
<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.colVis.min.js"></script>
<script src="https://cdn.datatables.net/colreorder/1.5.5/js/dataTables.colReorder.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
-->

    <script>
    jQuery(function($) {

      /*
      $('.close-sidebar').click(function () {
        Cookies.remove('sidenav', { path: '' })
        Cookies.set('sidenav', 'closed', { expires: 30 });
        console.log(Cookies.get('sidenav'));
      });
      $('.open-sidebar').click(function () {
        Cookies.remove('sidenav', { path: '' })
        Cookies.set('sidenav', 'open', { expires: 30 });
        console.log(Cookies.get('sidenav'));
      });

      if(Cookies.get('sidenav') === 'open') {
        $('body').addClass('side-open');
        $('.main-sidebar').addClass('active');
      }
      */

      /*
      var options = {
        valueNames: [ 'Loan Number', 'Loan Status Date', 'Borr Last Name' ]
      };

      var userList = new List('report_1', options);

      // window.jsPDF = window.jspdf.jsPDF;
      $('#pdf_export').click(function() {
        var doc = new jsPDF()
        doc.autoTable({ html: '#data-table' })
        doc.save('loan-data.pdf')
      });
      */



/*

      	//Only needed for the filename of export files.
      	//Normally set in the title tag of your page.
      	document.title='Simple DataTable';
      	// DataTable initialisation
      	$('#data-table').DataTable(
      		{
      			"dom": '<"dt-buttons"Bf><"clear">lirtp',
      			"paging": false,
            "colReorder": true,
      			"autoWidth": false,
            "scrollY":        "60vh",
            "scrollX": true,
            "fixedHeader": true,
      			"columnDefs": [
      				{ "orderable": false, "targets": 5 }
      			],
      			"buttons": [
      				'colvis',
      				// 'copyHtml5',
              'csvHtml5',
      				'excelHtml5',
              'pdfHtml5',
      				'print',
              {
                  extend: 'pdfHtml5',
                  download: 'open'
              }
      			]
      		}
      	);
      	//Add row button
      	$('.dt-add').each(function () {
      		$(this).on('click', function(evt){
      			//Create some data and insert it
      			var rowData = [];
      			var table = $('#example').DataTable();
      			//Store next row number in array
      			var info = table.page.info();
      			rowData.push(info.recordsTotal+1);
      			//Some description
      			rowData.push('New Order');
      			//Random date
      			var date1 = new Date(2016,01,01);
      			var date2 = new Date(2018,12,31);
      			var rndDate = new Date(+date1 + Math.random() * (date2 - date1));//.toLocaleDateString();
      			rowData.push(rndDate.getFullYear()+'/'+(rndDate.getMonth()+1)+'/'+rndDate.getDate());
      			//Status column
      			rowData.push('NEW');
      			//Amount column
      			rowData.push(Math.floor(Math.random() * 2000) + 1);
      			//Inserting the buttons ???
      			rowData.push('<button type="button" class="btn btn-primary btn-xs dt-edit" style="margin-right:16px;"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button><button type="button" class="btn btn-danger btn-xs dt-delete"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>');
      			//Looping over columns is possible
      			//var colCount = table.columns()[0].length;
      			//for(var i=0; i < colCount; i++){			}

      			//INSERT THE ROW
      			table.row.add(rowData).draw( false );
      			//REMOVE EDIT AND DELETE EVENTS FROM ALL BUTTONS
      			$('.dt-edit').off('click');
      			$('.dt-delete').off('click');
      			//CREATE NEW CLICK EVENTS
      			$('.dt-edit').each(function () {
      				$(this).on('click', function(evt){
      					$this = $(this);
      					var dtRow = $this.parents('tr');
      					$('div.modal-body').innerHTML='';
      					$('div.modal-body').append('Row index: '+dtRow[0].rowIndex+'<br/>');
      					$('div.modal-body').append('Number of columns: '+dtRow[0].cells.length+'<br/>');
      					for(var i=0; i < dtRow[0].cells.length; i++){
      						$('div.modal-body').append('Cell (column, row) '+dtRow[0].cells[i]._DT_CellIndex.column+', '+dtRow[0].cells[i]._DT_CellIndex.row+' => innerHTML : '+dtRow[0].cells[i].innerHTML+'<br/>');
      					}
      					$('#myModal').modal('show');
      				});
      			});
      			$('.dt-delete').each(function () {
      				$(this).on('click', function(evt){
      					$this = $(this);
      					var dtRow = $this.parents('tr');
      					if(confirm("Are you sure to delete this row?")){
      						var table = $('#example').DataTable();
      						table.row(dtRow[0].rowIndex-1).remove().draw( false );
      					}
      				});
      			});
      		});
      	});
      	//Edit row buttons
      	$('.dt-edit').each(function () {
      		$(this).on('click', function(evt){
      			$this = $(this);
      			var dtRow = $this.parents('tr');
      			$('div.modal-body').innerHTML='';
      			$('div.modal-body').append('Row index: '+dtRow[0].rowIndex+'<br/>');
      			$('div.modal-body').append('Number of columns: '+dtRow[0].cells.length+'<br/>');
      			for(var i=0; i < dtRow[0].cells.length; i++){
      				$('div.modal-body').append('Cell (column, row) '+dtRow[0].cells[i]._DT_CellIndex.column+', '+dtRow[0].cells[i]._DT_CellIndex.row+' => innerHTML : '+dtRow[0].cells[i].innerHTML+'<br/>');
      			}
      			$('#myModal').modal('show');
      		});
      	});
      	//Delete buttons
      	$('.dt-delete').each(function () {
      		$(this).on('click', function(evt){
      			$this = $(this);
      			var dtRow = $this.parents('tr');
      			if(confirm("Are you sure to delete this row?")){
      				var table = $('#example').DataTable();
      				table.row(dtRow[0].rowIndex-1).remove().draw( false );
      			}
      		});
      	});
      	$('#myModal').on('hidden.bs.modal', function (evt) {
      		$('.modal .modal-body').empty();
      	});

*/






/*
var table = $('#data-table');
        $('#data-table').dataTable({
           dom: 'Bfrtip',
           buttons: [ 'colvis' ],
           colReorder: true,
           buttons: [
             'copy', 'csv', 'excel', 'pdf', 'print',
           ],
         });

         $("#data-table > .dt-buttons").appendTo("div.table-filters");


                   $('a.toggle-vis').on( 'click', function (e) {
                       e.preventDefault();

                       // Get the column API object
                       var column = table.column( $(this).attr('data-column') );

                       // Toggle the visibility
                       column.visible( ! column.visible() );
                   } );
                   */

    });






    </script>

  </body>
</html>
