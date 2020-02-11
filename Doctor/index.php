<?php
include("../security.php");
include("../includes/dbconfig/dbconfig.php");
include("header.php");
$results = "";
$response = "";
$response2 = "";
$num_rows = "";
$date = date("Y/m/d");
if (!empty($_GET['patient_details'])) {
  $patient_details = $_GET['patient_details'];
  $patient_details = trim(strtoupper($patient_details));

  $result = mysqli_query($conn, "SELECT * FROM patient_record WHERE hospital_no = '$patient_details' OR identity='$patient_details' ");
  $num_rows = mysqli_num_rows($result);
  if ($num_rows >= 1) {
    if (strlen($patient_details) <= 1) {
      $response .= "<p style='color:red;'>You searched for <b>'$patient_details'</b></p>";
      $response2 .= "<p style='color:red;'>Search Value Too Short, Search Again!!!</p>";
    } else {
      $response .= "<div class='col m12 s12 center'>
                    <h5 style='color:green;'>You searched for $patient_details</h5>
                    <p class='center' style='color:green;'>$num_rows result(s) found</p>
                  </div>";

      //$response2 .= "<font style='color:green;'>$num_rows result(s) found</font><br/>";

      while ($row = mysqli_fetch_assoc($result)) {
        $pat_id = $row['pat_id'];
        $hospital_no = $row["hospital_no"];
        $identity = strtoupper($row["identity"]);
        $fname = strtoupper($row["first_name"]);
        $mname = strtoupper($row["middle_name"]);
        $lname = strtoupper($row["last_name"]);
        $passport = $row['passport'];
        $gender = strtoupper($row['gender']);
        $fullname = $fname . " " . $lname;
        $patient_type = strtoupper($row["patient_type"]);
        $dob = strtoupper($row["dob"]);
        $registered_by = strtoupper($row["registered_by"]);
        $patient_upd_date = strtoupper($row["patient_upd_date"]);
        $patient_upd_by = strtoupper($row["patient_upd_by"]);

        if ($row['passport'] == '') {
          $see = 'No photo';
        } else {
          $see = $row['passport'];
        }
        $img = "<img class='square' width='300' height='300' src='../passport/$see' border='0' alt='$see'/>";
        //$imgp = "<img src='../passport/" . $row['passport'] . "' border='0' alt='" . $see . "' />";
        //echo $img;
        $results .= "<div>
                    <div class='card horizontal'>
                      <div class='card-image'>$img</div>
                      <div class='card-stacked'>
                        <div class='card-content'>
                          <p>Hospital Number: $hospital_no </p>
                          <p>Unique Identity: $identity</p>
                          <p>Full Name: $fullname</p>
                          <p>Gender: $gender</p>
                          <p>Category: $patient_type</p>
                          <p>D.O.B: $dob</p>
                          <p>Reg. By: $registered_by</p>
                          <p>Date Updated: $patient_upd_date</p>
                          <p>Updated By: $patient_upd_by</p>
                        </div>
                        <div class='card-action center'>
                          <a href='prescribe_treatment.php?pat_id=$pat_id' class='btn blue darken-4 block'>Prescribe</a>
                        </div>
                      </div>
                    </div>
                  </div>";
      }
    }
  } else {
    $response .= "<font style='color:red;'>Patient Detail not Found!!!</font><br/><br/>";
  }
}

?>

<main>
  <!-- <div class="parallax-container">
    <div class="parallax" style="height: 200px;"><img src="../assets/images/Medical-Courses.jpg"></div>
  </div> -->
  <div class="container">
    <div>
      <div>
        <div>
          <div class="card-panel">
            <div class="row">
              <div class="col s12 m12 l8">
                <div class="row">
                  <form method="get" action="" class="col s12 m12 l12">
                    <div class="input-field col s12 m6 l6">
                      <input id="name" name="patient_details" type="text" class="validate">
                      <label for="name">Card Number/Unique Number</label>
                    </div>
                    <div class="input-field col s6">
                      <button class="btn light blue darken-4 tooltipped" data-position="bottom" data-delay="50" data-tooltip="Search Record(s)" type="submit" name="submit"><i class="material-icons ">search</i></button>
                    </div><br />
                    <div class="col s12">
                      <?php echo $response; ?><br />
                    </div>
                    <div class="col s12">
                      <?php echo $response2; ?>
                    </div>
                    <div class="col s12">
                      <?php
                      echo $results;
                      ?>
                    </div>
                  </form>
                </div>
              </div>


              <div class="col s12 m12 l4">
                <?php
                $sql_query = mysqli_query($conn, "SELECT * FROM appointment WHERE appointment_date LIKE '$date'")
                ?>
                <div>
                  <p class="center uppercase bold blue darken-4 text-white">Booked Appointment(s)</p>
                  <table>
                    <thead>
                      <?php if (mysqli_num_rows($sql_query) > 0) {
                        while ($row = mysqli_fetch_assoc($sql_query)) {
                          $hospital_no = $row['patient_id'];
                          echo "
                        <tr>
                        <th>Appointment List</th>
                        <th>View</th>
                      </tr>
                    </thead>

                    <tbody>
                      <tr>
                        <td> $hospital_no </td>
                        <td> <button class='btn light btn-flat tooltipped' data-position='bottom' data-delay='50' data-tooltip='View Records' type='submit' name='submit'><i class='material-icons prefix'>pageview</i></button>
                        </td>";
                        }
                      } else {
                        echo "No Pending Appointment for today.";
                      }
                      ?>
                      </tr>
                      </tbody>
                  </table>
                  <?php
                  $sql_query = mysqli_query($conn, "SELECT * FROM daily_visits WHERE visit_date LIKE '$date'")
                  ?>
                  <div>
                    <p class="center uppercase blue darken-4 bold text-white">Normal Visits</p>
                    <table>
                      <thead>
                        <?php if (mysqli_num_rows($sql_query) > 0) {
                          while ($row = mysqli_fetch_assoc($sql_query)) {
                            $hospital_no = $row['patient_id'];
                            echo "
                        <tr>
                        <th>Patients List</th>
                        <th>View</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td> $hospital_no </td>
                        <td> <button class='btn light btn-flat tooltipped' data-position='bottom' data-delay='50' data-tooltip='View Records' type='submit' name='submit'><i class='material-icons prefix'>pageview</i></button>
                        </td>";
                          }
                        } else {
                          echo "No Pending List.";
                        }
                        ?></tr>
                        </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div>
        </div>
      </div>
    </div>
  </div>
</main>

<footer>
  <?php //include("../footer.php"); 
  ?>
</footer>
<style>
  .uppercase {
    text-transform: uppercase;
  }

  .bold {
    text-transform: bold;
  }

  .text-white {
    color: white;
  }
</style>

<script src="../assets/materialize/js/jquery.js"></script>
<script src="../assets/materialize/js/materialize.js"></script>
<script src="../assets/materialize/js/script.js"></script>
<script>
  $(document).ready(function() {
    $('.parallax').parallax();


    $('.dropdown-button').dropdown({
      inDuration: 1000,
      outDuration: 2000,
      constrainWidth: false, // Does not change width of dropdown to that of the activator
      click: true, // Activate on hover
      gutter: 0, // Spacing from edge
      belowOrigin: false, // Displays dropdown below the button
      alignment: 'left', // Displays dropdown with edge aligned to the left of button
      stopPropagation: false // Stops event propagation
    });
  });
</script>
</body>

</html>