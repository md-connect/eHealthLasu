<?php
include("security.php");
include("includes/dbconfig/dbconfig.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>eHealthLasu | Patient Home-page</title>
    <link rel="shortcut icon" type="image/x-icon" href="../assets/images/lasuplus.png">
    <link rel="stylesheet" href="assets/materialize/css/materialize.css" />
    <link rel="stylesheet" href="assets/iconfont/material-icons.css" />
    <link rel="stylesheet" href="assets/materialize/css/style.css" />
    <link rel="stylesheet" href="assets/MaterialDesign-Webfont-master/css/materialdesignicons.css">
    <style>
        ul.select-dropdown,
        ul.dropdown-content {
            width: 15% !important;

            li>span {
                white-space: :nowrap;
            }
        }
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
                        <li class="active"><a href="patient-index.php">HOME</a></li>
                        <li class=""><a href="appointment.php">BOOK APPOINTMENT</a></li>
                        <li><a href="logout.php">LOGOUT</a></li>
                        <li>
                            <a class='dropdown-button' href='#' data-activates='dropdown1'>
                                <img class="circle mt-4" width="50" height="45" src="passport/<?php echo $_SESSION['passport']; ?>" alt="">
                            </a>

                            <!-- Dropdown Structure -->
                            <ul id='dropdown1' class='dropdown-content'>
                                <li><a href="#!"><img class="circle mt-4" width="50" height="45" src="passport/<?php echo $_SESSION['passport']; ?>" alt=""> </a></li>
                                <li><a href="profile.php"><i class="material-icons">account_box</i>Profile</a></li>
                                <li><a href="changepassword.php"><i class="material-icons">settings_applications</i>Setting</a></li>
                                <li class="divider"></li>
                                <li><a href="logout.php"><i class="material-icons">assignment_return</i>Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <ul class="side-nav" id="mobile-demo">
                    <li class="active"><a href="patient-index.php">HOME</a></li>
                    <li class=""><a href="appointment.php">BOOK APPOINTMENT</a></li>
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
            <div class="">
                <div class="row">
                    <div class="col s12 mt-2">
                        <div class="row">
                            <div class="col s12 center">
                                <h1>Welcome, <?php echo $_SESSION['name']; ?>.</h1>
                                <h3></h3>
                                <a class="btn blue darken-4" href="appointment.php" class="text-white">
                                    Clck here to book appointment
                                </a>
                            </div>
                        </div>
                    </div>

                    <?php
                    $hospital_no = $_SESSION['hospital_no'];
                    $sql_query = mysqli_query($conn, "SELECT * FROM appointment WHERE patient_id LIKE '$hospital_no'")
                    ?>
                </div>

            </div>

            <div class="card-panel">
                <div class="col s12">
                    <div class="row">
                        <div class="col s12 center">
                            <h5>Appointment History</h5>
                            <div>
                                <table class="responsive-table">
                                    <thead>
                                        <tr>
                                            <th>S/N</th>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Appt. Date</th>
                                            <th>Appt. Time</th>
                                            <th>Purpose</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (mysqli_num_rows($sql_query) > 0) {
                                            $count = 1;
                                            while ($row = mysqli_fetch_assoc($sql_query)) {
                                                $hospital_no = $row['patient_id'];
                                                $appointment_id = $row['appointment_id'];
                                                $name = $row['patient_name'];
                                                $date = $row['appointment_date'];
                                                $time = $row['appointment_time'];
                                                $purpose = $row['purpose_of_appointment'];
                                                echo "
                        
                      <tr>
                        <td> $count </td>
                        <td> $appointment_id </td>
                        <td> $name </td>
                        <td> $date </td>
                        <td> $time </td>
                        <td> $purpose </td>

                        ";
                                                $count++;
                                            }
                                        } else {
                                            echo "No Appointment History Found.";
                                        }
                                        ?></tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php include('footer.php'); ?>
    <script>
        $(document).ready(function() {
            // the "href" attribute of the modal trigger must specify the modal ID that wants to be triggered
            $(".modal").modal();

            $(".dropdown-trigger").dropdown({
                belowOrign: true,
                constrainWidth: false, // Does not change width of dropdown to that of the activator
            });
        });
    </script>
</body>

</html>