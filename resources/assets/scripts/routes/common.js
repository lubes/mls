/* eslint-disable */

export default {
  init() {
    // JavaScript to be fired on all pages

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

    $('#newWindow').click(function() {
      var w = window.open('', "", "width=900, height=600, scrollbars=yes");
      var html = $("#report_1").html();
      var cssLink = '<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">';
      $(w.document.body).html(cssLink+html);
      // <link rel='stylesheet' id='sage/main.css-css'  href='http://52.34.81.19/wp-content/themes/mls/dist/styles/main.css' type='text/css' media='all' />
    });

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



  },
  finalize() {
    // JavaScript to be fired on all pages, after page specific JS is fired
  },
};
