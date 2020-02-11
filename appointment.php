<?php session_start();
if ($_SESSION['role'] != "PATIENT") {
  header('Location: login.php');
}
//include("security.php");
include("includes/dbconfig/dbconfig.php");

$input_err = "";
$status = "";
$emailErr = "";
function test_input($data)
{
  include("includes/dbconfig/dbconfig.php");
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  $data = mysqli_real_escape_string($conn, $data);
  return $data;
}

if (isset($_POST['book_appointment'])) {
  if (empty($_POST["appointment_date"])) {
    $input_err = "* This field is required";
  } else {
    $appointment_date = test_input($_POST['appointment_date']);
  }
  if (empty($_POST["appointment_time"])) {
    $input_err = "* This field is required";
  } else {
    $appointment_time = test_input($_POST['appointment_time']);
  }
  if (empty($_POST["appointment_priority"])) {
    $input_err = "* This field is required";
  } else {
    $appointment_priority = test_input($_POST['appointment_priority']);
  }
  if (empty($_POST["currently_on_medication"])) {
    $input_err = "* This field is required";
  } else {
    $currently_on_medication = test_input($_POST['currently_on_medication']);
  }
  if (empty($_POST["purpose_of_appointment"])) {
    $input_err = "* This field is required";
  } else {
    $purpose_of_appointment = test_input($_POST['purpose_of_appointment']);
  }
  $appointment_id = (mt_rand(1124, 92992100));
  $patient_name = $_SESSION['name'];
  $patient_id = $_SESSION['hospital_no'];

  $query_appt = "INSERT INTO appointment (appointment_id, patient_id, patient_name, appointment_date, appointment_time, purpose_of_appointment, 
                              priority, currently_on_medication)
                  VALUES('$appointment_id', '$patient_id', '$patient_name', '$appointment_date', '$appointment_time', '$purpose_of_appointment',
                        '$appointment_priority', '$currently_on_medication')";
  $query_appt_run = mysqli_query($conn, $query_appt) or die(mysqli_error($conn));

  if ($query_appt_run) {
?>
    <script>
      alert("Appointment has been booked successfully. Kindly print your appointment slip.");
      window.location.assign("appointment-slip.php");
    </script>
  <?php
  } else {
  ?>
    <script>
      alert("Error has occured! kindly re-apply for the appointment.");
      window.location.assign("patient-index.php");
    </script>
<?php
  }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <title>eHealthLasu Appointment Page</title>
  <link rel="stylesheet" href="assets/materialize/css/materialize.css" />
  <link rel="stylesheet" href="assets/iconfont/material-icons.css" />
  <link rel="stylesheet" href="assets/materialize/css/style.css" />
  <link rel="stylesheet" href="assets/MaterialDesign-Webfont-master/css/materialdesignicons.css">
  <style>
    .modal {
      top: 30% !important;
      width: 30%;
    }

    .error {
      color: red;
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
            <li class="active"><a href="patient-user.php">HOME</a></li>
            <li><a href="logout.php">LOGOUT</a></li>
            <li>
              <a class='dropdown-button' href='#' data-activates='dropdown1'>
                <img class="circle mt-4" width="50" height="45" src="passport/<?php echo $_SESSION['passport']; ?>" alt="">
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
          <li class="active"><a href="patient-user.php">HOME</a></li>
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
        <div class="col s12 m12 l8 offset-l2">
          <div class="card-panel">
            <div class="center">
              <h5>BOOK YOUR APPOINTMENT HERE</h5>
            </div>
            <form method="POST" class="row">
              <div class="input-field col s6">
                <input name="hospitalNumber" type="text" disabled />
                <label for="hospitalNumber">Hospital Number: <?php echo $_SESSION['hospital_no']; ?></label>
              </div>
              <div class="input-field col s6">
                <input name="name" type="text" disabled />
                <label for="name">Full Name: <?php echo $_SESSION['name']; ?></label>
              </div>

              <div class="col s12 m12 l6 input-field">
                <input name="appointment_date" type="text" placeholder="Pick A Date" required="required" />
                <span class="error"> <?php echo $input_err; ?></span>
              </div>
              <div class="input-field col s6">
                <select name="appointment_time" required="required">
                  <option value="" disabled selected>Choose your option</option>
                  <option value="8:00am - 8:15am">8:00am - 8:15am</option>
                  <option value="8:15am - 8:30am">8:15am - 8:30am</option>
                  <option value="8:30am - 8:45am">8:30am - 8:45am</option>
                  <option value="8:45am - 9:00am">8:45am - 9:00am</option>
                  <option value="9:00am - 9:15am">9:00am - 9:15am</option>
                  <option value="9:15am - 9:30am">9:15am - 9:30am</option>
                  <option value="9:30am - 9:45am">9:30am - 9:45am</option>
                  <option value="9:45am - 10:00am">9:45am - 10:00am</option>
                  <option value="10:00am - 10:15am">10:00am - 10:15am</option>
                  <option value="10:15am - 10:30am">10:15am - 10:30am</option>
                  <option value="10:30am - 10:45am">10:30am - 10:45am</option>
                  <option value="10:45am - 11:00am">10:45am - 11:00am</option>
                  <option value="11:00am - 11:15am">11:00am - 11:15am</option>
                  <option value="11:15am - 11:30am">11:15am - 11:30am</option>
                  <option value="11:30am - 11:45am">11:30am - 11:45am</option>
                  <option value="11:45am - 12:00pm">11:45am - 12:00pm</option>
                  <option value="12:00pm - 12:15pm">12:00pm - 12:15pm</option>
                  <option value="12:15pm - 12:30pm">12:15pm - 12:30pm</option>
                  <option value="12:30pm - 12:45pm">12:30pm - 12:45pm</option>
                  <option value="12:45pm - 1:00pm">12:45pm - 1:00pm</option>
                  <option value="1:00pm - 1:15pm">1:00pm - 1:15pm</option>
                  <option value="1:15pm - 1:30pm">1:15pm - 1:30pm</option>
                  <option value="1:30pm - 1:45pm">1:30pm - 1:45pm</option>
                  <option value="1:45pm - 2:00pm">1:45pm - 2:00pm</option>
                </select>
                <label>Appointment Time</label>
                <span class="error"> <?php echo $input_err; ?></span>
              </div>
              <div class="input-field col s6">
                <select name="appointment_priority" required="required">
                  <option value="" disabled selected>Choose your option</option>
                  <option value="High">High</option>
                  <option value="Normal">Normal</option>
                  <option value="Low">Low</option>
                </select>
                <label>Priority</label>
                <span class="error"> <?php echo $input_err; ?></span>
              </div>
              <div class="input-field col s6">
                <select name="currently_on_medication" required="required">
                  <option value="" disabled selected>Choose your option</option>
                  <option value="Yes">Yes</option>
                  <option value="No">No</option>
                </select>
                <label>Are You Currently On Any Medication?</label>
                <span class="error"> <?php echo $input_err; ?></span>
              </div>

              <div class="input-field col s12">
                <textarea name="purpose_of_appointment" id="textarea1" class="materialize-textarea" required="required"></textarea>
                <label for="textarea1">Purpose of Appointment</label>
                <span class="error"> <?php echo $input_err; ?></span>
              </div>
              <div class="input-field col s12">
                <a class="btn blue block darken-4 modal-trigger" href="#modal1">
                  book appointment
                </a>
              </div>

              <!-- Modal Structure -->
              <div id="modal1" class="modal">
                <div class="modal-content center">
                  <h4 class="blue-text ">Confirmation!</h4>
                  <h5 class="center">Are you sure you want to submit?</h5>

                </div>
                <div class="modal-footer">
                  <button type="submit" name="book_appointment" class="btn flat blue darken-4">Yes</button>
                  <a href="#!" class="btn modal-action modal-close flat red">No</a>

                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>




  </main>
  <?php include('footer.php'); ?>

  <script>
    $(document).ready(function() {
      // the "href" attribute of the modal trigger must specify the modal ID that wants to be triggered
      $('.modal').modal({
        dismissible: false,
        inDuration: 50, // Transition in duration
        outDuration: 0, // Transition out duration

      });


      $('.datepicker').pickadate({
        selectMonths: true, // Creates a dropdown to control month
        selectYears: 15, // Creates a dropdown of 15 years to control year,
        format: 'yyyy/mm/dd',
        today: 'Today',
        clear: 'Clear',
        close: 'Ok',
        min: true,
        closeOnSelect: false // Close upon selecting a date,

      });
      $('.datepicker').on('mousedown', function(event) {
        event.preventDefault();
      });

      $(".dropdown-button").dropdown({
        belowOrign: true,
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