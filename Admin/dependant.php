<?php
include("../security.php");
include("../includes/dbconfig/dbconfig.php");
include("header.php");
$results = "";
$response = "";
$response2 = "";
$num_rows = "";

if (!empty($_GET['staff_no'])) {
    $staff_no = $_GET['staff_no'];
    $staff_no = trim(strtoupper($staff_no));

    $result = mysqli_query($conn, "SELECT * FROM patient_record WHERE identity = '$staff_no' AND patient_type='STAFF'");
    $num_rows = mysqli_num_rows($result);
    if ($num_rows >= 1) {
        if (strlen($staff_no) <= 1) {
            $response .= "<p style='color:red;'>You searched for <b>'$staff_no'</b></p>";
            $response2 .= "<p style='color:red;'>Search Value Too Short, Search Again!!!</p>";
        } else {
            $response .= "<div class='col m12 s12 center'>
                    <h5 style='color:green;'>You searched for $staff_no</h5>
                    <p class='center' style='color:green;'>$num_rows result(s) found</p>
                  </div>";

            //$response2 .= "<font style='color:green;'>$num_rows result(s) found</font><br/>";

            while ($row = mysqli_fetch_assoc($result)) {
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
                $imgp = "<img src='../passport/" . $row['passport'] . "' border='0' alt='" . $see . "' />";

                $results .= "<div>
                    <div class='card horizontal'>
                      <div class='card-image'>$imgp</div>
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
                          <a href='add_dependant.php?identity=$staff_no' class='btn blue darken-4 block'>Add Dependendant</a>
                        </div>
                      </div>
                    </div>
                  </div>";
            }
        }
    } else {
        $response .= "<font style='color:red;'>Staff's record not Found!!!</font><br/><br/>";
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
                            <form method="get" action="" class="col s12">
                                <div class="input-field col s12 m6 l6">
                                    <input id="name" name="staff_no" type="text" class="validate">
                                    <label for="name">Staff Number</label>
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