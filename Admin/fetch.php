<?php
session_start();
include('../includes/dbconfig/dbconfig.php');

if (isset($_POST["from_date"], $_POST["to_date"])) {
    $query = "SELECT id, code,descriptions,
COUNT(*) AS total,
COUNT(CASE WHEN pat_type='STUDENT' THEN 1 END) AS totalstd,
COUNT(CASE WHEN pat_type='STAFF' THEN 1 END) AS totalstff,
COUNT(CASE WHEN pat_type='DEPENDANT' THEN 1 END) AS totaldepdnt
          FROM disease_stats WHERE diagnosis_date BETWEEN '" . $_POST["from_date"] . "' AND '" . $_POST["to_date"] . "' GROUP BY code";
    $result = mysqli_query($conn, $query);

    //$query1 = "SELECT * FROM disease_stats GROUP BY code";
    //$query_run = mysqli_query($conn, $query1);
    ?>
    
    <div class="table-header">
        <span style="font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif" class="table-title">DISEASES TREATED FROM <?php echo $_POST["from_date"]; ?> TO <?php echo $_POST["to_date"]; ?></span>
    </div>
    <table class="centered" id="datatable">
        <thead>
            <tr>
                <th>S/N</th>
                <th>CODE</th>
                <th>DIAGNOSIS</th>
                <th>STUDENT</th>
                <th>STAFF</th>
                <th>DEPENDENT</th>
                <th>TOTAL</th>
            </tr>
        </thead>
        <tbody>
            <?php
                while ($row = mysqli_fetch_assoc($result)) {
                    $total = $row['total'];
                    $totalstd = $row['totalstd'];
                    $totalstff = $row['totalstff'];
                    $totaldepdnt = $row['totaldepdnt'];
                    //while ($row1 = mysqli_fetch_assoc($query_run)) {

                    ?>
                <tr>
                    <td><?php echo $row["id"]; ?></td>
                    <td><?php echo $row["code"]; ?></td>
                    <td><?php echo $row["descriptions"]; ?></td>
                    <td><?php echo $totalstd; ?></td>
                    <td><?php echo $totalstff; ?></td>
                    <td><?php echo $totaldepdnt; ?></td>
                    <td><?php echo $total; ?></td>
                <?php
                        //}
                    }
                    ?>

                </tr>
            <?php
            }
            ?>