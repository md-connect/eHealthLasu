<?php
include("../security.php");
include("../includes/dbconfig/dbconfig.php");
include("header.php");

$results = "";
$response = "";
$response2 = "";
$num_rows = "";

if (!empty($_GET['s_details'])) {
  $s_details = url_decode($_GET['s_details']);
  $s_detail = trim(strtoupper($s_details));

  $result = mysqli_query($conn, "SELECT * FROM patient_record WHERE hospital_no = '$card_no' ");
  if (mysqli_num_rows($result) >= 1) {
    if (strlen($s_detail) <= 1) {
      $response .= "<h5>You searched for '$card_no'</h5>";
      $response2 .= "<font style='color:red;'>Search Value Too Short, Search Again!!!</font>";
    } else {
      $response .= "<h5>You searched for '$card_no'</h5>";

      $num_rows = mysqli_num_rows($result);
      $response2 .= "<font style='color:green;'>$num_rows result(s) found</font><br/>";

      while ($row = mysqli_fetch_assoc($result)) {
        $hospital_no = $row["hospital_no"];
        $identity = strtoupper($row["identity"]);
        $fname = strtoupper($row["first_name"]);
        $mname = strtoupper($row["middle_name"]);
        $lname = strtoupper($row["last_name"]);
        $passport = $row['passport'];
        $gender = strtoupper($row['gender']);


        if ($row['passport'] == '') {
          $see = 'No photo';
        } else {
          $see = $row['passport'];
        }
        $imgp = "<img src='../passport/" . $row['passport'] . "' border='0' alt='" . $see . "' style='float:right;height:130px; width:100px'/>";

        $results .= '<br/><br/> <div class="card horizontal">
                    <div class="card-image">
                      <img src="../assets/images/matthew.png">
                    </div>
                    <div class="card-stacked">
                      <div class="card-content">
                        <p>Hospital Number: $hospital_no </p>
                        <p>Unique Identity:$hospital_no </p>
                        <p>Full Name: $hospital_no </p>
                        <p>Gender: $hospital_no </p>
                        <p>Category: $hospital_no </p>
                        <p>Reg. Date:$hospital_no </p>
                        <p>Reg. By:$hospital_no </p>
                        <p>Date Updated:$hospital_no </p>
                        <p>Updated By:$hospital_no </p>
                      </div>
                      <div class="card-action center">
                        <a href="prescribe_treatment.html" id="#modal1" class="btn modal-trigger blue darken-4 block"><i class="mdi mdi-account-edit"></i>PRESCRIBE</a>
                      </div>
                    </div>
                  </div>';
      }
    }
  } else {
    $response .= "<font style='color:red;'>Patient Detail not Found!!!</font><br/><br/> <button name='ok' class='details' style='text-decoration:none; background-color:yellow; color:black; width:60px;' onclick='history.go(-1);return true;'>DONE</button><br/><br/>";
  }
}
?>

<main>
  <div class="container">
    <div>
      <div>
        <div>
          <div class="row">
            <div class="">
              <div class="card-panel">
                <!-- <style>
                           .input-field .prefix{
                               right: 0;
                           }
                       </style> -->
                <form action="search_patient.php" method="POST" class="row">
                  <div class="input-field col s12 m12 l8 offset-l2">
                    <i class="mdi mdi-card-search prefix"></i>
                    <input type="text" name="patient_details" id="">
                    <label for="">Hospital Number/Unique Number</label>
                  </div>
                  <div class="input-field center">
                    <button type="submit" class="btn blue darken-4">search</button>
                  </div>

                </form>
                
                 
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

<footer></footer>

<script src="../assets/materialize/js/jquery.js"></script>
<script src="../assets/materialize/js/materialize.js"></script>
<script src="../assets/materialize/js/script.js"></script>
</body>

</html>