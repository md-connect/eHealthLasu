<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>eHealthLasu | <?php echo $_SESSION['role']; ?></title>
    <link rel="stylesheet" href="../assets/materialize/css/materialize.css" />
    <link rel="stylesheet" href="../assets/materialize/css/admin.css" />
    <link rel="stylesheet" href="../assets/iconfont/material-icons.css" />
    <link rel="stylesheet" href="../assets/stepper/css/mstepper.min.css" />
</head>

<body>
    <a id="slide-out" class="side-nav fixed">
        <li>
            <div class="user-view">
                <div class="background blue darken-2">
                    <!-- <img src="images/office.jpg" /> -->
                </div>
                <a href="#!user"><?php echo '<img class="circle" src="data:image/jpeg;base64,' . base64_encode($_SESSION['passport']) . '">' ?></a>
                <a href="#!name"><span class="white-text name"><?php echo $_SESSION['name']; ?></span></a>
            </div>
        </li>
        <li class="active">
            <a class="waves-effect uppercase" href="index.php">Dashboard</a>
        </li>

        <li>
            <div class="divider"></div>
        </li>


        <li><a class="subheader">OPERATIONS</a></li>
        <li>
            <a class="waves-effect uppercase" href="registerstaff.php">Register Staff</a>
        </li>
        <li>
            <a class="waves-effect uppercase" href="records.php">All Records</a>
        </li>

        <li>
            <div class="divider"></div>
        </li>


        <li>
            <a class="waves-effect uppercase" href="changepassword.php">Change Password</a>
        </li>

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

                        <a href="#" class="brand-logo">Logo</a>
                    </div>
                </div>
            </nav>
        </header>