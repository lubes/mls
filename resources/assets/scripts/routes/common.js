/* eslint-disable */
// import jsPDF from '../plugins/jspdf.js';
// import '../plugins/dataTables.js';


export default {
  init() {
    // JavaScript to be fired on all pages

    // var sidebar_status = document.getElementById("sidebar_status").value;
    // alert(sidebar_status);
    // Convert Dates



    $(".rr_view").on("change", function(){
      $(".table-body").html("");
      call_endpoint(theUser.role,theUser.username, $(this).val());
      console.log($(this).val());
      $('#current_view').html($(this).val());
      $('#refresh_value').val($(this).val());
    });

    $(".setup_view").on("change", function(){
      call_setup_endpoint($(this).val());
    });

    $(".admin_view").on("change", function(){
      $(".rr_view").empty();
      $(".rr_view_2").empty();
      record_requests($(this).val(), theUser.username);
      console.log($(this).val());
    });

    $("#refreshData").on("click", function(){
      $(".table-body").html("");
      $(this).html('Easy tiger...wait 1 minute');
      var refreshVal = $('#refresh_value').val();
      $('#loader').show();
      call_endpoint(theUser.role,theUser.username, refreshVal);
      console.log(refreshVal);
      $(this).prop("disabled",true);
      $('#loader').fadeOut();
      setTimeout(() => {
        $(this).prop("disabled",false);
        $(this).html('Refresh Data <i class="fas fa-sync"></i>');
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

    $('#newWindow').click(function(e) {
      e.preventDefault();
      var currentReport = document.getElementById("refresh_value").value;
      var newWindow = window.location.href+'/?report='+currentReport;
      window.open(newWindow, currentReport, 'window settings');
      console.log(currentReport);
      return false;
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

    */



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
