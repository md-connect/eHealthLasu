<?php
include('includes/dbconfig/dbconfig.php');
$status = "";

/* if (!empty($_GET['identity'])) {
    $identity = $_GET['identity'];
    $sql1 = "SELECT * FROM staff WHERE user_name='$username' AND s_password='$pwd'";
    if ($query = mysqli_query($conn, $sql) && (mysqli_num_rows($query) == 1)) { }
} */
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>eHealthLasu Password Recovery Page</title>
    <link rel="shortcut icon" type="image/x-icon" href="../assets/images/lasuplus.png">
    <link rel="stylesheet" href="assets/materialize/css/materialize.css" />
    <link rel="stylesheet" href="assets/iconfont/material-icons.css" />
    <link rel="stylesheet" href="assets/materialize/css/style.css" />
    <link rel="stylesheet" href="assets/MaterialDesign-Webfont-master/css/materialdesignicons.css">
    <style>
        .error {
            display: block;
            float: right;
            margin: 0 0 10px 10px;
            color: red;
            font-family: verdana, Helvetica;
        }
    </style>
</head>

<body>
    <header class="navbar-fixed">
        <nav class="z-depth-0 blue darken-4">
            <div class="nav-wrapper">
                <div class="container">
                    <a href="#" class="brand-logo">
                        <img src="assets/images/lasu.png" width="140" style="margin-top: 4.5px;" class="img-responsive" alt="Image">
                    </a>
                    <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons right-on-med-and-down">menu</i></a>
                    <ul class="right hide-on-med-and-down">
                        <li class="active"><a href="index.php">HOME</a></li>
                        <li><a href="login.php">APPOINTMENT BOOKING</a></li>
                        <li><a href="contact-us.php">CONTACT US</a></li>
                        <li><a href="login.php">LOGIN</a></li>

                    </ul>
                </div>
                <ul class="side-nav" id="mobile-demo">
                    <li><a href="index.php">HOME</a></li>
                    <li><a href="login.php">APPOINTMENT BOOKING</a></li>
                    <li><a href="contact-us.php">CONTACT US</a></li>
                    <li><a href="login.php">LOGIN</a></li>
                </ul>
            </div>
        </nav>
    </header>
    <main>
        <div class="container">
            <div class="row">
                <div class="col s12 m12 l6 offset-l3">
                    <div class="card mt-4">
                        <div class="card-content">
                            <h5 class="uppercase bold center">Password Recovery</h5>
                            <form action="" method="GET" class="row" id="forgotpwd_form">
                                <div class="input-field col s12">
                                    <input id="icon_prefix" type="text" name="identity" class="validate" />
                                    <label for="identity">Hospital No/Matric No/Staff No</label>
                                </div>
                                <div id="identity_validate"></div>
                                <div class="input-field col s12">
                                    <input id="icon_prefix" type="text" name="dob" class="datepicker validate" />
                                    <label for="dob">Date of Birth</label>
                                </div>
                                <div id="dob_validate"></div>
                                <h6 class="center red-text"><?php echo $status ?></h6>
                                <div class="input-field col s12">
                                    <button name="forgot_pwd" class="btn yellow darken-4 waves-effect waves-light block" type="submit">Reset Password</button>
                                </div>

                                <div class="input-field col s12">
                                    <a href="login.php" class="btn blue darken-4 waves-effect-wavess-light block">Back to Login</a>
                                </div>
                            </form>
                        </div>
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
                selectYears: 105, // Creates a dropdown of 15 years to control year,
                format: 'yyyy-mm-dd',
                today: 'Today',
                clear: 'Clear',
                close: 'Ok',
                max: true,
                closeOnSelect: false // Close upon selecting a date,

            });
            $('.datepicker').on('mousedown', function(event) {
                event.preventDefault();
            });
            $('#forgotpwd_form').validate({
                rules: {
                    identity: {
                        minlength: 4,
                        maxlength: 15,
                        required: true
                    },
                    dob: {
                        required: true,
                        date: true,
                        minlength: 8
                    }

                },
                errorPlacement: function(error, element) {
                    var name = $(element).attr("name");
                    error.appendTo($("#" + name + "_validate"));
                },

            });
        });
    </script>
</body>

</html>