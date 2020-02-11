<?php
include("../security.php");
include("../includes/dbconfig/dbconfig.php");
include("header.php");

$pet_date = date('Y-m-d');
$hospital_no = $_GET['hospital_no'];
$hospital_no = explode("?", $hospital_no);
$card_no = $hospital_no[0];
$id = explode("=", $hospital_no[1]);
$pat_id = $id[1];
$test_reg_date = date("Y-m-d h:i:sa");
$test_reg_by = $_SESSION['name'];

if ($conn) {
  $result = mysqli_query($conn, "SELECT * FROM patient_record WHERE pat_id='$pat_id' AND  hospital_no = '$card_no'");
  while ($row = mysqli_fetch_Assoc($result)) {
    $hospital_no = $row["hospital_no"];
    $identity = strtoupper($row["identity"]);
    $fname = strtoupper($row["first_name"]);
    $mname = strtoupper($row["middle_name"]);
    $lname = strtoupper($row["last_name"]);
    $passport = $row['passport'];
    $gender = strtoupper($row['gender']);
    $dob = $row['dob'];
    $age = floor(((time() - strtotime($dob))  / (3600 * 24 * 365)));
    $pat_type = $row["patient_type"];
    $fullname = "$lname $fname $mname";
    $fullname = strtoupper($fullname);
    $genotype = $row['genotype'];
    $blood_group = $row['blood_group'];
  }
  if (isset($_POST['submit'])) {
    $hb = $_POST['hb'];
    $pcv = $_POST['pcv'];
    $wbc = $_POST['wbc'];
    $mchc = $_POST['mchc'];
    $rbc = $_POST['rbc'];
    $mcv = $_POST['mcv'];
    $p = $_POST['p'];
    $l = $_POST['l'];
    $m = $_POST['m'];
    $e = $_POST['e'];
    $b = $_POST['b'];
    $retics = $_POST['retics'];
    $malaria_parasite = $_POST['malaria_parasite'];
    $hb_genotype = $_POST['hb_genotype'];
    $proth_time = $_POST['proth_time'];
    $control = $_POST['control'];
    $bleed_time = $_POST['bleed_time'];
    $clot_time = $_POST['clot_time'];
    $plate_count = $_POST['plate_count'];
    $urinalysis = $_POST['urinalysis'];
    $urine_colour = $_POST['urine_colour'];
    $sp_gr = $_POST['sp_gr'];
    $acetone = $_POST['acetone'];
    $occ_blood = $_POST['occ_blood'];
    $wbc_hff = $_POST['wbc_hff'];
    $epith_cells = $_POST['epith_cells'];
    $appearance = $_POST['appearance'];
    $albumin = $_POST['albumin'];
    $urobilingen = $_POST['urobilingen'];
    $mucus = $_POST['mucus'];
    $rbc_hpf = $_POST['rbc_hpf'];
    $casts = $_POST['casts'];
    $ph = $_POST['ph'];
    $glucose = $_POST['glucose'];
    $bilirubin = $_POST['bilirubin'];
    $crystals = $_POST['crystals'];
    $bacteria = $_POST['bacteria'];
    $t_vaginalis = $_POST['t_vaginalis'];
    $microbiology = implode(", ", $_POST['microbiology']);
    $routine_app = $_POST['routine_app'];
    $microscopy = $_POST['microscopy'];
    $occult_blood = $_POST['occult_blood'];
    $cs3 = $_POST['cs3'];
    $skin_ship = $_POST['skin_ship'];
    $blood_parasite = $_POST['blood_parasite'];
    $blood_group = $_POST['blood_group'];
    $rh_factor = $_POST['rh_factor'];
    $vdrl_test = $_POST['vdrl_test'];
    $aso_titre = $_POST['aso_titre'];
    $antibody_tire = $_POST['antibody_tire'];
    $widal_reaction = $_POST['widal_reaction'];
    $rhmtd_factor = $_POST['rhmtd_factor'];
    $austr_antigen = $_POST['austr_antigen'];
    $preg_test = $_POST['preg_test'];
    $seminal_analysis = $_POST['seminal_anal'];
    $time_col = $_POST['time_col'];
    $examination = $_POST['examination'];
    $misc_colour = $_POST['misc_colour'];
    $volume = $_POST['volume'];
    $viscosity = $_POST['viscosity'];
    $motility = $_POST['motility'];
    $count = $_POST['count'];
    $abnormal_forms = $_POST['abnormal_forms'];

    $query_test = "INSERT INTO lab_test(hospital_no, identity, first_name, middle_name, last_name, gender,dob,hb, pcv, wbc, mchc, rbc, mcv, p, l, m, e, b, retics, malaria_parasite, hb_genotype, prothromb_time, control, bleed_time, clot_time, platelet_count, urinalysis_test_type, urinalysis_colour, sp_gr, acetone, occ_blood, wbc_hff, epith_cells, appearance, albumin, urobilingen, mucus, rbc_hpf, casts, ph, glucose, bilirubin, crystals, bacteria, t_vaginalis, microbiology, routine_appearance, microscopy, occult_blood, parasitology_culture_sensitivity, skin_ship, 
    blood_parasite, blood_group, rh_factor, vdrl_test, aso_titre, antibody_tire, widal_reaction, rheumatoid_factor, australia_antigen, pregnancy_test, 
    seminal_analysis, time_of_collection, examination, misc_colour, volume, viscosity, motility, count_, abnormal_forms, test_reg_by, test_reg_date) 
                VALUES ('$card_no', '$identity', '$fname', '$mname', '$lname', '$gender', '$dob', '$hb', '$pcv', '$wbc', '$mchc', '$rbc', '$mcv', '$p', '$l', '$m', '$e', '$b', '$retics', '$malaria_parasite', '$hb_genotype', '$proth_time', '$control', '$bleed_time', '$clot_time', '$plate_count', '$urinalysis', '$urine_colour', '$sp_gr', '$acetone', '$occ_blood', '$wbc_hff', '$epith_cells', '$appearance', '$albumin', '$urobilingen', '$mucus', '$rbc_hpf', '$casts', '$ph', '$glucose', '$bilirubin', '$crystals', '$bacteria', '$t_vaginalis', '$microbiology', '$routine_app', '$microscopy', '$occult_blood', '$cs3', '$skin_ship', 
                '$blood_parasite', '$blood_group', '$rh_factor', '$vdrl_test', '$aso_titre', '$antibody_tire', '$widal_reaction',
                '$rhmtd_factor', '$austr_antigen', '$preg_test', '$seminal_analysis', '$time_col', '$examination', '$misc_colour', '$volume', '$viscosity', '$motility', '$count', '$abnormal_forms', '$test_reg_by', '$test_reg_date')";

    $result_test = mysqli_query($conn, $query_test) or die(mysqli_error($conn));
    if ($result_test) {
      ?>
      <script>
        alert("Patient Test Taken! Click OK to continue");
        window.location.assign("index.php");
      </script>
    <?php
        } else {
          ?>
      <script>
        alert("Error has occured, Please try later! Click OK to continue");
        window.location.assign("tests.php");
      </script>
<?php    }
  }
}
?>

