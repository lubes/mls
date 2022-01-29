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

    $(".data-refresh").on("click",function(){
      $(this).val('Loading...');
    })

    $('#newWindow').click(function() {
      var w = window.open('', "", "width=900, height=600, scrollbars=yes");
      var html = $("#report_1").html();
      $(w.document.body).html(html);
    });

    $( "#taskSearch" ).keyup(function() {
      // Declare variables
      var input, filter, table, tr, td, i, txtValue;
      input = document.getElementById("taskSearch");
      filter = input.value.toUpperCase();
      table = document.getElementById("tasks");
      tr = table.getElementsByTagName("tr");

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

  },
  finalize() {
    // JavaScript to be fired on all pages, after page specific JS is fired
  },
};
