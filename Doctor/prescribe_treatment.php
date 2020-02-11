<?php
include("../security.php");
include("header.php");
include("../includes/dbconfig/dbconfig.php");
include("../other_func/timeago/timeago.php");

$pet_date = date('Y-m-d');
$pat_id = $_GET['pat_id'];
$prescription_date = date("Y-m-d h:i:sa");
$prescription_by = $_SESSION['name'];
$timeago = "";
$timeagoUpd = "";
$counter = 0;
$rest = "";
$allergies = "";
$last_vitals = "";
$last_lab_test = "";
$last_prescription = "";
$last_scan = "";
$all_patient_vitals = "";
$all_patient_tests = "";
$all_patient_prescriptions = "";
$all_patient_scans = "";
//$pat1 = $_POST['pat_id1'];
$result_query = mysqli_query($conn, "SELECT * FROM patient_record WHERE pat_id = '$pat_id'");
$row = mysqli_fetch_Assoc($result_query);
$hospital_no = $row['hospital_no'];
$identity = $row['identity'];
$first_name = $row['first_name'];
if ($conn) {
  $result = mysqli_query($conn, "SELECT * FROM patient_record WHERE pat_id = '$pat_id'");
  while ($row = mysqli_fetch_Assoc($result)) {
    $hospital_no = $row["hospital_no"];
    $identity = strtoupper($row["identity"]);
    $fname = strtoupper($row["first_name"]);
    $mname = strtoupper($row["middle_name"]);
    $lname = strtoupper($row["last_name"]);
    $passport = $row['passport'];
    $gender = strtoupper($row['gender']);
    //$gender = $row["gender"];
    $pat_type = $row["patient_type"];

    $fullname = "$lname $fname $mname";
    $full = strtoupper($fullname);

    if (isset($_POST['submit'])) {
      $complaints = $_POST['complaints'];
      $observation = $_POST['observation'];
      //$diagnosis = $_POST['diagnosis'];
      $prescriptions = $_POST['prescriptions'];
      $test = strtoupper($_POST['testOption']);
      if ($test == "YES") {
        $testType = $_POST['testType'];
      } elseif ($test == "NO") {
        $testType = "NIL";
      }
      $text = $_POST["make_text"];
      $list = explode("=>", $text);
      foreach ($list as $ds) {
        $ba = explode("=>", $ds);
        foreach ($ba as $ind) {
          $foo = explode(":", $ind);
          /* echo "Code = " . $foo[0] . "<br>";
          echo "Name = " . $foo[1] . "<br>";
          echo "-----------------------------------------<br>"; */
          $code = $foo[0];
          $descriptions = $foo[1];
          $h[] = $foo[1];
          //$k = implode($h);

          $query_disease = "INSERT INTO disease_stats(card_no, pat_type, gender, code, descriptions, diagnosis_date)
							VALUES('$hospital_no', '$pat_type', '$gender', '$code', '$descriptions', '$pet_date')";
          $result_disease = mysqli_query($conn, $query_disease) or die(mysqli_error($conn));
          if ($result_disease) {
?>
            <script>
              alert("Details have been inserted successfully! Click OK to continue");
            </script> <?php
                      header("location: prescriptions-slip.php?hospital_no=$hospital_no");
                    } else {
                      ?>
            <script>
              alert("Details could not be updated into Disease_stats! Click OK to retry");
            </script> <?php
                      header("location: prescriptions-slip.php?hospital_no=$hospital_no");
                    }
                  }
                }
                /* print_r($h);
              echo "<br>"; */
                if (count($h) == 1) {
                  $rest .= $h[0];
                } else {
                  for ($i = 0; $i < count($h); $i++) {

                    if ($h[$i] != end($h)) {
                      $rest .= $h[$i] . "; ";
                    } else {
                      $rest .= "and " . $h[$i];
                    }
                  }
                }
                //echo $rest;

                $query_prescription = "INSERT INTO prescription(hospital_no, identity, first_name, middle_name, last_name, gender, complaints, observation, diagnosis, prescriptions, test, prescription_date, prescription_by) 
		VALUES ('$hospital_no', '$identity', '$fname', '$mname', '$lname', '$gender','$complaints','$observation','$rest','$prescriptions', '$test', '$prescription_date', '$prescription_by')";
                $result_prescription = mysqli_query($conn, $query_prescription) or die(mysqli_error($conn));

                //INSERT INTO LOG
                //INSERT INTO PATIENT LOG
                $query2 = "SELECT * FROM pat_stats WHERE hospital_no= '$hospital_no' AND log_date='$pet_date'";
                $result2 = mysqli_query($conn, $query2);

                if (mysqli_num_rows($result2) > 0) {
                      ?>
        <script>
          alert("Details have been updated! Click OK to continue");
        </script>
      <?php
                  header("location: prescriptions-slip.php?hospital_no=$hospital_no");
                } else {
                  $query = "INSERT INTO pat_stats(hospital_no, gender, pat_type, log_date ) VALUES ('$hospital_no',  '$gender', '$pat_type', '$pet_date')";
                  $result = mysqli_query($conn, $query) or die(mysqli_error($conn));

      ?>
        <script>
          alert("Success ! Click OK to continue");
        </script> 
<?php
                  header("location: prescriptions-slip.php?hospital_no=$hospital_no");
                }
              }
            }
          }

          /* Modal Control */
          /* Allergies results */
          $query = "SELECT * FROM patient_record WHERE pat_id= '$pat_id' ";
          $result = mysqli_query($conn, $query);
          while ($row = mysqli_fetch_assoc($result)) {

            if ($row['allergies'] == "") {
              $allergy_message = "<font style='font-weight:bold; color:red;'>Patient Has No Allergy Or Has Not Submitted Details About His/Her Allergies</font> <br/><br/>";
            } else {
              $allergy_message = "Allergy: " . $row['allergies'] . "<br/><br/>";
            }

            $hospital_no = $row["hospital_no"];
            $identity = strtoupper($row["identity"]);
            $fname = strtoupper($row["first_name"]);
            $mname = strtoupper($row["middle_name"]);
            $lname = strtoupper($row["last_name"]);
            $gender = strtoupper($row['gender']);

            $fullname = "$fname $mname $lname";
            $full = strtoupper($fullname);
          }

          $allergies .= "<div class='center offset-l4'>
                    <div class='card horizontal'>
                      <div class='card-stacked'>
                        <div class='card-content'>
                          <p>Hospital Number: $hospital_no </p>
                          <p>Unique Identity: $identity</p>
                          <p>Full Name: $full</p>
                          <p>Gender: $gender</p>
                          <p>Category: $allergy_message</p>
                        </div>
                      </div>
                    </div>
                  </div>";
          /* End of allergies result */

          /* Last vital taken */

          $query1 = "SELECT * FROM patient_record WHERE pat_id= '$pat_id' ";
          $query2 = "SELECT * FROM patient_vitals WHERE hospital_no= '$hospital_no' ORDER BY pat_id DESC LIMIT 1 ";
          $result1 = mysqli_query($conn, $query1);
          $result2 = mysqli_query($conn, $query2);
          $message_vitals = "";
          $timeago = "";
          $timeagoUpd = "";
          while ($row1 = mysqli_fetch_assoc($result1)) {
            $hospital_no = $row1["hospital_no"];
            $identity = strtoupper($row1["identity"]);
            $fname = strtoupper($row1["first_name"]);
            $mname = strtoupper($row1["middle_name"]);
            $lname = strtoupper($row1["last_name"]);
            $gender = strtoupper($row1['gender']);
            $fullname = "$fname $mname $lname";
            $full = strtoupper($fullname);
            if (mysqli_num_rows($result2) == 0) {
              $message_vitals = "<font style='font-weight:bold; color:red; '> Patient Has Done Any Vital Sign Test </font> <br/><br/>";
              $temperature_message = "";
              $pulse_message = "";
              $respiratory_rate_message = "";
              $blood_pressure_message = "";
              $weight_message = "";
              $height_message = "";
              $pain_message = "";
              $menstrual_cycle_message = "";
              $glasgow_coma_scale_message = "";
              $glucose_message = "";
              $vital_reg_date_message = "";
              $vital_reg_by_message = "";
              $vital_upd_date_message = "";
              $vital_upd_by_message = "";
            }
            while ($row2 = mysqli_fetch_assoc($result2)) {
              $temperature = $row2['temperature'];
              $pulse = $row2['pulse'];
              $respiratory_rate = $row2['respiratory_rate'];
              $blood_pressure = $row2['blood_pressure'];
              $weight = $row2['weight'];
              $height = $row2['height'];
              $pain = $row2['pain'];
              $menstrual_cycle = $row2['menstrual_cycle'];
              $glasgow_coma_scale = $row2['glasgow_coma_scale'];
              $glucose = $row2['glucose'];
              $vital_reg_date = $row2['vital_reg_date'];
              $vital_reg_by = $row2['vital_reg_by'];
              $vital_upd_date = $row2['vital_upd_date'];
              $vital_upd_by = $row2['vital_upd_by'];

              $timeago = get_timeago(strtotime($row2['vital_reg_date']));
              $timeagoUpd = get_timeago(strtotime($row2['vital_upd_date']));

              if ($temperature == "") {
                $temperature_message = "";
              } else {
                $temperature_message = "Temperature: $temperature <br/>";
              }
              if ($pulse == "") {
                $pulse_message = "";
              } else {
                $pulse_message = "Pulse: $pulse <br/>";
              }
              if ($respiratory_rate == "") {
                $respiratory_rate_message = "";
              } else {
                $respiratory_rate_message = "Respiratory Rate: $respiratory_rate <br/>";
              }
              if ($blood_pressure == "") {
                $blood_pressure_message = "";
              } else {
                $blood_pressure_message = "Blood Pressure: $blood_pressure <br/>";
              }
              if ($weight == "") {
                $weight_message = "";
              } else {
                $weight_message = "Weight: $weight <br/>";
              }
              if ($height == "") {
                $height_message = "";
              } else {
                $height_message = "Height: $height <br/>";
              }
              if ($pain == "") {
                $pain_message = "";
              } else {
                $pain_message = "Pain: $pain <br/>";
              }
              if ($menstrual_cycle == "") {
                $menstrual_cycle_message = "";
              } else {
                $menstrual_cycle_message = "Menstrual Cycle: $menstrual_cycle <br/>";
              }
              if ($glasgow_coma_scale == "") {
                $glasgow_coma_scale_message = "";
              } else {
                $glasgow_coma_scale_message = "Glasgow Coma Scale: $glasgow_coma_scale <br/>";
              }
              if ($glucose == "") {
                $glucose_message = "";
              } else {
                $glucose_message = "Glucose: $glucose <br/>";
              }
              if ($vital_reg_by == "") {
                $vital_reg_by_message = "";
              } else {
                $vital_reg_by_message = "Taken By: $vital_reg_by <br/>";
              }
              if ($vital_reg_date == "") {
                $vital_reg_date_message = "";
              } else {
                $vital_reg_date_message = "Date Taken: $vital_reg_date <br/>";
              }
              if ($vital_upd_by == "") {
                $vital_upd_by_message = "";
              } else {
                $vital_upd_by_message = "Updated By: $vital_upd_by <br/>";
              }
              if ($vital_upd_date == "") {
                $vital_upd_date_message = "";
              } else {
                $vital_upd_date_message = "Date Updated: $vital_upd_date <br/>";
              }
            }
          }

          $last_vitals .= "<div class='center offset-l4'>
                    <div class='card horizontal'>
                      <div class='card-stacked'>
                        <div class='card-content'>
                          <p>Hospital Number: $hospital_no </p>
                          <p>Unique Identity: $identity</p>
                          <p>Full Name: $full</p>
                          <p>Gender: $gender</p>
                       
                  $temperature_message
                  $pulse_message
                  $respiratory_rate_message
                  $blood_pressure_message
                  $weight_message
                  $height_message
                  $pain_message
                  $menstrual_cycle_message
                  $glasgow_coma_scale_message
                  $glucose_message
                  $vital_reg_date_message $timeago
                  $vital_reg_by_message
                  
                  $vital_upd_date_message $timeagoUpd
                  $vital_upd_by_message
                  </div>
                          </div>
                    </div>      
                  </div>";
          /* End of last vital taken */

          /*Last Test taken  */
          $query1 = "SELECT * FROM patient_record WHERE pat_id= '$pat_id' ";
          $query2 = "SELECT * FROM lab_test WHERE hospital_no= '$hospital_no' ORDER BY pat_id DESC LIMIT 1  ";

          $result1 = mysqli_query($conn, $query1);
          $result2 = mysqli_query($conn, $query2);

          $message_test = "";
          $timeagoTest = "";
          $timeagoTestUpd = "";

          while ($row1 = mysqli_fetch_assoc($result1)) {

            $pat_id = $row1['pat_id'];
            $hospital_no = $row1["hospital_no"];
            $identity = strtoupper($row1["identity"]);
            $fname = strtoupper($row1["first_name"]);
            $mname = strtoupper($row1["middle_name"]);
            $lname = strtoupper($row1["last_name"]);
            $gender = strtoupper($row1['gender']);
            $dob = strtoupper($row1['dob']);
            $department = strtoupper($row1['department']);
            $faculty = strtoupper($row1['faculty']);

            $fullname = "$fname $mname $lname";
            $full = strtoupper($fullname);

            if (mysqli_num_rows($result2) == 0) {
              $message_test = "<font style='font-weight:bold; color:red; '>Patient Has Not Conducted Any Laboratory Test</font> <br/>";
              $hb_message = "";
              $pcv_message = "";
              $wbc_message = "";
              $mchc_message = "";
              $rbc_message = "";
              $mcv_message = "";
              $p_message = "";
              $l_message = "";
              $m_message = "";
              $e_message = "";
              $b_message = "";
              $retics_message = "";
              $malaria_parasite_message = "";
              $hb_genotype_message = "";
              $prothromb_time_message = "";
              $control_message = "";
              $bleed_time_message = "";

              $clot_time_message = "";
              $platelet_count_message = "";
              $urinalysis_test_type_message = "";
              $urinalysis_colour_message = "";
              $sp_gr_message = "";
              $acetone_message = "";
              $occ_blood_message = "";
              $wbc_hff_message = "";
              $epith_cells_message = "";
              $appearance_message = "";
              $albumin_message = "";
              $urobilingen_message = "";
              $mucus_message = "";
              $rbc_hpf_message = "";
              $casts_message = "";
              $ph_message = "";
              $glucose_message = "";
              $bilirubin_message = "";
              $crystals_message = "";
              $bacteria_message = "";
              $t_vaginalis_message = "";
              $microbiology_message = "";
              $routine_appearance_message = "";
              $microscopy_message = "";
              $occult_blood_message = "";
              $parasitology_culture_sensitivity_message = "";
              $skin_ship_message = "";

              $blood_parasite_message = "";
              $blood_group_message = "";
              $rh_factor_message = "";
              $vdrl_test_message = "";
              $aso_titre_message = "";
              $antibody_tire_message = "";
              $widal_reaction_message = "";
              $rheumatoid_factor_message = "";
              $australia_antigen_message = "";
              $pregnancy_test_message = "";
              $seminal_analysis_message = "";
              $time_of_collection_message = "";
              $examination_message = "";
              $misc_colour_message = "";
              $volume_message = "";
              $viscosity_message = "";
              $motility_message = "";
              $count_message = "";
              $abnormal_forms_message = "";


              $test_reg_by_message = "";
              $test_reg_date_message = "";

              $test_upd_by_message = "";
              $test_upd_date_message = "";
            }

            while ($row2 = mysqli_fetch_assoc($result2)) {
              $hb = $row2['hb'];
              $pcv = $row2['pcv'];
              $wbc = $row2['wbc'];
              $mchc = $row2['mchc'];
              $rbc = $row2['rbc'];
              $mcv = $row2['mcv'];
              $p = $row2['p'];
              $l = $row2['l'];
              $m = $row2['m'];
              $e = $row2['e'];
              $b = $row2['b'];
              $retics = $row2['retics'];
              $malaria_parasite = $row2['malaria_parasite'];
              $hb_genotype = $row2['hb_genotype'];
              $prothromb_time = $row2['prothromb_time'];
              $control = $row2['control'];
              $bleed_time = $row2['bleed_time'];
              $clot_time = $row2['clot_time'];
              $platelet_count = $row2['platelet_count'];
              $urinalysis_test_type = $row2['urinalysis_test_type'];
              $urinalysis_colour = $row2['urinalysis_colour'];
              $sp_gr = $row2['sp_gr'];
              $acetone = $row2['acetone'];
              $occ_blood = $row2['occ_blood'];
              $wbc_hff = $row2['wbc_hff'];
              $epith_cells = $row2['epith_cells'];
              $appearance = $row2['appearance'];
              $albumin = $row2['albumin'];
              $urobilingen = $row2['urobilingen'];
              $mucus = $row2['mucus'];
              $rbc_hpf = $row2['rbc_hpf'];
              $casts = $row2['casts'];
              $ph = $row2['ph'];
              $glucose = $row2['glucose'];
              $bilirubin = $row2['bilirubin'];
              $crystals = $row2['crystals'];
              $bacteria = $row2['bacteria'];
              $t_vaginalis = $row2['t_vaginalis'];
              $microbiology = $row2['microbiology'];
              $routine_appearance = $row2['routine_appearance'];
              $microscopy = $row2['microscopy'];
              $occult_blood = $row2['occult_blood'];
              $parasitology_culture_sensitivity = $row2['parasitology_culture_sensitivity'];
              $skin_ship = $row2['skin_ship'];
              $blood_parasite = $row2['blood_parasite'];
              $blood_group = $row2['blood_group'];
              $rh_factor = $row2['rh_factor'];
              $vdrl_test = $row2['vdrl_test'];
              $aso_titre = $row2['aso_titre'];
              $antibody_tire = $row2['antibody_tire'];
              $widal_reaction = $row2['widal_reaction'];
              $rheumatoid_factor = $row2['rheumatoid_factor'];
              $australia_antigen = $row2['australia_antigen'];
              $pregnancy_test = $row2['pregnancy_test'];
              $seminal_analysis = $row2['seminal_analysis'];
              $time_of_collection = $row2['time_of_collection'];
              $examination = $row2['examination'];
              $misc_colour = $row2['misc_colour'];
              $volume = $row2['volume'];
              $viscosity = $row2['viscosity'];
              $motility = $row2['motility'];
              $count = $row2['count_'];
              $abnormal_forms = $row2['abnormal_forms'];

              $test_reg_by = $row2['test_reg_by'];
              $test_reg_date = $row2['test_reg_date'];

              $test_upd_by = $row2['test_upd_by'];
              $test_upd_date = $row2['test_upd_date'];

              $timeagoTest = get_timeago(strtotime($row2['test_reg_date']));
              $timeagoTestUpd = get_timeago(strtotime($row2['test_upd_date']));



              if ($hb == "") {
                $hb_message = "";
              } else {
                $hb_message = "Hb: $hb <br/>";
              }
              if ($pcv == "") {
                $pcv_message = "";
              } else {
                $pcv_message = "PCV: $pcv <br/>";
              }
              if ($wbc == "") {
                $wbc_message = "";
              } else {
                $wbc_message = "WBC: $wbc <br/>";
              }
              if ($mchc == "") {
                $mchc_message = "";
              } else {
                $mchc_message = "MCHC: $mchc <br/>";
              }
              if ($rbc == "") {
                $rbc_message = "";
              } else {
                $rbc_message = "RBC: $rbc <br/>";
              }
              if ($mcv == "") {
                $mcv_message = "";
              } else {
                $mcv_message = "MCV: $mcv <br/>";
              }
              if ($p == "") {
                $p_message = "";
              } else {
                $p_message = "P: $p <br/>";
              }
              if ($l == "") {
                $l_message = "";
              } else {
                $l_message = "L: $l <br/>";
              }

              if ($m == "") {
                $m_message = "";
              } else {
                $m_message = "M: $m <br/>";
              }
              if ($e == "") {
                $e_message = "";
              } else {
                $e_message = "E: $e <br/>";
              }
              if ($b == "") {
                $b_message = "";
              } else {
                $b_message = "B: $b <br/>";
              }
              if ($retics == "") {
                $retics_message = "";
              } else {
                $retics_message = "Retics: $retics <br/>";
              }
              if ($malaria_parasite == "") {
                $malaria_parasite_message = "";
              } else {
                $malaria_parasite_message = "Malaria Parasite: $malaria_parasite <br/>";
              }
              if ($hb_genotype == "") {
                $hb_genotype_message = "";
              } else {
                $hb_genotype_message = "Hb Genotype: $hb_genotype <br/>";
              }
              if ($prothromb_time == "") {
                $prothromb_time_message = "";
              } else {
                $prothromb_time_message = "Prothromb Time: $prothromb_time <br/>";
              }
              if ($control == "") {
                $control_message = "";
              } else {
                $control_message = "Control: $control <br/>";
              }


              if ($bleed_time == "") {
                $bleed_time_message = "";
              } else {
                $bleed_time_message = "Bleed Time: $bleed_time <br/>";
              }
              if ($clot_time == "") {
                $clot_time_message = "";
              } else {
                $clot_time_message = "Clot Time: $clot_time <br/>";
              }
              if ($platelet_count == "") {
                $platelet_count_message = "";
              } else {
                $platelet_count_message = "Platelet Count: $platelet_count <br/>";
              }
              if ($urinalysis_test_type == "") {
                $urinalysis_test_type_message = "";
              } else {
                $urinalysis_test_type_message = "Test Type: $urinalysis_test_type <br/>";
              }
              if ($urinalysis_colour == "") {
                $urinalysis_colour_message = "";
              } else {
                $urinalysis_colour_message = "Urinalysis Colour: $urinalysis_colour <br/>";
              }
              if ($sp_gr == "") {
                $sp_gr_message = "";
              } else {
                $sp_gr_message = "SP GR: $sp_gr <br/>";
              }
              if ($acetone == "") {
                $acetone_message = "";
              } else {
                $acetone_message = "Acetone: $acetone <br/>";
              }
              if ($occ_blood == "") {
                $occ_blood_message = "";
              } else {
                $occ_blood_message = "Occ Blood: $occ_blood <br/>";
              }

              if ($wbc_hff == "") {
                $wbc_hff_message = "";
              } else {
                $wbc_hff_message = "WBC Hff: $wbc_hff <br/>";
              }
              if ($epith_cells == "") {
                $epith_cells_message = "";
              } else {
                $epith_cells_message = "Epith Cells: $epith_cells <br/>";
              }
              if ($appearance == "") {
                $appearance_message = "";
              } else {
                $appearance_message = "Appearance: $appearance <br/>";
              }
              if ($albumin == "") {
                $albumin_message = "";
              } else {
                $albumin_message = "Albumin: $albumin <br/>";
              }
              if ($urobilingen == "") {
                $urobilingen_message = "";
              } else {
                $urobilingen_message = "Urobilingen: $urobilingen <br/>";
              }
              if ($mucus == "") {
                $mucus_message = "";
              } else {
                $mucus_message = "Mucus: $mucus <br/>";
              }
              if ($rbc_hpf == "") {
                $rbc_hpf_message = "";
              } else {
                $rbc_hpf_message = "RBC HPF: $rbc_hpf <br/>";
              }
              if ($casts == "") {
                $casts_message = "";
              } else {
                $casts_message = "Casts: $casts <br/>";
              }

              if ($ph == "") {
                $ph_message = "";
              } else {
                $ph_message = "PH: $ph <br/>";
              }
              if ($glucose == "") {
                $glucose_message = "";
              } else {
                $glucose_message = "Glucose: $glucose <br/>";
              }
              if ($bilirubin == "") {
                $bilirubin_message = "";
              } else {
                $bilirubin_message = "Bilirubin: $bilirubin <br/>";
              }
              if ($crystals == "") {
                $crystals_message = "";
              } else {
                $crystals_message = "Crystals: $crystals <br/>";
              }
              if ($bacteria == "") {
                $bacteria_message = "";
              } else {
                $bacteria_message = "Bacteria: $bacteria <br/>";
              }
              if ($t_vaginalis == "") {
                $t_vaginalis_message = "";
              } else {
                $t_vaginalis_message = "T Vaginalis: $t_vaginalis <br/>";
              }
              if ($microbiology == "") {
                $microbiology_message = "";
              } else {
                $microbiology_message = "Microbiology: $microbiology <br/>";
              }
              if ($routine_appearance == "") {
                $routine_appearance_message = "";
              } else {
                $routine_appearance_message = "Routine Appearance: $routine_appearance <br/>";
              }

              if ($microscopy == "") {
                $microscopy_message = "";
              } else {
                $microscopy_message = "Microscopy: $microscopy <br/>";
              }
              if ($occult_blood == "") {
                $occult_blood_message = "";
              } else {
                $occult_blood_message = "Occult Blood: $occult_blood <br/>";
              }
              if ($parasitology_culture_sensitivity == "") {
                $parasitology_culture_sensitivity_message = "";
              } else {
                $parasitology_culture_sensitivity_message = "Parasitology Culture Sensitivity: $parasitology_culture_sensitivity <br/>";
              }


              if ($skin_ship == "") {
                $skin_ship_message = "";
              } else {
                $skin_ship_message = "Skin Ship: $skin_ship <br/>";
              }
              if ($blood_parasite == "") {
                $blood_parasite_message = "";
              } else {
                $blood_parasite_message = "Blood Parasite: $blood_parasite <br/>";
              }
              if ($blood_group == "") {
                $blood_group_message = "";
              } else {
                $blood_group_message = "Blood Group: $blood_group <br/>";
              }
              if ($rh_factor == "") {
                $rh_factor_message = "";
              } else {
                $rh_factor_message = "Rh Factor: $rh_factor <br/>";
              }
              if ($vdrl_test == "") {
                $vdrl_test_message = "";
              } else {
                $vdrl_test_message = "VDRL Test: $vdrl_test <br/>";
              }


              if ($aso_titre == "") {
                $aso_titre_message = "";
              } else {
                $aso_titre_message = "ASO Titre: $aso_titre <br/>";
              }
              if ($antibody_tire == "") {
                $antibody_tire_message = "";
              } else {
                $antibody_tire_message = "Antibody Tire: $antibody_tire <br/>";
              }
              if ($widal_reaction == "") {
                $widal_reaction_message = "";
              } else {
                $widal_reaction_message = "Widal Reaction: $widal_reaction <br/>";
              }
              if ($rheumatoid_factor == "") {
                $rheumatoid_factor_message = "";
              } else {
                $rheumatoid_factor_message = "Rheumatoid Factor: $rheumatoid_factor <br/>";
              }
              if ($australia_antigen == "") {
                $australia_antigen_message = "";
              } else {
                $australia_antigen_message = "Australia Antigen: $australia_antigen <br/>";
              }
              if ($pregnancy_test == "") {
                $pregnancy_test_message = "";
              } else {
                $pregnancy_test_message = "Pregnancy Test: $pregnancy_test <br/>";
              }
              if ($seminal_analysis == "") {
                $seminal_analysis_message = "";
              } else {
                $seminal_analysis_message = "Seminal Analysis: $seminal_analysis <br/>";
              }
              if ($time_of_collection == "") {
                $time_of_collection_message = "";
              } else {
                $time_of_collection_message = "Time Of Collection: $time_of_collection <br/>";
              }

              if ($examination == "") {
                $examination_message = "";
              } else {
                $examination_message = "Examination: $examination <br/>";
              }
              if ($misc_colour == "") {
                $misc_colour_message = "";
              } else {
                $misc_colour_message = "Color: $misc_colour <br/>";
              }
              if ($volume == "") {
                $volume_message = "";
              } else {
                $volume_message = "Volume: $volume <br/>";
              }
              if ($viscosity == "") {
                $viscosity_message = "";
              } else {
                $viscosity_message = "Viscosity: $viscosity <br/>";
              }
              if ($motility == "") {
                $motility_message = "";
              } else {
                $motility_message = "Motility: $motility <br/>";
              }
              if ($count == "") {
                $count_message = "";
              } else {
                $count_message = "Count: $count <br/>";
              }
              if ($abnormal_forms == "") {
                $abnormal_forms_message = "";
              } else {
                $abnormal_forms_message = "Abnormal Forms: $abnormal_forms <br/>";
              }
              if ($test_reg_by == "") {
                $test_reg_by_message = "";
              } else {
                $test_reg_by_message = "Taken By: $test_reg_by <br/>";
              }
              if ($test_reg_date == "") {
                $test_reg_date_message = "";
              } else {
                $test_reg_date_message = "Date Taken: $test_reg_date <br/>";
              }
              if ($test_upd_by == "") {
                $test_upd_by_message = "";
              } else {
                $test_upd_by_message = "Updated By: $test_upd_by <br/>";
              }
              if ($test_upd_date == "") {
                $test_upd_date_message = "";
              } else {
                $test_upd_date_message = "Date Updated: $test_upd_date <br/>";
              }
            }
          }
          $last_lab_test .= "<div class='center offset-l4'>
                    <div class='card horizontal'>
                      <div class='card-stacked'>
                        <div class='card-content'>
                          <p>Hospital Number: $hospital_no </p>
                          <p>Unique Identity: $identity</p>
                          <p>Full Name: $full</p>
                          <p>Gender: $gender</p>
                       
				 $message_test
			  $hb_message
			  $pcv_message
			  $wbc_message
			  $mchc_message
			  $rbc_message
			  $mcv_message
			  $p_message
			  $l_message
			  $m_message
			  $e_message
			  $b_message
			  $retics_message
			  $malaria_parasite_message
			  $hb_genotype_message
			  $prothromb_time_message
			  $control_message
			  $bleed_time_message
			  $clot_time_message
			  $platelet_count_message
			  $urinalysis_test_type_message
			  $urinalysis_colour_message
			  $sp_gr_message
			  $acetone_message
			  $occ_blood_message
			  $wbc_hff_message
			  $epith_cells_message
			  $appearance_message
			  $albumin_message
			  $urobilingen_message 
			  $mucus_message
			  $rbc_hpf_message
			  $casts_message
			  $ph_message
			  $glucose_message
			  $bilirubin_message
			  $crystals_message
			  $bacteria_message
			  $t_vaginalis_message
			  $microbiology_message
			  $routine_appearance_message
			  $microscopy_message 
			  $occult_blood_message
			  $parasitology_culture_sensitivity_message
			  $skin_ship_message
			  $blood_parasite_message
			  $blood_group_message
			  $rh_factor_message
			  $vdrl_test_message
			  $aso_titre_message
			  $antibody_tire_message
			  $widal_reaction_message
			  $rheumatoid_factor_message
			  $australia_antigen_message
			  $pregnancy_test_message
			  $seminal_analysis_message
			  $time_of_collection_message
			  $examination_message
			  $misc_colour_message
			  $volume_message
			  $viscosity_message
			  $motility_message
			  $count_message
			  $abnormal_forms_message
			<br/>
			  $test_reg_by_message
			  $test_reg_date_message $timeagoTest
			 <br/>
			  $test_upd_by_message
			  $test_upd_date_message $timeagoTestUpd
			 </div>
                      </div>
                    </div>
                  </div>";
          /* End of lab Test */

          /* Last prescriptions */
          $query1 = "SELECT * FROM patient_record WHERE pat_id = '$pat_id' ";
          $query2 = "SELECT * FROM prescription WHERE hospital_no= '$hospital_no' ORDER BY pat_id DESC LIMIT 1 ";

          $result1 = mysqli_query($conn, $query1);
          $result2 = mysqli_query($conn, $query2);

          $message_prescription = "";

          $timeagoPres = "";
          $timeagoPresUpd = "";
          while ($row1 = mysqli_fetch_assoc($result1)) {

            $hospital_no = $row1["hospital_no"];
            $identity = strtoupper($row1["identity"]);
            $fname = strtoupper($row1["first_name"]);
            $mname = strtoupper($row1["middle_name"]);
            $lname = strtoupper($row1["last_name"]);
            $gender = strtoupper($row1['gender']);

            $fullname = "$fname $mname $lname";
            $full = strtoupper($fullname);

            if (mysqli_num_rows($result2) == 0) {
              $message_prescription = "<font style='font-weight:bold; color:red; '> Patient Has Not Visited The Doctor </font> <br/><br/>";

              $complaints_message = "";
              $observation_message = "";
              $test_message = "";
              $diagnosis_message = "";
              $prescriptions_message = "";
              $prescription_by_message = "";
              $prescription_date_message = "";
              $prescription_upd_by_message = "";
              $prescription_upd_date_message = "";
            }

            while ($row2 = mysqli_fetch_assoc($result2)) {
              $complaints = $row2['complaints'];
              $observation = $row2['observation'];
              $test = $row2['test'];
              $diagnosis = $row2['diagnosis'];
              $prescriptions = $row2['prescriptions'];
              $prescription_date = $row2['prescription_date'];
              $prescription_by = $row2['prescription_by'];

              $prescription_upd_date = $row2['prescription_upd_date'];
              $prescription_upd_by = $row2['prescription_upd_by'];

              $timeagoPres = get_timeago(strtotime($row2['prescription_date']));
              $timeagoPresUpd = get_timeago(strtotime($row2['prescription_upd_date']));

              if ($complaints == "") {
                $complaints_message = "";
              } else {
                $complaints_message = "Complaints: $complaints <br/>";
              }
              if ($observation == "") {
                $observation_message = "";
              } else {
                $observation_message = "Observation: $observation <br/>";
              }
              if ($test == "") {
                $test_message = "";
              } else {
                $test_message = "Test: $test <br/>";
              }
              if ($diagnosis == "") {
                $diagnosis_message = "";
              } else {
                $diagnosis_message = "Diagnosis: $diagnosis <br/>";
              }
              if ($prescriptions == "") {
                $prescriptions_message = "";
              } else {
                $prescriptions_message = "Prescription: $prescriptions <br/>";
              }
              if ($prescription_date == "") {
                $prescription_date_message = "";
              } else {
                $prescription_date_message = "Prescription Date: $prescription_date <br/>";
              }
              if ($prescription_by == "") {
                $prescription_by_message = "";
              } else {
                $prescription_by_message = "Prescribed By: $prescription_by <br/>";
              }
              if ($prescription_upd_date == "") {
                $prescription_upd_date_message = "";
              } else {
                $prescription_upd_date_message = "Date Updated: $prescription_upd_date <br/>";
              }
              if ($prescription_upd_by == "") {
                $prescription_upd_by_message = "";
              } else {
                $prescription_upd_by_message = "Updated By: $prescription_upd_by <br/>";
              }
            }
          }

          $last_prescription .= "<div class='center offset-l4'>
                    <div class='card horizontal'>
                      <div class='card-stacked'>
                        <div class='card-content'>
                          <p>Hospital Number: $hospital_no </p>
                          <p>Unique Identity: $identity</p>
                          <p>Full Name: $full</p>
                          <p>Gender: $gender</p>
                       
				  $complaints_message 
			 $observation_message
			 $test_message 
			 $diagnosis_message
			 $prescriptions_message 
			 $prescription_date_message $timeagoPres
			 $prescription_by_message 
			
			 $prescription_upd_date_message $timeagoPresUpd
			 $prescription_upd_by_message 
			
			 $message_prescription <br/>
				</div>
			</div>
		</div>
  </div>";
          /* End of last prescriptions */

          /* Last scan */
          $timeago = "";
          $timeagoUpd = "";
          $xray_upd_date = "";
          $message_scan = "";

          $query1 = "SELECT * FROM patient_record WHERE pat_id = '$pat_id' ";
          $query2 = "SELECT * FROM xray WHERE hospital_no= '$hospital_no' ORDER BY pat_id DESC LIMIT 1 ";

          $result1 = mysqli_query($conn, $query1);
          $result2 = mysqli_query($conn, $query2);

          while ($row1 = mysqli_fetch_assoc($result1)) {

            if ($row1['passport'] == '') {
              $see = 'No photo';
            } else {
              $see = $row1['passport'];
            }
            $imgp = "<img src='../passport/" . $row1['passport'] . "' border='1' alt='" . $see . "' style='float:left;height:100px; width:100px'/>";
            $hospital_no = $row1["hospital_no"];
            $identity = strtoupper($row1["identity"]);
            $fname = strtoupper($row1["first_name"]);
            $mname = strtoupper($row1["middle_name"]);
            $lname = strtoupper($row1["last_name"]);
            $gender = strtoupper($row1['gender']);
            $dob = strtoupper($row1['dob']);
            $address = strtoupper($row1['address']);
            $patient_type = strtoupper($row1['patient_type']);
            $department = strtoupper($row1['department']);
            $passport = $row1['passport'];

            $fullname = "$fname $mname $lname";
            $full = strtoupper($fullname);
            $age = floor(((time() - strtotime($dob))  / (3600 * 24 * 365)));
            //$age = date("Y-m-d") - $dob;

            if (mysqli_num_rows($result2) == 0) {
              $message_scan = "<font style='font-weight:bold; color:red; '> Patient Has Done Any Scan </font> <br/><br/>";
              $xray_no_message = "";
              $tentative_diagnosis_message = "";
              $examination_requested_message = "";
              $size_message = "";
              $previous_xray_message = "";
              $operation_message = "";
              $radiographer_comment_message = "";
              $radiologist_report_message = "";
              $xray_reg_date_message = "";
              $xray_reg_by_message = "";
              $xray_upd_date_message = "";
              $xray_upd_by_message = "";
            }

            while ($row2 = mysqli_fetch_assoc($result2)) {
              $xray_no = $row2['xray_no'];
              $tentative_diagnosis = $row2['tentative_diagnosis'];
              $examination_requested = $row2['examination_requested'];
              $size = $row2['size'];
              $previous_xray = $row2['previous_xray'];
              $operation = $row2['operation'];
              $radiographer_comment = $row2['radiographer_comment'];
              $radiologist_report = $row2['radiologist_report'];
              $xray_reg_date = $row2['xray_reg_date'];
              $xray_reg_by = $row2['xray_reg_by'];
              $xray_upd_date = $row2['xray_upd_date'];
              $xray_upd_by = $row2['xray_upd_by'];
              $timeago = get_timeago(strtotime($row2['xray_reg_date']));
              $timeagoUpd = get_timeago(strtotime($row2['xray_upd_date']));

              if ($xray_no == "") {
                $xray_no_message = "";
              } else {
                $xray_no_message = "$xray_no";
              }
              if ($tentative_diagnosis == "") {
                $tentative_diagnosis_message = "";
              } else {
                $tentative_diagnosis_message = "$tentative_diagnosis";
              }
              if ($examination_requested == "") {
                $examination_requested_message = "";
              } else {
                $examination_requested_message = "$examination_requested";
              }
              if ($size == "") {
                $size_message = "";
              } else {
                $size_message = '$size_message';
              }
              if ($previous_xray == "") {
                $previous_xray_message = "";
              } else {
                $previous_xray_message = "$previous_xray";
              }
              if ($operation == "") {
                $operation_message = "";
              } else {
                $operation_message = "$operation";
              }
              if ($radiographer_comment == "") {
                $radiographer_comment_message = "";
              } else {
                $radiographer_comment_message = "$radiographer_comment";
              }
              if ($radiologist_report == "") {
                $radiologist_report_message = "";
              } else {
                $radiologist_report_message = "$radiologist_report";
              }
              if ($xray_reg_date == "") {
                $xray_reg_date_message = "";
              } else {
                $xray_reg_date_message = "$xray_reg_date";
              }
              if ($xray_reg_by == "") {
                $xray_reg_by_message = "";
              } else {
                $xray_reg_by_message = "$xray_reg_by";
              }
              if ($xray_upd_date == "") {
                $xray_upd_date_message = "";
              } else {
                $xray_upd_date_message = "$xray_upd_date";
              }
              if ($xray_upd_by == "") {
                $xray_upd_by_message = "";
              } else {
                $xray_upd_by_message = "$xray_upd_by";
              }
            }
          }
          $last_scan .= "<div class='center offset-l4'>
                    <div class='card horizontal'>
                      <div class='card-stacked'>
                        <div class='card-content'>
                          <p>Hospital Number: $hospital_no </p>
                          <p>Unique Identity: $identity</p>
                          <p>Full Name: $full</p>
                          <p>Gender: $gender</p>
                       
              <p class=‘card-title’>VIEW LAST SCAN RESULT</p>
              <table>
        <tbody>
          <tr>
            <td rowspan='3'> $imgp</td>
            <td>Hospital Number: $hospital_no
            <td>Identity: $identity</td>
            <td>Category: $patient_type</td>
             <td>Gender: $gender</td>
          </tr>
          <tr>
            <td>   Full Name:<br/>     $full </td>
            <td>   Age:   $age </td>
            <td>   Department:   $department </td>
            <td>   Date of Birth:  $dob </td>
        </tr>
        <tr>
            <td  colspan=‘3’>   Address:   $address </td>
        </tr>
        
        <tr>
            <td >   X-ray No:  $xray_no_message </td>
            <td >   Tentative Diagnosis:  $tentative_diagnosis_message </td>
            <td >   Examination Required:<br/>   $examination_requested_message </td>
            <td >  Size:  $size_message </td>
            <td >   Previous X-Ray?:   $previous_xray_message </td>
        </tr>
        <tr>
            <td >   Any Operation?:<br/>   $operation_message </td>
            <td  colspan=‘2’>   Radiographer's Comment:<br/>   $radiographer_comment_message </td>
            <td  colspan=‘2’>   Radiologist Report:<br/>   $radiologist_report_message </td>
        </tr>
        <tr>
            <td colspan='2'>   Date Taken:<br/>   $xray_reg_date_message  <br/>  $timeago </td>
            <td >  Taken By:<br/>   $xray_reg_by_message </td>
            <td >   Date Updated:<br/>   $xray_upd_date_message  <br/>  $timeagoUpd </td>
            <td >   Updated By:<br/>   $xray_upd_by_message </td>
        </tr>
        </tbody>
            </div>
          </div>
        </div>
      </div>
