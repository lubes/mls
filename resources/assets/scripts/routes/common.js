/* eslint-disable */
// import jsPDF from '../plugins/jspdf.js';
// import '../plugins/dataTables.js';
import 'datatables.net';
import 'datatables.net-buttons';
import 'datatables.net-colreorder';
import '../plugins/pdfmake.js';
import '../plugins/vfs_fonts';
// import 'datatables.net-bs';

import 'datatables.net-bs5';
// import '../plugins/dataTables.bootstrap.min.js';
import 'datatables.net-buttons/js/buttons.colVis.js';
import 'datatables.net-buttons/js/buttons.html5.js';
import 'datatables.net-buttons/js/buttons.print.js';

export default {
  init() {
    // JavaScript to be fired on all pages

    // $('#example').DataTable();



    $('#example').DataTable({
      "colReorder": true,
      dom: 'Bfrtip',
      "paging": false,
      "autoWidth": false,
      "scrollY":        "60vh",
      "scrollX": true,
      "fixedHeader": true,
      "buttons": [
        'colvis',
        'copyHtml5',
        'csvHtml5',
        'excelHtml5',
        'pdfHtml5',
        'print',
        {
            extend: 'pdfHtml5',
            download: 'open'
        }
      ],
      /*
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
      */
    });



    /* DataTables Examples */
    function datatable(datas) {
      $("#example").dataTable().fnDestroy();

      var columns = new Array();
      var col_head;
      $(".table-header").html("");

      $.each( datas["order"], function( key, value ) {
        // Create Order Object

        columns.push({data: value});

        // Create New Column Headers
        col_head = "<th>"+ value +"</th>";
        $(".table-header").append(col_head);

        });
        console.log(datas);



     $('#example').DataTable( {
       //"ajax": "wp-content/themes/mls/resources/sample.txt",
       data: datas["data"],
       columns: columns,
       "colReorder": true,
       dom: 'Bfrtip',
       "paging": false,
       "autoWidth": false,
       "scrollY":        "60vh",
       "scrollX": true,
       "fixedHeader": true,
       "buttons": [
         'colvis',
         'copyHtml5',
         'csvHtml5',
         // 'excelHtml5',
         'pdfHtml5',
         'print',
         {
             extend: 'pdfHtml5',
             download: 'open'
         }
       ],
       /*"columns": [
         { "data": "Loan Number" },
         {  "data":    "Borr Last Name"},
          { "data":     "Broker Company Name"},
          { "data":     "DTI"},
          {  "data":    "Estimated Close Date"},
          {  "data":    "Le Issued Date"},
          {  "data":    "Loan Program Name"},
          {  "data":    "Loan Purpose"},
          { "data":     "Loan Status"},
          { "data":     "Loan Status Date"},
          { "data":     "Loan Type"},
          {  "data":    "Lock Expiration Date"},
          { "data":     "LTV"},
          {  "data":    "Note Rate"},
          {  "data":    "Rate Lock Status"},
          {  "data":    "Rate Locked Date"},
          {  "data":    "Total Loan Amount"},
          {  "data":    "Assigned Account Executive Name"},
          {  "data":    "Processor Name"},
          {  "data":    "Junior Processor Name"},
          {  "data":    "Assigned Loan Officer Name"},
          {  "data":    "Underwriter Name"},
          {  "data":    "Subj Prop Occ"},
          {  "data":    "Assigned Username"},
          { "data":     "LE Signed Date"}
       ]*/
     });
   }
    //datatable();

    function call_endpoint(_role, _userName, _recordRequest){
      var formData = {role:_role,userName:_userName,recordRequest: _recordRequest}; //Array
      formData = JSON.stringify(formData);

      $('#loader').fadeIn();

      //console.log(formData);
      //console.log(theUser.role);
      $.ajax({
            url : "https://w2dufry7w8.execute-api.us-west-2.amazonaws.com/controller",
            type: "POST",
            contentType: "application/json",
            dataType: "json",
            data : formData,
            success: function(data, textStatus, jqXHR)
            {

              $('#loader').fadeOut();

                //datatable();
              process_data(data);
                //data - response from server
                //console.log(data);
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
              console.log(jqXHR);

            }
        });
    }

    function reorder_object(obj, order){
      const data = new Object();
        $.each(order, function( key, value ) {
          data[value] = obj[value];
        });
      return data;

    }

    function process_data(datas){


      var data = new Array();
      var order = new Array();
      var new_table, new_value;

      //console.log(datas["tables"][0]);

      data = datas["tables"][0]["data"];
      order = datas["tables"][0]["order"];
      new_table = "<tr role='row'>";
      //console.log(order);

      // Display custom column order
    /*  $.each( order, function( key, value ) {
        new_table += '<th scope="col" class="sorting_asc" tabindex="0" aria-controls="data-table" rowspan="1" colspan="1" data-column-index="0" aria-sort="ascending" aria-label="' + value + ': activate to sort column descending">'+value+'</th>';
      });
      new_table += "</tr>";
      $(".header").html(new_table);*/

      datatable(datas["tables"][0]);

      // Display Data into Table
      /*$.each( data, function( key, value ) {
        new_value = reorder_object(value, order);
        new_table = "<tr>";
        $.each(new_value, function(k, v){
          if(k == "Loan Number"){
              new_table += "<td class='" + k + "'><a href='https://excelerate-dev.bluesageusa.com/lp/index.html#/loan/"+ v + "/loan-action?section=0' target='_blank' class='btn btn-default'>" + v + "</a></td>";
          } else if(k != "Assigned Username") {
            new_table += "<td class='"+ k + "'>" + v + "</td>";
          }
        })
        new_table += "</tr>";
        $(".table-body").append(new_table);
      })*/

      /* DataTables Examples */
      // $("#example").dataTable().fnDestroy();
      //datatable();



    }


    // Show all Record Requests
    function record_requests(_role, _userName){
      var formData = {role:_role,userName:_userName}; //Array
      formData = JSON.stringify(formData);
      var output, role, view, first_view;
      $.ajax({
            url : "https://w2dufry7w8.execute-api.us-west-2.amazonaws.com//records",
            type: "GET",
            contentType: "application/json",
            dataType: "json",
            data : formData,
            success: function(data, textStatus, jqXHR)
            {
              //process_data(data);
                //data - response from server
                //console.log(data);
                if(_role == "ADMIN"){
                  $.each(data, function(key, value){
                    role = '<option value="' + key + '"';
                    role += '>' + key + '</option>';
                    $(".admin_view").append(role);
                  })
                }
                // console.log('here');

                // console.log(data[_role][0]["key"]);
                first_view = data[_role][0]["key"];

                $.each(data[_role], function(k, v){

                view = '<option value="' + v["key"] + '"';
                view += '>' + v["value"] + '</option>'
                /*output = '<li class="dropdown-item"><div class="radio-btn"><input type="radio" class="btn-check loan-type-filter" id="ae_1" autocomplete="off" name="rr" value="' + v["key"] + '"';
                if(v["key"] == _recordRequest){ output += "checked"; }
                output += '><label class="btn w-100" for="ae_1"><i class="fal fa-check"></i>' + v["value"] + '</label></div></li>';
                $(".dropdown-menu").append(output);*/
                $(".rr_view").append(view);
              });
              // console.log(first_view);
              $('#current_view').html(first_view);
              call_endpoint(theUser.role,theUser.username, first_view);
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
              console.log(jqXHR);

            }
        });


    }
    record_requests(theUser.role,theUser.username);

    $(".rr_view").on("change", function(){
      $(".table-body").html("");
      call_endpoint(theUser.role,theUser.username, $(this).val());
      console.log($(this).val());
      $('#current_view').html($(this).val());
    });
    $(".admin_view").on("change", function(){
      $(".rr_view").empty();
      record_requests($(this).val(), theUser.username);
      console.log($(this).val());

    });





    $(".loan-type-filter").on("change", function(){
      $(".table-body").html("");
      call_endpoint(theUser.role,theUser.username, $(this).val());
      console.log($(this).val());
    });


    $(".sidebar-toggle").on("click",function(){
      $('.main-sidebar').toggleClass('active');
      if($('.main-sidebar').hasClass('active')) {
        $('.sidebar-toggle').addClass('close-sidebar');
        $('.sidebar-toggle').removeClass('open-sidebar');
      } else {
        $('.sidebar-toggle').addClass('open-sidebar');
        $('.sidebar-toggle').removeClass('close-sidebar');
      }
      $('body').toggleClass('side-open');
    });

    $(".filter-toggle").on("click", function(){
      $(this).toggleClass('active');
      if($(this).hasClass('active')) {
        $(this).html('Hide Filters <i class="fal fa-angle-up"></i>');
      } else {
        $(this).html('Show Filters <i class="fal fa-angle-down"></i>');
      }
    });

    $('#newWindow').click(function() {
      // window.open(window.location.href, '_blank');
      var w = window.open('', "", "width=900, height=500, scrollbars=yes");
      var html = $(".dataTables_scroll").html();
      var cssLink = '<link rel="stylesheet" id="sage/main.css-css"  href="http://52.34.81.19/wp-content/themes/mls/dist/styles/main.css" type="text/css" media="all" /><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">';
      var jsLink = '<script type="text/javascript" src="https://views.exceleratecapital.com/wp-content/themes/mls/dist/scripts/main.js"></script>';
      $(w.document.body).html(cssLink+html);
    });



    $(".loan_filter").on("change", function(){
      if($(this).val() == "Loan-Type"){
        $(".all").show();
      } else {
        $(".all").hide();
        $("." + $(this).val()).toggle();
      }
      console.log("filter");
    });

    $(".loanSearch").keyup(function(e) {
      if($(".loanSearch").val() != ""){
        $(".all").hide();
        $(".ln" + $(".loanSearch").val()).show();
      } else {
        $(".all").show();
      }
    });

    $(".data-refresh").on("click",function(){
      $(this).val('Loading...');
    })

    /*
    $( "#taskSearch" ).keyup(function() {
      // Declare variables
      var input, filter, table, tr, td, i, txtValue;
      input = document.getElementById("taskSearch");
      filter = input.value.toUpperCase();
      table = document.querySelectorAll("table");
      var tr = document.querySelectorAll("table tr");

      // Loop through all table rows, and hide those who don't match the search query
      for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[0];
        if (td) {
          txtValue = td.textContent || td.innerText;
          if (txtValue.toUpperCase().indexOf(filter) > -1) {
            tr[i].style.display = "";
          } else {
            tr[i].style.display = "none";
          }
        }
      }
    });
    */



    // Download as CSV
    function download_csv(csv, filename) {
        var csvFile;
        var downloadLink;
        // CSV FILE
        csvFile = new Blob([csv], {type: "text/csv"});
        // Download link
        downloadLink = document.createElement("a");
        // File name
        downloadLink.download = filename;
        // We have to create a link to the file
        downloadLink.href = window.URL.createObjectURL(csvFile);
        // Make sure that the link is not displayed
        downloadLink.style.display = "none";
        // Add the link to your DOM
        document.body.appendChild(downloadLink);
        // Lanzamos
        downloadLink.click();
    }

    function export_table_to_csv(html, filename) {
    	var csv = [];
    	var rows = document.querySelectorAll("table tr");
        for (var i = 0; i < rows.length; i++) {
    		var row = [], cols = rows[i].querySelectorAll("td, th");
            for (var j = 0; j < cols.length; j++)
                row.push(cols[j].innerText);
    		csv.push(row.join(","));
    	}
        // Download CSV
        download_csv(csv.join("\n"), filename);
    }

    document.getElementById("csv").addEventListener("click", function () {
        var html = document.querySelector("table").outerHTML;
    	export_table_to_csv(html, "table.csv");
    });





    /*
    document.getElementById("pdf_export").addEventListener("click", function () {
        demoFromHTML();
    });
    */


  },
  finalize() {
    // JavaScript to be fired on all pages, after page specific JS is fired
  },
};
