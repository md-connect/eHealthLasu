<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>eHealthLasu Home</title>
    <link rel="shortcut icon" type="image/x-icon" href="../assets/images/lasuplus.png">
    <link rel="stylesheet" href="assets/materialize/css/materialize.css" />
    <link rel="stylesheet" href="assets/iconfont/material-icons.css" />
    <link rel="stylesheet" href="assets/materialize/css/style.css" />
    <link rel="stylesheet" href="assets/MaterialDesign-Webfont-master/css/materialdesignicons.css">
    <link rel="stylesheet" href="assets/stepper/css/mstepper.min.css" />
    <link rel="stylesheet" href="assets/materialize/css/select2.css" />

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
        <!-- Dropdown Structure -->
        <ul id="drop" class="dropdown-content">
            <li><a href="management-team.php">MANAGEMENT TEAM</a></li>
            <li><a href="about-healthcentre.php">LASU HEALTH CENTRE</a></li>
            <li><a href="dhs-lasu.php">DIRECTOR OF HEALTH CENTRE</a></li>
        </ul>
        <ul id="drop1" class="dropdown-content">
            <li><a href="management-team.php">MANAGEMENT TEAM</a></li>
            <li><a href="about-healthcentre.php">LASU HEALTH CENTRE</a></li>
            <li><a href="dhs-lasu.php">DIRECTOR OF HEALTH CENTRE</a></li>
        </ul>
        <ul id="drop2" class="dropdown-content">
            <li><a href="about-doctor-unit.php">DOCTOR</a></li>
            <li><a href="about-lab-unit.php">LABORATORY</a></li>
            <li><a href="about-medica-record-unit.php">MEDICAL RECORD</a></li>
            <li><a href="about-nurse-unit.php">NURSE</a></li>
            <li><a href="about-pharmacy-unit.php">PHARMACY</a></li>
            <li><a href="about-x-ray-unit.php">X-RAY</a></li>
        </ul>
        <ul id="dropdown2" class="dropdown-content">
            <li><a href="about-doctor-unit.php">DOCTOR</a></li>
            <li><a href="about-lab-unit.php">LABORATORY</a></li>
            <li><a href="about-medica-record-unit.php">MEDICAL RECORD</a></li>
            <li><a href="about-nurse-unit.php">NURSE</a></li>
            <li><a href="about-pharmacy-unit.php">PHARMACY</a></li>
            <li><a href="about-x-ray-unit.php">X-RAY</a></li>
        </ul>


        <nav class="z-depth-0 blue" style="background-image:url('assets/images/page-header2.jpg');">
            <div class="nav-wrapper">
                <div class="container">
                    <a href="#" class="brand-logo">
                        <img src="assets/images/lasu.png" width="150" style="margin-top: 1.5px;;" class="img-responsive" alt="Image">
                    </a>
                    <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons right-on-med-and-down">menu</i></a>
                    <ul class="right hide-on-med-and-down">
                        <li class="active"><a href="index.php">HOME</a></li>
                        <li><a class="dropdown-button" href="#!" data-activates="drop2">UNITS<i class="material-icons right">arrow_drop_down</i></a></li>
                        <li><a href="appointment.php">APPOINTMENT BOOKING</a></li>
                        <li><a class="dropdown-button" href="#!" data-activates="drop">ABOUT US<i class="material-icons right">arrow_drop_down</i></a></li>
                        <li><a href="contact-us.php">CONTACT US</a></li>
                        <li><a class="modal-trigger" href="#modal1">LOGIN</a></li>
                        <li><a href="patient-registration.php">REGISTER</a></li>
                    </ul>
                </div>
                <ul class="side-nav" id="mobile-demo">
                    <li class="active"><a href="index.php">HOME</a></li>
                    <li><a class="dropdown-button" href="#!" data-activates="dropdown2">UNITS<i class="material-icons right">arrow_drop_down</i></a></li>
                    <li><a href="appointment.php">APPOINTMENT BOOKING</a></li>
                    <li><a class="dropdown-button" href="#!" data-activates="drop1">ABOUT US<i class="material-icons right">arrow_drop_down</i></a></li>
                    <li><a href="contact-us.php">CONTACT US</a></li>
                    <li><a class="modal-trigger" href="#modal1">LOGIN</a></li>
                    <li><a href="patient-registration.php">REGISTER</a></li>
                </ul>
            </div>
        </nav>
    </header>