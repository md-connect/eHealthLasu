<?php session_start();
if ($_SESSION['role'] != "PATIENT") {
    header('Location: login.php');
}
//include("security.php");
include("includes/dbconfig/dbconfig.php");


?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>eHealthLasu Appointment Page</title>
    <link rel="stylesheet" href="assets/materialize/css/materialize.css" />
    <link rel="stylesheet" href="assets/iconfont/material-icons.css" />
    <link rel="stylesheet" href="assets/materialize/css/style.css" />
    <link rel="stylesheet" href="assets/MaterialDesign-Webfont-master/css/materialdesignicons.css">
    <style>
        .modal {
            top: 30% !important;
            width: 30%;
        }

        .error {
            color: red;
        }

        @media print {
            .no-print {
                visibility: hidden;
            }
        }

        .mt-2 {
            margin-top: 5%;
        }
    </style>
</head>

<body>
    <header class="navbar-fixed no-print">
        <nav class="z-depth-0 blue" style="background-image:url('assets/images/page-header2.jpg');">
            <div class="nav-wrapper">
                <div class="container">
                    <a href="#" class="brand-logo">
                        <img src="assets/images/lasu.png" width="150" style="margin-top: 1.5px;;" class="img-responsive" alt="Image">
                    </a>
                    <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons right-on-med-and-down">menu</i></a>
                    <ul class="right hide-on-med-and-down">
                        <li class="active"><a href="patient-index.php">HOME</a></li>
                        <li><a href="logout.php">LOGOUT</a></li>
                        <li>
                            <a class='dropdown-button' href='#' data-activates='dropdown1'>
                                <img class="circle mt-4" width="50" height="45" src="passport/<?php echo $_SESSION['passport']; ?>" alt="">
                            </a>
                            <!-- Dropdown Structure -->
                            <ul id='dropdown1' class='dropdown-content'>
                                <li><a href=" #!"><img class="circle mt-4" width="50" height="45" src="passport/<?php echo $_SESSION['passport']; ?>" alt=""> </a></li>
                                <li><a href=" #!"><i class="material-icons">account_box</i>Profile</a></li>
                                <li><a href="#!"><i class="material-icons">settings_applications</i>Setting</a></li>
                                <li class="divider"></li>
                                <li><a href="logout.php"><i class="material-icons">assignment_return</i>Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <ul class="side-nav" id="mobile-demo">
                    <li class="active"><a href="patient-index.php">HOME</a></li>
                    <li><a href="#!"><i class="material-icons">account_box</i>Profile</a></li>
                    <li><a href="#!"><i class="material-icons">settings_applications</i>Setting</a></li>
                    <li class="divider"></li>
                    <li><a href="logout.php"><i class="material-icons">assignment_return</i>Logout</a></li>
                </ul>
            </div>
        </nav>
    </header>

    <?php
    $hospital_no = $_SESSION['hospital_no'];
    $sql_query = mysqli_query($conn, "SELECT * FROM appointment WHERE patient_id LIKE '$hospital_no' ORDER BY id DESC LIMIT 1");
    $row = mysqli_fetch_assoc($sql_query);
    $hospital_no = $row['patient_id'];
    $appointment_id = $row['appointment_id'];
    $name = $row['patient_name'];
    $date = $row['appointment_date'];
    $time = $row['appointment_time'];
    $purpose = $row['purpose_of_appointment'];
    ?>
    <main>
        <div class="container mt-2 bordered">
            <div class="row">

                <div class="col s2 m2 l2">
                    <img class="responsive-img" src="assets\images\lasu_logo.png" alt="" srcset="" height="60" width="60">
                </div>
                <div class="col s8 m8 l8 center">
                    <h5>LAGOS STATE UNIVERSITY HEALTH CENTRE</h5>
                    <p>KM 15, Badagry Expressway, Ojo, PMB 0001, LASU Post Office, Ojo, Lagos, Nigeria.</p>
                    <h5 class="uppercase" style="font-family:arial-black">appointment slip</h5>

                </div>
                <div class="col s2 m2 l2">
                    <img class="responsive-img" src="passport/<?php echo $_SESSION['passport']; ?>" alt="" srcset="" height="60" width="60">
                </div>

                <div class="col s12">
                    <div class="divider"></div>
                </div>

                <div class="col s12  center">
                    <h6>Appointment ID: <span class="bold"><?php echo $row['appointment_id']; ?></span></h5>
                </div>

                <div class="col s12 center">
                    <h6>Name: <span class="bold"><?php echo $row['patient_name']; ?></span></h4>
                </div>

                <div class="col s12 center">
                    <h6>Appointment Date: <span class="bold"><?php echo $row['appointment_date']; ?></span></h4>
                </div>

                <div class="col s12 center">
                    <h6>Appointment Time: <span class="bold"><?php echo $row['appointment_time']; ?></span></h4>
                </div>

                <div class="col s12 center">
                    <h6>Purpose of Appointment: <span class="bold"><?php echo $row['purpose_of_appointment']; ?></span></h5>
                </div>


                <div class="col s12 mt-2">
                    <div class="center">
                        <button onclick="window.print();" class="btn  black no-print">PRINT</button>

                    </div>
                </div>
            </div>

        </div>

    </main>
    <?php include('footer.php'); ?>

    <script>
        $(document).ready(function() {
            // the "href" attribute of the modal trigger must specify the modal ID that wants to be triggered
            $('.modal').modal({
                dismissible: false,
                inDuration: 50, // Transition in duration
                outDuration: 0, // Transition out duration

            });


            $('.datepicker').pickadate({
                selectMonths: true, // Creates a dropdown to control month
                selectYears: 15, // Creates a dropdown of 15 years to control year,
                format: 'yyyy/mm/dd',
                today: 'Today',
                clear: 'Clear',
                close: 'Ok',
                min: true,
                closeOnSelect: false // Close upon selecting a date,

            });
            $('.datepicker').on('mousedown', function(event) {
                event.preventDefault();
            });
            $(".dropdown-button").dropdown({
                belowOrign: true,
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