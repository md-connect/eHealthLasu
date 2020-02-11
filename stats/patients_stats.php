<?php
include("../security.php");


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <title>eHealthLasu | <?php echo $_SESSION['role']; ?></title>
  <link rel="stylesheet" href="../assets/materialize/css/materialize.css" />
  <link rel="stylesheet" href="../assets/materialize/css/admin.css" />
  <link rel="stylesheet" href="../assets/iconfont/material-icons.css" />
  <link rel="stylesheet" href="../assets/stepper/css/mstepper.min.css" />
  <link rel="stylesheet" href="../assets/materialize/css/style.css" />
  <link rel="stylesheet" href="../assets/Mdi/css/materialdesignicons.css">
  <link rel="stylesheet" href="../assets/datatable/style.css" />
  <link rel="stylesheet" href="../assets/materialize/css/materialize.min.css">
</head>

<body>
  <ul id="slide-out" class="side-nav fixed">
    <li>
      <div class="user-view">
        <div class="background blue darken-2">
          <!-- <img src="images/office.jpg" /> -->
        </div>
        <a href="#!user"><?php echo '<img class="circle" src="data:image/jpeg;base64,' . base64_encode($_SESSION['passport']) . '">' ?></a>
        <a href="#!name"><span class="white-text name"><?php echo $_SESSION['name']; ?></span></a>
      </div>
    </li>
    <li class="active"><a href="../Admin/index.php"><i class="material-icons">dashboard</i>DASHBOARD</a></li>

    <li>
      <div class="divider"></div>
    </li>

    <li><a class="subheader">OPERATIONS</a></li>

    <li>
      <a class="waves-effect uppercase" href="../Admin/registerpatient.php"><i class="material-icons">person_add</i>Register
        Patient</a>
    </li>



    <li>
      <a class="waves-effect uppercase" href="../Admin/view_patient.php"><i class="material-icons">visibility</i>View
        Patient</a>
    </li>


    <li>
      <a class="waves-effect uppercase" href="../Admin/allpatients.php"><i class="material-icons">view_list</i>View All
        Patients</a>
    </li>

    <li>
      <div class="divider"></div>
    </li>

    <li class="white">
      <ul class="collapsible collapsible-accordion">
        <li>
          <a class="collapsible-header waves-effect waves-blue"><i class="material-icons">filter_list</i>STATISTICS
            <i class="material-icons right" style="margin-right:0;">arrow_drop_down</i></a>
          <div class="collapsible-body">
            <ul>
              <li><a class="waves-effect waves-blue" href="../stats/patients_stats.php"><i class="material-icons">fullscreen</i>Patients Stats</a></li>
              <li><a class="waves-effect waves-blue" href="diseases_stats.php"><i class="material-icons">swap_horiz</i>Disease Stats</a></li>
              <li>
                <div class="divider"></div>
              </li>
            </ul>
          </div>
        </li>
      </ul>
    </li>
    <li>
      <div class="divider"></div>
    </li>
    <li><a class="waves-effect waves-blue" href="#"><i class="material-icons">vpn_key</i>Change
        Password</a></li>
    <li><a class="waves-effect waves-blue" href="../logout.php"><i class="material-icons">thumb_down</i>Log Out</a></li>
    <li>
      <div class="divider"></div>
  </ul>

  <header>
    <div class="navbar-fixed">
      <nav class="blue">
        <div class="nav-wrapper">
          <div class="container">
            <a href="#" data-activates="slide-out" class="button-collapse"><i class="material-icons">menu</i></a>

            <a href="#" class="brand-logo centre">

              <img src="../assets/images/lasu logo.png" width="35" style="margin-top: 1.5px;;" class="img-responsive" alt="Image">

            </a>

          </div>
        </div>
      </nav>
    </div>
  </header>

  <main>
    <div class="row mt-4">
      <div class="">
        <div class=" col s12 m12 l12 offset-l3 ">
          <div class="card-body">
            <h5>View Number of patietns that visit the hospital here</h5>
            <div class="row">
              <form class="col s12 m12 l6 center">
                <div class="row">
                  <div class="input-field col s12 m12 l3">
                    <input type="text" name="from_date" id="from_date" class="datepicker">
                    <label for="from_date">From Date</label>
                  </div>
                  <div class="input-field col s12 m12 l3">
                    <input type="text" name="to_date" id="to_date" class="datepicker">
                    <label for="last_name">To Date</label>
                  </div>
                  <div class="input-field col s12 l3">
                    <select name="visit">
                      <option value="" disabled selected>Choose option</option>
                      <option value="firstVisit">First Visit</option>
                      <option value="allvisits">All Visits</option>
                     </select>
                    <label>Visit Type</label>
                  </div>
                  <div class="input-field col s12 m12 l3">
                    <input class="btn blue center" type="button" name="filter" id="filter" value="Filter"></input>
                  </div>
                </div>
            </div>
          </div>
          </form>
        </div>
      </div>

    </div>

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
    /* Ajax for the filter button */
    $('#filter').click(function() {
      var from_date = $('#from_date').val();
      var to_date = $('#to_date').val();

      if (from_date != '' && to_date != '') {
        $.ajax({
          url: "filter.php",
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

    $(document).ready(function() {

      $('.datepicker').pickadate({
        selectMonths: true, // Creates a dropdown to control month
        selectYears: 15, // Creates a dropdown of 15 years to control year,
        format: 'yyyy/mm/dd',
        today: 'Today',
        clear: 'Clear',
        close: 'Ok',
        closeOnSelect: false // Close upon selecting a date,

      });
    });
    $('.datepicker').on('mousedown', function(event) {
      event.preventDefault();
    });
    /*  var currYear = (new Date()).getFullYear();
     $(document).ready(function() {
       $(".datepicker").datepicker({
         format: "yyyy-mm-dd"
       });

     }); */
  </script>
</body>

</html>