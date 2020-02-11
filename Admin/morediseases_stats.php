<?php
include("../security.php");
include("header.php");
include("../includes/dbconfig/dbconfig.php");


?>
<main>
    <div class="row mt-4" id="detailedstats">
        <div class="col s12">
            <div class="row">
                <div id="admin" class="col s12">
                    <div class="card material-table">
                        <div class="table-header">
                            <span class="table-title">TREATMENT TABLE</span>
                            <div class="actions">
                                <a href="#" class="search-toggle  btn-flat nopadding"><i class="material-icons">search</i></a>
                            </div>
                        </div>
                        <table class="centered" id="datatable">
                            <thead>
                                <tr>
                                    <th>S/N</th>
                                    <th>CODE</th>
                                    <th>DISEASES</th>
                                    <th>CARD NO</th>
                                    <th>FULL NAME</th>
                                    <th>ADDRESS</th>
                                    <th>PHONE NO</th>
                                    <th>PATIENT TYPE</th>
                                    <th>DATE</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                /*  if ($db_config) { */

                                $query_user1 = "SELECT * FROM disease_stats";
                                $results = mysqli_query($conn, $query_user1);
                                $count = 1;
                                /*  if (mysqli_num_rows($results) > 0) { */
                                while ($user = mysqli_fetch_assoc($results)) {
                                    $card_no = $user["card_no"];
                                    $query_user1details = "SELECT * FROM patient_record WHERE hospital_no='$card_no'";
                                    $result = mysqli_query($conn, $query_user1details);
                                    while ($patientdetails = mysqli_fetch_assoc($result)) {
                                        $fullname = strtoupper($patientdetails['last_name'] . " " . $patientdetails['first_name'] . " " . $patientdetails['middle_name']);
                                        $address = $patientdetails['address'];
                                        $phone = $patientdetails['phone'];

                                        ?>
                                        <tr>
                                            <td><?php echo $count; ?></td>
                                            <td><?php echo $user["code"]; ?></td>
                                            <td><?php echo $user["descriptions"]; ?></td>
                                            <td><?php echo $user["card_no"]; ?></td>
                                            <td><?php echo $fullname; ?></td>
                                            <td><?php echo $address; ?></td>
                                            <td><?php echo $phone; ?></td>
                                            <td><?php echo $user["pat_type"]; ?></td>
                                            <td><?php echo $user["diagnosis_date"]; ?></td>

                                    <?php

                                        }
                                        $count++;
                                    }
                                    //}
                                    //}
                                    ?>

                                        </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</main>


<script src="../assets/materialize/jquery.min.js"></script>
<script src="../assets/datatable/jquery.dataTables.min.js"></script>
<script src="../assets/materialize/js/materialize.min.js"></script>
<script src="../assets/datatable/buttons.html5.min.js"></script>
<script src="../assets/datatable/buttons.print.min.js"></script>
<script src="../assets/datatable/dataTables.buttons.min.js"></script>
<script src="../assets/datatable/jszip.min.js"></script>
<script src="../assets/materialize/js/materialize.js"></script>
<script src="../assets/materialize/js/script.js"></script>
<script src="../assets/datatable/script.js"></script>


</body>

</html>