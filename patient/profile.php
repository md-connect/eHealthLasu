<?php session_start();
if ($_SESSION['role'] != "PATIENT") {
    header('Location: login.php');
}

//include("security.php");
include("includes/dbconfig/dbconfig.php");

if (isset($_POST['submit_apppointment'])) {

    $appointment_date = $_POST['appointment_date'];
    $appointment_time = $_POST['appointment_date'];
    $appointment_purpose = $_POST['appointment_date'];
    $appointment_priority = $_POST['appointment_date'];
    $currently_on_medication = $_POST['currently_on_medication'];
    $appointment_note = $_POST['appointment_date'];
    $appointment_status = "pending";

    $query = "SELECT * FROM patient_record WHERE hospital_no= '$hospital_no'";
    $run = mysqli_query($conn, $query);
    while ($row = mysqli_fetch_assoc($run)) {
        $patient_name = $row['last_name'] . " " . $row['first_name'] . " " . $row['middle_name'];
    }

    $query_appt = "INSERT INTO appointment(patient_id, patient_name, appointment_date, appointment_time, purpose, 
                              priority, currently_on_medication, appointment_note, appointment_status)
                  VALUES('$patient_id', '$patient_name', '$appointment_date', '$appointment_time', '$appointment_purpose',
                        '$appointment_priority', '$currently_on_medication', '$appointment_note', '$appointment_status')";
    $query_appt_run = mysqli_query($conn, $query_appt) or die(mysqli_error($conn));

    if ($query_appt_run) {
?>
        <script>
            alert("Appointment records has been successfully uploaded for approval, kindly view your appointment status for approval detail");
            window.location.assign("index.php");
        </script>
    <?php
    } else {
    ?>
        <script>
            alert("Error has occured! kindly re-apply for the appointment.");
            window.location.assign("index.php");
        </script>
<?php
    }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>eHealthLasu Appointment Page</title>
    <link rel="stylesheet" href="../assets/materialize/css/materialize.css" />
    <link rel="stylesheet" href="../assets/iconfont/material-icons.css" />
    <link rel="stylesheet" href="../assets/materialize/css/style.css" />
    <link rel="stylesheet" href="../assets/MaterialDesign-Webfont-master/css/materialdesignicons.css">
    <style>
        /* ul.select-dropdown,
    ul.dropdown-content {
      width: 15% !important;
    }

    li > span {
      white-space: nowrap;
    } */
    </style>
</head>

