<!doctype html>
<html {!! get_language_attributes() !!}>
  @include('partials.head')
  <body @php body_class('side-open') @endphp>
    @php do_action('get_header') @endphp

    <?php $current_user = wp_get_current_user(); ?>
    <?php // $_GET['report'];?>
    <!--<input type="text" id="sidebar_status" value="<?php echo the_field('sidebar', $current_user);?>" />-->

    <div class="wrap" role="document">
      <div class="content">
        <main class="main d-block d-md-flex">
            @include('partials.sidebar')
            <div class="db-content m-0 ms-md-4 mt-md-4 me-md-4">
              <div class="page-header d-flex align-items-end justify-content-between pt-5 pt-md-0 ps-5 mb-4">

                <div class="dash-info dash-summary">
                  <span class="dash-info-text">Currently Viewing:</span>
                  <span id="current_view" class="dash-info-desc"><?php echo the_title();?></span>
                </div>

                <!--
                <div class="d-flex">
                  <form method="post" class="">
                    <input type="hidden" id="refresh_value" autocomplete="off" name="refresh" value="<?php if($_GET['report']) { echo $_GET['report']; } ?>">
                    <button class="btn btn-primary me-3" id="refreshData">Refresh Data <i class="fas fa-sync"></i></button>
                    <input type="hidden" name="refresh" value="true">
                  </form>
                  <button class="btn btn-outline-primary me-5" id="newWindow">New Window</button>
                </div>
                -->

                <?php if(is_single()):?>
                <div class="d-flex">
                  <a href="<?php echo site_url();?>" class="btn btn-outline-primary me-5" id="">Go Back</a>
                </div>
                <?php endif;?>

              </div>
              @yield('content')
            </div>
        </main>
      </div>
    </div>
    @php do_action('get_footer') @endphp
    @include('partials.footer')
    @php wp_footer() @endphp


<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.colVis.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<script src="https://cdn.datatables.net/colreorder/1.5.5/js/dataTables.colReorder.min.js"></script>
<script src="https://cdn.datatables.net/plug-ins/1.11.5/api/fnMultiFilter.js"></script>


    <script>
    jQuery(function($) {


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
