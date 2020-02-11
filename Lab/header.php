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
</head>

<body>
    <ul id="slide-out" class="side-nav fixed">
        <li>
            <div class="user-view">
                <div class="background blue darken-2">
                    <!-- <img src="images/office.jpg" /> -->
                </div>
                <a href="#!user"><img class="circle" src="../passport/<?php echo $_SESSION['passport'] ?>"></a>
                <a href="#!name"><span class="white-text name"><?php echo $_SESSION['name']; ?></span></a>
            </div>
        </li>
        <li class="active"><a href="index.php"><i class="material-icons">dashboard</i>DASHBOARD</a></li>
        <li class="active">
            <a class="waves-effect uppercase" href="index.php">Laboratory Test</a>
        </li>
        <li>
            <a class="waves-effect uppercase" href="allpatients_tests.php">Operations</a>
        </li>


        <li>
            <div class="divider"></div>
        </li>


        <li><a class="waves-effect waves-blue uppercase" href="../changepassword.php?id=<?php echo $_SESSION['id']; ?>"><i class="material-icons">vpn_key</i>Change
                Password</a></li>

        <li>
            <div class="divider"></div>
        </li>
        <li>
            <a class="waves-effect uppercase" href="../logout.php"><i class="material-icons prefix">assignment_return</i>Log Out</a>
        </li>
    </ul>
    <header>
        <nav class="blue">
            <div class="nav-wrapper">
                <div class="container">
                    <a href="#" data-activates="slide-out" class="button-collapse"><i class="material-icons">menu</i></a>
                    <a href="#" class="brand-logo center">
                        <img src="../assets/images/lasu.png" width="150" style="margin-top: 1.5px;" class="img-responsive" alt="Image">
                    </a>
                </div>
            </div>
        </nav>
    </header>