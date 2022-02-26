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

    // var sidebar_status = document.getElementById("sidebar_status").value;
    // alert(sidebar_status);
    // Convert Dates

    var moment = require('moment-timezone');
    var tz = moment.tz.guess();
        function convert_dates(){
          $(".convertdate").each(function( index ) {
            var a = moment.tz($(this).text(), tz);
            if (a.isValid()) {
              $(this).text(a.format('MM/DD/YYYY'));
            } else {
                // It doesn't
            }

          });
    }


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
        'print',
        {
          extend: 'pdfHtml5',
          orientation: 'landscape',
          pageSize: 'LEGAL',
          customize: function(doc) {
            doc.styles.tableHeader.fontSize = 7;
            doc.styles.tableHeader.alignment = 'left';
            doc.defaultStyle.fontSize = 7;
            doc.styles.tableHeader.color = '#ffffff';
            doc.styles.tableHeader.fillColor = '#121f47';
          }
        },
        'copyHtml5',
        'csvHtml5',
        'excelHtml5',
        //'pdfHtml5',
      ],
    });


    /* DataTables Examples */
    function datatable(datas, key) {
      // Clear Existing Data
      var div_id, table_id, table_header, new_table;

      console.log(datas)
      console.log(key)
      div_id = "dt_"+key;
      table_id = "dt-table-" + key;
      table_header = "table-header-" + key;
      new_table='<div class="row ' + div_id +'""></div><table id="' + table_id +'" class="report-table table table-striped"><thead><tr class="table-header '+table_header+'"><th></th></tr></thead><tbody class="table-body '+table_id+' list"><tr><td></td></tr></tbody></table>'


      $("#data-table-id").append(new_table);

      var table = $('#'+table_id).DataTable();
      table.destroy();
      table.clear().draw();

      $("."+ table_header).html("");
      var columns = new Array();
      var col_head;

      $.each( datas["order"], function( key, value ) {
        // Create Order Object
        if (value.includes("Date")){
          var obj = {
              data: value,
              className: "convertdate"
          };
          columns.push(obj);
        } else if (value.includes("Loan Number")){
          var obj = {
              data: value,
              className: "convertLoan",
              render: function ( data, type, row, meta ) {
                return '<a href="https://excelerate-dev.bluesageusa.com/lp/index.html#/loan/' + data + '/loan-action?section=0" target="_blank" class="loan-link btn btn-default btn-sm">'+data+'</a>';
              }

          };

          columns.push(obj);

        } else {
          columns.push({data: value});
        }
        // Create New Column Headers
        col_head = "<th>"+ value +"</th>";
        $("."+ table_header).append(col_head);

      });
        // console.log(columns);

        console.log(datas);


        var formatter = new Intl.NumberFormat('en-US', {
          style: 'currency',
          currency: 'USD',
        });

      $.each( datas["summary"], function( key, value ) {
        // var dash_header = '<div class="col-md-4"><div class="dash-info dash-summary" id="loan_sum"><span class="dash-info-text">'+key+'</span><div class="dash-info-card"><span class="dash-info-value">'+value+'</span></div></div></div>';
        if(key == "Total Loan Amount (SUM)"){
          value = formatter.format(value);
        }
        var dash_header = '<div class="col-md-4"><div class="dash-info dash-summary" id="loan_sum"><span class="dash-info-text">'+key+'</span><div class="dash-info-card"><span class="dash-info-value">'+value+'</span></div></div></div>';
        $("."+div_id).append(dash_header);
        //$(".dash-header").append(dash_header);
      });


     $('#'+table_id).DataTable( {
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
         'print',
         {
           extend: 'pdfHtml5',
           orientation: 'landscape',
           pageSize: 'LEGAL',
           customize: function(doc) {
             doc.styles.tableHeader.fontSize = 7;
             doc.styles.tableHeader.alignment = 'left';
             doc.defaultStyle.fontSize = 7;
             doc.styles.tableHeader.color = '#ffffff';
             doc.styles.tableHeader.fillColor = '#121f47';
           }
         },
         'copyHtml5',
         'csvHtml5',
         'excelHtml5',
         //'pdfHtml5',
       ],



       /*
       buttons: [
           {
               extend: 'pdfHtml5',
               orientation: 'landscape',
               pageSize: 'LEGAL',
               customize: function(doc) {
                 doc.styles.tableHeader.fontSize = 7;
                 doc.styles.tableBodyOdd.alignment = 'left';
                 doc.defaultStyle.fontSize = 7;
               }
           }
       ],
       */
     });
     console.log("go convert");
     convert_dates();
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
                //console.log(data);
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

      $("#data-table-id").html("");


      $.each(datas["tables"], function( key, value ) {
        datatable(datas["tables"][key], key);
      });

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
      var roles;
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
                    // $('.role-list').append(role);
                  })
                }
                // console.log('here');

                // console.log(data[_role][0]["key"]);
                first_view = data[_role][0]["key"];

                $.each(data[_role], function(k, v){


                // view = '<option value="' + v["key"] + '"';
                // view += '>' + v["value"] + '</option>';

                view = '<li class="nav-item"><div class="radio-btn"><input type="radio" class="btn-check rr_view" id="' + v["key"] + '" autocomplete="off" name="rr" value="' + v["key"] + '"><label class="btn w-100" for="' + v["key"] + '"><i class="fal fa-file-spreadsheet"></i>' + v["value"] + '</label></div></li>';

                /*
                view_2 = '<li class="dropdown-item"><div class="radio-btn"><input type="radio" class="btn-check loan-type-filter" id="ae_1" autocomplete="off" name="rr" value="' + v["key"] + '"';
                if(v["key"] == _recordRequest){ output += "checked"; }
                view_2 += '><label class="btn w-100" for="ae_1"><i class="fal fa-check"></i>' + v["value"] + '</label></div></li>';
                */

                // $(".rr_view").append(view);

                $(".rr_view_2").append(view);
                // alert('hello');
              });



              // console.log(first_view);
              $('#current_view').html(first_view);
              $('#refresh_value').val(first_view);
              call_endpoint(theUser.role,theUser.username, first_view);

              console.log(theUser.username);
            },
            complete: function(data, textStatus, jqXHR) {

              $(".rr_view").on("change", function(){
                $(".table-body").html("");
                call_endpoint(theUser.role,theUser.username, $(this).val());
                console.log($(this).val());
                $('#current_view').html($(this).val());
                $('#refresh_value').val($(this).val());

              });

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
      $('#refresh_value').val($(this).val());
    });

    $(".admin_view").on("change", function(){
      $(".rr_view").empty();
      record_requests($(this).val(), theUser.username);
      console.log($(this).val());
    });

    $("#refreshData").on("click", function(){
      $(".table-body").html("");
      var refreshVal = $('#refresh_value').val();
      call_endpoint(theUser.role,theUser.username, refreshVal);
      console.log(refreshVal);
      $(this).prop("disabled",true);
      setTimeout(() => {
        $(this).prop("disabled",false);
      }, 60000);
      // $('#current_view').html($(this).val());
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
