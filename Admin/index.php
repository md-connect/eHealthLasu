<?php
include("../security.php");
include("header.php");


function totalmedicalstaff()
{
  include("../includes/dbconfig/dbconfig.php");
  $query = "SELECT staff_id FROM staff ORDER BY staff_id";
  $run = mysqli_query($conn, $query);
  $row = mysqli_num_rows($run);
  return $row;
}

function totalpatient($pat_type)
{
  include("../includes/dbconfig/dbconfig.php");
  $query = "SELECT pat_id FROM patient_record WHERE patient_type='$pat_type' ORDER BY pat_id";
  $run = mysqli_query($conn, $query);
  $row = mysqli_num_rows($run);
  return $row;
}

/* $totaldoctor = totalmedicalstaff('doctor');
$totalnurse = totalmedicalstaff('nurse');
$totallab = totalmedicalstaff('lab');
$totalxray = totalmedicalstaff('xray'); */

$medicalstaff = totalmedicalstaff();
$totalstudent = totalpatient('STUDENT');
$totalstaff = totalpatient('STAFF');
$totaldependant = totalpatient('DEPENDANT');



?>



<main>
  <!-- <div class="parallax-container">
    <div class="parallax"><img src="../assets/images/Medical-Courses.jpg"></div>
  </div> -->
  <div class="container">
    <div class="row">
      <div class="col s12 m12 l6">
        <div class="card-panel">
          <div class="center">
            <h6 class="bold">TOTAL REGISTERED MEDICAL STAFF</h6>
            <h3 class="bold"><?php echo $medicalstaff; ?></h3>
            <h5>MEDICAL STAFF</h5>
          </div>
        </div>
      </div>

      <div class="col s12 m12 l6">
        <div class="card-panel">
          <div class="center">
            <h6 class="bold">TOTAL REGISTERED STAFF</h6>
            <h3 class="bold"><?php echo $totalstaff; ?></h3>
            <h5>STAFF</h5>
          </div>
        </div>
      </div>

      <div class="col s12 m12 l6">
        <div class="card-panel">
          <div class="center">
            <h6 class="bold">TOTAL REGISTERED STUDENTS</h6>
            <h3 class="bold"><?php echo $totalstudent; ?></h3>
            <h5>STUDENTS</h5>
          </div>
        </div>
      </div>

      <div class="col s12 m12 l6">
        <div class="card-panel">
          <div class="center">
            <h6 class="bold">TOTAL REGISTERED STAFF DEPENDANTS</h6>
            <h3 class="bold"><?php echo $totaldependant; ?></h3>
            <h5>STAFF DEPENDANTS</h5>
          </div>
        </div>
      </div>
    </div>
  </div>


</main>

<?php include("../footer.php"); ?>

<style>
  .parallax-container {
    height: 300px;
  }

  .nmt {
    margin-top: -20vh;
  }
</style>

<script src="../assets/materialize/js/jquery.js"></script>
<script src="../assets/materialize/js/materialize.js"></script>
<script src="../assets/materialize/js/script.js"></script>
<script>
  $(document).ready(function() {
    $(' .parallax').parallax();
  });
</script>
</body>

</html>