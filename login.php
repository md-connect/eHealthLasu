<?php session_start();
$_SESSION['errmsg'] = "";
require('includes/dbconfig/dbconfig.php');
if (isset($_POST['login'])) {
  $username = $_POST['username'];
  $pwd = md5($_POST['pwd']);
  $query_user1 = "SELECT * FROM staff WHERE user_name='$username'  AND s_password='$pwd'";

  if (($query = mysqli_query($conn, $query_user1)) && (mysqli_num_rows($query) == 1)) {
    $results = mysqli_query($conn, $query_user1);
    $userType = mysqli_fetch_array($results);
    $_SESSION['auth'] = true;
    $_SESSION['id'] = $userType['staff_id'];
    $_SESSION['name'] = $userType['first_name'] . " " . $userType['last_name'];
    $_SESSION['username'] = $userType['user_name'];
    $_SESSION['pwd'] = $userType['s_password'];
    $_SESSION['passport'] = $userType['passport'];
    $_SESSION['role'] = $userType['s_role'];
    //echo $_SESSION['passport'];
    if ($_SESSION['role'] == "admin") {
      header("Location: Admin/index.php");
    } else if ($_SESSION['role'] == "doctor") {
      header("Location: Doctor/index.php");
    } else if ($_SESSION['role'] == "nurse") {
      header("Location: Nurse/index.php");
    } else if ($_SESSION['role'] == "lab_scientist") {
      header("Location: Lab/index.php");
    } else if ($_SESSION['role'] == "nurse") {
      header("Location: Nurse/index.php");
    } else if ($_SESSION['role'] == "super_admin") {
      header("Location: SuperAdmin/index.php");
    } else if ($_SESSION['role'] == "xray_specialist") {
      header("Location: Xray/index.php");
    } else if ($_SESSION['role'] == "pharmacist") {
      header("Location: Pharmacist/index.php");
    } else if ($_SESSION['role'] == "patient") {
      header("Location: patient/index.php");
    }
  } else {

    $query_user2 = "SELECT * FROM patient_record WHERE (identity='$username' OR hospital_no='$username') AND pwd='$pwd'";
    if (($query = mysqli_query($conn, $query_user2)) && (mysqli_num_rows($query) == 1)) {
      $userType2 = mysqli_fetch_assoc($query);
      $_SESSION['auth'] = true;
      $_SESSION['pat_id'] = $userType2['pat_id'];
      $_SESSION['hospital_no'] = $userType2['hospital_no'];
      $_SESSION['fname'] = $userType2['first_name'];
      $_SESSION['lame'] = $userType2['last_name'];
      $_SESSION['name'] = $userType2['first_name'] . " " . $userType2['last_name'];
      $_SESSION['username'] = $userType2['identity'];
      $_SESSION['pwd'] = $userType2['pwd'];
      $_SESSION['passport'] = $userType2['passport'];
      $_SESSION['role'] = 'PATIENT';
      header("Location: patient-index.php");
    } else {
      $_SESSION['errmsg'] = "Invalid username and password combination!";
    }
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <title>eHealthLasu | Login Page</title>
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
    <nav class="z-depth-0 blue" style="background-image:url('assets/images/page-header2.jpg');">
      <div class="nav-wrapper">
        <div class="container"><a href="#" class="brand-logo"><img src="assets/images/lasu.png" width="140" style="margin-top: 1.5px;" class="img-responsive" alt="Image"></a><a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons right-on-med-and-down">menu</i></a>
          <ul class="right hide-on-med-and-down">
            <li class="active"><a href="index.php">HOME</a></li>
            <li><a href="login.php">APPOINTMENT BOOKING</a></li>
            <li><a href="contactus.php">CONTACT US</a></li>

          </ul>
        </div>
        <ul class="side-nav" id="mobile-demo">
          <li class="active"><a href="index.php">HOME</a></li>
          <li><a href="login.php">APPOINTMENT BOOKING</a></li>
          <li><a href="contactus.php">CONTACT US</a></li>

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
              <h5 class="capitalize bold center">login here</h5>
              <h6 class="center red-text"><?php echo $_SESSION['errmsg']; ?></h6>
              <form action="login.php" method="POST" class="row" id="loginform">
                <div class="input-field col s12"><i class="material-icons prefix">account_box</i>
                  <input id="username" type="text" class="validate" name="username" maxlength="15" />
                  <label for="username">Username</label>
                </div>
                <div id="username_validate"></div>
                <div class="input-field col s12"><i class="material-icons prefix">lock</i><input id="pwd" type="text" class="validate" name="pwd" /><label for="pwd">Password</label></div>
                <div id="pwd_validate"></div>
                <div class="input-field col s12">
                  <div class="divider"></div>
                </div>
                <div class="input-field col s12 m6 l6">
                  <p><a href="forgotpassword.php" type="button" style="color:red">FORGOT PASSOWRD?</a></p>
                </div>
                <div class="input-field col s12 m6 l6"><button type="submit" name="login" class="btn blue block  darken-4 waves-effect waves-light">login </button></div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main><?php include('footer.php'); ?>
  <script>
    $(function() {
      $('#loginform').validate({
        rules: {
          username: {
            minlength: 2,
            maxlength: 12,
            required: true
          },
          pwd: {
            required: true,
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