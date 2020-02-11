<?php
include("../security.php");
include("header.php");
include("../includes/dbconfig/dbconfig.php");
include("../other_func/timeago/timeago.php");


?>


<main>
    <?php
    if (isset($_POST['btn_viewmore'])) {

        $staff_id = $_POST['btn_id'];
        $result = mysqli_query($conn, "SELECT * FROM staff WHERE staff_id='$staff_id'");
        while ($row = mysqli_fetch_assoc($result)) {

            if ($row['passport'] == '') {
                $passport = 'No photo';
            } else {
                $passport = $row['passport'];
            }
            $staff_no = strtoupper($row['staff_no']);
            $user_name = strtoupper($row['user_name']);
            $first_name = strtoupper($row['first_name']);
            $middle_name = strtoupper($row['middle_name']);
            $last_name = strtoupper($row['last_name']);
            $dob = strtoupper($row['dob']);
            $cadre = strtoupper($row['s_role']);
            $gender = strtoupper($row['gender']);
            $phone = strtoupper($row['phone_no']);
            $email_add = strtoupper($row['email_add']);
            $reg_date = strtoupper($row['reg_date']);
            $reg_by = strtoupper($row['reg_by']);
            $date_updated = strtoupper($row['date_updated']);
        }
    } else {
        //$status = "<font style='color:red;'>Not right connection </font>";
    }
    ?>
    <div class="row  mt-2">
        <div class="col l9">
            <div class="col l12 divider"></div>
            <div class="col l12">
                <h6 class="bold center green-text">PERSONAL INFORMATION</h6>
            </div>
            <div class="col l4">
                <img src="../passport/<?php echo $passport; ?>" width="150" alt="">
            </div>

            <div class="col l4">
                <p>Staff No: <?php echo $staff_no; ?></p>
            </div>

            <div class="col l4">
                <p>Username: <?php echo $user_name; ?></p>
            </div>
            <div class="col l4">
                <p>First Name: <?php echo $first_name; ?></p>
            </div>

            <div class="col l4">
                <p>Middle Name: <?php echo $middle_name; ?></p>
            </div>
            <div class="col l4">
                <p>Last Name: <?php echo $last_name; ?></p>
            </div>

            <div class="col l4">
                <p>Cadre: <?php echo $cadre; ?></p>
            </div>
            <div class="col l4">
                <p>Gender: <?php echo $gender; ?></p>
            </div>

            <div class="col l4">
                <p>D.O.B: <?php echo $dob; ?></p>
            </div>
            <div class="col l4">
                <p>Phone No: <?php echo $phone; ?></p>
            </div>
            <div class="col l4">
                <p>Email: <?php echo $email_add; ?></p>
            </div>
            <div class="col l4">
                <p>Reg. Date: <?php echo $reg_date; ?></p>
            </div>
            <div class="col l4">
                <p>Reg. By: <?php echo $reg_by; ?></p>
            </div>

            <div class="col l4">
                <p>Date Updated: <?php echo $date_updated; ?></p>
            </div>
        </div>
    </div>

    <div id="modal1" class="modal modal-fixed-footer">
        <div class="modal-content">
            <h4 class="center">PATIENT ALLERGIES</h4>
            <div id="see_allergies"><?php echo $allergies;
                                    ?></div>
        </div>
        <div class="modal-footer">
            <a href="#!?hospital_no=<?php echo $hospital_no ?>" class="modal-action modal-close green darken-1 btn-flat ">OK</a>
        </div>
    </div>
    <div id="modal2" class="modal modal-fixed-footer">
        <div class="modal-content">
            <h4 class="center">PATIENT RECENT VITALS TAKEN</h4>
            <div id="see_last_vitals"><?php //echo $last_vitals; 
                                        ?></div>
            <div id="see_allergies"><?php echo $all_patient_vitals; ?></div>
        </div>
        <div class="modal-footer">
            <a href="#!?hospital_no=<?php echo $hospital_no ?>" class="modal-action modal-close green darken-1 btn-flat ">OK</a>
        </div>
    </div>
    <div id="modal3" class="modal modal-fixed-footer">
        <div class="modal-content">
            <h4 class="center">PATIENT RECENT LAB TEST TAKEN</h4>
            <div id="see_last_test"><?php //echo $last_lab_test; 
                                    ?></div>
            <div id="see_all_pat_test"><?php echo $all_patient_tests; ?></div>

        </div>
        <div class="modal-footer">
            <a href="#!?hospital_no=<?php echo $hospital_no ?>" class="modal-action modal-close green darken-1 btn-flat ">OK</a>
        </div>
    </div>
    <div id="modal4" class="modal modal-fixed-footer">
        <div class="modal-content">
            <h4 class="center">PATIENT RECENT PRESCRIPTIONS TAKEN</h4>
            <div id="see_last_presciption"><?php //echo $last_prescription; 
                                            ?></div>
            <div id="see_all_pat_presciptions"><?php echo $all_patient_prescriptions; ?></div>
        </div>
        <div class="modal-footer">
            <a href="#!?hospital_no=<?php echo $hospital_no ?>" class="modal-action modal-close green darken-1 btn-flat ">OK</a>
        </div>
    </div>
    <div id="modal5" class="modal modal-fixed-footer">
        <div class="modal-content">
            <h4 class="center">PATIENT'S LAST SCAN TAKEN</h4>
            <div id="see_last_scan"><?php //echo $last_scan; 
                                    ?></div>
            <div id="see_all_pat_scans"><?php echo $all_patient_scans; ?></div>
        </div>
        <div class="modal-footer">
            <a href="#!?hospital_no=<?php echo $hospital_no ?>" class="modal-action modal-close green darken-1 btn-flat ">OK</a>
        </div>
    </div>

</main>

<style>
    .sticky {
        position: sticky;
        position: -webkit-sticky;
        top: 0;
    }
</style>
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

<script>
    $(document).ready(function() {
        // the "href" attribute of the modal trigger must specify the modal ID that wants to be triggered
        // the "href" attribute of the modal trigger must specify the modal ID that wants to be triggered
        $(".modal").modal({
            dismissible: false, // Modal can be dismissed by clicking outside of the modal
            opacity: .5, // Opacity of modal background
            inDuration: 300, // Transition in duration
            outDuration: 200, // Transition out duration
            startingTop: '4%', // Starting top style attribute
            endingTop: '10%', // Ending top style attribute
        });
    });
</script>
</body>

</html>