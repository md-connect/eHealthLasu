

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
        <div class="card-body">
        <h1 class="card-title bg-warning">Database Connection Error</h1>
        <h2 class="card-title">Database Failure</h2>
        <p class="card-text"> Please Check Your Databse Connection</p>
        <a href="index.php" class="btn btn-primary">Back to Homepage</a>
        <hr>
        </div>
        ' . mysqli_connect_error());
  }
