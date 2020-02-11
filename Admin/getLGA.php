<?php
session_start();
include("../includes/dbconfig/dbconfig.php");
if (!empty($_POST["state_id"])) {
    $query = "SELECT * FROM lg_area WHERE state_id = '" . $_POST["state_id"] . "'";

    $results = mysqli_query($conn, $query);
    echo '<option value="" disabled selected>Choose your option</option>';
    while ($row = mysqli_fetch_assoc($results)) {
        ?>

        <option value="<?php echo $row["lg_name "]; ?>"><?php echo $row["lg_name "]; ?></option>

<?php
    }
}

?>