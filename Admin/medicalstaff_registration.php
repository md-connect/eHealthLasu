<?php
include("../security.php");
include("../includes/dbconfig/dbconfig.php");
include("header.php");

$status = "";
$reg_date = date("Y-m-d h:i:sa");

if (isset($_POST['submit'])) {
    $staff_no = $_POST['staffno'];
    $fname = $_POST['first_name'];
    $mname = $_POST['middle_name'];
    $lname = $_POST['surname'];
    $gender = $_POST['gender'];
    $role = $_POST['role'];
    $dob = $_POST['bdate'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $passport = $_FILES['passport']['name'];
    $temp = $_FILES['passport']['tmp_name'];
    $type = $_FILES['passport']['type'];
    $pwd = $_POST['pwd'];
    $newpwd = $_POST['newpwd'];
    $registered_by = $_SESSION['name'];
    echo $reg_date;
    if ($pwd == $newpwd) {
        $password = password_hash($password, PASSWORD_DEFAULT);
    } else {
        $status .= "<b style='font-size:30px; color:red; background:yellow;'>Password do not match!</b>";
    }
    $confirmExistence = "SELECT * FROM staff WHERE staff_no = '$staff_no'";
    $confirmResullt = mysqli_query($conn, $confirmExistence);
    $num_row = mysqli_num_rows($confirmResullt);
    if ($num_row > 0) {
        $status .= "<b style='font-size:30px; color:red; background:yellow;'>Staff Already exists.</b>";
    } else {
        if (($type == "image/jpeg") || ($type == "image/jpg") || ($type == "image/bmp") || ($type == "image/png") || ($type == "")) {
            $tempx = explode(".", $passport);
            $passportname = $fname . "_" . time() . "." . end($tempx);

            $insert = "INSERT INTO staff (staff_no, first_name, middle_name, last_name, dob, s_role, gender, phone_no, email_add, s_password, passport, reg_date, reg_by)
						VALUES ('$staff_no', '$fname', '$mname', '$lname', '$dob', '$role', '$gender', '$phone', '$email', '$password', '$passportname', '$reg_date', '$registered_by')";
            $run_insert = mysqli_query($conn, $insert);
            if ($run_insert) {
                move_uploaded_file($temp, "../passport/$passportname");
                ?>
                <script>
                    alert("Staff Successfully registered! Click OK to continue");
                    //window.location.assign("index.php");
                </script>
<?php
            } else {
                $status .= "<b style='color:red, background:yellow;'>Error encounter! Please try again later</b>";
            }
        } else {
            $status .= "<b style='color:red, background:yellow;'>Invalid image type. Please JPG/JPEG/BMP/PNG image format.</b>";
        }
    }
}
?>


<main>
    <div class="row mt-2">
        <div class="col s12">
            <div class="row">
                <div id="admin" class="col s12">
                    <div class="center">
                        <h4 class="bold">MEDICAL STAFF REGISTRATION PAGE</h4>
                    </div>
                    <div class="card-panel">
                        <div class="center">
                            <?php echo $status; ?>
                        </div>
                        <form method="POST" enctype="multipart/form-data">
                            <div class="row">
                                <div class="input-field col s12 l3">
                                    <input type="text" name="staffno" id="" />
                                    <label for="">Staff No</label>
                                </div>
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
                                <div class="input-field col s12 l3">
                                    <select name="role">
                                        <option value="" disabled selected>Choose your option</option>
                                        <option value="super_admin">DIRECTOR</option>
                                        <option value="doctor">DOCTOR</option>
                                        <option value="lab_scientist">LAB SCIENTIST</option>
                                        <option value="admin">MEDICAL RECORDS</option>
                                        <option value="nurse">NURSE</option>
                                        <option value="pharmacist">PHARMACIST</option>
                                        <option value="xray_specialist">XRAY TECHNICIAN</option>
                                    </select>
                                    <label>CADRE</label>
                                </div>

                                <div class="input-field col s12 l3">
                                    <input type=text name="bdate" id="bdate" class="datepicker">
                                    <label for="bdate">Date of Birth</label>
                                </div>

                                <div class="input-field col s12 l3">
                                    <input type="text" name="phone" id="phone" />
                                    <label for="">Phone Number</label>
                                </div>

                                <div class="input-field col s12 l3">
                                    <input type="text" name="email" id="email" />
                                    <label for="">Email Address</label>
                                </div>
                                <div class="input-field col s12 l3">
                                    <input type="password" name="pwd" id="pwd" />
                                    <label for="">Choose a Password</label>
                                </div>
                                <div class="input-field col s12 l3">
                                    <input type="password" name="newpwd" id="newpwd" />
                                    <label for="">Re-enter Your Password</label>
                                </div>

                                <div class="file-field input-field col s12 m6 l3">
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
                                    REGISTER
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