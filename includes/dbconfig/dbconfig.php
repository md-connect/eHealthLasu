

  <?php
  $servername = "localhost";
  $db_username = "root";
  $db_password = "";
  $db_name = "emr_db";

  $conn = mysqli_connect($servername, $db_username, $db_password);
  $db_config = mysqli_select_db($conn, $db_name);
  if ($db_config) {
    //echo "Database connection successful";
  } else {
    die('
        <div class="center"> 
    <h4>>Database Connection Error</h4>
    <h6>Please Check Your Databse Connection</h6>
    <a href="index.php" class="btn btn-primary">Back to Homepage</a>
  </div>
        ' . mysqli_connect_error());
  }


  // <div class="center"> 
  //   <h4>>Database Connection Error</h4>
  //   <h6>Please Check Your Databse Connection</h6>
  //   <a href="index.php" class="btn btn-primary">Back to Homepage</a>
  // </div>