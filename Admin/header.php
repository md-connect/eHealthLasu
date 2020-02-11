<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>eHealthLasu | <?php echo $_SESSION['role']; ?></title>
    <link rel="shortcut icon" type="image/x-icon" href="../assets/images/lasuplus.png">
    <link rel="stylesheet" href="../assets/materialize/css/materialize.css" />
    <link rel="stylesheet" href="../assets/materialize/css/admin.css" />
    <link rel="stylesheet" href="../assets/iconfont/material-icons.css" />
    <link rel="stylesheet" href="../assets/stepper/css/mstepper.min.css" />
    <link rel="stylesheet" href="../assets/materialize/css/style.css" />
    <link rel="stylesheet" href="../assets/Mdi/css/materialdesignicons.css">
    <link rel="stylesheet" href="../assets/datatable/style.css" />
    <link rel="stylesheet" href="../assets/datatable/style.css" />
    <link rel="stylesheet" href="../assets/materialize/materialize.1.0.0.min.css" />
    <link rel="stylesheet" href="../assets/materialize/css/select2.css" />

    <!-- 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" /> -->
</head>

<body>
    <ul id="slide-out" class="side-nav fixed">
        <li>
            <div class="user-view">
                <div class="background blue darken-2">
                    <!--   <img src="../assets/images/page-header2.jpg" /> -->
                </div>
                <a href="#!user"><img class="circle" src="../passport/<?php echo $_SESSION['passport'] ?>"></a>
                <a href="#!name"><span class="white-text name"><?php echo $_SESSION['name']; ?></span></a>
            </div>
        </li>
        <li class="active"><a href="index.php"><i class="material-icons">dashboard</i>DASHBOARD</a></li>

        <li>
            <div class="divider"></div>
        </li>

        <li><a class="subheader">OPERATIONS</a></li>
        <li class="white">
            <ul class="collapsible collapsible-accordion">
                <li>
                    <a class="collapsible-header waves-effect waves-blue"><i class="material-icons">person_add</i>REGISTRATION
                        <i class="material-icons right" style="margin-right:0;">arrow_drop_down</i></a>
                    <div class="collapsible-body">
                        <ul>
                            <li> <a class="waves-effect uppercase" href="medicalstaff_registration.php"><i class="material-icons">person_add</i>Add
                                    Medical Staff</a></li>
                            <li> <a class="waves-effect uppercase" href="registerpatient.php"><i class="material-icons">person_add</i>Register
                                    Patient</a></li>
                            <li> <a class="waves-effect uppercase" href="dependant.php"><i class="material-icons">person_add</i>Add Staff Dependant</a></li>
                            <li>
                                <div class="divider"></div>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </li>
        <li>
            <a class="waves-effect uppercase" href="view_patient.php"><i class="material-icons">visibility</i>View
                Patient</a>
        </li>
        <li>
            <a class="waves-effect uppercase" href="allstaff.php"><i class="material-icons">view_list</i>View All Medical
                Staff</a>
        </li>

        <li>
            <a class="waves-effect uppercase" href="allpatients.php"><i class="material-icons">view_list</i>View All
                Patients</a>
        </li>

        <li>
            <div class="divider"></div>
        </li>

        <li class="white">
            <ul class="collapsible collapsible-accordion">
                <li>
                    <a class="collapsible-header waves-effect waves-blue"><i class="material-icons">filter_list</i>STATISTICS
                        <i class="material-icons right" style="margin-right:0;">arrow_drop_down</i></a>
                    <div class="collapsible-body">
                        <ul>
                            <li><a class="waves-effect waves-blue" href="../stats/patients_stats.php"><i class="material-icons">fullscreen</i>Patients Stats</a></li>
                            <li><a class="waves-effect waves-blue" href="diseases_stats.php"><i class="material-icons">swap_horiz</i>Monthly Disease Stats</a></li>
                            <li><a class="waves-effect waves-blue" href="morediseases_stats.php"><i class="material-icons">swap_horiz</i>Detailed Disease Stats</a></li>
                            <li>
                                <div class="divider"></div>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </li>
        <li>
            <div class="divider"></div>
        </li>
        <li><a class="waves-effect waves-blue uppercase" href="../changepassword.php?id=<?php echo $_SESSION['id']; ?>"><i class="material-icons">vpn_key</i>Change
                Password</a></li>
        <li><a class="waves-effect waves-blue uppercase" href="../logout.php"><i class="material-icons prefix">assignment_return</i>Log Out</a></li>
        <li>
            <div class="divider"></div>
    </ul>

    <header>
        <div class="navbar-fixed">
            <nav class="blue">
                <div class="nav-wrapper">
                    <div class="container">
                        <a href="#" data-activates="slide-out" class="button-collapse"><i class="material-icons">menu</i></a>

                        <a href="#" class="brand-logo">
                            <img src="../assets/images/lasu.png" width="150" style="margin-top: 1.5px;" class="img-responsive" alt="Image">
                        </a>

                    </div>
                </div>
            </nav>
        </div>
    </header>