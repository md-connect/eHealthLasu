<?php session_start();
if ($_SESSION['role'] != "PATIENT") {
    header('Location: login.php');
}

//include("security.php");
include("includes/dbconfig/dbconfig.php");
$pat_id = $_SESSION['pat_id'];
echo $pat_id;
$sql_run = mysqli_query($conn, "SELECT * FROM patient_record WHERE pat_id='$pat_id'");
if ($sql_run) {
    $row = mysqli_fetch_array($sql_run);
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>eHealthLasu | Patient Profile Page</title>
    <link rel="stylesheet" href="assets/materialize/css/materialize.css" />
    <link rel="stylesheet" href="assets/iconfont/material-icons.css" />
    <link rel="stylesheet" href="assets/materialize/css/style.css" />
    <link rel="stylesheet" href="assets/MaterialDesign-Webfont-master/css/materialdesignicons.css">
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
                    <a href="#" class="brand-logo">
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
                                <li><a href="#!"><img class="circle mt-4" width="50" height="45" src="passport/<?php echo $_SESSION['passport']; ?>" alt=""> </a></li>
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
    <main>
        <div class="container">
            <div class="row">
                <div class="col s12 m12 l10 offset-l1">
                    <div class="card">
                        <div class="card-tabs">
                            <ul class="tabs tabs-fixed-width">
                                <li class="tab"><a class="active" href="#test4">MY PROFILE</a></li>
                                <li class="tab"><a class="" href="#test5">APPOINTMENTS</a></li>
                            </ul>
                        </div>
                        <div class="card-content grey lighten-4">
                            <div id="test4">
                                <div class="row center">
                                    <div class="col s12">
                                        <div class="center">
                                            <img class="circle" src="assets/passport/<?php echo $passport; ?>" width="200" alt="">
                                        </div>
                                    </div>
                                </div>

                                <div class="row center">
                                    <div class="col s12 m12 l4">
                                        <p>Lorem, ipsum dolor.</p>
                                    </div>
                                    <div class="col s12 m12 l4">
                                        <p>Lorem, ipsum dolor.</p>
                                    </div>

                                    <div class="col s12 m12 l4">
                                        <p>Lorem, ipsum dolor.</p>
                                    </div>

                                    <div class="col s12 m12 l4">
                                        <p>Lorem, ipsum dolor.</p>
                                    </div>

                                    <div class="col s12 m12 l4">
                                        <p>Lorem, ipsum dolor.</p>
                                    </div>

                                    <div class="col s12 m12 l4">
                                        <p>Lorem, ipsum dolor.</p>
                                    </div>

                                    <div class="col s12 m12 l4">
                                        <p>Lorem, ipsum dolor.</p>
                                    </div>

                                    <div class="col s12 m12 l4">
                                        <p>Lorem, ipsum dolor.</p>
                                    </div>

                                    <div class="col s12 m12 l4">
                                        <p>Lorem, ipsum dolor.</p>
                                    </div>

                                </div>
                            </div>
                            <div id="test5">
                                <table class="bordered responsive-table">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Lorem ipsum dolor sit amet.</th>
                                            <th>Item Price</th>
                                            <th>Name</th>
                                            <th>Item Name</th>
                                            <th>Item Price</th>
                                            <th>Name</th>
                                            <th>Item Name</th>
                                            <th>Item Price</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <tr>
                                            <td>Alvin</td>
                                            <td>Eclair</td>
                                            <td>$0.87</td>
                                            <td>Alvin</td>
                                            <td>Eclair</td>
                                            <td>$0.87</td>
                                            <td>Alvin</td>
                                            <td>Eclair</td>
                                            <td>$0.87</td>
                                        </tr>
                                        <tr>
                                            <td>Alvin</td>
                                            <td>Eclair</td>
                                            <td>$0.87</td>
                                            <td>Alvin</td>
                                            <td>Eclair</td>
                                            <td>$0.87</td>
                                            <td>Alvin</td>
                                            <td>Eclair</td>
                                            <td>$0.87</td>
                                        </tr>
                                        <tr>
                                            <td>Alvin</td>
                                            <td>Eclair</td>
                                            <td>$0.87</td>
                                            <td>Alvin</td>
                                            <td>Eclair</td>
                                            <td>$0.87</td>
                                            <td>Alvin</td>
                                            <td>Eclair</td>
                                            <td>$0.87</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
    </main>
    <?php include('footer.php'); ?>

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