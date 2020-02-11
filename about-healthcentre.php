<?php
include("header.php");
?>

<main>
    <div class="container">
        <!-- Modal Structure -->
        <div id="modal1" class="modal">
            <div class="modal-content">
                <div class="center">
                    <h4>User Login</h4>
                </div>

                <div class="container">
                    <form action="login.php" method="POST" class="row" id="loginform">
                        <div class="input-field col s12">
                            <i class="material-icons prefix">account_box</i>
                            <input id="username" type="text" name="username" class="validate" />
                            <label for="username">Username</label>
                        </div>
                        <div class="center" id="username_validate"></div>

                        <div class="input-field col s12">
                            <i class="material-icons prefix">lock</i>
                            <input id="pwd" type="password" name="pwd" class="validate" />
                            <label for="pwd">Password</label>
                        </div>
                        <div class="center" id="pwd_validate"></div>
                        <div class="input-field col s12">
                            <button name="login" class="btn blue darken-4 waves-effect waves-light block" type="submit">login</button>
                        </div>

                        <div class="input-field col s12">
                            <a href="forgotpassword.php" class="btn red darken-4 waves-effect-wavess-light block">forgot pasword</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="" style="margin-bottom: 2%;">
            <h3 class="uppercase center">about lasu health centre</h3>
            <div class="divider"></div>
        </div>
        <br />

        <div class="container">
            <div class="card-panel">
                <div class="row">
                    <div class="col s12 m12 l6">
                        <h6>The University Health Services Department headed by the Director, Health Services caters for the health needs of the University Community which includes Undergraduate and Postgraduate Students. It provides Curative and Preventive Services. The services provided include:</h6>

                        <span>a. Daily Consultations and Management of Emergency cases.</span><br />
                        <span>b. Annual Medical Examination for all new students and new employees.</span><br />
                        <span>c. Child Welfare Clinics (Immunization – E.P.I. programme).</span><br />
                        <span>d. Family Planning Clinics.</span><br />
                        <span>e. X-Ray Services</span><br />
                        <span>f. Medical Laboratory Services </span><br />
                        <span>g. Ante-Natal Clinics</span><br />
                        <span>h. HV/AIDS Counselling</span><br />
                        <span>i. Environmental Sanitation</span><br />
                        <span>j. Inoculation for purposes of International Travels.</span><br />
                        <span>k. The Health Centre in Ojo Campus is recognized by the World Health Organization as an Approved Vaccination Centre.</span><br />
                    </div>

                    <div class="col s12 m12 l6">
                        <h5 class="uppercase center">Out-Patient Clinics</h5>
                        <table class="bordered responsive">
                            <thead>
                                <tr class="center">
                                    <th class="center">S/N</th>
                                    <th class="center">CLINIC TYPE</th>
                                    <th class="center">CONSULTATION HOURS</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr>
                                    <td>1.</td>
                                    <td>Emergencies </td>
                                    <td>24 hours daily</td>
                                </tr>
                                <tr>
                                    <td>2.</td>
                                    <td>Medical Screening for new undergraduate and new Postgraduate students; all new staff members including Contract staffers
                                    </td>
                                    <td>8:00am - 2:00pm</td>
                                </tr>
                                <tr>
                                    <td>3.</td>
                                    <td>Annual Medical Checkup for all students and all staff members could be done one week before the next birthday of each student/staff member at the University Health Centre</td>
                                    <td>8:00am - 2:00pm</td>
                                </tr>
                                <tr>
                                    <td>4.</td>
                                    <td>Child Welfare (E.P.I Programme) - 1st Wednesday of Every Month </td>
                                    <td>8:00am - 2:00pm</td>
                                </tr>
                                <tr>
                                    <td>5.</td>
                                    <td>Ante-Natal Clinic - Every Thursday </td>
                                    <td>8:00am - 2:00pm</td>
                                </tr>
                                <tr>
                                    <td>6.</td>
                                    <td>Family Planning Clinic - Every Thursday </td>
                                    <td>8:00am - 2:00pm</td>
                                </tr>
                                <tr>
                                    <td>7.</td>
                                    <td>X-ray Services (Monday to Friday) </td>
                                    <td>8:00am - 2:00pm</td>
                                </tr>
                                <tr>
                                    <td>8.</td>
                                    <td>Medical Laboratory Services </td>
                                    <td>24 hours daily</td>
                                </tr>
                                <tr>
                                    <td>9.</td>
                                    <td>The normal Consulting days are Monday through Friday </td>
                                    <td>8:00am - 4:00pm</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</main>
<?php include('footer.php'); ?>

<script>
    $(document).ready(function() {
        $(".dropdown-button").dropdown({
            belowOrigin: true, // Displays dropdown below the button
        });
        // the "href" attribute of the modal trigger must specify the modal ID that wants to be triggered
        $(".modal").modal();

    });
</script>
</body>

</table>