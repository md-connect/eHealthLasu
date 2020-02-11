<?php
include("../security.php");
include("header.php");
include("../includes/dbconfig/dbconfig.php");

$date_updated = date("Y-M-D");
$status = "";
$updated_by = $_SESSION['username'];

if (isset($_POST['update'])) {
    $staff_no = $_POST['staffno'];
    $username = $_POST['username'];
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
    $types = $_FILES['passport']['type'];
    $pwd = $_POST['pwd'];
    $newpwd = $_POST['newpwd'];
    $updated_by = $_SESSION['name'];
    if ($pwd == $newpwd) {
        $password = password_hash($pwd, PASSWORD_DEFAULT);
    } else {
        $status .= "<b style='font-size:30px; color:red; background:yellow;'>Password do not match!</b>";
    }
    if (($types == "image/jpeg") || ($types == "image/jpg") || ($types == "image/bmp") || ($types == "image/png") || ($types == "")) {
        $tempx = explode(".", $passport);
        $passportname = $fname . "_" . time() . "." . end($tempx);
        $query_insert = "UPDATE  staff SET staff_no='$staff_no', user_name='$username', first_name='$fname', middle_name='$mname', last_name='$lname', dob='$dob', s_role='$role', gender='$gender', phone_no='$phone', email_add='$email', s_password='$password', passport='$passportname', date_updated='$date_updated', updated_by='$updated_by' WHERE staff_no='$staff_no'";
        if ($query = mysqli_query($conn, $query_insert)) {
            move_uploaded_file($temp, "../passport/$passportname");
            $status .= "<b style='color:green'>SUCCESS!</b>";
?>
            <script>
                alert("Staff record updated Successfully! Click OK to continue");
                window.location.assign("allstaff.php");
            </script>
        <?php
        } else {
            $status .= "<b style='color:red'>ERROR HAS OCCURED</b>";
        ?>
            <script>
                alert("Error has occured, please try again!");
                // window.location.assign("index.php");
            </script>
    <?php
        }
    } else {
        $status .= "<b style='color:red, background:yellow;'>Image is not a supported filetype</b>";
    }
}
if (isset($_POST['edit_staff'])) {
    $staff_id = $_POST['staff_id'];
    $sql = mysqli_query($conn, "SELECT * FROM staff WHERE staff_id ='$staff_id'");
    $result2 = mysqli_fetch_assoc($sql);
    ?>
    <main>
        <div class="row mt-2">
            <div class="col s12">
                <div class="row">
                    <div id="admin" class="col s12">
                        <div class="center">
                            <h4 class="bold">EDIT MEDICAL STAFF RECORD</h4>
                        </div>
                        <div class="card-panel">
                            <div class="center">
                                <?php echo $status; ?>
                            </div>
                            <form method="POST" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="input-field col s12 l3">
                                        <input type="text" name="staffno" id="" value="<?php echo $result2['staff_no']; ?>" />
                                        <label for="">Staff No</label>
                                    </div>
                                    <div class=" input-field col s12 l3">
                                        <input type="text" name="first_name" id="" value="<?php echo $result2['first_name']; ?>" />
                                        <label for="">First Name</label>
                                    </div>
                                    <div class=" input-field col s12 l3">
                                        <input type="text" name="middle_name" id="" value="<?php echo $result2['middle_name']; ?>" />
                                        <label for="">Middle Name</label>
                                    </div>

                                    <div class=" input-field col s12 l3">
                                        <input type="text" name="surname" id="" value="<?php echo $result2['last_name']; ?>" />
                                        <label for="">Surname</label>
                                    </div>
                                    <div class=" input-field col s12 l3">
                                        <select name="gender">
                                            <option value="<?php echo $result2['gender']; ?>" selected><?php echo $result2['gender']; ?></option>
                                            <option value="MALE" se>MALE</option>
                                            <option value="FEMALE">FEMALE</option>
                                            <option value="OTHERS">OTHERS</option>
                                        </select>
                                        <label>GENDER</label>
                                    </div>
                                    <div class="input-field col s12 l3">
                                        <select name="role">
                                            <option value="<?php echo $result2['s_role']; ?>" selected><?php echo $result2['s_role']; ?></option>
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
                                        <input type=text name="bdate" id="bdate" class="datepicker" value="<?php echo $result2['dob']; ?>" />
                                        <label for=" bdate">Date of Birth</label>
                                    </div>

                                    <div class="input-field col s12 l3">
                                        <input type="text" name="phone" id="phone" value="<?php echo $result2['phone_no']; ?>" />
                                        <label for="">Phone Number</label>
                                    </div>

                                    <div class=" input-field col s12 l3">
                                        <input type="text" name="email" id="email" value="<?php echo $result2['email_add']; ?>" />
                                        <label for="">Email Address</label>
                                    </div>
                                    <div class=" input-field col s12 l2">
                                        <input type="text" name="username" id="username" value="<?php echo $result2['user_name']; ?>" />
                                        <label for="">Choose a Username</label>
                                    </div>
                                    <div class=" input-field col s12 l2">
                                        <input type="password" name="pwd" id="pwd" />
                                        <label for="">Choose a Password</label>
                                    </div>
                                    <div class="input-field col s12 l2">
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
                                    <button type="submit" class="btn blue" name="update">
                                        UPDATE RECORD
                                    </button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

<?php

}
?>
<script src="../assets/materialize/js/jquery.js"></script>
<script src="../assets/materialize/materialize.1.0.0.min.js"></script>
<script src="../assets/materialize/js/materialize.js"></script>
<script src="../assets/materialize/js/script.js"></script>
<script src="../assets/stepper/js/mstepper.min.js"></script>
<script src="../assets/materialize/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $(".ethnic").select2({
            placeholder: "Select Ethnic Group",
            allowClear: true
        });

        $(".datepicker").datepicker({
            defaultDate: new Date(currYear - 5, 1, 31),
            // setDefaultDate: new Date(2000,01,31),
            maxDate: new Date(currYear - 5, 12, 31),
            yearRange: [1928, currYear - 5],
            format: "yyyy-mm-dd"
        });


    });
</script>
</body>

</html>