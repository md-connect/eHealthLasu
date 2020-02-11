<?php
include("../security.php");
include("header.php");
include("../includes/dbconfig/dbconfig.php");
include("../other_func/timeago/timeago.php");

$pet_date = date('Y-m-d');
$hospital_no = $_GET['hospital_no'];
$hospital_no = explode("?", $hospital_no);
$card_no = $hospital_no[0];
$id = explode("=", $hospital_no[1]);
$pat_id = $id[1];
$vital_reg_date = date("Y-m-d h:i:sa");
$vital_reg_by = $_SESSION['name'];

if ($conn) {
  $result = mysqli_query($conn, "SELECT * FROM patient_record WHERE pat_id='$pat_id' AND  hospital_no = '$card_no'");
  while ($row = mysqli_fetch_Assoc($result)) {
    $hospital_no = $row["hospital_no"];
    $identity = strtoupper($row["identity"]);
    $fname = strtoupper($row["first_name"]);
    $mname = strtoupper($row["middle_name"]);
    $lname = strtoupper($row["last_name"]);
    $passport = $row['passport'];
    $gender = strtoupper($row['gender']);
    $dob = $row['dob'];
    $age = floor(((time() - strtotime($dob))  / (3600 * 24 * 365)));
    $pat_type = $row["patient_type"];
    $fullname = "$lname $fname $mname";
    $fullname = strtoupper($fullname);
    $genotype = $row['genotype'];
    $blood_group = $row['blood_group'];
  }
  if (isset($_POST['submit'])) {
    $temperature = $_POST['body_temp'];
    $pulse = $_POST['pulse'];
    $resp_rate = $_POST['resp_rate'];
    $blood_press = $_POST['bloodpress'];
    $weight = $_POST['weight'];
    $height = $_POST['height'];
    $pain = $_POST['pain'];
    $menstrual_cycle = $_POST['menstrual_cycle'];
    $glasglow = $_POST['glasglow'];
    $bglucose = $_POST['bglucose'];
    $query_vital = "INSERT INTO patient_vitals(hospital_no, identity, first_name, middle_name, last_name, gender, temperature, pulse, respiratory_rate, blood_pressure, pain, menstrual_cycle, glasgow_coma_scale, glucose, weight, height, vital_reg_date, vital_reg_by)
              VALUES('$card_no', '$identity', '$fname', '$mname', '$lname', '$gender','$temperature','$pulse','$resp_rate','$blood_press','$pain','$menstrual_cycle','$glasglow', '$bglucose', '$weight', '$height', '$vital_reg_date', '$vital_reg_by')";
    $result_vital = mysqli_query($conn, $query_vital) or die(mysqli_error($conn));

    //INSERT INTO LOG
    $pet_date = date('Y-m-d');
    $query2 = "SELECT * FROM pat_stats WHERE hospital_no= '$card_no' AND pat_type='$pat_type' AND log_date='$pet_date'";
    $result2 = mysqli_query($conn, $query2);

    if (mysqli_num_rows($result2) > 0) {
      ?>
      <script>
        alert("Details have been updated! Click OK to continue");
        window.location.assign("index.php");
      </script>
    <?php
        } else {
          $query = "INSERT INTO pat_stats(hospital_no, gender, pat_type, log_date ) VALUES ('$card_no',  '$gender', '$pat_type', '$pet_date')";
          $result = mysqli_query($conn, $query) or die(mysqli_error($conn));

          ?>
      <script>
        alert("Patient Vitals Added! Click OK to continue");
        window.location.assign("index.php");
      </script>
<?php
    }
  }
}
?>
<main>
  <!--  <div class="parallax-container">
    <div class="parallax" style="height: 200px;"><img src="../assets/images/Medical-Courses.jpg"></div>
  </div> -->
  <div class="" style="padding-left: 20px; padding-right: 20px;">
    <div class="card-panel gradient-border">
      <div class="row">
        <div class="col m12 s12 l3">
          <p>Hospital No: <?php echo $card_no; ?></p>
        </div>
        <div class="col m12 s12 l3">
          <p>School ID: <?php echo $identity; ?></p>
        </div>
        <div class="col m12 s12 l6">
          <p>Name: <?php echo $fullname; ?></p>
        </div>
        <div class="col m12 s12 l3">
          <p>Patient Type: <?php echo $pat_type; ?></p>
        </div>
        <div class="col m12 s12 l2">
          <p>Age: <?php echo $age; ?></p>
        </div>

        <div class="col m12 s12 l2">
          <p>Genotype: <?php echo $genotype; ?></p>
        </div>
        <div class="col m12 s12 l2">
          <p>Blood Group: <?php echo $blood_group; ?></p>
        </div>

      </div>
      <div class="container">

      </div>
      <div class="divider"></div>
      <div class="row">
        <div class="">
          <form action="" method="POST">
            <div class="row">
              <div class="input-field col s12 l2">
                <input type="text" name="body_temp" id="" />
                <label for="">Temperature</label>
              </div>
              <div class="input-field col s12 l2">
                <input type="text" name="pulse" id="" />
                <label for="">Pulse</label>
              </div>

              <div class="input-field col s12 l2">
                <input type="text" name="resp_rate" id="" />
                <label for="">Respiratory Rate</label>
              </div>

              <div class="input-field col s12 l2">
                <input type="text" name="bloodpress" id="" />
                <label for="bdate">Blood Pressure</label>
              </div>
              <div class="input-field col s12 l2">
                <input type="text" name="weight" id="" />
                <label for="">Weight</label>
              </div>
              <div class="input-field col s12 l2">
                <input type="text" name="height" id="" />
                <label for="">Height</label>
              </div>


              <div class="input-field col s12 l3">
                <input type="text" name="pain" id="" />
                <label for="">Pain</label>
              </div>

              <div class="input-field col s12 l3">
                <input type="text" name="menstrual_cycle" id="" />
                <label for="">Menstrual Cycle</label>
              </div>
              <div class="input-field col s12 l3">
                <input type="text" name="glasglow" id="" />
                <label for="">Glasglow Coma Rate</label>
              </div>
              <div class="input-field col s12 l3">
                <input type="text" name="bglucose" id="" />
                <label for="">Blood Glucose Level</label>
              </div>
            </div>
            <div class="input-field">
              <button type="submit" class="btn blue gradient right" name="submit">
                Submit Vitals
              </button>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>
</main>

<footer></footer>

<script src="../assets/materialize/js/jquery.js"></script>
<script src="../assets/materialize/js/materialize.js"></script>
<script src="../assets/materialize/js/script.js"></script>
<script>
  $(document).ready(function() {
    $('.parallax').parallax();


    $('.dropdown-button').dropdown({
      inDuration: 2000,
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