";
          /* End of last scan */

          /* All pateint Vitals */
          $query1 = "SELECT * FROM patient_record WHERE pat_id = '$pat_id' ";
          $query2 = "SELECT * FROM patient_vitals WHERE hospital_no= '$hospital_no' ORDER BY pat_id DESC";
          $result2 = mysqli_query($conn, $query2);

          /*   while ($row1 = mysqli_fetch_assoc($result1)) {
              $hospital_no = $row1["hospital_no"];
              $identity = strtoupper($row1["identity"]);
              $fname = strtoupper($row1["first_name"]);
              $mname = strtoupper($row1["middle_name"]);
              $lname = strtoupper($row1["last_name"]);
              $gender = strtoupper($row1['gender']);
              $fullname = "$fname $mname $lname";
              $full = strtoupper($fullname); */
          while ($row2 = mysqli_fetch_assoc($result2)) {
            $temperature = $row2['temperature'];
            $pulse = $row2['pulse'];
            $respiratory_rate = $row2['respiratory_rate'];
            $blood_pressure = $row2['blood_pressure'];
            $pain = $row2['pain'];
            $weight = $row2['weight'];
            $height = $row2['height'];
            $menstrual_cycle = $row2['menstrual_cycle'];
            $glasgow_coma_scale = $row2['glasgow_coma_scale'];
            $glucose = $row2['glucose'];
            $vital_reg_date = $row2['vital_reg_date'];
            $vital_reg_by = $row2['vital_reg_by'];
            $timeago = get_timeago(strtotime($row2['vital_reg_date']));

            $all_patient_vitals .= "<div class='center offset-l4'>
                    <div class='card horizontal'>
                      <div class='card-stacked'>
                        <div class='card-content'>
                          <p>Hospital Number: $hospital_no </p>
                          <p>Unique Identity: $identity</p>
                          <p>Full Name: $full</p>
                          <p>Gender: $gender</p>
                       
                  $temperature_message
                  $pulse_message
                  $respiratory_rate_message
                  $blood_pressure_message
                  $weight_message
                  $height_message
                  $pain_message
                  $menstrual_cycle_message
                  $glasgow_coma_scale_message
                  $glucose_message
                  $vital_reg_date_message $timeago
                  $vital_reg_by_message
                  
                  $vital_upd_date_message $timeagoUpd
                  $vital_upd_by_message
                </div>
            </div>
        </div>
    </div>

";
          }

          //}          
          /* End of all patient vitals */

          /* All patient lab test */

          $query2 = "SELECT * FROM lab_test WHERE hospital_no= '$hospital_no' ORDER BY pat_id DESC";
          $result2 = mysqli_query($conn, $query2);
          while ($row2 = mysqli_fetch_assoc($result2)) {
            $hb = $row2['hb'];
            $pcv = $row2['pcv'];
            $wbc = $row2['wbc'];
            $mchc = $row2['mchc'];
            $rbc = $row2['rbc'];
            $mcv = $row2['mcv'];
            $p = $row2['p'];
            $l = $row2['l'];
            $m = $row2['m'];
            $e = $row2['e'];
            $b = $row2['b'];
            $retics = $row2['retics'];
            $malaria_parasite = $row2['malaria_parasite'];
            $hb_genotype = $row2['hb_genotype'];
            $prothromb_time = $row2['prothromb_time'];
            $control = $row2['control'];
            $bleed_time = $row2['bleed_time'];
            $clot_time = $row2['clot_time'];
            $platelet_count = $row2['platelet_count'];
            $urinalysis_test_type = $row2['urinalysis_test_type'];
            $urinalysis_colour = $row2['urinalysis_colour'];
            $sp_gr = $row2['sp_gr'];
            $acetone = $row2['acetone'];
            $occ_blood = $row2['occ_blood'];
            $wbc_hff = $row2['wbc_hff'];
            $epith_cells = $row2['epith_cells'];
            $appearance = $row2['appearance'];
            $albumin = $row2['albumin'];
            $urobilingen = $row2['urobilingen'];
            $mucus = $row2['mucus'];
            $rbc_hpf = $row2['rbc_hpf'];
            $casts = $row2['casts'];
            $ph = $row2['ph'];
            $glucose = $row2['glucose'];
            $bilirubin = $row2['bilirubin'];
            $crystals = $row2['crystals'];
            $bacteria = $row2['bacteria'];
            $t_vaginalis = $row2['t_vaginalis'];
            $microbiology = $row2['microbiology'];
            $routine_appearance = $row2['routine_appearance'];
            $microscopy = $row2['microscopy'];
            $occult_blood = $row2['occult_blood'];
            $parasitology_culture_sensitivity = $row2['parasitology_culture_sensitivity'];
            $skin_ship = $row2['skin_ship'];
            $blood_parasite = $row2['blood_parasite'];
            $blood_group = $row2['blood_group'];
            $rh_factor = $row2['rh_factor'];
            $vdrl_test = $row2['vdrl_test'];
            $aso_titre = $row2['aso_titre'];
            $antibody_tire = $row2['antibody_tire'];
            $widal_reaction = $row2['widal_reaction'];
            $rheumatoid_factor = $row2['rheumatoid_factor'];
            $australia_antigen = $row2['australia_antigen'];
            $pregnancy_test = $row2['pregnancy_test'];
            $seminal_analysis = $row2['seminal_analysis'];
            $time_of_collection = $row2['time_of_collection'];
            $examination = $row2['examination'];
            $misc_colour = $row2['misc_colour'];
            $volume = $row2['volume'];
            $viscosity = $row2['viscosity'];
            $motility = $row2['motility'];
            $count = $row2['count_'];
            $abnormal_forms = $row2['abnormal_forms'];

            $test_reg_by = $row2['test_reg_by'];
            $test_reg_date = $row2['test_reg_date'];

            $timeagoTest = get_timeago(strtotime($row2['test_reg_date']));


            if ($hb == "") {
              $hb_message = "";
            } else {
              $hb_message = "Hb: $hb <br/>";
            }
            if ($pcv == "") {
              $pcv_message = "";
            } else {
              $pcv_message = "PCV: $pcv <br/>";
            }
            if ($wbc == "") {
              $wbc_message = "";
            } else {
              $wbc_message = "WBC: $wbc <br/>";
            }
            if ($mchc == "") {
              $mchc_message = "";
            } else {
              $mchc_message = "MCHC: $mchc <br/>";
            }
            if ($rbc == "") {
              $rbc_message = "";
            } else {
              $rbc_message = "RBC: $rbc <br/>";
            }
            if ($mcv == "") {
              $mcv_message = "";
            } else {
              $mcv_message = "MCV: $mcv <br/>";
            }
            if ($p == "") {
              $p_message = "";
            } else {
              $p_message = "P: $p <br/>";
            }
            if ($l == "") {
              $l_message = "";
            } else {
              $l_message = "L: $l <br/>";
            }

            if ($m == "") {
              $m_message = "";
            } else {
              $m_message = "M: $m <br/>";
            }
            if ($e == "") {
              $e_message = "";
            } else {
              $e_message = "E: $e <br/>";
            }
            if ($b == "") {
              $b_message = "";
            } else {
              $b_message = "B: $b <br/>";
            }
            if ($retics == "") {
              $retics_message = "";
            } else {
              $retics_message = "Retics: $retics <br/>";
            }
            if ($malaria_parasite == "") {
              $malaria_parasite_message = "";
            } else {
              $malaria_parasite_message = "Malaria Parasite: $malaria_parasite <br/>";
            }
            if ($hb_genotype == "") {
              $hb_genotype_message = "";
            } else {
              $hb_genotype_message = "Hb Genotype: $hb_genotype <br/>";
            }
            if ($prothromb_time == "") {
              $prothromb_time_message = "";
            } else {
              $prothromb_time_message = "Prothromb Time: $prothromb_time <br/>";
            }
            if ($control == "") {
              $control_message = "";
            } else {
              $control_message = "Control: $control <br/>";
            }


            if ($bleed_time == "") {
              $bleed_time_message = "";
            } else {
              $bleed_time_message = "Bleed Time: $bleed_time <br/>";
            }
            if ($clot_time == "") {
              $clot_time_message = "";
            } else {
              $clot_time_message = "Clot Time: $clot_time <br/>";
            }
            if ($platelet_count == "") {
              $platelet_count_message = "";
            } else {
              $platelet_count_message = "Platelet Count: $platelet_count <br/>";
            }
            if ($urinalysis_test_type == "") {
              $urinalysis_test_type_message = "";
            } else {
              $urinalysis_test_type_message = "Test Type: $urinalysis_test_type <br/>";
            }
            if ($urinalysis_colour == "") {
              $urinalysis_colour_message = "";
            } else {
              $urinalysis_colour_message = "Urinalysis Colour: $urinalysis_colour <br/>";
            }
            if ($sp_gr == "") {
              $sp_gr_message = "";
            } else {
              $sp_gr_message = "SP GR: $sp_gr <br/>";
            }
            if ($acetone == "") {
              $acetone_message = "";
            } else {
              $acetone_message = "Acetone: $acetone <br/>";
            }
            if ($occ_blood == "") {
              $occ_blood_message = "";
            } else {
              $occ_blood_message = "Occ Blood: $occ_blood <br/>";
            }

            if ($wbc_hff == "") {
              $wbc_hff_message = "";
            } else {
              $wbc_hff_message = "WBC Hff: $wbc_hff <br/>";
            }
            if ($epith_cells == "") {
              $epith_cells_message = "";
            } else {
              $epith_cells_message = "Epith Cells: $epith_cells <br/>";
            }
            if ($appearance == "") {
              $appearance_message = "";
            } else {
              $appearance_message = "Appearance: $appearance <br/>";
            }
            if ($albumin == "") {
              $albumin_message = "";
            } else {
              $albumin_message = "Albumin: $albumin <br/>";
            }
            if ($urobilingen == "") {
              $urobilingen_message = "";
            } else {
              $urobilingen_message = "Urobilingen: $urobilingen <br/>";
            }
            if ($mucus == "") {
              $mucus_message = "";
            } else {
              $mucus_message = "Mucus: $mucus <br/>";
            }
            if ($rbc_hpf == "") {
              $rbc_hpf_message = "";
            } else {
              $rbc_hpf_message = "RBC HPF: $rbc_hpf <br/>";
            }
            if ($casts == "") {
              $casts_message = "";
            } else {
              $casts_message = "Casts: $casts <br/>";
            }

            if ($ph == "") {
              $ph_message = "";
            } else {
              $ph_message = "PH: $ph <br/>";
            }
            if ($glucose == "") {
              $glucose_message = "";
            } else {
              $glucose_message = "Glucose: $glucose <br/>";
            }
            if ($bilirubin == "") {
              $bilirubin_message = "";
            } else {
              $bilirubin_message = "Bilirubin: $bilirubin <br/>";
            }
            if ($crystals == "") {
              $crystals_message = "";
            } else {
              $crystals_message = "Crystals: $crystals <br/>";
            }
            if ($bacteria == "") {
              $bacteria_message = "";
            } else {
              $bacteria_message = "Bacteria: $bacteria <br/>";
            }
            if ($t_vaginalis == "") {
              $t_vaginalis_message = "";
            } else {
              $t_vaginalis_message = "T Vaginalis: $t_vaginalis <br/>";
            }
            if ($microbiology == "") {
              $microbiology_message = "";
            } else {
              $microbiology_message = "Microbiology: $microbiology <br/>";
            }
            if ($routine_appearance == "") {
              $routine_appearance_message = "";
            } else {
              $routine_appearance_message = "Routine Appearance: $routine_appearance <br/>";
            }

            if ($microscopy == "") {
              $microscopy_message = "";
            } else {
              $microscopy_message = "Microscopy: $microscopy <br/>";
            }
            if ($occult_blood == "") {
              $occult_blood_message = "";
            } else {
              $occult_blood_message = "Occult Blood: $occult_blood <br/>";
            }
            if ($parasitology_culture_sensitivity == "") {
              $parasitology_culture_sensitivity_message = "";
            } else {
              $parasitology_culture_sensitivity_message = "Parasitology Culture Sensitivity: $parasitology_culture_sensitivity <br/>";
            }


            if ($skin_ship == "") {
              $skin_ship_message = "";
            } else {
              $skin_ship_message = "Skin Ship: $skin_ship <br/>";
            }
            if ($blood_parasite == "") {
              $blood_parasite_message = "";
            } else {
              $blood_parasite_message = "Blood Parasite: $blood_parasite <br/>";
            }
            if ($blood_group == "") {
              $blood_group_message = "";
            } else {
              $blood_group_message = "Blood Group: $blood_group <br/>";
            }
            if ($rh_factor == "") {
              $rh_factor_message = "";
            } else {
              $rh_factor_message = "Rh Factor: $rh_factor <br/>";
            }
            if ($vdrl_test == "") {
              $vdrl_test_message = "";
            } else {
              $vdrl_test_message = "VDRL Test: $vdrl_test <br/>";
            }


            if ($aso_titre == "") {
              $aso_titre_message = "";
            } else {
              $aso_titre_message = "ASO Titre: $aso_titre <br/>";
            }
            if ($antibody_tire == "") {
              $antibody_tire_message = "";
            } else {
              $antibody_tire_message = "Antibody Tire: $antibody_tire <br/>";
            }
            if ($widal_reaction == "") {
              $widal_reaction_message = "";
            } else {
              $widal_reaction_message = "Widal Reaction: $widal_reaction <br/>";
            }
            if ($rheumatoid_factor == "") {
              $rheumatoid_factor_message = "";
            } else {
              $rheumatoid_factor_message = "Rheumatoid Factor: $rheumatoid_factor <br/>";
            }
            if ($australia_antigen == "") {
              $australia_antigen_message = "";
            } else {
              $australia_antigen_message = "Australia Antigen: $australia_antigen <br/>";
            }
            if ($pregnancy_test == "") {
              $pregnancy_test_message = "";
            } else {
              $pregnancy_test_message = "Pregnancy Test: $pregnancy_test <br/>";
            }
            if ($seminal_analysis == "") {
              $seminal_analysis_message = "";
            } else {
              $seminal_analysis_message = "Seminal Analysis: $seminal_analysis <br/>";
            }
            if ($time_of_collection == "") {
              $time_of_collection_message = "";
            } else {
              $time_of_collection_message = "Time Of Collection: $time_of_collection <br/>";
            }

            if ($examination == "") {
              $examination_message = "";
            } else {
              $examination_message = "Examination: $examination <br/>";
            }
            if ($misc_colour == "") {
              $misc_colour_message = "";
            } else {
              $misc_colour_message = "Color: $misc_colour <br/>";
            }
            if ($volume == "") {
              $volume_message = "";
            } else {
              $volume_message = "Volume: $volume <br/>";
            }
            if ($viscosity == "") {
              $viscosity_message = "";
            } else {
              $viscosity_message = "Viscosity: $viscosity <br/>";
            }
            if ($motility == "") {
              $motility_message = "";
            } else {
              $motility_message = "Motility: $motility <br/>";
            }
            if ($count == "") {
              $count_message = "";
            } else {
              $count_message = "Count: $count <br/>";
            }
            if ($abnormal_forms == "") {
              $abnormal_forms_message = "";
            } else {
              $abnormal_forms_message = "Abnormal Forms: $abnormal_forms <br/>";
            }
            if ($test_reg_by == "") {
              $test_reg_by_message = "";
            } else {
              $test_reg_by_message = "Taken By: $test_reg_by <br/>";
            }
            if ($test_reg_date == "") {
              $test_reg_date_message = "";
            } else {
              $test_reg_date_message = "Date Taken: $test_reg_date <br/>";
            }


            $all_patient_tests .= "<div class='center offset-l4'>
                    <div class='card horizontal'>
                      <div class='card-stacked'>
                        <div class='card-content'>
                          <p>Hospital Number: $hospital_no </p>
                          <p>Unique Identity: $identity</p>
                          <p>Full Name: $full</p>
                          <p>Gender: $gender</p>
                    <br /><br />
                     $hb_message
              $pcv_message
              $wbc_message
              $mchc_message 
              $rbc_message
              $mcv_message
              $p_message 
              $l_message
              $m_message 
              $e_message
              $b_message
              $retics_message 
              $malaria_parasite_message 
              $hb_genotype_message
              $prothromb_time_message
              $control_message 
              $bleed_time_message
              $clot_time_message
              $platelet_count_message
              $urinalysis_test_type_message
              $urinalysis_colour_message
              $sp_gr_message
              $acetone_message 
              $occ_blood_message
              $wbc_hff_message
              $epith_cells_message
              $appearance_message
              $albumin_message
              $urobilingen_message 
              $mucus_message
              $rbc_hpf_message
              $casts_message
              $ph_message
              $glucose_message
              $bilirubin_message
              $crystals_message 
              $bacteria_message
              $t_vaginalis_message
              $microbiology_message 
              $routine_appearance_message
              $microscopy_message 
              $occult_blood_message
              $parasitology_culture_sensitivity_message
              $skin_ship_message
              $blood_parasite_message
              $blood_group_message
              $rh_factor_message 
              $vdrl_test_message
              $aso_titre_message
              $antibody_tire_message
              $widal_reaction_message
              $rheumatoid_factor_message
              $australia_antigen_message
              $pregnancy_test_message 
              $seminal_analysis_message
              $time_of_collection_message
              $examination_message
              $misc_colour_message
              $volume_message
              $viscosity_message 
              $motility_message
              $count_message
              $abnormal_forms_message
              <br/>
              $test_reg_by_message
              $test_reg_date_message  $timeagoTest
                </div>
            </div>
        </div>
    </div>";
          }
          /* End of all patient lab test */

          /* All prescriptions */
          $query2 = "SELECT * FROM prescription WHERE hospital_no= '$hospital_no' ORDER BY pat_id DESC";
          $result2 = mysqli_query($conn, $query2);
          while ($row2 = mysqli_fetch_assoc($result2)) {
            $complaints = $row2['complaints'];
            $observation = $row2['observation'];
            $test = $row2['test'];
            $diagnosis = $row2['diagnosis'];
            $prescriptions = $row2['prescriptions'];
            $prescription_date = $row2['prescription_date'];
            $prescription_by = $row2['prescription_by'];
            $prescription_upd_date = $row2['prescription_upd_date'];
            $prescription_upd_by = $row2['prescription_upd_by'];

            $timeagoPres = get_timeago(strtotime($row2['prescription_date']));
            $timeagoPresUpd = get_timeago(strtotime($row2['prescription_upd_date']));

            $all_patient_prescriptions .= "<div class='center offset-l4'>
                    <div class='card horizontal'>
                      <div class='card-stacked'>
                        <div class='card-content'>
                          <p>Hospital Number: $hospital_no </p>
                          <p>Unique Identity: $identity</p>
                          <p>Full Name: $full</p>
                          <p>Gender: $gender</p>
                          <p class='center'>....................................................</p>
                          <br />
                           <p>Complaints: $complaints </p>
                          <p>Observation: $observation</p>
                          <p>Diagnosis: $diagnosis</p>
                           <p>Test: $test</p>
                            <p>Prescription: $prescriptions </p>
                          <p>Prescription Date: $prescription_date</p>
                          <p>Prescription Time: $timeagoPresUpd</p>
                          <p>Prescribed By: $prescription_upd_by</p>
                </div>
            </div>
        </div>
    </div>
    <div class='divider'></div>
";
          }
          /* End of all prescriptions */
          /* All scans */
          $timeago = "";
          $timeagoUpd = "";
          $xray_upd_date = "";


          $query2 = "SELECT * FROM xray WHERE hospital_no= '$hospital_no' ORDER BY pat_id DESC";
          $result2 = mysqli_query($conn, $query2);

          while ($row2 = mysqli_fetch_assoc($result2)) {
            $xray_no = $row2['xray_no'];
            $tentative_diagnosis = $row2['tentative_diagnosis'];
            $examination_requested = $row2['examination_requested'];
            $size = $row2['size'];
            $previous_xray = $row2['previous_xray'];
            $operation = $row2['operation'];
            $radiographer_comment = $row2['radiographer_comment'];
            $radiologist_report = $row2['radiologist_report'];

            $xray_reg_date = $row2['xray_reg_date'];
            $xray_reg_by = $row2['xray_reg_by'];

            $xray_upd_date = $row2['xray_upd_date'];
            $xray_upd_by = $row2['xray_upd_by'];

            $timeago = get_timeago(strtotime($row2['xray_reg_date']));
            $timeagoUpd = get_timeago(strtotime($row2['xray_upd_date']));

            $all_patient_scans .= "<div class='center offset-l4'>
                    <div class='card horizontal'>
                      <div class='card-stacked'>
                        <div class='card-content'>
                    <table style=‘font-size:90%’ width=‘90%’ border=‘0’ align=‘center’ cellpadding=‘0’ align=‘center’>
                        <tr>
                            <td height=‘26’ colspan=‘5’ style=‘font-size:150% text-align:center color:green’>VIEW SCAN RESULT</td>
                        </tr>
                        <tr>
                            <td rowspan=‘3’ width=‘200’ style=‘color:blue’> $imgp </td>
                            <td width=‘200’ valign=‘top’> <span style=‘color:blue’> Hospital Number:</span><br /> $hospital_no </td>
                            <td width=‘200’ valign=‘top’> <span style=‘color:blue’>Identity:</span><br /> $identity </td>
                            <td width=‘200’ valign=‘top’> <span style=‘color:blue’>Patient Type:</span><br />  $patient_type </td>
                            <td width=‘200’ valign=‘top’> <span style=‘color:blue’> Gender:</span><br />  $gender </td>
                        </tr>
                        <tr>
                            <td width=‘200’ valign=‘top’> <span style=‘color:blue’> First Name:</span><br />  $fname </td>
                            <td valign=‘top’ width=‘200’> <span style=‘color:blue’> Middle Name:</span><br />  $mname </td>
                            <td valign=‘top’ width=‘200’> <span style=‘color:blue’> Last Name:</span><br />  $lname </td>
                            <td valign=‘top’ width=‘200’> <span style=‘color:blue’> Date of Birth:</span><br /> $dob </td>
                        </tr>
                        <tr>
                            <td valign=‘top’ width=‘200’> <span style=‘color:blue’> Age:</span><br /> $age </td>
                            <td valign=‘top’ width=‘200’> <span style=‘color:blue’> Department:</span><br />  $department </td>
                            <td valign=‘top’ width=‘200’ colspan=‘2’> <span style=‘color:blue’> Address:</span><br />  $address </td>
                        </tr>

                        <tr>
                            <td valign=‘top’ width=‘200’ colspan=‘‘> <span style=‘color:blue’> X-ray No:</span><br />  $xray_no </td>
                            <td valign=‘top’ width=‘200’ colspan=‘‘> <span style=‘color:blue’> Tentative Diagnosis:</span><br />  $tentative_diagnosis </td>
                            <td valign=‘top’ width=‘200’ colspan=‘‘> <span style=‘color:blue’> Examination Required:</span><br />  $examination_requested </td>
                            <td valign=‘top’ width=‘200’ colspan=‘‘> <span style=‘color:blue’> Size:</span><br />  $size </td>
                            <td valign=‘top’ width=‘200’ colspan=‘‘> <span style=‘color:blue’> Previous X-Ray?:</span><br />  $previous_xray </td>
                        </tr>
                        <tr>
                            <td valign=‘top’ width=‘200’ colspan=‘‘> <span style=‘color:blue’> Any Operation?:</span><br />  $operation </td>
                            <td valign=‘top’ width=‘200’ colspan=‘2’> <span style=‘color:blue’> Radiographer's Comment:</span><br />  $radiographer_comment </td>
                            <td valign=‘top’ width=‘200’ colspan=‘2’> <span style=‘color:blue’> Radiologist Report:</span><br />  $radiologist_report </td>
                        </tr>
                        <tr>
                            <td valign=‘top’ width=‘200’ colspan=‘‘> <span style=‘color:blue’> Date Taken:</span><br />  $xray_reg_date  <br /> $timeago </td>
                            <td valign=‘top’ width=‘200’ colspan=‘‘> <span style=‘color:blue’> Taken By:</span><br />  $xray_reg_by </td>
                            <td valign=‘top’ width=‘200’ colspan=‘‘> <span style=‘color:blue’> Date Updated:</span><br />  $xray_upd_date  <br /> $timeagoUpd </td>
                            <td valign=‘top’ width=‘200’ colspan=‘‘> <span style=‘color:blue’> Updated By:</span><br />  $xray_upd_by </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class='divider'> </div>
";
          }

          /* End of all scans */
