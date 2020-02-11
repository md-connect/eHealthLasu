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
    <link href="../assets/materialize/css/materialize.min.css" rel="stylesheet" />
    <link href="../assets/materialize/css/select2.css" rel="stylesheet" />
    <link rel="../assets/materialize/css/style.css" />
</head>

<body>
    <ul id="slide-out" class="side-nav fixed no-print">
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

        <li>
            <div class="divider"></div>
        </li>

        <li><a class="subheader">OPERATIONS</a></li>

        <li>
            <a class="waves-effect uppercase" href="index.php"><i class="material-icons">healing</i>Prescribe Treatment</a>
        </li>
        <div class="divider"></div>
        </li>
        <li><a class="waves-effect waves-blue uppercase" href="../changepassword.php?id=<?php echo $_SESSION['id']; ?>"><i class="material-icons">vpn_key</i>Change
                Password</a></li>
        <li><a class="waves-effect waves-blue" href="../logout.php"><i class="material-icons prefix">assignment_return</i>LOG OUT</a></li>
        <li>
            <div class="divider"></div>
        </li>

    </ul>

    <header class="no-print">
        <nav class="blue">
            <div class="nav-wrapper">
                <div class="container">
                    <img src="../assets/images/lasu.png" width="150" style="margin-top: 5px;" class="img-responsive" alt="Image">
                    <a href="#" data-activates="slide-out" class="button-collapse"><i class="material-icons">menu</i></a>

                </div>
                <ul class="side-nav" id="mobile-demo">
                    <li><a href="sass.html">Sass</a></li>
                    <li><a href="badges.html">Components</a></li>
                    <li><a href="collapsible.html">Javascript</a></li>
                    <li><a href="mobile.html">Mobile</a></li>
                </ul>
            </div>
        </nav>
    </header>