<main>
  <div class="" style="padding-left: 20px; padding-right: 20px;">
    <div class="card-panel gradient-border">
      <div class="row">
        <div class="col m12 s12 l3">
          <p>Hospital No: <?php echo $card_no; ?></p>
        </div>
        <div class="col m12 s12 l3">
          <p>School ID: <?php echo $identity; ?></p>
        </div>
        <div class="col m12 s12 l6">
          <p>Name: <?php echo $fullname; ?></p>
        </div>
        <div class="col m12 s12 l3">
          <p>Patient Type: <?php echo $pat_type; ?></p>
        </div>
        <div class="col m12 s12 l3">
          <p>Age: <?php echo $age; ?></p>
        </div>
        <div class="col m12 s12 l3">
          <p>Sex: <?php echo $gender; ?></p>
        </div>

      </div>
      <div class="container">

      </div>
      <div class="divider"></div>
      <div class="row">
        <div class="">
          <form action="" method="POST">
            <div class="row">
              <div class="container grey lighten-4 block">
                <h5 style="text-align: center; font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">
                  TENTATIVE DIAGNOSIS</h5>
                <h5 style="text-align: center; ">HAEMATOLOGY</h5>
              </div>

              <div class="divider"></div>
              <div class="input-field col s12 l2">
                <input type="text" name="hb" id="hb" />
                <label for="">HB</label>
              </div>

              <div class="input-field col s12 l2">
                <input type="text" name="pcv" id="pcv" />
                <label for="">PCV</label>
              </div>

              <div class="input-field col s12 l2">
                <input type="text" name="wbc" id="wbc" />
                <label for="">WBC</label>
              </div>

              <div class="input-field col s12 l2">
                <input type="text" name="mchc" id="mchc" />
                <label for="mchc">MCHC</label>
              </div>

              <div class="input-field col s12 l2">
                <input type="text" name="rbc" id="rbc" />
                <label for="">RBC</label>
              </div>
              <div class="input-field col s12 l2">
                <input type="text" name="mcv" id="mcv" />
                <label for="">MCV</label>
              </div>

              <div class="container grey lighten-4 col s12 l12">
                <p style="text-align: center;">Diff:</p>
              </div>

              <div class="input-field col s12 l1">
                <input type="text" name="p" id="p" />
                <label for="">P</label>
              </div>
              <div class="input-field col s12 l1">
                <input type="text" name="l" id="l" />
                <label for="">L</label>
              </div>
              <div class="input-field col s12 l2">
                <input type="text" name="m" id="m" />
                <label for="">M</label>
              </div>
              <div class="input-field col s12 l2">
                <input type="text" name="e" id="e" />
                <label for="">E</label>
              </div>
              <div class="input-field col s12 l2">
                <input type="text" name="b" id="b" />
                <label for="">B</label>
              </div>
              <div class="input-field col s12 l2">
                <input type="text" name="retics" id="retics" />
                <label for="">RETICS</label>
              </div>
              <div class="input-field col s12 l2">
                <input type="text" name="malaria_parasite" id="malaria_parasite" />
                <label for="">MALARIA PARASITES</label>
              </div>

              <div class="divider"></div>
              <div class="container grey lighten-4 col s12 l12">
                <p style="text-align: center;">BLOOD FILM</p>
              </div>

              <div class="input-field col s12 l2">
                <input type="text" name="hb_genotype" id="hb_genotype" />
                <label for="">Hb Genotype</label>
              </div>

              <div class="input-field col s12 l2">
                <input type="text" name="proth_time" id="proth_time" />
                <label for="">Prothromb Time</label>
              </div>
              <div class="input-field col s12 l2">
                <input type="text" name="control" id="control" />
                <label for="">Control</label>
              </div>
              <div class="input-field col s12 l2">
                <input type="text" name="bleed_time" id="bleed_time" />
                <label for="">Bleed Time</label>
              </div>
              <div class="input-field col s12 l2">
                <input type="text" name="clot_time" id="clot_time" />
                <label for="">Clot Time</label>
              </div>
              <div class="input-field col s12 l2">
                <input type="text" name="plate_count" id="plate_count" />
                <label for="">Platelet Count</label>
              </div>

              <div class="divider"></div>
              <div class="container grey lighten-4 col s12 l12">
                <h5 style="text-align: center;">URINALYSIS</h5>
                <div class="center">
                  <span>
                    <input class="with-gap" name="urinalysis" type="radio" id="test1" value="Routine" />
                    <label for="test1">Routine</label>
                  </span>
                  <span>
                    <input class="with-gap" name="urinalysis" type="radio" id="test3" value="Culture & Sensitivity" />
                    <label for="test3">Culture & Sensitivity</label>
                  </span>
                </div>
              </div>

              <div class="input-field col s12 l2">
                <input type="text" name="urine_colour" id="colour" />
                <label for="">Colour</label>
              </div>
              <div class="input-field col s12 l2">
                <input type="text" name="sp_gr" id="sp_gr" />
                <label for="">SP. Gr.</label>
              </div>
              <div class="input-field col s12 l2">
                <input type="text" name="acetone" id="acetone" />
                <label for="">Acetone</label>
              </div>
              <div class="input-field col s12 l2">
                <input type="text" name="occ_blood" id="occ_blood" />
                <label for="">Occ. Blood</label>
              </div>
              <div class="input-field col s12 l2">
                <input type="text" name="wbc_hff" id="wbc_hff" />
                <label for="">Wbc/Hff</label>
              </div>
              <div class="input-field col s12 l2">
                <input type="text" name="epith_cells" id="epith_cells" />
                <label for="">Epith/Cells</label>
              </div>
              <div class="input-field col s12 l2">
                <input type="text" name="appearance" id="appearance" />
                <label for="">Appearance</label>
              </div>
              <div class="input-field col s12 l2">
                <input type="text" name="albumin" id="albumin" />
                <label for="">Albumin</label>
              </div>
              <div class="input-field col s12 l2">
                <input type="text" name="urobilingen" id="urobilingen" />
                <label for="">Urobilingen</label>
              </div>
              <div class="input-field col s12 l2">
                <input type="text" name="mucus" id="mucus" />
                <label for="">Mucus</label>
              </div>
              <div class="input-field col s12 l2">
                <input type="text" name="rbc_hpf" id="rbc_hpf" />
                <label for="">Rbc/Hpf</label>
              </div>
              <div class="input-field col s12 l2">
                <input type="text" name="casts" id="casts" />
                <label for="">Casts</label>
              </div>
              <div class="input-field col s12 l2">
                <input type="text" name="ph" id="ph" />
                <label for="">PH</label>
              </div>
              <div class="input-field col s12 l2">
                <input type="text" name="glucose" id="glucose" />
                <label for="">Glucose</label>
              </div>
              <div class="input-field col s12 l2">
                <input type="text" name="bilirubin" id="bilirubin" />
                <label for="">Bilirubin</label>
              </div>
              <div class="input-field col s12 l2">
                <input type="text" name="crystals" id="crystals" />
                <label for="">Crystals</label>
              </div>
              <div class="input-field col s12 l2">
                <input type="text" name="bacteria" id="bacteria" />
                <label for="">Bacteria</label>
              </div>
              <div class="input-field col s12 l2">
                <input type="text" name="t_vaginalis" id="casts" />
                <label for="">T. Vaginalis</label>
              </div>
              <div class="divider"></div>

              <div class="container grey lighten-4 col s12 l12">
                <div class="col s12 l12">
                  <h5 style=" text-align: center;">MICROBIOLOGY</h5>
                </div>
              </div>
              <div class="col s12 l12">
                <div class="row">
                  <div class="input-field col s12 l2">
                    <p>
                      <input type="checkbox" class="filled-in" name="microbiology[]" id="gso" value="Gram Stain Only" />
                      <label for="gso">Gram Stain Only</label>
                    </p>
                  </div>
                  <div class="input-field col s12 l3">
                    <p>
                      <input type="checkbox" class="filled-in" name="microbiology[]" id="cs" value="Culture & Sensitivity" />
                      <label for="cs">Culture & Sensitivity</label>
                    </p>
                  </div>
                  <div class="input-field col s12 l1">
                    <p>
                      <input type="checkbox" class="filled-in" name="microbiology[]" id="csf" value="CSF" />
                      <label for="csf">CSF</label>
                    </p>
                  </div>
                  <div class="input-field col s12 l1">
                    <p>
                      <input type="checkbox" class="filled-in" name="microbiology[]" id="hvs" value="H.V.S">
                      <label for="hvs">H.V.S.</label>
                    </p>
                  </div>
                  <div class="input-field col s12 l1">
                    <p>
                      <input type="checkbox" class="filled-in" name="microbiology[]" id="nsl" value="Nasal">
                      <label for="nsl">Nasal</label>
                    </p>
                  </div>
                  <div class="input-field col s12 l1">
                    <p>
                      <input type="checkbox" class="filled-in" name="microbiology[]" id="ear" value="Ear" />
                      <label for="ear">Ear</label>
                    </p>
                  </div>
                  <div class="input-field col s12 l2">
                    <p>
                      <input type="checkbox" class="filled-in" name="microbiology[]" id="utl" value="Urethral">
                      <label for="utl">Urethral</label>
                    </p>
                  </div>
                  <div class="input-field col s12 l2">
                    <p>
                      <input type="checkbox" class="filled-in" name="microbiology[]" id="spm" value="Sputum" />
                      <label for="spm">Sputum</label>
                    </p>
                  </div>
                  <div class="input-field col s12 l1">
                    <p>
                      <input type="checkbox" class="filled-in" name="microbiology[]" id="wnd" value="Wound">
                      <label for="wnd">Wound</label>
                    </p>
                  </div>
                </div>
              </div>


              <div class=""></div>
              <div class="divider"></div>
              <div class="container grey lighten-4 col s12 l12">
                <h5 style="text-align: center;">PARASITOLOGY (Stool Examination)</h5>
              </div>
              <div class="input-field col s12 l2">
                <input type="text" name="routine_app" id="routine_app" />
                <label for="">Routine Appearance</label>
              </div>
              <div class="input-field col s12 l2">
                <input type="text" name="microscopy" id="microscopy" />
                <label for="">Microscopy</label>
              </div>
              <div class="input-field col s12 l2">
                <input type="text" name="occult_blood" id="occult_blood" />
                <label for="">Occult Blood</label>
              </div>
              <div class="input-field col s12 l2">
                <input type="text" name="cs3" id="cs3" />
                <label for="">Culture & Sensitivity</label>
              </div>
              <div class="input-field col s12 l2">
                <input type="text" name="skin_ship" id="skin_ship" />
                <label for="">Skin Ship</label>
              </div>
              <div class="input-field col s12 l2">
                <input type="text" name="blood_parasite" id="blood_parasite" />
                <label for="">Blood Parasite</label>
              </div>
              <div class="divider"></div>
              <div class="container grey lighten-4 col s12 l12">
                <h5 style="text-align: center;">BLOOD SEROLOGY</h5>
              </div>
              <div class="input-field col s12 l2">
                <input type="text" name="blood_group" id="blood_group" />
                <label for="">Blood Group</label>
              </div>
              <div class="input-field col s12 l2">
                <input type="text" name="rh_factor" id="rh_factor" />
                <label for="">Rh Factor</label>
              </div>
              <div class="input-field col s12 l2">
                <input type="text" name="vdrl_test" id="vdrl_test" />
                <label for="">VDRL Test</label>
              </div>
              <div class="input-field col s12 l2">
                <input type="text" name="aso_titre" id="aso_titre" />
                <label for="">ASO Titre</label>
              </div>
              <div class="input-field col s12 l2">
                <input type="text" name="antibody_tire" id="antibody_tire" />
                <label for="">Antibody Tire</label>
              </div>
              <div class="input-field col s12 l2">
                <input type="text" name="widal_reaction" id="widal_reaction" />
                <label for="">Widal Reaction</label>
              </div>
              <div class="input-field col s12 l2">
                <input type="text" name="rhmtd_factor" id="rhmtd_factor" />
                <label for="">Rheumatoid Factor</label>
              </div>
              <div class="input-field col s12 l2">
                <input type="text" name="austr_antigen" id="austr_antigen" />
                <label for="">Australia Antigen</label>
              </div>

              <div class="divider"></div>
              <div class="container grey lighten-4 col s12 l12">
                <h5 style="text-align: center;">MISCELLANEOUS</h5>
              </div>
              <div class="input-field col s12 l2">
                <input type="text" name="preg_test" id="preg_test" />
                <label for="">Pregnancy Test</label>
              </div>
              <div class="input-field col s12 l2">
                <input type="text" name="seminal_anal" id="seminal_anal" />
                <label for="">Seminal Analysis</label>
              </div>
              <div class="input-field col s12 l2">
                <input type="text" name="time_col" id="time_col" />
                <label for="">Time of Collection</label>
              </div>
              <div class="input-field col s12 l2">
                <input type="text" name="examination" id="examination" />
                <label for="">Examination</label>
              </div>
              <div class="input-field col s12 l2">
                <input type="text" name="misc_colour" id="misc_colour" />
                <label for="">Colour</label>
              </div>
              <div class="input-field col s12 l2">
                <input type="text" name="volume" id="volume" />
                <label for="">Volume</label>
              </div>
              <div class="input-field col s12 l2">
                <input type="text" name="viscosity" id="viscosity" />
                <label for="">Viscosity</label>
              </div>
              <div class="input-field col s12 l2">
                <input type="text" name="motility" id="motility" />
                <label for="">Motility</label>
              </div>
              <div class="input-field col s12 l2">
                <input type="text" name="count" id="count" />
                <label for="">Count</label>
              </div>
              <div class="input-field col s12 l2">
                <input type="text" name="abnormal_forms" id="abnormal_forms" />
                <label for="">Abnormal Forms %</label>
              </div>

            </div>


        </div>
        <div class="input-field">
          <button type="submit" class="waves-effect waves-dark btn gradient right" name="submit">
            Submit Vitals
          </button>
        </div>

        </form>
      </div>
    </div>
  </div>

</main>
<footer></footer>

<script src="../assets/materialize/js/jquery.js"></script>
<script src="../assets/materialize/js/materialize.js"></script>
<script src="../assets/materialize/js/script.js"></script>
</body>

</html>