<body>
    <header class="navbar-fixed">
        <nav class="z-depth-0 blue" style="background-image:url('assets/images/page-header2.jpg');">
            <div class="nav-wrapper">
                <div class="container">
                    <a href="#" class="brand-logo left hide-on-med-and-down">
                        <img src="assets/images/lasu.png" width="150" style="margin-top: 1.5px;;" class="img-responsive" alt="Image">
                    </a>
                    <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons right-on-med-and-down">menu</i></a>
                    <ul class="right hide-on-med-and-down">
                        <li class="active"><a href="index.php">HOME</a></li>
                        <li><a href="appointment.php">APPOINTMENT BOOKING</a></li>
                        <li><a href="contactus.php">CONTACT US</a></li>
                        <li>
                            <a class='dropdown-button' href='#' data-activates='dropdown1'>
                                <img class="circle mt-4" width="50" height="45" src="assets/images/md.jpg" alt="">
                            </a>

                            <!-- Dropdown Structure -->
                            <ul id='dropdown1' class='dropdown-content'>
                                <li><a href="#!"><img class="circle mt-4" width="50" height="45" src="assets/images/md.jpg" alt=""> </a></li>
                                <li><a href="#!"><i class="material-icons">account_box</i>Profile</a></li>
                                <li><a href="#!"><i class="material-icons">settings_applications</i>Setting</a></li>
                                <li class="divider"></li>
                                <li><a href="logout.php"><i class="material-icons">assignment_return</i>Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <ul class="side-nav" id="mobile-demo">
                    <li class="active"><a href="index.php">HOME</a></li>
                    <li><a href="appointment.php">APPOINTMENT BOOKING</a></li>
                    <li><a href="contactus.php">CONTACT US</a></li>
                    <li><a href="#!"><i class="material-icons">account_box</i>Profile</a></li>
                    <li><a href="#!"><i class="material-icons">settings_applications</i>Setting</a></li>
                    <li class="divider"></li>
                    <li><a href="logout.php"><i class="material-icons">assignment_return</i>Logout</a></li>

                </ul>
            </div>
        </nav>
    </header>
    <div class="fixed-action-btn">
        <a class="btn-floating btn-large red">
            <i class="large material-icons">message</i>
        </a>
    </div>
    <main>
        <div class="container">
            <div class="row">
                <div class="col s12 m12 l8 offset-l2">
                    <div class="card-panel">
                        <div class="center">
                            <h5>BOOK YOUR APPOINTMENT HERE</h5>
                        </div>
                        <form action="" class="row">
                            <div class="input-field col s6">
                                <input name="hospitalNumber" type="text" disabled />
                                <label for="hospitalNumber">Hospital Number: <?php echo $_SESSION['hospital_no']; ?></label>
                            </div>
                            <div class="input-field col s6">
                                <input name="name" type="text" disabled />
                                <label for="name">Full Name: <?php echo $_SESSION['name']; ?></label>
                            </div>

                            <div class="col s12 m12 l6 input-field">
                                <input name="appointment_date" type="text" placeholder="Pick A Date" class="datepicker" required="required" />
                            </div>

                            <div class="col s12 m12 l6 input-field">
                                <input name="appointment_time" type="text" placeholder="Pick A Time" class="timepicker" required="required" />
                            </div>
                            <div class="input-field col s6">
                                <select name="appointment_purpose" required="required">
                                    <option value="" disabled selected>Choose your option</option>
                                    <option value="1">Diagnosis</option>
                                    <option value="2">Body Checkup</option>
                                    <option value="3">Cardiology</option>
                                    <option value="4">X-ray</option>
                                    <option value="5">Others</option>
                                </select>
                                <label>Purpose of Appointment</label>
                            </div>
                            <div class="input-field col s6">
                                <select name="appointment_priority" required="required">
                                    <option value="" disabled selected>Choose your option</option>
                                    <option value="1">High</option>
                                    <option value="2">Normal</option>
                                    <option value="3">Low</option>
                                </select>
                                <label>Priority</label>
                            </div>
                            <div class="input-field col s6">
                                <select name="currently_on_medication" required="required">
                                    <option value="" disabled selected>Choose your option</option>
                                    <option value="yes">Yes</option>
                                    <option value="no">No</option>
                                </select>
                                <label>Are You Currently On Any Medication?</label>
                            </div>
                            <!-- <div class="input-field col s6">
                <p>Are You Currently On Any Medication?</p>
                <p class="inline">
                  <input name="yes" type="radio" id="test1" />
                  <label for="test1">Yes</label>
                </p>
                <p class="inline">
                  <input name="no" type="radio" id="test1" />
                  <label for="test1">No</label>
                </p>
              </div> -->
                            <?php
                            $query = "SELECT * FROM staff WHERE s_role = 'doctor'";
                            $query_run = mysqli_query($conn, $query);
                            ?>
                            <div class="input-field col s6">
                                <select name="specialist">
                                    <option value="" disabled selected>Choose your option</option>
                                    <option value="generalize">Generalize</option>
                                    <?php
                                    while ($row = mysqli_fetch_assoc($query_run)) {
                                        $staffNo = $row['staff_id'];
                                        $doctorName = $row['first_name'] . " " . $row['last_name'];
                                    ?>
                                        <option value="<?php echo $staff_id; ?>"><?php echo $doctorName; ?></option>';
                                    <?php
                                    }
                                    ?>
                                </select>
                                <label>Specify Specialist?</label>

                            </div>

                            <div class="input-field col s12">
                                <textarea name="appointment_note" id="textarea1" class="materialize-textarea" required="required"></textarea>
                                <label for="textarea1">Short Note</label>
                            </div>
                            <div class="input-field col s12">
                                <button type="submit_appointment" class="btn blue block darken-4">
                                    book appointment
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <footer class="page-footer blue darken-4 center">
        <div class="footer-copyright">
            <div class="container">
                <p>Copyright &copy <?php echo date("Y"); ?> Lagos State University Health Centre.</p>
                <!-- <a class="grey-text text-lighten-4 right" href="#!">More Links</a> -->
            </div>
        </div>
    </footer>
    <script src="../assets/materialize/js/jquery.js"></script>
    <script src="../assets/materialize/js/materialize.js"></script>
    <!--include jQuery Validation Plugin-->
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.12.0/jquery.validate.min.js" type="text/javascript"></script>

    <!--Optional: include only if you are using the extra rules in additional-methods.js -->
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.12.0/additional-methods.min.js" type="text/javascript"></script>

    <script src="../assets/materialize/js/script.js"></script>

    <script>
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
            $('.datepicker').on('mousedown', function(event) {
                event.preventDefault();
            });

            $('.timepicker').pickatime({
                default: 'now', // Set default time: 'now', '1:30AM', '16:30'
                fromnow: 0, // set default time to * milliseconds from now (using with default = 'now')
                twelvehour: false, // Use AM/PM or 24-hour format
                donetext: 'OK', // text for done-button
                cleartext: 'Clear', // text for clear-button
                canceltext: 'Cancel', // Text for cancel-button
                autoclose: false, // automatic close timepicker
                ampmclickable: true, // make AM PM clickable
                aftershow: function() {} //Function for after opening timepicker
            });
            $('.timepicker').on('mousedown', function(event) {
                event.preventDefault();
            });

            $(".dropdown-button").dropdown({
                belowOrign: true
            });

            $(function() {
                $('#loginform').validate({
                    rules: {
                        username: {
                            minlength: 2,
                            maxlength: 50,
                            required: true
                        },
                        pwd: {
                            required: true,
                            email: true,
                            minlength: 10
                        }

                    },
                    errorPlacement: function(error, element) {
                        var name = $(element).attr("name");
                        error.appendTo($("#" + name + "_validate"));
                    },

                });


            });
        });
    </script>
</body>

</html>