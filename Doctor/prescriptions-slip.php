<?php
include("../security.php");
include("header.php");
include("../includes/dbconfig/dbconfig.php");
include("../other_func/timeago/timeago.php");
?>

<style>
    .modal {
        top: 30% !important;
        width: 30%;
    }

    .error {
        color: red;
    }

    @media print {
        .no-print {
            visibility: hidden;
        }
    }

    .mt-2 {
        margin-top: 5%;
    }

    .uppercase {
        text-transform: uppercase;
    }
</style>

<?php
$hospital_no = $_GET['hospital_no'];

$sql_query = mysqli_query($conn, "SELECT * FROM prescription WHERE hospital_no LIKE '$hospital_no' ORDER BY pat_id DESC LIMIT 1");
$row = mysqli_fetch_assoc($sql_query);
?>
<main>
    <div class="container mt-2 bordered">
        <div class="row">

            <div class="col s2 m2 l2">
                <img class="responsive-img" src="assets/images/lasu_logo.png" alt="" srcset="" height="60" width="60">
            </div>
            <div class="col s8 m8 l10 center">
                <h5>LAGOS STATE UNIVERSITY HEALTH CENTRE</h5>
                <p>KM 15, Badagry Expressway, Ojo, PMB 0001, LASU Post Office, Ojo, Lagos, Nigeria.</p>
                <h5 class="uppercase" style="font-family:arial-black">prescriptions slip</h5>

            </div>

            <div class="col s12">
                <div class="divider"></div>
            </div>

            <div class="col s12  center">
                <h6>Hospital No: <span class="bold"><?php echo $row['hospital_no']; ?></span></h5>
            </div>

            <div class="col s12 center">
                <h6>Name: <span class="bold"><?php echo $row['last_name'] . " " . $row['first_name'] . " " . $row['middle_name']; ?></span></h4>
            </div>

            <div class="col s12 center">
                <h6>Prescriptions: <span class="bold"><?php echo $row['prescriptions']; ?></span></h4>
            </div>
            <div class="col s12 center">
                <h6>Prescription Date: <span class="bold"><?php echo $row['prescription_date']; ?></span></h4>
            </div>
            <div class="col s12 center">
                <h6>Prescribed By: <span class="bold"><?php echo $row['prescription_by']; ?></span></h5>
            </div>


            <div class="col s12 mt-2">
                <div class="center">
                    <button onclick="window.print();" class="btn  black no-print">PRINT</button>

                </div>
            </div>
        </div>

    </div>

</main>


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