?>

<main>
  <div class="container">

    <div class="row">
      <div class="col s12 m12 l6 center">
        <h5 style='color:green;'>Card No: <?php echo $hospital_no; ?></h5>
        <h6 style='color:green;'>Full Name: <?php echo $full; ?></h6>
      </div>
      <div class="col s12 m12 l8">
        <div class="card-panel">
          <div class="row">
            <form method="POST" class="col s12">
              <div class="row">
                <div class="input-field col s6">
                  <textarea id="complaints" class="materialize-textarea" name="complaints" required="required"></textarea>
                  <label for="complaints">COMPLAINTS</label>
                </div>
                <div class="input-field col s6">
                  <textarea id="observations" class="materialize-textarea" name="observation" required="required"></textarea>
                  <label for="observations">OBSERVATIONS</label>
                </div>

                <?php
                $query = "SELECT * FROM disease_category";
                $result = mysqli_query($conn, $query);
                ?>

                <div class="input-field col s12">
                  <select name="discategory" id="disease_category" onChange="getDiseases(this.value);">
                    <option value="" disabled selected>Choose your option</option>
                    <?php
                    while ($row = mysqli_fetch_assoc($result)) {
                    ?>

                      <option value="<?php echo $row['id']; ?>"><?php echo $row['category_desc']; ?></option>
                    <?php
                    }

                    echo '</select>';
                    ?>
                    <label>WHICH OF THESE BEST DESCRIBE THE CATEGORY OF THE CONDITION?</label>
                </div>

                <div class="input-field col s12 ">
                  <select name="diagnosis" id="disease-list" class="js-example-placeholder-single browser-default">
                    <option value="" disabled selected>Choose your option</option>
                    <input id="make_text" type="hidden" name="make_text" value="" />
                  </select><br /><br />

                  <p class="btn blue block" id='add' name="add_dics">Add Condition</p>
                </div>

                <div class="input-field col s6">
                  <select id="test" name="testOption" required="required">
                    <option value="" disabled selected>Choose your option</option>
                    <option value="yes">YES</option>
                    <option value="no">NO</option>
                  </select>
                  <label>REQUIRED TEST?</label>
                </div>

                <div class="input-field col s6" id="testOption">
                  <input id="first_name" name="testType" type="text" class="validate" placeholder="Specify test here">
                  <label for="first_name">Required Test</label>
                </div>
                <div class="input-field col s6">
                  <textarea id="prescriptions" class="materialize-textarea" name="prescriptions"></textarea>
                  <label for="prescriptions">PRESCRIPTIONS</label>
                </div>

                <button type="submit" name="submit" class="btn blue darken-4 block mt-2">SUBMIT</button>
              </div>

          </div>
        </div>
      </div>
      <div class="col s12 m12 l4">
        <div id="disease_div">
          <table id="dis_table">
            <thead>
              <tr>
                <th>Code</th>
                <th>Description</th>
                <th>Remove</th>
              </tr>
            </thead>

            <tbody id="tbody">
              <!--  <tr>
            <td class="hidden">Alvin</td>
            <td>Eclair</td>
            <td>X</td>
          </tr> -->
            </tbody>
          </table>
        </div>
        <a type="button" id="allergies" class="modal-trigger btn blue darken-4 block mt-2" href="#modal1">PATIENT ALLERGIES</a>
        <a type="button" id="last_vitals" class="modal-trigger btn blue darken-4 block mt-2" href="#modal2">ALL PATIENT'S VITALS</a>
        <a type="button" id="last_test" class="modal-trigger btn blue darken-4 block mt-2" href="#modal3">ALL PATIENT'S TESTS</a>
        <a type="button" id="last_presciption" class="modal-trigger btn blue darken-4 block mt-2" href="#modal4">ALL PRESCRIPTIONS</a>
        <a type="button" id="last_scan" class="modal-trigger btn blue darken-4 block mt-2" href="#modal5">ALL PATIENT's SCANS</a>
      </div>
    </div>
    </form>
  </div>

  <div id="modal1" class="modal modal-fixed-footer" style="width:30%;">
    <div class="modal-content">
      <h4 class="center">PATIENT ALLERGIES</h4>
      <div id="see_allergies"><?php echo $allergies;
                              ?></div>
    </div>
    <div class="modal-footer">
      <a href="#!?hospital_no=<?php echo $hospital_no ?>" class="modal-action modal-close green darken-1 btn-flat ">OK</a>
    </div>
  </div>
  <div id="modal2" class="modal modal-fixed-footer" style="width:30%;">
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
  <div id="modal3" class="modal modal-fixed-footer" style="width:30%;">
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
  <div id="modal4" class="modal modal-fixed-footer" style="width:30%;">
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

