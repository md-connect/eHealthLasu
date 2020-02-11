<?php
include("../security.php");
include("../includes/dbconfig/dbconfig.php");
include("header.php");

$status = "";
$staff_no = $_GET['identity'];
$reg_date = date("Y-m-d h:i:sa");
$registered_by = $_SESSION['name'];


$query = "SELECT * FROM patient_record WHERE identity='$staff_no'";
$query_run = mysqli_query($conn, $query);
while ($row = mysqli_fetch_assoc($query_run)) {
    $hospital_no = $row["hospital_no"];
    //$identity = strtoupper($row["identity"]);
    $fname = strtoupper($row["first_name"]);
    $mname = strtoupper($row["middle_name"]);
    $lname = strtoupper($row["last_name"]);
    $fullname = $lname . " " . $fname . " " . $mname;
    $address = strtoupper($row["address"]);
    $phone = strtoupper($row["phone"]);
    $religion = strtoupper($row["religion"]);
    $nationality = strtoupper($row["nationality"]);
    $state = strtoupper($row["state"]);
    $ethnic_group = strtoupper($row["ethnic_group"]);
}
if (isset($_POST['submit'])) {
    $depdnt_fname = $_POST['first_name'];
    $depdnt_mname = $_POST['middle_name'];
    $depdnt_lname = $_POST['surname'];
    $depdnt_gender = $_POST['gender'];
    $depdnt_pat_type = 'DEPENDANT';
    $depdnt_dob = $_POST['bdate'];
    $depdnt_reg_yr = date('Y');
    $depdnt_phone = $_POST['phone'];
    $depdnt_email = $_POST['email'];
    $depdnt_passport = $_FILES['passport']['name'];
    $temp = $_FILES['passport']['tmp_name'];
    $type = $_FILES['passport']['type'];
    $pwd = explode("-", $depdnt_dob);
    $pwdd = $pwd[0];
    $password = $depdnt_fname . $pwdd;
    $depdnt_password = password_hash($password, PASSWORD_DEFAULT);

    $confirmQuery = "SELECT * FROM patient_record WHERE hospital_no = '$hospital_no' AND patient_type='$depdnt_pat_type' AND first_name='$depdnt_fname' AND middle_name='$depdnt_mname' AND gender='$depdnt_gender' AND dob='$depdnt_dob'";
    $confirmResullt = mysqli_query($conn, $confirmQuery);
    $num_row = mysqli_num_rows($confirmResullt);
    if ($num_row > 0) {
        $status .= "<b style='font-size:30px; color:red; background:yellow;'>Dependant Already registered</b>";
    } else {
        if (($type == "image/jpeg") || ($type == "image/jpg") || ($type == "image/bmp") || ($type == "image/png") || ($type == "")) {
            $tempx = explode(".", $depdnt_passport);
            $depdnt_passportname = $depdnt_fname . "_" . time() . "." . end($tempx);

            $insert = "INSERT INTO patient_record (hospital_no, identity, patient_type, first_name, middle_name, last_name, gender, nationality, ethnic_group, state, dob, year_of_admission, religion, phone, address, next_of_kin_name, next_of_kin_relationship, next_of_kin_phone, next_of_kin_address, email, guardian_name, guardian_relationship, guardian_phone, guardian_address, date_of_entry, registered_by, passport, pwd)
						 						VALUES ('$hospital_no', 'NIL', '$depdnt_pat_type', '$depdnt_fname', '$depdnt_mname', '$depdnt_lname', '$depdnt_gender', '$nationality', '$ethnic_group', '$state', '$depdnt_dob','$depdnt_reg_yr', '$religion', '$depdnt_phone', '$address', '$fullname', 'PARENT', '$phone', '$address', '$depdnt_email', '$fullname', 'PARENT', '$phone', '$address', '$depdnt_reg_yr', '$registered_by', '$depdnt_passportname', '$depdnt_password')";
            $run_insert = mysqli_query($conn, $insert);
            if ($run_insert) {
                move_uploaded_file($temp, "../passport/$depdnt_passportname");
                ?>
                <script>
                    alert("Dependant Successfully registered! Click OK to continue");
                    window.location.assign("index.php");
                </script>
<?php
            } else {
                $status .= "<b style='color:red, background:yellow;'>Query Error encounter! Please try again later</b>";
            }
        } else {
            $status .= "<b style='color:red, background:yellow;'>Invalid image type. Please JPG/JPEG/BMP/PNG image format.</b>";
        }
    }
}
/* if (mysqli_num_rows($confirmResullt) >= 1) {
            ?>
            <script>
                alert("Patient Identity Already Exists");
                window.location.assign("index.php");
            </script>
            <?php
                    } else {
                        if (($type == "image/jpeg") || ($type == "image/jpg") || ($type == "image/bmp") || ($type == "image/png") || ($type == "")) {
                            $tempx = explode(".", $depdnt_passport);
                            $depdnt_passportname = $depdnt_fname . "_" . time() . "." . end($tempx);

                            $query_insert = "INSERT INTO patient_record (hospital_no, patient_type, first_name, middle_name, last_name, gender, nationality, ethnic_group, state, dob, year_of_admission, religion, phone, address, next_of_kin_name, next_of_kin_relationship, next_of_kin_phone, next_of_kin_address, email, guardian_name, guardian_relationship, guardian_phone, guardian_address, date_of_entry, registered_by, passport, pwd)
						 						VALUES ('$hospital_no', '$depdnt_pat_type', '$depdnt_fname', '$depdnt_mname', '$depdnt_lname', '$depdnt_gender', '$nationality', '$ethnic_group', '$state', '$depdnt_dob','$depdnt_reg_yr', '$religion', '$depdnt_phone', '$address', '$fullname', 'PARENT', '$phone', '$address', '$depdnt_email', '$fullname', 'PARENT', '$phone', '$address', '$depdnt_reg_yr', '$registered_by', '$depdnt_passportname', '$depdnt_password')";

                            if ($query = mysqli_query($conn, $query)) {
                                move_uploaded_file($temp, "../passport/$depdnt_passportname");
                                $status .= "<b style='color:green'>SUCCESS!</b>";
                                ?>
                    <script>
                        alert("Patient Successfully registered! Click OK to continue");
                        //window.location.assign("index.php");
                    </script>
                <?php
                                } else {
                                    $status .= "<b style='color:red'>ERROR HAS OCCURED</b>";
                                    ?>
                    <script>
                        alert("Error has occured, please try again!");
                        /* window.location.assign("registerpatient.php"); */
