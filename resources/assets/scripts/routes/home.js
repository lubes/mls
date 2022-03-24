/* eslint-disable */

export default {
  init() {
    // JavaScript to be fired on the home page
    // CHeck if this is a new Window
    var url_string = window.location.href;
    var url = new URL(url_string);
    var c = url.searchParams.get("report");

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

    $(".setup_view").on("change", function(){
      call_setup_endpoint($(this).val());
    });


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
          text:      '<i class="fa fa-files-o"></i>',
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
      initComplete: function() {
       $('.buttons-copy').html('<i class="fa fa-copy" />')
       $('.buttons-csv').html('<i class="fa fa-file-text-o" />')
       $('.buttons-excel').html('<i class="fa fa-file-excel-o" />')
       $('.buttons-pdf').html('<i class="fa fa-file-pdf-o" />')
       $('.buttons-print').html('<i class="fa fa-print" />')
      }
    });


    function wpcpt_loan(value, callback){
      $.ajax({
       type: "POST",
       url: "/wp-admin/admin-ajax.php",
       //async: false,
       data: {
           action: 'search_by_slug',
           loanNumber: value["Loan Number"]
       },
       success: function(data, textStatus, jqXHR){
          var post = JSON.parse(data["data"]);
          callback(post);
       }
       });
    }
    function get_loans(){
      var post;
      $.ajax({
       type: "GET",
       url: "/wp-json/wp/v2/loans",
       async: false,
       success: function(data, textStatus, jqXHR){
         post = data;
       }
     }
     );
     return post;
    }


    /* DataTables Examples */
    function datatable(datas, key, _view) {
      // Clear Existing Data
      var div_id, table_id, table_header, new_table;
      var _role = theUser.role;
      div_id = "dt_"+key;
      table_id = "dt-table-" + key;
      table_header = "table-header-" + key;
      new_table='<div class="row ' + div_id +'""></div><table id="' + table_id +'" class="report-table table table-striped"><thead><tr class="table-header '+table_header+'"><th></th></tr></thead><tbody class="table-body '+table_id+' list"><tr><td></td></tr></tbody></table>'


      $("#data-table-id").append(new_table);

      var table = $('#'+table_id).DataTable();
      table.destroy();
      table.clear().draw();
      $("."+ table_header).html("");
      var col_head, _view;
      var columns = new Array();

      //_view = "assigned";
      // Add Assign action if SETUP: Open
      if(_view == "open"){
        if(_role == "SETUP" || _role == "SETUP_TL"){

          $.each( datas["data"], function(key, value){
            value["Assign"] = "<a href='#' class='assigner' data-bs-toggle='modal' data-bs-target='#assignModal' data-loan='" + value["Loan Number"] + "'>Assign</a>";
            datas["data"][key]= value;
          });
          col_head = "<th>Assign</th>";
          $("."+ table_header).append(col_head);
          var new_columns = { data: "Assign"};
          columns.push(new_columns);
        }
      }

      // Add Assign action if SETUP: Assigned
      if(_view == "assigned"){
          var date_assigned, last_note;
          var posts = get_loans();
          console.log(posts);

        $.each( datas["data"], function(key, value){
          /* Get Wordpress Data */
          $.each(posts, function(k, v){
            date_assigned = "N/A";
            last_note = "";
            var slug = v.slug.toUpperCase()
            if(value["Loan Number"] == slug){
              date_assigned = v["acf"]["date_assigned"];
              last_note = v["last_comment"];
              return false;
            }
          })


          value["Dater"] = "<span class='dater'>" + date_assigned + "</span>";
          value["Notes"] = last_note + " <a href='/loans/" + value["Loan Number"] + "' class='notes' target='_blank'>View All</a>";
          datas["data"][key]= value;
        });
        col_head = "<th>Date Assigned</th>";
        $("."+ table_header).append(col_head);

        var new_columns = { data: "Dater"};
        columns.push(new_columns);

      }

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
              className: "",
              render: function ( data, type, row, meta ) {
                return '<a href="#" class="loanlink" data-ln="'+data+'">'+data+'</a>';
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

      if(_view == "assigned"){
        //if(_role == "SETUP" || _role == "SETUP_TL" || _role == "MANAGER" || _role == "ADMIN"){
        var new_columns = { data: "Notes"};
        columns.push(new_columns);
        col_head = "<th>Notes</th>";
        $("."+ table_header).append(col_head);
      //}
      }


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
       initComplete: function() {
         $('.buttons-colvis').html('<i class="fas fa-eye"></i> Column Visibility')
         $('.buttons-copy').html('<i class="fas fa-copy"></i> Copy')
         $('.buttons-csv').html('<i class="fas fa-file-csv"></i> CSV')
         $('.buttons-excel').html('<i class="fas fa-file-excel"></i> Excel')
         $('.buttons-pdf').html('<i class="fas fa-file-pdf"></i> PDF')
         $('.buttons-print').html('<i class="fas fa-print"></i> Print')
      },


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

     // $('#'+table_id).fnMultiFilter( { "engine": "Gecko", "browser": "Cam" } );

     convert_dates();

     $(".loanlink").on("click", function(e){
       var _token = theUser.token;
       var _loanNumber =  $(this).attr("data-ln");
       var formData = {token:_token, loanNumber: _loanNumber}; //Array
       formData = JSON.stringify(formData);
       $.ajax({
             url : "https://7ri4vh86qb.execute-api.us-west-2.amazonaws.com/get-loan-url  ",
             type: "POST",
             contentType: "application/json",
             dataType: "json",
             data : formData,
             success: function(data, textStatus, jqXHR)
             {
               console.log(data);
               window.open(data["url"], "mWindow", "directories=no,titlebar=no,toolbar=no,location=no,status=no,menubar=no,scrollbars=no, width=1000, height=800, left=100, top=100");




             },
             error: function (jqXHR, textStatus, errorThrown)
             {
               console.log(jqXHR);


             }
         });


     })
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

    function call_setup_endpoint(_view){
      var _token, datas;

      //_token = "&lt;USER_TICKET EncryptedTicket=\"agw8m/eZqFwBQxV59JdeeAz/M0D8SJ3OacfeU+Ero5ATs0GqoWGSmQC2/CK3/jn1sGDiRMjVmXK2zYRhrzoj6OJ1TD7FygZrGPTlkgZntQIeiUYcDmZ+Md68LOcs37W/k9wc0/U3lhoMutRk85sZJxkheA9Ozh7qznSFRs6JTOQayW+ixI1LNEV0SJpQqpuF1Iuns97OvPWxqeWodlBwKsSMW9jYghlrDio2hXv26VRKZ8yCv9LS86dFO8TV3Vmg\" Site=\"LQB\" /&gt;";

      _token = theUser.token;
      var formData = {token:_token}; //Array
      formData = JSON.stringify(formData);
      $('#loader').fadeIn();

      //console.log(formData);
      //console.log(theUser.role);
      $.ajax({
            url : "https://7ri4vh86qb.execute-api.us-west-2.amazonaws.com/get-tables",
            type: "POST",
            contentType: "application/json",
            dataType: "json",
            data : formData,
            success: function(data, textStatus, jqXHR)
            {
              console.log(data);
              $('#loader').fadeOut();
                var assigned, open;

                if(_view == "assigned"){
                  datas = data["assigned"];
                } else {
                  datas = data["open"];
                }
                process_setup_data(datas, _view);
                //datatable();
                //console.log(data);
                //process_data(data);
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

      var total_sum = 0;
      var total_count = 0;

      $.each(datas["tables"], function( key, value ) {
        datatable(datas["tables"][key], key);
        console.log(key);
        console.log(value["summary"]);
        if(("summary" in value)){
                total_sum += parseInt(value["summary"]["Total Loan Amount (SUM)"]);
                total_count += parseInt(value["summary"]["Total Loans"]);
        }
      });

      var formatter = new Intl.NumberFormat('en-US', {
        style: 'currency',
        currency: 'USD',
      });
      console.log(total_count);
      if(total_count > 0){
        $(".dash-header").show();

      $("#loan_sum").text(formatter.format(total_sum));
      $("#loan_count").text(total_count);
    } else {
      $(".dash-header").hide();

    }
      // Totals



      /* DataTables Examples */
      // $("#example").dataTable().fnDestroy();
      //datatable();



    }

    function process_setup_data(datas, _view){


      var data = new Array();
      var order = new Array();
      var new_table, new_value;

      //console.log(datas["tables"][0]);

      data = datas["data"];
      order = datas["order"];
      new_table = "<tr role='row'>";
      //console.log(order);

      // Display custom column order
    /*  $.each( order, function( key, value ) {
        new_table += '<th scope="col" class="sorting_asc" tabindex="0" aria-controls="data-table" rowspan="1" colspan="1" data-column-index="0" aria-sort="ascending" aria-label="' + value + ': activate to sort column descending">'+value+'</th>';
      });
      new_table += "</tr>";
      $(".header").html(new_table);*/

      $("#data-table-id").html("");

      var total_sum = 0;
      var total_count = 0;
      var key = 0;
        datatable(datas, key, _view);

      var formatter = new Intl.NumberFormat('en-US', {
        style: 'currency',
        currency: 'USD',
      });

      $(".dash-header").hide();

      // Totals



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

                first_view = data[_role][0]["key"];

                // console.log('here');
                // console.log(data[_role][0]["key"]);

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


              if(c) {
                call_endpoint(theUser.role,theUser.username, c);
                $('#current_view').html(c);
                $('#refresh_value').val(c);
                $('body').removeClass('side-open');
                $('.main-sidebar').removeClass('active');
              } else {
                call_endpoint(theUser.role,theUser.username, first_view);
              }


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

    if(theUser.role == "SETUP" || theUser.role == "SETUP_TL"){
      call_setup_endpoint("open");
      /*$(".assigner").on("click", function(){
        console.log($(this).data("loan"));
      })*/



      $('#assignModal').on('show.bs.modal', function(e) {
        var _username = theUser.username;
        var _loanNumber =  e.relatedTarget.dataset.loan;
        $(".assign-loan").html("<h3>Loan Number: " + _loanNumber + "</h3><p>"+_username+"</p>");
        $(".assign-confirm").attr('data-ln', _loanNumber);
        //$('#loader').fadeIn();

        //console.log(formData);
        //console.log(theUser.role);
      });



      $(".assign-confirm").on("click", function(e){
        var _token = theUser.token;
        var _username = theUser.username;
        var _loanNumber =  $(".assign-confirm").attr('data-ln');
        var formData = {token:_token, username:_username, loanNumber: _loanNumber}; //Array
        formData = JSON.stringify(formData);
        $.ajax({
              url : "https://7ri4vh86qb.execute-api.us-west-2.amazonaws.com/fake-assign-setup",
              type: "POST",
              contentType: "application/json",
              dataType: "json",
              data : formData,
              success: function(data, textStatus, jqXHR)
              {
                console.log(data);
                $.ajax({
                 type: "POST",
                 url: "/wp-admin/admin-ajax.php",
                 data: {
                     action: 'create_loan_post',
                     loanNumber: _loanNumber,
                     username: _username

                 },
                 success: function (output) {
                    console.log(output);
                 }
                 });
                 $('.assigner[data-loan="'+_loanNumber+'"]').html("Assigned").contents().unwrap();

                 console.log(_loanNumber);

                $(".modal-body").html("<div>"+data["message"]+" <a href='"+data["url"]+"' target='_blank'>Go to loan now</a></div>");


              },
              error: function (jqXHR, textStatus, errorThrown)
              {
                console.log(jqXHR);
                $(".assign-loan").html("<h3>Fail</h3><p>"+_username+"</p>");


              }
          });
      })
    } else {
      call_setup_endpoint("assigned");
    }



  },
  finalize() {


    // JavaScript to be fired on the home page, after the init JS
  },
};