<footer></footer>
<script src="../assets/materialize/js/jquery.js"></script>
<script src="../assets/materialize/js/select2.min.js"></script>
<script src="../assets/materialize/js/materialize.js"></script>


<script src="../assets/materialize/js/script.js"></script>

<script>
  /* AJAX code to fetch diseases */
  function getDiseases(val) {
    $.ajax({
      type: "POST",
      url: "getDiseases.php",
      data: "category_id=" + val,
      success: function(data) {
        $("#disease-list").html(data);
      }
    });

  }

  var dataIWantToShow = '1';
  $(document).ready(function() {
    $(".js-example-placeholder-single").select2({
      placeholder: "Select Condition",
      allowClear: true
    });

    /* test option */
    $(function() {
      $('#testOption').hide();
      $('#test').change(function() {
        if ($('#test').val() == 'yes') {
          $('#testOption').show();
        } else {
          $('#testOption').hide();
        }
      });


    });

    // the "href" attribute of the modal trigger must specify the modal ID that wants to be triggered
    $(".modal").modal({
      dismissible: false, // Modal can be dismissed by clicking outside of the modal
      opacity: .5, // Opacity of modal background
      inDuration: 300, // Transition in duration
      outDuration: 200, // Transition out duration
      startingTop: '4%', // Starting top style attribute
      endingTop: '10%', // Ending top style attribute
    });
    /* Javascript for diseases */
    var arrdisease = [];
    $('#add').click(function() {
      var i = 0;
      var e = document.getElementById("disease-list");
      var disVal = e.options[e.selectedIndex].value;
      var disText = e.options[e.selectedIndex].text;
      var descs = disVal + ":" + disText;
      arrdisease.push(descs);
      //alert(arrdisease);

      document.getElementById("make_text").value = arrdisease.join("=>");
      //alert($('#make_text').val());

      // var select = $('#make_text option')
      $('#tbody').append("<tr id='myTableRow'><td> <input t" + disVal + "</td><td>" + disText + "</td><td><button type='button' class='remove'>X</button></td></tr>");

    });

    $(document).on('click', '.remove', function(e) {
      e.preventDefault();
      var delete_row = $(this).data("row");
      $('#myTableRow').remove();
      arrdisease.unpush(descs);
    });

    //$('#see_allergies, #see_last_vitals, #see_last_test, #see_last_presciption, #see_last_scan, #see_all_pat_vitals, #see_all_pat_test, #see_all_pat_presciptions, #see_all_pat_scans').hide();

  });
</script>
</body>

</html>