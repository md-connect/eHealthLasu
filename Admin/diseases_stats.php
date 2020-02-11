<?php
include("../security.php");
include("header.php");

include("../includes/dbconfig/dbconfig.php");

$query = "SELECT id, code,descriptions,
COUNT(*) AS total,
COUNT(CASE WHEN pat_type='STUDENT' THEN 1 END) AS totalstd,
COUNT(CASE WHEN pat_type='STAFF' THEN 1 END) AS totalstff,
COUNT(CASE WHEN pat_type='DEPENDANT' THEN 1 END) AS totaldepdnt
          FROM disease_stats GROUP BY code";
$result = mysqli_query($conn, $query);

?>
<main>


  <!-- Monthly Filter panel -->
  <div class="row mt-4">
    <div class=" col s12 m12 l12 offset-l3 ">
      <div class="card-body">
        <div class="row">
          <div class="row" id="fetch_date">
            <form class="col s12 m12 l6 center">
              <div class="row">
                <div class="input-field col s12 m12 l4">
                  <input type="text" name="from_date" id="from_date" class="datepicker">
                  <label for="from_date">From Date</label>
                </div>
                <div class="input-field col s12 m12 l4">
                  <input type="text" name="to_date" id="to_date" class="datepicker">
                  <label for="last_name">To Date</label>
                </div>
                <div class="input-field col s12 m12 l4">
                  <input class="btn blue center" type="button" name="fetch" id="fetch" value="Fetch"></input>
                </div>
              </div>
          </div>
        </div>
        </form>
      </div>
    </div>

    <!-- End of monthly filter panel -->
    <div class="row mt-4">
      <div class="col s12">
        <div class="row">
          <div id="admin" class="col s12">
            <div class="card material-table">
              <div id="log_table"> </div>

              </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
</main>


<script src="../assets/materialize/jquery.min.js"></script>
<script src="../assets/datatable/jquery.dataTables.min.js"></script>
<script src="../assets/materialize/js/materialize.min.js"></script>
<script src="../assets/datatable/buttons.html5.min.js"></script>
<script src="../assets/datatable/buttons.print.min.js"></script>
<script src="../assets/datatable/dataTables.buttons.min.js"></script>
<script src="../assets/datatable/jszip.min.js"></script>
<script src="../assets/materialize/js/materialize.js"></script>
<script src="../assets/materialize/js/script.js"></script>
<script src="../assets/datatable/script.js"></script>

<script>
  /* AJAX code to fetch from the database */
  $('#fetch').click(function() {
    var from_date = $('#from_date').val();
    var to_date = $('#to_date').val();

    if (from_date != '' && to_date != '') {
      $.ajax({
        url: "fetch.php",
        method: "POST",
        data: {
          from_date: from_date,
          to_date: to_date
        },
        success: function(data) {
          $('#log_table').html(data);
        }
      });
    } else {
      alert("Please Select Date");
    }
  });
  /* End of AJAX to fetch from database */

  $(document).ready(function() {
    // the "href" attribute of the modal trigger must specify the modal ID that wants to be triggered

    $('.datepicker').pickadate({
      selectMonths: true, // Creates a dropdown to control month
      selectYears: 15, // Creates a dropdown of 15 years to control year,
      format: 'yyyy-mm-dd',
      today: 'Today',
      clear: 'Clear',
      close: 'Ok',
      closeOnSelect: false // Close upon selecting a date,

    });
    $('.datepicker').on('mousedown', function(event) {
      event.preventDefault();
    });
    /* Hide or show panel */
    /* $(function() {
      $('#fetch_date').hide();
      $('#detailedstats').hide();
      $('#statsType').change(function() {
        if ($('#statsType').val() == 'monthly') {
          $('#fetch_date').show();
          $('#detailedstats').hide();
        } else if ($('#statsType').val() == 'detailedstats') {
          $('#detailedstats').show();
          $('#fetch_date').hide();
        } else {
          $('#fetch_date').hide();
          $('#detailedstats').hide();

        }
      });


 */

  });
</script>
</body>

</html>