//</script>
//<?php
/*     }
            } else {
                $status .= "<b style='color:red, background:yellow;'>Image is not a supported filetype</b>";
            } 
        } */
// }


?>


<main>
    <div class="row mt-2">
        <div class="col s12">
            <div class="row">
                <div id="admin" class="col s12">
                    <div class="center">
                        <h4 class="bold">DEPENDANT REGISTRATION PAGE</h4>
                    </div>
                    <div class="card-panel">
                        <div class="center">
                            <?php echo $status; ?>
                        </div>
                        <form method="POST" enctype="multipart/form-data">
                            <div class="row">
                                <div class="input-field col s12 l3">
                                    <input type="text" name="first_name" id="" />
                                    <label for="">First Name</label>
                                </div>

                                <div class="input-field col s12 l3">
                                    <input type="text" name="middle_name" id="" />
                                    <label for="">Middle Name</label>
                                </div>

                                <div class="input-field col s12 l3">
                                    <input type="text" name="surname" id="" />
                                    <label for="">Surname</label>
                                </div>

                                <div class="input-field col s12 l3">
                                    <select name="gender">
                                        <option value="" disabled selected>Choose your option</option>
                                        <option value="MALE">MALE</option>
                                        <option value="FEMALE">FEMALE</option>
                                        <option value="OTHERS">OTHERS</option>
                                    </select>
                                    <label>GENDER</label>
                                </div>

                                <div class="input-field col s12 l4">
                                    <input type=text name="bdate" id="bdate" class="datepicker">
                                    <label for="bdate">Date of Birth</label>
                                </div>

                                <div class="input-field col s12 l4">
                                    <input type="email" name="phone" id="phone" />
                                    <label for="">Phone Number</label>
                                </div>

                                <div class="input-field col s12 l4">
                                    <input type="text" name="email" id="email" />
                                    <label for="">Email Address</label>
                                </div>

                                <div class="file-field input-field col s12 m6 l4">
                                    <div class="btn blue">
                                        <span>Passport Photograph</span>
                                        <input type="file" name="passport" id="passport">
                                    </div>
                                    <div class="file-path-wrapper">
                                        <input class="file-path validate" type="text" name="path">
                                    </div>
                                </div>
                            </div>

                            <div class="center">
                                <button type="submit" class="btn blue" name="submit">
                                    submit
                                </button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<footer></footer>

<script src="../assets/materialize/js/jquery.js"></script>
<script src="../assets/materialize/materialize.1.0.0.min.js"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script> -->
<script src="../assets/materialize/js/materialize.js"></script>
<script src="../assets/materialize/js/script.js"></script>
<script src="../assets/stepper/js/mstepper.min.js"></script>
<script>
    $(document).ready(function() {
        $('.datepicker').pickadate({
            selectMonths: true, // Creates a dropdown to control month
            selectYears: 25, // Creates a dropdown of 15 years to control year,
            format: 'yyyy-mm-dd',
            today: 'Today',
            clear: 'Clear',
            close: 'Ok',
            closeOnSelect: false // Close upon selecting a date,

        });
        $('.datepicker').on('mousedown', function(event) {
            event.preventDefault();
        });
    });
</script>
</body>

</html>