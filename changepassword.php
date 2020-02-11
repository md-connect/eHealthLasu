<?php
//include('security.php');
include('includes/dbconfig/dbconfig.php');
$input_err = "";
$status = "";
function test_input($data)
{
  include("./includes/dbconfig.php");
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  $data = mysqli_real_escape_string($conn, $data);
  return $data;
}
$id = $_GET['id'];
if (isset($_POST['change-pwd'])) {
  if (empty($_POST["pwd"])) {
    $pwd = "";
    $input_err = "* This field is required";
  } else {
    $pwd = test_input($_POST['pwd']);
  }
  if (empty($_POST["npwd"])) {
    $npwd = "";
    $input_err = "* This field is required";
  } else {
    $npwd = test_input($_POST['npwd']);
  }
  if ($pwd == $npwd) {
    $pwd_hash = password_hash($pwd, PASSWORD_DEFAULT);

    $check1 = mysqli_query($conn, "SELECT * FROM staff WHERE staff_id='$id'");
    if (mysqli_num_rows($check1) == 1) {
      $sql = "UPDATE staff SET s_password='$pwd_hash' WHERE staff_id='$id'";
      if ($query = mysqli_query($conn, $sql)) {
?>
        <script>
          alert("Password reset was successful, please proceeed to login.");
          window.location.assign("index.php");
        </script>
        <?php
      } else {
        $status .= '<div class="alert alert-danger">
                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                  <strong>Password reset failed, please try again later.</strong>
          </div>';
      }
    } else {
      $check2 = mysqli_query($conn, "SELECT * FROM patient_record WHERE pat_id='$id'");
      if (mysqli_num_rows($check2) == 1) {
        $sql = "UPDATE patient_record SET pwd='$pwd_hash' WHERE pat_id='$id'";
        if ($query = mysqli_query($conn, $sql)) {
        ?>
          <script>
            alert("Password reset was successful, please proceeed to login.");
            window.location.assign("index.php");
          </script>
        <?php
        } else {
          $status .= '<div class="alert alert-danger">
                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                  <strong>Password reset failed, please try again later.</strong>
          </div>';
        }
      } else {
        ?>
        <script>
          alert("Password reset failed!");
          window.location.assign("index.php");
        </script>
<?php
      }
    }
  } else {
    $status .= '<div class="alert alert-danger">
                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                  <strong>Password does not match!</strong>
          </div>';
  }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <title>eHealthLasu | Change Password</title>
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
              <h5 class="uppercase bold center">Change Password</h5>
              <h6 class="center red-text"><?php echo $status ?></h6>

              <form action="" method="POST" class="row" id="forgotpwd_form">
                <div class="input-field col s12">
                  <input id="icon_prefix" type="text" name="pwd" class="validate" minlength="8" />
                  <label for="pwd">Enter New Password</label>
                </div>
                <div id="pwd_validate"></div>

                <div class="input-field col s12">
                  <input id="icon_prefix" type="text" name="npwd" class="validate" minlength="8" />
                  <label for="npwd">Re-enter New Password</label>
                </div>
                <div id="pwd_validate"></div>
                <div class="input-field col s12">
                  <button name="change-pwd" class="btn yellow darken-4 waves-effect waves-light block" type="submit">Change Password</button>
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
        selectYears: 15, // Creates a dropdown of 15 years to control year,
        format: 'yyyy-mm-dd',
        today: 'Today',
        clear: 'Clear',
        close: 'Ok',
        closeOnSelect: false // Close upon selecting a date,

      });
      $('.datepicker').on('mousedown', function(event) {
        event.preventDefault();
      });
      $('#forgotpwd_form').validate({
        rules: {
          identity: {
            minlength: 8,
            maxlength: 10,
            required: true
          },
          dob: {
            required: true,
            date: true,
            minlength: 10
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