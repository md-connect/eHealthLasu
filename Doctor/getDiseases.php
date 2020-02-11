<?php
session_start();
include("../includes/dbconfig/dbconfig.php");
if (!empty($_POST["category_id"])) {
    $query = "SELECT * FROM classification WHERE category_id = '" . $_POST["category_id"] . "'";

    $results = mysqli_query($conn, $query);
    echo '<option value="" disabled selected>Choose your option</option>';
    while ($row = mysqli_fetch_assoc($results)) {
        ?>

        <option value="<?php echo $row["code"]; ?>"><?php echo $row["descriptions"]; ?></option>

<?php
    }
}

?>