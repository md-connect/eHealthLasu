<?php
include("../security.php");
include("header.php");
include("../includes/dbconfig/dbconfig.php");


//to gerate year in hospital_no 
$year = date("Y");





$status = "";


$registered_by = $_SESSION['username'];


if (isset($_POST['submit'])) {
	//generating random serial number from 100 to 80100
	//it can only generate 80,000 numbers
	$serial = (mt_rand(100, 80100));
	$mainSerial = sprintf("%05d", $serial);

	//final hospital number containing string, year and random serial
	$hospital_no = "LHC/" . $year . '/' . $mainSerial;
	//still need to loop main serial every year so that the it wont exhaust after getting to the last number
	$fname = $_POST['first_name'];
	$mname = $_POST['middle_name'];
	$lname = $_POST['surname'];
	$nationality = $_POST['nationality'];
	$state = $_POST['state'];
	$ethnic_group = $_POST['ethnic'];
	$gender = $_POST['gender'];
	$mStatus = $_POST['maritalstatus'];
	$patient_type = $_POST["pat_type"];
	$identity = $_POST['identity'];
	$dob = $_POST['bdate'];
	$year_of_admission = $_POST['year_of_admission'];

	$religion = $_POST['religion'];
	$passport = $_FILES['passport']['name'];
	$temp = $_FILES['passport']['tmp_name'];
	$types = $_FILES['passport']['type'];
	$password = password_hash($lname, PASSWORD_DEFAULT);
	$phone = $_POST['phone'];
	$address = $_POST['raddress'];
	$town = $_POST['town'];
	$residence_state = $_POST['rstate'];
	$raddress = "$address $town $residence_state";
	$email = $_POST['email'];
	$next_of_kin_name = $_POST['kin_name'];
	$next_of_kin_relationship = $_POST['kin_relationship'];
	$next_of_kin_phone = $_POST['kin_phone'];
	$next_of_kin_address = $_POST['kin_address'];
	$guardian_name = $_POST['guardian_name'];
	$guardian_relationship = $_POST['guardian_relationship'];
	$guardian_phone = $_POST['guardian_phone'];
	$guardian_address = $_POST['guardian_address'];

	if ($patient_type == "STUDENT" || ($patient_type == "STAFF" && $mStatus == "SINGLE")) {
		///spouse's form input
		$spouse_fname = "";
		$spouse_mname = "";
		$spouse_surname = "";
		$spouse_nationality = "";
		$spouse_state = "";
		$spouse_ethnic = "";
		$spouse_gender = "";
		$spouse_religion = "";
		$spouse_dob = "";
		$spouse_addr = "";
		$spouse_town = "";
		$spouse_address =  "";
		$spouse_email = "";
		$spouse_phone = "";
		$spouse_passport = "";
		$spouse_password = "";


		$confirmQuery = "SELECT * FROM patient_record WHERE identity='$identity' ";
		$confirmResullt = mysqli_query($conn, $confirmQuery);
		if (mysqli_num_rows($confirmResullt) >= 1) {
?>
			<script>
				alert("Patient Identity Already Exists");
				window.location.assign("index.php");
			</script>
			<?php
		} else {
			if (($types == "image/jpeg") || ($types == "image/jpg") || ($types == "image/bmp") || ($types == "image/png") || ($types == "")) {
				$tempx = explode(".", $passport);
				$passportname = $fname . "_" . time() . "." . end($tempx);

				if ($patient_type == "STUDENT") {
					$query_insert = "INSERT INTO patient_record (hospital_no, identity, patient_type, first_name, middle_name, last_name, gender, nationality, ethnic_group, state, dob, year_of_admission, marital_status, religion, phone, address, next_of_kin_name, next_of_kin_relationship, next_of_kin_phone, next_of_kin_address, email, guardian_name, guardian_relationship, guardian_phone, guardian_address, date_of_entry, registered_by, passport, pwd)
						 						VALUES ('$hospital_no','$identity', '$patient_type', '$fname', '$mname', '$lname', '$gender', '$nationality', '$ethnic_group', '$state', '$dob','$year_of_admission', '$mStatus', '$religion', '$phone', '$raddress', '$next_of_kin_name', '$next_of_kin_relationship', '$next_of_kin_phone', '$next_of_kin_address', '$email', '$guardian_name', '$guardian_relationship', '$guardian_phone', '$guardian_address', '$year_of_admission', '$registered_by', '$passportname', '$password')";
				} elseif ($patient_type == "STAFF" && $mStatus == "SINGLE") {
					$query_insert = "INSERT INTO patient_record (hospital_no, identity, patient_type, first_name, middle_name, last_name, gender, nationality, ethnic_group, state, dob, year_of_admission, marital_status, religion, phone, address, next_of_kin_name, next_of_kin_relationship, next_of_kin_phone, next_of_kin_address, email, date_of_entry, registered_by, passport, pwd)
						 						VALUES ('$hospital_no','$identity', '$patient_type', '$fname', '$mname', '$lname', '$gender', '$nationality', '$ethnic_group', '$state', '$dob','$year_of_admission', '$mStatus', '$religion', '$phone', '$raddress', '$next_of_kin_name', '$next_of_kin_relationship', '$next_of_kin_phone', '$next_of_kin_address', '$email', '$year_of_admission', '$registered_by', '$passportname', '$password')";
				}

				if ($query = mysqli_query($conn, $query_insert)) {
					move_uploaded_file($temp, "../passport/$passportname");
					$status .= "<b style='color:green'>SUCCESS!</b>";
			?>
					<script>
						alert("Patient Successfully registered! Click OK to continue");
						window.location.assign("index.php");
					</script>
				<?php
				} else {
					$status .= "<b style='color:red'>ERROR HAS OCCURED</b>";
				?>
					<script>
						alert("Error has occured, please try again!");
						window.location.assign("registerpatient.php");
					</script>
			<?php
				}
			} else {
				$status .= "<b style='color:red, background:yellow;'>Image is not a supported filetype</b>";
			}
		}
	} elseif ($patient_type == "STAFF" && $mStatus == "MARRIED") {
		///spouse's form input
		$spouse_fname = $_POST['spouse_fname'];
		$spouse_mname = $_POST['spouse_mname'];
		$spouse_surname = $_POST['spouse_surname'];
		$spouse_nationality = $_POST['spouse_nationality'];
		$spouse_state = $_POST['spouse_state'];
		$spouse_ethnic = $_POST['spouse_ethnic'];
		$spouse_gender = $_POST['spouse_gender'];
		$spouse_religion = $_POST['spouse_religion'];
		$spouse_dob = $_POST['spouse_dob'];
		$spouse_addr = $_POST['spouse_addr'];
		$spouse_town = $_POST['spouse_town'];
		$spouse_address = "$spouse_addr $spouse_town $spouse_state";
		$spouse_email = $_POST['spouse_email'];
		$spouse_phone = $_POST['spouse_phone'];
		$spouse_passport = $_FILES['spouse_passport']['name'];
		$temp2 = $_FILES['spouse_passport']['tmp_name'];
		$types2 = $_FILES['spouse_passport']['type'];
		$spouse_password = password_hash($spouse_surname, PASSWORD_DEFAULT);

		/* Checking if staff records already exist */
		$confirmQuery = "SELECT * FROM patient_record WHERE identity='$identity' ";
		$confirmResullt = mysqli_query($conn, $confirmQuery);
		if (mysqli_num_rows($confirmResullt) >= 1) {
			?>
			<script>
				alert("Patient Identity Already Exists");
				//window.location.assign("index.php");
			</script>
			<?php
		} else {
			if (($types && $types2 == "image/jpeg") || ($types && $types2 == "image/jpg") || ($types && $types2 == "image/bmp") || ($types && $types2 == "image/png") || ($types && $types2 == "")) {
				$tempx = explode(".", $passport);
				$tempx2 = explode(".", $spouse_passport);
				$passportname = $fname . "_" . time() . "." . end($tempx);
				$spouse_passportname = $spouse_fname . "_" . time() . "." . end($tempx2);
				//echo $mStatus;
				$query_insert_staff = "INSERT INTO patient_record (hospital_no, identity, patient_type, first_name, middle_name, last_name, gender, nationality, ethnic_group, state, dob, marital_status, religion, phone, address, next_of_kin_name, next_of_kin_relationship, next_of_kin_phone, next_of_kin_address, email, date_of_entry, registered_by, passport, pwd)
							VALUES ('$hospital_no','$identity', '$patient_type', '$fname', '$mname', '$lname', '$gender', '$nationality', '$ethnic_group', '$state', '$dob', '$mStatus', '$religion', '$phone', '$raddress', '$next_of_kin_name', '$next_of_kin_relationship', '$next_of_kin_phone', '$next_of_kin_address', '$email', '$year_of_admission', '$registered_by', '$passportname', '$password')";

				$query_insert_staff_spouse = "INSERT INTO patient_record (hospital_no, identity, patient_type, first_name, middle_name, last_name, gender, nationality, ethnic_group, state, dob, marital_status, religion, phone, address, next_of_kin_name, next_of_kin_relationship, next_of_kin_phone, next_of_kin_address, email, date_of_entry, registered_by, passport, pwd)
							VALUES ('$hospital_no', 'NIL', 'DEPENDANT', '$spouse_fname', '$spouse_mname', '$spouse_surname', '$spouse_gender', '$spouse_nationality', '$spouse_ethnic', '$spouse_state', '$spouse_dob', '$mStatus', '$spouse_religion', '$spouse_phone', '$spouse_address', '$lname $fname $mname', 'Spouse', '$phone', '$raddress', '$spouse_email', '$year_of_admission', '$registered_by', '$spouse_passportname', '$spouse_password')";


				if ($query = mysqli_query($conn, $query_insert_staff) && $query2 = mysqli_query($conn, $query_insert_staff_spouse)) {
					move_uploaded_file($temp, "../passport/$passportname");
					move_uploaded_file($temp2, "../passport/$spouse_passportname");
					$status .= "<b style='color:green'>SUCCESS!</b>";
			?>
					<script>
						alert("Patient Successfully registered! Click OK to continue");
						//window.location.assign("index.php");
					</script>
				<?php
				} else {
					$status .= "<b style='color:red'>ERROR HAS OCCURED</b>";
				?>
					<script>
						alert("Error has occured, please try again!");
						/* window.location.assign("registerpatient.php"); */
					</script>
<?php
				}
			} else {
				$status .= "<b style='color:red, background:yellow;'>Image is not a supported filetype</b>";
			}
		}
	}
}
echo " <div class='center offset-l4'> $status <br></div>";


?>

<main>
	<div class="row mt-2">
		<div class="col s12">
			<div class="row">
				<div id="admin" class="col s12">
					<h5>PATIENT REGISTRATION FORM</h5>
					<div class="card-panel">
						<form method="POST" enctype="multipart/form-data">
							<ul class="stepper horizontal linear demos">
								<li class="step">
									<div data-step-label="Personal Details" class="step-title dark">
										Step 1
									</div>

									<div class="step-content">
										<div class="row">
											<div class="input-field col s12 l3">
												<input type="text" name="first_name" id="" />
												<label for="">First Name</label>
											</div>

											<div class="input-field col s12 l3">
												<input type="text" name="middle_name" id="" />
												<label for="">Middle Name</label>
											</div>

											<div class="input-field col s12 l3">
												<input type="text" name="surname" id="" />
												<label for="">Surname</label>
											</div>

											<div class="input-field col s12 l3">
												<select name="nationality" class="validate">
													<option value="" disabled selected>Choose your option</option>
													<option value="NIGERIA">NIGERIA</option>
													<option value="GHANA">GHANA</option>
													<option value="TUNISIA">TUNISIA</option>
												</select>
												<label>NATIONALITY</label>
											</div>
											<div class="input-field col s12 l3">
												<?php
												$queryState = "SELECT * FROM state";
												$result = mysqli_query($conn, $queryState);
												?>
												<select name="state" id="state">
													<option value="" disabled selected>Choose your option</option>
													<?php
													while ($row = mysqli_fetch_assoc($result)) {
													?>
														<option value="<?php echo $row['state'] . " "; ?> state"><?php echo $row['state'] . " "; ?>state</option>
													<?php
													}
													?>
												</select>
												<label>STATE OF ORIGIN</label>
											</div>

											<div class="input-field col s12 l3">
												<select name="ethnic" class="ethnic browser-default">
													<option value="" disabled selected>Choose your Ethic Group</option>
													<option value='Abayon Cross River'> Abayon Cross River </option>
													<option value='Abua (Odual) Rivers'> Abua (Odual) Rivers </option>
													<option value='Achipa (Achipawa) Kebbi'> Achipa (Achipawa) Kebbi </option>
													<option value='Adim Cross River'> Adim Cross River </option>
													<option value='Adun Cross River'> Adun Cross River </option>
													<option value='Affade Yobe'> Affade Yobe </option>
													<option value='Afizere Plateau'> Afizere Plateau </option>
													<option value='Afo Plateau'> Afo Plateau </option>
													<option value='Agbo Cross River'> Agbo Cross River </option>
													<option value='Akaju-Ndem (Akajuk) Cross River'> Akaju-Ndem (Akajuk) Cross River </option>
													<option value='Akweya-Yachi Benue'> Akweya-Yachi Benue </option>
													<option value='Alago (Arago) Plateau'> Alago (Arago) Plateau </option>
													<option value='Amo Plateau'> Amo Plateau </option>
													<option value='Anaguta Plateau'> Anaguta Plateau </option>
													<option value='Anang Akwa lbom'> Anang Akwa lbom </option>
													<option value='Andoni'> Andoni </option>
													<option value='Angas'> Angas </option>
													<option value='Ankwei Plateau'> Ankwei Plateau </option>
													<option value='Anyima Cross River'> Anyima Cross River </option>
													<option value='Attakar (ataka) Kaduna'> Attakar (ataka) Kaduna </option>
													<option value='Auyoka (Auyokawa) Jigawa'> Auyoka (Auyokawa) Jigawa </option>
													<option value='Awori'> Awori </option>
													<option value='Ayu Kaduna'> Ayu Kaduna </option>
													<option value='Babur'> Babur </option>
													<option value='Bachama Adamawa'> Bachama Adamawa </option>
													<option value='Bachere Cross River'> Bachere Cross River </option>
													<option value='Bada Plateau'> Bada Plateau </option>
													<option value='Bade Yobe'> Bade Yobe </option>
													<option value='Bahumono Cross River'> Bahumono Cross River </option>
													<option value='Bakulung Taraba'> Bakulung Taraba </option>
													<option value='Bali Taraba'> Bali Taraba </option>
													<option value='Bambora (Bambarawa) Bauchi'> Bambora (Bambarawa) Bauchi </option>
													<option value='Bambuko Taraba'> Bambuko Taraba </option>
													<option value='Banda (Bandawa) Taraba'> Banda (Bandawa) Taraba </option>
													<option value='Banka (Bankalawa) Bauchi'> Banka (Bankalawa) Bauchi </option>
													<option value='Banso (Panso) Adamawa'> Banso (Panso) Adamawa </option>
													<option value='Bara (Barawa) Bauchi'> Bara (Barawa) Bauchi </option>
													<option value='Barke Bauchi'> Barke Bauchi </option>
													<option value='Baruba (Barba) Niger'> Baruba (Barba) Niger </option>
													<option value='Bashiri (Bashirawa) Plateau'> Bashiri (Bashirawa) Plateau </option>
													<option value='Bassa'> Bassa </option>
													<option value='Batta Adamawa'> Batta Adamawa </option>
													<option value='Baushi Niger'> Baushi Niger </option>
													<option value='Baya Adamawa'> Baya Adamawa </option>
													<option value='Bekwarra Cross River'> Bekwarra Cross River </option>
													<option value='Bele (Buli, Belewa) Bauchi'> Bele (Buli, Belewa) Bauchi </option>
													<option value='Betso (Bete) Taraba'> Betso (Bete) Taraba </option>
													<option value='Bette Cross River'> Bette Cross River </option>
													<option value='Bilei Adamawa'> Bilei Adamawa </option>
													<option value='Bille Adamawa'> Bille Adamawa </option>
													<option value='Bina (Binawa) Kaduna'> Bina (Binawa) Kaduna </option>
													<option value='Bini Edo'> Bini Edo </option>
													<option value='Birom Plateau'> Birom Plateau </option>
													<option value='Bobua Taraba'> Bobua Taraba </option>
													<option value='Boki (Nki) Cross River'> Boki (Nki) Cross River </option>
													<option value='Bkkos Plateau'> Bkkos Plateau </option>
													<option value='Boko (Bussawa, Bargawa) Niger'> Boko (Bussawa, Bargawa) Niger </option>
													<option value='Bole (Bolewa) Bauchi, Yobe'> Bole (Bolewa) Bauchi, Yobe </option>
													<option value='Botlere Adamawa'> Botlere Adamawa </option>
													<option value='Boma (Bomawa, Burmano) Bauchi'> Boma (Bomawa, Burmano) Bauchi </option>
													<option value='Bomboro Bauchi'> Bomboro Bauchi </option>
													<option value='Buduma Borno, Niger'> Buduma Borno, Niger </option>
													<option value='Buji Plateau'> Buji Plateau </option>
													<option value='Buli Bauchi'> Buli Bauchi </option>
													<option value='Bunu Kogi'> Bunu Kogi </option>
													<option value='Bura Adamawa, Borno'> Bura Adamawa, Borno </option>
													<option value='Burak Bauchi'> Burak Bauchi </option>
													<option value='Burma (Burmawa) Plateau'> Burma (Burmawa) Plateau </option>
													<option value='Buru Yobe'> Buru Yobe </option>
													<option value='Buta (Butawa) Bauchi'> Buta (Butawa) Bauchi </option>
													<option value='Bwall Plateau'> Bwall Plateau </option>
													<option value='Bwatiye Adamawa'> Bwatiye Adamawa </option>
													<option value='Bwazza Adamawa'> Bwazza Adamawa </option>
													<option value='Challa Plateau'> Challa Plateau </option>
													<option value='Chama (Chamawa Fitilai) Bauchi'> Chama (Chamawa Fitilai) Bauchi </option>
													<option value='Chamba Taraba'> Chamba Taraba </option>
													<option value='Chamo Bauchi'> Chamo Bauchi </option>
													<option value='Chibok (Chibbak) Yobe'> Chibok (Chibbak) Yobe </option>
													<option value='Chinine Borno'> Chinine Borno </option>
													<option value='Chip Plateau'> Chip Plateau </option>
													<option value='Chokobo Plateau'> Chokobo Plateau </option>
													<option value='Chukkol Taraba'> Chukkol Taraba </option>
													<option value='Daba Adamawa'> Daba Adamawa </option>
													<option value='Dadiya Bauchi'> Dadiya Bauchi </option>
													<option value='Daka Adamawa'> Daka Adamawa </option>
													<option value='Dakarkari Niger, Kebbi'> Dakarkari Niger, Kebbi </option>
													<option value='Danda (Dandawa) Kebbi'> Danda (Dandawa) Kebbi </option>
													<option value='Dangsa Taraba'> Dangsa Taraba </option>
													<option value='Daza (Dere, Derewa) Bauchi'> Daza (Dere, Derewa) Bauchi </option>
													<option value='Degema Rivers'> Degema Rivers </option>
													<option value='Deno (Denawa) Bauchi'> Deno (Denawa) Bauchi </option>
													<option value='Dghwede Bomo'> Dghwede Bomo </option>
													<option value='Diba Taraba'> Diba Taraba </option>
													<option value='Doemak (Dumuk) Plateau'> Doemak (Dumuk) Plateau </option>
													<option value='Ouguri Bauchi'> Ouguri Bauchi </option>
													<option value='Duka (Dukawa) Kebbi'> Duka (Dukawa) Kebbi </option>
													<option value='Duma (Dumawa) Bauchi'> Duma (Dumawa) Bauchi </option>
													<option value='Ebana (Ebani) Rivers'> Ebana (Ebani) Rivers </option>
													<option value='Ebirra (lgbirra)'> Ebirra (lgbirra) </option>
													<option value='Ebu Edo, Kogi'> Ebu Edo, Kogi </option>
													<option value='Efik Cross River'> Efik Cross River </option>
													<option value='Egbema Rivers'> Egbema Rivers </option>
													<option value='Egede (lgedde) Benue'> Egede (lgedde) Benue </option>
													<option value='Eggon Plateau'> Eggon Plateau </option>
													<option value='Egun (Gu)'> Egun (Gu) </option>
													<option value='Ejagham Cross River'> Ejagham Cross River</option>
													<option value='Ekajuk Cross River'> Ekajuk Cross River </option>
													<option value='Eket Akwa Ibom'> Eket Akwa Ibom </option>
													<option value='Ekoi Cross River'> Ekoi Cross River </option>
													<option value='Engenni (Ngene) Rivers'> Engenni (Ngene) Rivers </option>
													<option value='Epie Rivers'> Epie Rivers </option>
													<option value='Esan (Ishan) Edo'> Esan (Ishan) Edo </option>
													<option value='Etche Rivers'> Etche Rivers </option>
													<option value='Etolu (Etilo) Benue'> Etolu (Etilo) Benue </option>
													<option value='Etsako Edo'> Etsako Edo </option>
													<option value='Etung Cross River'> Etung Cross River </option>
													<option value='Etuno Edo'> Etuno Edo </option>
													<option value='Palli Adamawa'> Palli Adamawa </option>
													<option value='Pulani (Pulbe)'> Pulani (Pulbe) </option>
													<option value='Fyam (Fyem) Plateau'> Fyam (Fyem) Plateau </option>
													<option value='Fyer(Fer) Plateau'> Fyer(Fer) Plateau </option>
													<option value='Ga’anda Adamawa'> Ga’anda Adamawa </option>
													<option value='Gade Niger'> Gade Niger</option>
													<option value='Galambi Bauchi'> Galambi Bauchi </option>
													<option value='Gamergu-Mulgwa Bomo'> Gamergu-Mulgwa Bomo </option>
													<option value='Qanawuri Plateau'> Qanawuri Plateau </option>
													<option value='Gavako Borno'> Gavako Borno </option>
													<option value='Gbedde Kogi'> Gbedde Kogi </option>
													<option value='Gengle Taraba'> Gengle Taraba </option>
													<option value='Geji Bauchi'> Geji Bauchi </option>
													<option value='Gera (Gere, Gerawa) Bauchi'> Gera (Gere, Gerawa) Bauchi </option>
													<option value='Geruma (Gerumawa) Plateau'> Geruma (Gerumawa) Plateau </option>
													<option value='Geruma (Gerumawa) Bauchi'> Geruma (Gerumawa) Bauchi </option>
													<option value='Gingwak Bauchi'> Gingwak Bauchi </option>
													<option value='Gira Adamawa'> Gira Adamawa </option>
													<option value='Gizigz Adamawa'> Gizigz Adamawa </option>
													<option value='Goernai Plateau'> Goernai Plateau </option>
													<option value='Gokana (Kana) Rivers'> Gokana (Kana) Rivers </option>
													<option value='Gombi Adamawa'> Gombi Adamawa </option>
													<option value='Gornun (Gmun) Taraba'> Gornun (Gmun) Taraba </option>
													<option value='Gonia Taraba'> Gonia Taraba </option>
													<option value='Gubi (Gubawa) Bauchi'> Gubi (Gubawa) Bauchi </option>
													<option value='Gude Adamawa'> Gude Adamawa </option>
													<option value='Gudu Adamawa'> Gudu Adamawa </option>
													<option value='Gure Kaduna'> Gure Kaduna </option>
													<option value='Gurmana Niger'> Gurmana Niger </option>
													<option value='Gururntum Bauchi'> Gururntum Bauchi </option>
													<option value='Gusu Plateau'> Gusu Plateau </option>
													<option value='Gwa (Gurawa) Adamawa'> Gwa (Gurawa) Adamawa </option>
													<option value='Gwamba Adamawa'> Gwamba Adamawa </option>
													<option value='Gwandara Kaduna, Niger, Plateau'> Gwandara Kaduna, Niger, Plateau </option>
													<option value='Gwari (Gbari) Kaduna, Niger, Plateau'> Gwari (Gbari) Kaduna, Niger, Plateau </option>
													<option value='Gwom Taraba'> Gwom Taraba </option>
													<option value='Gwoza (Waha) Bomo'> Gwoza (Waha) Bomo </option>
													<option value='Gyem Bauchi'> Gyem Bauchi </option>
													<option value='Hausa'> Hausa </option>
													<option value='Higi (Hig) Borno, Adamawa'> Higi (Hig) Borno, Adamawa </option>
													<option value='Holma Adamawa'> Holma Adamawa </option>
													<option value='Hona Adamawa'> Hona Adamawa </option>
													<option value='Ibeno Akwa lbom'> Ibeno Akwa lbom </option>
													<option value='Ibibio Akwa lbom'> Ibibio Akwa lbom </option>
													<option value='Ichen Adamawa'> Ichen Adamawa </option>
													<option value='Idoma Benue, Taraba'> Idoma Benue, Taraba </option>
													<option value='Igalla Kogi'> Igalla Kogi </option>
													<option value='lgbo'> lgbo </option>
													<option value='ljumu Kogi'> ljumu Kogi </option>
													<option value='Ikorn Cross River'> Ikorn Cross River </option>
													<option value='Irigwe Plateau'> Irigwe Plateau </option>
													<option value='Isoko Delta'> Isoko Delta </option>
													<option value='Ekajuk Cross River'> Ekajuk Cross River </option>
													<option value='lsekiri (Itsekiri) Delta'> lsekiri (Itsekiri) Delta </option>
													<option value='lyala (lyalla) Cross River'> lyala (lyalla) Cross River </option>
													<option value='lzondjo (Bayelsa, Delta, Ondo, Rivers)'> lzondjo (Bayelsa, Delta, Ondo, Rivers) </option>
													<option value='Jaba Kaduna'> Jaba Kaduna </option>
													<option value='Jahuna (Jahunawa) Taraba'> Jahuna (Jahunawa) Taraba </option>
													<option value='Jaku Bauchi'> Jaku Bauchi </option>
													<option value='Jara (Jaar Jarawa Jarawa-Dutse) Bauchi'> Jara (Jaar Jarawa Jarawa-Dutse) Bauchi </option>
													<option value='Jere (Jare, Jera, Jera, Jerawa) Bauchi, Plateau'> Jere (Jare, Jera, Jera, Jerawa) Bauchi, Plateau </option>
													<option value='Jero Taraba'> Jero Taraba </option>
													<option value='Jibu Adamawa'> Jibu Adamawa</option>
													<option value='Jidda-Abu Platea'> Jidda-Abu Platea </option>
													<option value='Jimbin (Jimbinawa) Bauchi'> Jimbin (Jimbinawa) Bauchi </option>
													<option value='Jirai Adamawa'> Jirai Adamawa </option>
													<option value='Jonjo (Jenjo) Taraba'> Jonjo (Jenjo) Taraba </option>
													<option value='Jukun Bauchi, Benue,Taraba, Plateau'> Jukun Bauchi, Benue,Taraba, Plateau </option>
													<option value='Kaba(Kabawa) Taraba'> Kaba(Kabawa) Taraba </option>
													<option value='Kadara Taraba'> Kadara Taraba </option>
													<option value='Kafanchan Kaduna'> Kafanchan Kaduna </option>
													<option value='Kagoro Kaduna'> Kagoro Kaduna </option>
													<option value='Kaje (Kache) Kaduna'> Kaje (Kache) Kaduna </option>
													<option value='Kajuru (Kajurawa) Kaduna'> Kajuru (Kajurawa) Kaduna </option>
													<option value='Kaka Adamawa'> Kaka Adamawa </option>
													<option value='Kamaku (Karnukawa) Kaduna, Kebbi, Niger'> Kamaku (Karnukawa) Kaduna, Kebbi, Niger </option>
													<option value='Kambari Kebbi, Niger'> Kambari Kebbi, Niger </option>
													<option value='Kambu Adamawa'> Kambu Adamawa </option>
													<option value='Kamo Bauchi'> Kamo Bauchi </option>
													<option value='Kanakuru (Dera) Adamawa, Borno'> Kanakuru (Dera) Adamawa, Borno </option>
													<option value='Kanembu Bomo'> Kanembu Bomo </option>
													<option value='Kanikon Kaduna'> Kanikon Kaduna </option>
													<option value='Kantana Plateau'> Kantana Plateau </option>
													<option value='Kanufi'> Kanufi </option>
													<option value='Karekare (Karaikarai) Bauchi, Yobe'> Karekare (Karaikarai) Bauchi, Yobe </option>
													<option value='Karimjo Taraba'> Karimjo Taraba </option>
													<option value='Kariya Bauchi'> Kariya Bauchi </option>
													<option value='Katab (Kataf) Kaduna'> Katab (Kataf) Kaduna </option>
													<option value='Kenern (Koenoem) Plateau'> Kenern (Koenoem) Plateau </option>
													<option value='Kenton Taraba'> Kenton Taraba </option>
													<option value='Kiballo (Kiwollo) Kaduna'> Kiballo (Kiwollo) Kaduna </option>
													<option value='Kilba Adamawa'> Kilba Adamawa </option>
													<option value='Kirfi (Kirfawa) Bauchi'> Kirfi (Kirfawa) Bauchi </option>
													<option value='Koma Taraba'> Koma Taraba</option>
													<option value='Kona Taraba'> Kona Taraba </option>
													<option value='Koro (Kwaro) Kaduna, Niger'> Koro (Kwaro) Kaduna, Niger </option>
													<option value='Kubi (Kubawa) Bauchi'> Kubi (Kubawa) Bauchi </option>
													<option value='Kudachano (Kudawa) Bauchi'> Kudachano (Kudawa) Bauchi </option>
													<option value='Kugama Taraba'> Kugama Taraba </option>
													<option value='Kulere (Kaler) Plateau'> Kulere (Kaler) Plateau</option>
													<option value='Kurdul Adamawa'> Kurdul Adamawa </option>
													<option value='Kushi Bauchi'> Kushi Bauchi </option>
													<option value='Kuteb Taraba'> Kuteb Taraba </option>
													<option value='Kutin Taraba'> Kutin Taraba </option>
													<option value='Kwalla Plateau'> Kwalla Plateau </option>
													<option value='Kwami (Kwom) Bauchi'> Kwami (Kwom) Bauchi </option>
													<option value='Kwanchi Taraba'> Kwanchi Taraba </option>
													<option value='Kwanka (Kwankwa) Bauchi, Plateau'> Kwanka (Kwankwa) Bauchi, Plateau </option>
													<option value='Kwaro Plateau'> Kwaro Plateau </option>
													<option value='Kwato Plateau'> Kwato Plateau </option>
													<option value='Kyenga (Kengawa) Sokoto'> Kyenga (Kengawa) Sokoto </option>
													<option value='Laaru (Larawa) Niger'> Laaru (Larawa) Niger </option>
													<option value='Lakka Adamawa'> Lakka Adamawa </option>
													<option value='Lala Adamawa'> Lala Adamawa </option>
													<option value='Lama Taraba'> Lama Taraba </option>
													<option value='Lamja Taraba'> Lamja Taraba </option>
													<option value='Lau Taraba'> Lau Taraba </option>
													<option value='Ubbo Adamawa'> Ubbo Adamawa </option>
													<option value='Limono Bauchi, Plateau'> Limono Bauchi, Plateau </option>
													<option value='Lopa (Lupa, Lopawa) Niger'> Lopa (Lupa, Lopawa) Niger </option>
													<option value='Longuda (Lunguda) Adamawa, Bauchi'> Longuda (Lunguda) Adamawa, Bauchi </option>
													<option value='Mabo Plateau'> Mabo Plateau </option>
													<option value='Mada Kaduna, Plateau'> Mada Kaduna, Plateau </option>
													<option value='Mama Plateau'> Mama Plateau </option>
													<option value='Mambilla Adamawa'> Mambilla Adamawa </option>
													<option value='Manchok Kaduna'> Manchok Kaduna </option>
													<option value='Mandara (Wandala) Bomo'> Mandara (Wandala) Bomo </option>
													<option value='Manga (Mangawa) Yobe'> Manga (Mangawa) Yobe </option>
													<option value='Margi (Marghi) Adamawa, Bomo'> Margi (Marghi) Adamawa, Bomo </option>
													<option value='Matakarn Adamawa'> Matakarn Adamawa </option>
													<option value='Mbembe Cross River, Enugu'> Mbembe Cross River, Enugu</option>
													<option value='Mbol Adamawa'> Mbol Adamawa </option>
													<option value='Mbube Cross River'> Mbube Cross River</option>
													<option value='Mbula Adamawa'> Mbula Adamawa</option>
													<option value='Mbum Taraba'> Mbum Taraba</option>
													<option value='Memyang (Meryan) Platea'> Memyang (Meryan) Platea</option>
													<option value='Miango Plateau'> Miango Plateau</option>
													<option value='Miligili (Migili) Plateau'> Miligili (Migili) Plateau</option>
													<option value='Miya (Miyawa) Bauchi'> Miya (Miyawa) Bauchi</option>
													<option value='Mobber Bomo'> Mobber Bomo</option>
													<option value='Montol Plateau'> Montol Plateau</option>
													<option value='Moruwa (Moro’a, Morwa) Kaduna'> Moruwa (Moro’a, Morwa) Kaduna</option>
													<option value='Muchaila Adamawa'> Muchaila Adamawa</option>
													<option value='Mumuye Taraba'> Mumuye Taraba</option>
													<option value='Mundang Adamawa'> Mundang Adamawa </option>
													<option value='Munga (Mupang) Plateau'> Munga (Mupang) Plateau</option>
													<option value='Mushere Plateau'>Mushere Plateau</option>
													<option value='Mwahavul (Mwaghavul) Plateau'>Mwahavul (Mwaghavul) Plateau</option>
													<option value='Ndoro Taraba'>Ndoro Taraba</option>
													<option value='Ngamo Bauchi, Yobe'>Ngamo Bauchi, Yobe</option>
													<option value='Ngizim Yobe'>Ngizim Yobe</option>
													<option value='Ngweshe (Ndhang.Ngoshe-Ndhang) Adamawa, Borno'>Ngweshe (Ndhang.Ngoshe-Ndhang) Adamawa, Borno</option>
													<option value='Ningi (Ningawa) Bauchi'>Ningi (Ningawa) Bauchi</option>
													<option value='Ninzam (Ninzo) Kaduna, Plateau'>Ninzam (Ninzo) Kaduna, Plateau</option>
													<option value='Njayi Adamawa'>Njayi Adamawa</option>
													<option value='Nkim Cross River'>Nkim Cross River</option>
													<option value='Nkum Cross River'>Nkum Cross River</option>
													<option value='Nokere (Nakere) Plateau'>Nokere (Nakere) Plateau</option>
													<option value='Nunku Kaduna, Plateau'>Nunku Kaduna, Plateau</option>
													<option value='Nupe Niger'>Nupe Niger</option>
													<option value='Nyandang Taraba'>Nyandang Taraba</option>
													<option value='Ododop Cross River'>Ododop Cross River</option>
													<option value='Ogori Kwara'>Ogori Kwara</option>
													<option value='Okobo (Okkobor) Akwa lbom'>Okobo (Okkobor) Akwa lbom</option>
													<option value='Okpamheri Edo'>Okpamheri Edo</option>
													<option value='Olulumo Cross River'>Olulumo Cross River</option>
													<option value='Oron Akwa lbom'>Oron Akwa lbom</option>
													<option value='Owan Edo'>Owan Edo</option>
													<option value='Owe Kwara'>Owe Kwara</option>
													<option value='Oworo Kwara'>Oworo Kwara</option>
													<option value='Pa’a (Pa’awa Afawa) Bauchi'>Pa’a (Pa’awa Afawa) Bauchi</option>
													<option value='Pai Plateau'>Pai Plateau</option>
													<option value='Panyam Taraba'>Panyam Taraba</option>
													<option value='Pero Bauch'>Pero Bauch</option>
													<option value='Pire Adamawa'>Pire Adamawa</option>
													<option value='Pkanzom Taraba'>Pkanzom Taraba</option>
													<option value='Poll Taraba'>Poll Taraba</option>
													<option value='Polchi Habe Bauchi'>Polchi Habe Bauchi</option>
													<option value='Pongo (Pongu) Niger'>Pongo (Pongu) Niger</option>
													<option value='Potopo Taraba'>Potopo Taraba</option>
													<option value='Pyapun (Piapung) Plateau'>Pyapun (Piapung) Plateau</option>
													<option value='Qua Cross River'>Qua Cross River</option>
													<option value='Rebina (Rebinawa) Bauchi'>Rebina (Rebinawa) Bauchi</option>
													<option value='Reshe Kebbi, Niger'>Reshe Kebbi, Niger</option>
													<option value='Rindire (Rendre) Platea'>Rindire (Rendre) Platea</option>
													<option value='Rishuwa Kaduna'>Rishuwa Kaduna</option>
													<option value='Ron Piateau'>Ron Piateau</option>
													<option value='Rubu Niger'>Rubu Niger</option>
													<option value='Rukuba Plateau'>Rukuba Plateau</option>
													<option value='Rumada Kaduna'>Rumada Kaduna</option>
													<option value='Rumaya Kaduna'>Rumaya Kaduna</option>
													<option value='Sakbe Taraba'>Sakbe Taraba</option>
													<option value='Sanga Bauchi'>Sanga Bauchi</option>
													<option value='Sate Taraba'>Sate Taraba</option>
													<option value='Saya (Sayawa Za’ar) Bauchi'>Saya (Sayawa Za’ar) Bauchi</option>
													<option value='Segidi (Sigidawa) Bauchi'>Segidi (Sigidawa) Bauchi</option>
													<option value='Shanga (Shangawa) Sokoto'>Shanga (Shangawa) Sokoto</option>
													<option value='Shangawa (Shangau) Plateau'>Shangawa (Shangau) Plateau</option>
													<option value='Shan-Shan Plateau'>Shan-Shan Plateau</option>
													<option value='Shira (Shirawa) Kano'>Shira (Shirawa) Kano</option>
													<option value='Shomo Taraba'>Shomo Taraba</option>
													<option value='Shuwa Adamawa, Borno'>Shuwa Adamawa, Borno</option>
													<option value='Sikdi Plateau'>Sikdi Plateau</option>
													<option value='Siri (Sirawa) Bauchi'>Siri (Sirawa) Bauchi</option>
													<option value='Srubu (Surubu) Kaduna'>Srubu (Surubu) Kaduna</option>
													<option value='Sukur Adamawa'>Sukur Adamawa</option>
													<option value='Sura Plateau'>Sura Plateau</option>
													<option value='Tangale Bauchi'>Tangale Bauchi</option>
													<option value='Tarok Plateau, Taraba'>Tarok Plateau, Taraba</option>
													<option value='Teme Adamawa'>Teme Adamawa</option>
													<option value='Tera (Terawa) Bauchi, Bomo'>Tera (Terawa) Bauchi, Bomo</option>
													<option value='Teshena (Teshenawa) Kano'>Teshena (Teshenawa) Kano</option>
													<option value='Tigon Adamawa'>Tigon Adamawa</option>
													<option value='Tikar Taraba'>Tikar Taraba</option>
													<option value='Tiv Benue, Plateau, Taraba'>Tiv Benue, Plateau, Taraba</option>
													<option value='Tula Bauchi'>Tula Bauchi</option>
													<option value='Tur Adamawa'>Tur Adamawa</option>
													<option value='Ufia Benue'>Ufia Benue</option>
													<option value='Ukelle Cross River'>Ukelle Cross River</option>
													<option value='Ukwani (Kwale) Delta'>Ukwani (Kwale) Delta</option>
													<option value='Uncinda Kaduna, Kebbi, Niger, Sokoto'>Uncinda Kaduna, Kebbi, Niger, Sokoto</option>
													<option value='Uneme (Ineme) Edo'>Uneme (Ineme) Edo</option>
													<option value='Ura (Ula) Niger'>Ura (Ula) Niger</option>
													<option value='Urhobo Delta'>Urhobo Delta</option>
													<option value='Utonkong Benue'>Utonkong Benue</option>
													<option value='Uyanga Cross River'>Uyanga Cross River</option>
													<option value='Vemgo Adamawa'>Vemgo Adamawa</option>
													<option value='Verre Adamawa'>Verre Adamawa</option>
													<option value='Vommi Taraba'>Vommi Taraba</option>
													<option value='Wagga Adamawa'>Wagga Adamawa</option>
													<option value='Waja Bauchi'>Waja Bauchi</option>
													<option value='Waka Tarab'>Waka Tarab</option>
													<option value='Warja (Warja) Jigawa'>Warja (Warja) Jigawa</option>
													<option value='Warji Bauchi'>Warji Bauchi</option>
													<option value='Wula Adamawa'>Wula Adamawa</option>
													<option value='Wurbo Adamawa'>Wurbo Adamawa</option>
													<option value='Wurkun Taraba'>Wurkun Taraba</option>
													<option value='Yache Cross River'>Yache Cross River</option>
													<option value='Yagba Kwara'>Yagba Kwara</option>
													<option value='Yakurr (Yako) Cross River'>Yakurr (Yako) Cross River</option>
													<option value='Yalla Benue'>Yalla Benue</option>
													<option value='Yandang Taraba'>Yandang Taraba</option>
													<option value='Yergan (Yergum) Plateau'>Yergan (Yergum) Plateau</option>
													<option value='Yoruba'>Yoruba </option>
													<option value='Yott Taraba'>Yott Taraba</option>
													<option value='Yumu Niger'>Yumu Niger</option>
													<option value='Yungur Adamawa'>Yungur Adamawa</option>
													<option value='Yuom Plateau'>Yuom Plateau</option>
													<option value='Zabara Niger'>Zabara Niger</option>
													<option value='Zaranda Bauchi'>Zaranda Bauchi</option>
													<option value='Zarma (Zarmawa) Kebbi'>Zarma (Zarmawa) Kebbi</option>
													<option value='Zayam (Zeam) Bauchi'>Zayam (Zeam) Bauchi</option>
													<option value='Zul (Zulawa) Bauchi'>Zul (Zulawa) Bauchi</option>
												</select>
												<!-- <label>ETHNIC GROUP</label> -->
											</div>

											<div class="input-field col s12 l3">
												<select name="gender">
													<option value="" disabled selected>Choose your option</option>
													<option value="MALE">MALE</option>
													<option value="FEMALE">FEMALE</option>
													<option value="OTHERS">OTHERS</option>
												</select>
												<label>GENDER</label>
											</div>
											<div class="input-field col s12 l3">
												<select name="maritalstatus" id="maritalstatus">
													<option value="" disabled selected>Choose your option</option>
													<option value="SINGLE">SINGLE</option>
													<option value="MARRIED">MARRIED</option>
													<option value="OTHERS">OTHERS</option>
												</select>
												<label>MARITAL STATUS</label>
											</div>

											<div class="input-field col s12 l3">
												<select name="pat_type" id="pat_type">
													<option value="" disabled selected>Choose your option</option>
													<option value="STAFF">STAFF</option>
													<option value="STUDENT">STUDENT</option>
												</select>
												<label>PATIENT TYPE</label>
											</div>

											<div class="input-field col s12 l3">
												<select name="religion">
													<option value="" disabled selected>Choose your option</option>
													<option value="CHRISTIANITY">CHRISTIANITY</option>
													<option value="ISLAM">ISLAM</option>
													<option value="OTHER">OTHERS</option>

												</select>
												<label>RELIGION</label>
											</div>

											<div class="input-field col s12 l2">
												<input type=text name="bdate" id="bdate" class="datepicker">
												<label for="bdate">Birthday</label>
											</div>

											<div class="input-field col s12 l2">
												<input type="text" name="year_of_admission" id="admission_yr" />
												<label for="">Year of Admission (if Student)</label>
											</div>
											<div class="input-field col s12 l2">
												<input type=text name="occupation">
												<label for="occupation">Occupation</label>
											</div>
											<div class="input-field col s12 l2">
												<input type="text" name="phone" id="phone" />
												<label for="">Phone Number</label>
											</div>


											<div class="input-field col s12 l4">
												<input type="text" name="raddress" id="" />
												<label for="">Residence Address</label>
											</div>
											<div class="input-field col s12 l3">
												<input type="text" name="town" id="town" />
												<label for="">Town (e.g Okokomaiko, Alaba, e.t.c)</label>
											</div>
											<div class="input-field col s12 l3">
												<?php
												$queryState = "SELECT * FROM state";
												$result = mysqli_query($conn, $queryState);
												?>
												<select name='rstate' id="state">
													<option value="" disabled selected>Choose your option</option>
													<?php
													while ($row = mysqli_fetch_assoc($result)) {
													?>
														<option value="<?php echo $row['state'] . " "; ?> state"><?php echo $row['state'] . " "; ?>state</option>
													<?php
													}
													?>
												</select>
												<label>STATE OF RESIDENCE</label>
											</div>

											<div class="input-field col s12 l3">
												<input type="text" name="email" id="email" />
												<label for="">Email Address</label>
											</div>
											<div class="input-field col s12 l2">
												<input type="text" name="identity" id="identity" />
												<label for="">PF/MATRIC NO</label>
											</div>
											<div class="file-field input-field col s12 m6 l4">
												<div class="btn">
													<span>Passport Photograph</span>
													<input type="file" name="passport" id="passport">
												</div>
												<div class="file-path-wrapper">
													<input class="file-path validate" type="text" name="path">
												</div>
											</div>
										</div>
										<div class="step-actions">
											<button class=" btn gradient blue next-step">
												CONTINUE
											</button>
										</div>
									</div>
								</li>

								<li class="step">
									<div data-step-label="Next of Kin" class="step-title waves-effect waves-dark">
										Step 2</div>
									<h class="step-content">
										<div class="row">
											<h class="">NEXT OF KIN DETAILS</h>
											<div class="input-field col s12 l6">
												<input type="text" name="kin_name" id="kin_name" />
												<label for="">Next of Kin</label>
											</div>
											<div class="input-field col s12 l6">
												<select name='kin_relationship'>
													<option value="" disabled selected>Choose your option</option>
													<option value="Father">Father</option>
													<option value="Mother">Mother</option>
													<option value="Brother">Brother</option>
													<option value="Sister">Sister</option>
													<option value="Spouse">Spouse</option>
													<option value="Guardian">Guardian</option>
													<option value="Niece">Niece</option>
													<option value="Cousin">Cousin</option>
													<option value="Nephew">Nephew</option>
													<option value="Uncle">Uncle</option>
													<option value="Aunt">Aunt</option>
													<option value="Other">Other</option>
												</select>
												<label>RELATIONSHIP</label>
											</div>


											<div class="input-field col s12 l6">
												<input type="text" name="kin_address" id="kin_address" />
												<label for="">Address</label>
											</div>


											<div class="input-field col s12 l6">
												<input type="text" name="kin_phone" id="" />
												<label for="">Phone Number</label>
											</div>

										</div>
										<div class="divider"></div>
										<h class="row">
											<h class="">PARENT/GUARDIAN DETAILS</h>
											<div class="input-field col s12 l6">
												<input type="text" name="guardian_name" id="" />
												<label for="">FULL NAME</label>
											</div>
											<div class="input-field col s12 l6">
												<select name='guardian_relationship'>
													<option value="" disabled selected>Choose your option</option>
													<option value="FATHER">Father</option>
													<option value="MOTHER">Mother</option>
													<option value="BROTHER">Brother</option>
													<option value="SISTER">Sister</option>
													<option value="GURARDIAN">Guardian</option>
													<option value="OTHERS">Other</option>
												</select>
												<label>RELATIONSHIP</label>
											</div>


											<div class="input-field col s12 l6">
												<input type="text" name="guardian_address" id="" />
												<label for="">Address</label>
											</div>


											<div class="input-field col s12 l6">
												<input type="text" name="guardian_phone" id="" />
												<label for="">Phone Number</label>
											</div>

										</h>

										<div id="STUDENT_SECTION"></div>
										<div class="step-actions">
											<button class="waves-effect waves-dark btn gradient next-step">
												CONTINUE
											</button>
											<button class="waves-effect waves-dark btn-flat previous-step">
												BACK
											</button>
										</div>
									</h>
								</li>

								<li class="step">
									<div data-step-label="Spouse Details" class="step-title waves-effect waves-dark">Step 3</div>
									<div class="step-content">
										<div class="row" id="spouse_form">
											<h5 class="">SPOUSE FORM</h5>
											<div class="input-field col s12 l3">
												<input type="text" name="spouse_fname" id="" />
												<label for="">First Name</label>
											</div>

											<div class="input-field col s12 l3">
												<input type="text" name="spouse_mname" id="" />
												<label for="">Middle Name</label>
											</div>

											<div class="input-field col s12 l3">
												<input type="text" name="spouse_surname" id="" />
												<label for="">Surname</label>
											</div>

											<div class="input-field col s12 l3">
												<select name='spouse_nationality'>
													<option value="" disabled selected>Choose your option</option>
													<option value="NIGERIA">NIGERIA</option>
													<option value="GHANA">GHANA</option>
													<option value="TUNISIA">TUNISIA</option>
												</select>
												<label>NATIONALITY</label>
											</div>

											<div class="input-field col s12 l3">
												<?php
												$queryState = "SELECT * FROM state";
												$result = mysqli_query($conn, $queryState);
												?>
												<select name='spouse_state' id="spouse_state">
													<option value="" disabled selected>Choose your option</option>
													<?php
													while ($row = mysqli_fetch_assoc($result)) {
													?>
														<option value="<?php echo $row['state'] . " "; ?> state"><?php echo $row['state'] . " "; ?>state</option>
													<?php
													}
													?>
												</select>
												<label>STATE OF ORIGIN</label>
											</div>

											<div class="input-field col s12 l3 ethnic">
												<select name="spouse_ethnic">
													<option value="" disabled selected>Choose your option</option>
													<option value="" disabled selected>Choose your option</option>
													<option value='Abayon Cross River'> Abayon Cross River </option>
													<option value='Abua (Odual) Rivers'> Abua (Odual) Rivers </option>
													<option value='Achipa (Achipawa) Kebbi'> Achipa (Achipawa) Kebbi </option>
													<option value='Adim Cross River'> Adim Cross River </option>
													<option value='Adun Cross River'> Adun Cross River </option>
													<option value='Affade Yobe'> Affade Yobe </option>
													<option value='Afizere Plateau'> Afizere Plateau </option>
													<option value='Afo Plateau'> Afo Plateau </option>
													<option value='Agbo Cross River'> Agbo Cross River </option>
													<option value='Akaju-Ndem (Akajuk) Cross River'> Akaju-Ndem (Akajuk) Cross River </option>
													<option value='Akweya-Yachi Benue'> Akweya-Yachi Benue </option>
													<option value='Alago (Arago) Plateau'> Alago (Arago) Plateau </option>
													<option value='Amo Plateau'> Amo Plateau </option>
													<option value='Anaguta Plateau'> Anaguta Plateau </option>
													<option value='Anang Akwa lbom'> Anang Akwa lbom </option>
													<option value='Andoni'> Andoni </option>
													<option value='Angas'> Angas </option>
													<option value='Ankwei Plateau'> Ankwei Plateau </option>
													<option value='Anyima Cross River'> Anyima Cross River </option>
													<option value='Attakar (ataka) Kaduna'> Attakar (ataka) Kaduna </option>
													<option value='Auyoka (Auyokawa) Jigawa'> Auyoka (Auyokawa) Jigawa </option>
													<option value='Awori'> Awori </option>
													<option value='Ayu Kaduna'> Ayu Kaduna </option>
													<option value='Babur'> Babur </option>
													<option value='Bachama Adamawa'> Bachama Adamawa </option>
													<option value='Bachere Cross River'> Bachere Cross River </option>
													<option value='Bada Plateau'> Bada Plateau </option>
													<option value='Bade Yobe'> Bade Yobe </option>
													<option value='Bahumono Cross River'> Bahumono Cross River </option>
													<option value='Bakulung Taraba'> Bakulung Taraba </option>
													<option value='Bali Taraba'> Bali Taraba </option>
													<option value='Bambora (Bambarawa) Bauchi'> Bambora (Bambarawa) Bauchi </option>
													<option value='Bambuko Taraba'> Bambuko Taraba </option>
													<option value='Banda (Bandawa) Taraba'> Banda (Bandawa) Taraba </option>
													<option value='Banka (Bankalawa) Bauchi'> Banka (Bankalawa) Bauchi </option>
													<option value='Banso (Panso) Adamawa'> Banso (Panso) Adamawa </option>
													<option value='Bara (Barawa) Bauchi'> Bara (Barawa) Bauchi </option>
													<option value='Barke Bauchi'> Barke Bauchi </option>
													<option value='Baruba (Barba) Niger'> Baruba (Barba) Niger </option>
													<option value='Bashiri (Bashirawa) Plateau'> Bashiri (Bashirawa) Plateau </option>
													<option value='Bassa'> Bassa </option>
													<option value='Batta Adamawa'> Batta Adamawa </option>
													<option value='Baushi Niger'> Baushi Niger </option>
													<option value='Baya Adamawa'> Baya Adamawa </option>
													<option value='Bekwarra Cross River'> Bekwarra Cross River </option>
													<option value='Bele (Buli, Belewa) Bauchi'> Bele (Buli, Belewa) Bauchi </option>
													<option value='Betso (Bete) Taraba'> Betso (Bete) Taraba </option>
													<option value='Bette Cross River'> Bette Cross River </option>
													<option value='Bilei Adamawa'> Bilei Adamawa </option>
													<option value='Bille Adamawa'> Bille Adamawa </option>
													<option value='Bina (Binawa) Kaduna'> Bina (Binawa) Kaduna </option>
													<option value='Bini Edo'> Bini Edo </option>
													<option value='Birom Plateau'> Birom Plateau </option>
													<option value='Bobua Taraba'> Bobua Taraba </option>
													<option value='Boki (Nki) Cross River'> Boki (Nki) Cross River </option>
													<option value='Bkkos Plateau'> Bkkos Plateau </option>
													<option value='Boko (Bussawa, Bargawa) Niger'> Boko (Bussawa, Bargawa) Niger </option>
													<option value='Bole (Bolewa) Bauchi, Yobe'> Bole (Bolewa) Bauchi, Yobe </option>
													<option value='Botlere Adamawa'> Botlere Adamawa </option>
													<option value='Boma (Bomawa, Burmano) Bauchi'> Boma (Bomawa, Burmano) Bauchi </option>
													<option value='Bomboro Bauchi'> Bomboro Bauchi </option>
													<option value='Buduma Borno, Niger'> Buduma Borno, Niger </option>
													<option value='Buji Plateau'> Buji Plateau </option>
													<option value='Buli Bauchi'> Buli Bauchi </option>
													<option value='Bunu Kogi'> Bunu Kogi </option>
													<option value='Bura Adamawa, Borno'> Bura Adamawa, Borno </option>
													<option value='Burak Bauchi'> Burak Bauchi </option>
													<option value='Burma (Burmawa) Plateau'> Burma (Burmawa) Plateau </option>
													<option value='Buru Yobe'> Buru Yobe </option>
													<option value='Buta (Butawa) Bauchi'> Buta (Butawa) Bauchi </option>
													<option value='Bwall Plateau'> Bwall Plateau </option>
													<option value='Bwatiye Adamawa'> Bwatiye Adamawa </option>
													<option value='Bwazza Adamawa'> Bwazza Adamawa </option>
													<option value='Challa Plateau'> Challa Plateau </option>
													<option value='Chama (Chamawa Fitilai) Bauchi'> Chama (Chamawa Fitilai) Bauchi </option>
													<option value='Chamba Taraba'> Chamba Taraba </option>
													<option value='Chamo Bauchi'> Chamo Bauchi </option>
													<option value='Chibok (Chibbak) Yobe'> Chibok (Chibbak) Yobe </option>
													<option value='Chinine Borno'> Chinine Borno </option>
													<option value='Chip Plateau'> Chip Plateau </option>
													<option value='Chokobo Plateau'> Chokobo Plateau </option>
													<option value='Chukkol Taraba'> Chukkol Taraba </option>
													<option value='Daba Adamawa'> Daba Adamawa </option>
													<option value='Dadiya Bauchi'> Dadiya Bauchi </option>
													<option value='Daka Adamawa'> Daka Adamawa </option>
													<option value='Dakarkari Niger, Kebbi'> Dakarkari Niger, Kebbi </option>
													<option value='Danda (Dandawa) Kebbi'> Danda (Dandawa) Kebbi </option>
													<option value='Dangsa Taraba'> Dangsa Taraba </option>
													<option value='Daza (Dere, Derewa) Bauchi'> Daza (Dere, Derewa) Bauchi </option>
													<option value='Degema Rivers'> Degema Rivers </option>
													<option value='Deno (Denawa) Bauchi'> Deno (Denawa) Bauchi </option>
													<option value='Dghwede Bomo'> Dghwede Bomo </option>
													<option value='Diba Taraba'> Diba Taraba </option>
													<option value='Doemak (Dumuk) Plateau'> Doemak (Dumuk) Plateau </option>
													<option value='Ouguri Bauchi'> Ouguri Bauchi </option>
													<option value='Duka (Dukawa) Kebbi'> Duka (Dukawa) Kebbi </option>
													<option value='Duma (Dumawa) Bauchi'> Duma (Dumawa) Bauchi </option>
													<option value='Ebana (Ebani) Rivers'> Ebana (Ebani) Rivers </option>
													<option value='Ebirra (lgbirra)'> Ebirra (lgbirra) </option>
													<option value='Ebu Edo, Kogi'> Ebu Edo, Kogi </option>
													<option value='Efik Cross River'> Efik Cross River </option>
													<option value='Egbema Rivers'> Egbema Rivers </option>
													<option value='Egede (lgedde) Benue'> Egede (lgedde) Benue </option>
													<option value='Eggon Plateau'> Eggon Plateau </option>
													<option value='Egun (Gu)'> Egun (Gu) </option>
													<option value='Ejagham Cross River'> Ejagham Cross River</option>
													<option value='Ekajuk Cross River'> Ekajuk Cross River </option>
													<option value='Eket Akwa Ibom'> Eket Akwa Ibom </option>
													<option value='Ekoi Cross River'> Ekoi Cross River </option>
													<option value='Engenni (Ngene) Rivers'> Engenni (Ngene) Rivers </option>
													<option value='Epie Rivers'> Epie Rivers </option>
													<option value='Esan (Ishan) Edo'> Esan (Ishan) Edo </option>
													<option value='Etche Rivers'> Etche Rivers </option>
													<option value='Etolu (Etilo) Benue'> Etolu (Etilo) Benue </option>
													<option value='Etsako Edo'> Etsako Edo </option>
													<option value='Etung Cross River'> Etung Cross River </option>
													<option value='Etuno Edo'> Etuno Edo </option>
													<option value='Palli Adamawa'> Palli Adamawa </option>
													<option value='Pulani (Pulbe)'> Pulani (Pulbe) </option>
													<option value='Fyam (Fyem) Plateau'> Fyam (Fyem) Plateau </option>
													<option value='Fyer(Fer) Plateau'> Fyer(Fer) Plateau </option>
													<option value='Ga’anda Adamawa'> Ga’anda Adamawa </option>
													<option value='Gade Niger'> Gade Niger</option>
													<option value='Galambi Bauchi'> Galambi Bauchi </option>
													<option value='Gamergu-Mulgwa Bomo'> Gamergu-Mulgwa Bomo </option>
													<option value='Qanawuri Plateau'> Qanawuri Plateau </option>
													<option value='Gavako Borno'> Gavako Borno </option>
													<option value='Gbedde Kogi'> Gbedde Kogi </option>
													<option value='Gengle Taraba'> Gengle Taraba </option>
													<option value='Geji Bauchi'> Geji Bauchi </option>
													<option value='Gera (Gere, Gerawa) Bauchi'> Gera (Gere, Gerawa) Bauchi </option>
													<option value='Geruma (Gerumawa) Plateau'> Geruma (Gerumawa) Plateau </option>
													<option value='Geruma (Gerumawa) Bauchi'> Geruma (Gerumawa) Bauchi </option>
													<option value='Gingwak Bauchi'> Gingwak Bauchi </option>
													<option value='Gira Adamawa'> Gira Adamawa </option>
													<option value='Gizigz Adamawa'> Gizigz Adamawa </option>
													<option value='Goernai Plateau'> Goernai Plateau </option>
													<option value='Gokana (Kana) Rivers'> Gokana (Kana) Rivers </option>
													<option value='Gombi Adamawa'> Gombi Adamawa </option>
													<option value='Gornun (Gmun) Taraba'> Gornun (Gmun) Taraba </option>
													<option value='Gonia Taraba'> Gonia Taraba </option>
													<option value='Gubi (Gubawa) Bauchi'> Gubi (Gubawa) Bauchi </option>
													<option value='Gude Adamawa'> Gude Adamawa </option>
													<option value='Gudu Adamawa'> Gudu Adamawa </option>
													<option value='Gure Kaduna'> Gure Kaduna </option>
													<option value='Gurmana Niger'> Gurmana Niger </option>
													<option value='Gururntum Bauchi'> Gururntum Bauchi </option>
													<option value='Gusu Plateau'> Gusu Plateau </option>
													<option value='Gwa (Gurawa) Adamawa'> Gwa (Gurawa) Adamawa </option>
													<option value='Gwamba Adamawa'> Gwamba Adamawa </option>
													<option value='Gwandara Kaduna, Niger, Plateau'> Gwandara Kaduna, Niger, Plateau </option>
													<option value='Gwari (Gbari) Kaduna, Niger, Plateau'> Gwari (Gbari) Kaduna, Niger, Plateau </option>
													<option value='Gwom Taraba'> Gwom Taraba </option>
													<option value='Gwoza (Waha) Bomo'> Gwoza (Waha) Bomo </option>
													<option value='Gyem Bauchi'> Gyem Bauchi </option>
													<option value='Hausa'> Hausa </option>
													<option value='Higi (Hig) Borno, Adamawa'> Higi (Hig) Borno, Adamawa </option>
													<option value='Holma Adamawa'> Holma Adamawa </option>
													<option value='Hona Adamawa'> Hona Adamawa </option>
													<option value='Ibeno Akwa lbom'> Ibeno Akwa lbom </option>
													<option value='Ibibio Akwa lbom'> Ibibio Akwa lbom </option>
													<option value='Ichen Adamawa'> Ichen Adamawa </option>
													<option value='Idoma Benue, Taraba'> Idoma Benue, Taraba </option>
													<option value='Igalla Kogi'> Igalla Kogi </option>
													<option value='lgbo'> lgbo </option>
													<option value='ljumu Kogi'> ljumu Kogi </option>
													<option value='Ikorn Cross River'> Ikorn Cross River </option>
													<option value='Irigwe Plateau'> Irigwe Plateau </option>
													<option value='Isoko Delta'> Isoko Delta </option>
													<option value='Ekajuk Cross River'> Ekajuk Cross River </option>
													<option value='lsekiri (Itsekiri) Delta'> lsekiri (Itsekiri) Delta </option>
													<option value='lyala (lyalla) Cross River'> lyala (lyalla) Cross River </option>
													<option value='lzondjo (Bayelsa, Delta, Ondo, Rivers)'> lzondjo (Bayelsa, Delta, Ondo, Rivers) </option>
													<option value='Jaba Kaduna'> Jaba Kaduna </option>
													<option value='Jahuna (Jahunawa) Taraba'> Jahuna (Jahunawa) Taraba </option>
													<option value='Jaku Bauchi'> Jaku Bauchi </option>
													<option value='Jara (Jaar Jarawa Jarawa-Dutse) Bauchi'> Jara (Jaar Jarawa Jarawa-Dutse) Bauchi </option>
													<option value='Jere (Jare, Jera, Jera, Jerawa) Bauchi, Plateau'> Jere (Jare, Jera, Jera, Jerawa) Bauchi, Plateau </option>
													<option value='Jero Taraba'> Jero Taraba </option>
													<option value='Jibu Adamawa'> Jibu Adamawa</option>
													<option value='Jidda-Abu Platea'> Jidda-Abu Platea </option>
													<option value='Jimbin (Jimbinawa) Bauchi'> Jimbin (Jimbinawa) Bauchi </option>
													<option value='Jirai Adamawa'> Jirai Adamawa </option>
													<option value='Jonjo (Jenjo) Taraba'> Jonjo (Jenjo) Taraba </option>
													<option value='Jukun Bauchi, Benue,Taraba, Plateau'> Jukun Bauchi, Benue,Taraba, Plateau </option>
													<option value='Kaba(Kabawa) Taraba'> Kaba(Kabawa) Taraba </option>
													<option value='Kadara Taraba'> Kadara Taraba </option>
													<option value='Kafanchan Kaduna'> Kafanchan Kaduna </option>
													<option value='Kagoro Kaduna'> Kagoro Kaduna </option>
													<option value='Kaje (Kache) Kaduna'> Kaje (Kache) Kaduna </option>
													<option value='Kajuru (Kajurawa) Kaduna'> Kajuru (Kajurawa) Kaduna </option>
													<option value='Kaka Adamawa'> Kaka Adamawa </option>
													<option value='Kamaku (Karnukawa) Kaduna, Kebbi, Niger'> Kamaku (Karnukawa) Kaduna, Kebbi, Niger </option>
													<option value='Kambari Kebbi, Niger'> Kambari Kebbi, Niger </option>
													<option value='Kambu Adamawa'> Kambu Adamawa </option>
													<option value='Kamo Bauchi'> Kamo Bauchi </option>
													<option value='Kanakuru (Dera) Adamawa, Borno'> Kanakuru (Dera) Adamawa, Borno </option>
													<option value='Kanembu Bomo'> Kanembu Bomo </option>
													<option value='Kanikon Kaduna'> Kanikon Kaduna </option>
													<option value='Kantana Plateau'> Kantana Plateau </option>
													<option value='Kanufi'> Kanufi </option>
													<option value='Karekare (Karaikarai) Bauchi, Yobe'> Karekare (Karaikarai) Bauchi, Yobe </option>
													<option value='Karimjo Taraba'> Karimjo Taraba </option>
													<option value='Kariya Bauchi'> Kariya Bauchi </option>
													<option value='Katab (Kataf) Kaduna'> Katab (Kataf) Kaduna </option>
													<option value='Kenern (Koenoem) Plateau'> Kenern (Koenoem) Plateau </option>
													<option value='Kenton Taraba'> Kenton Taraba </option>
													<option value='Kiballo (Kiwollo) Kaduna'> Kiballo (Kiwollo) Kaduna </option>
													<option value='Kilba Adamawa'> Kilba Adamawa </option>
													<option value='Kirfi (Kirfawa) Bauchi'> Kirfi (Kirfawa) Bauchi </option>
													<option value='Koma Taraba'> Koma Taraba</option>
													<option value='Kona Taraba'> Kona Taraba </option>
													<option value='Koro (Kwaro) Kaduna, Niger'> Koro (Kwaro) Kaduna, Niger </option>
													<option value='Kubi (Kubawa) Bauchi'> Kubi (Kubawa) Bauchi </option>
													<option value='Kudachano (Kudawa) Bauchi'> Kudachano (Kudawa) Bauchi </option>
													<option value='Kugama Taraba'> Kugama Taraba </option>
													<option value='Kulere (Kaler) Plateau'> Kulere (Kaler) Plateau</option>
													<option value='Kurdul Adamawa'> Kurdul Adamawa </option>
													<option value='Kushi Bauchi'> Kushi Bauchi </option>
													<option value='Kuteb Taraba'> Kuteb Taraba </option>
													<option value='Kutin Taraba'> Kutin Taraba </option>
													<option value='Kwalla Plateau'> Kwalla Plateau </option>
													<option value='Kwami (Kwom) Bauchi'> Kwami (Kwom) Bauchi </option>
													<option value='Kwanchi Taraba'> Kwanchi Taraba </option>
													<option value='Kwanka (Kwankwa) Bauchi, Plateau'> Kwanka (Kwankwa) Bauchi, Plateau </option>
													<option value='Kwaro Plateau'> Kwaro Plateau </option>
													<option value='Kwato Plateau'> Kwato Plateau </option>
													<option value='Kyenga (Kengawa) Sokoto'> Kyenga (Kengawa) Sokoto </option>
													<option value='Laaru (Larawa) Niger'> Laaru (Larawa) Niger </option>
													<option value='Lakka Adamawa'> Lakka Adamawa </option>
													<option value='Lala Adamawa'> Lala Adamawa </option>
													<option value='Lama Taraba'> Lama Taraba </option>
													<option value='Lamja Taraba'> Lamja Taraba </option>
													<option value='Lau Taraba'> Lau Taraba </option>
													<option value='Ubbo Adamawa'> Ubbo Adamawa </option>
													<option value='Limono Bauchi, Plateau'> Limono Bauchi, Plateau </option>
													<option value='Lopa (Lupa, Lopawa) Niger'> Lopa (Lupa, Lopawa) Niger </option>
													<option value='Longuda (Lunguda) Adamawa, Bauchi'> Longuda (Lunguda) Adamawa, Bauchi </option>
													<option value='Mabo Plateau'> Mabo Plateau </option>
													<option value='Mada Kaduna, Plateau'> Mada Kaduna, Plateau </option>
													<option value='Mama Plateau'> Mama Plateau </option>
													<option value='Mambilla Adamawa'> Mambilla Adamawa </option>
													<option value='Manchok Kaduna'> Manchok Kaduna </option>
													<option value='Mandara (Wandala) Bomo'> Mandara (Wandala) Bomo </option>
													<option value='Manga (Mangawa) Yobe'> Manga (Mangawa) Yobe </option>
													<option value='Margi (Marghi) Adamawa, Bomo'> Margi (Marghi) Adamawa, Bomo </option>
													<option value='Matakarn Adamawa'> Matakarn Adamawa </option>
													<option value='Mbembe Cross River, Enugu'> Mbembe Cross River, Enugu</option>
													<option value='Mbol Adamawa'> Mbol Adamawa </option>
													<option value='Mbube Cross River'> Mbube Cross River</option>
													<option value='Mbula Adamawa'> Mbula Adamawa</option>
													<option value='Mbum Taraba'> Mbum Taraba</option>
													<option value='Memyang (Meryan) Platea'> Memyang (Meryan) Platea</option>
													<option value='Miango Plateau'> Miango Plateau</option>
													<option value='Miligili (Migili) Plateau'> Miligili (Migili) Plateau</option>
													<option value='Miya (Miyawa) Bauchi'> Miya (Miyawa) Bauchi</option>
													<option value='Mobber Bomo'> Mobber Bomo</option>
													<option value='Montol Plateau'> Montol Plateau</option>
													<option value='Moruwa (Moro’a, Morwa) Kaduna'> Moruwa (Moro’a, Morwa) Kaduna</option>
													<option value='Muchaila Adamawa'> Muchaila Adamawa</option>
													<option value='Mumuye Taraba'> Mumuye Taraba</option>
													<option value='Mundang Adamawa'> Mundang Adamawa </option>
													<option value='Munga (Mupang) Plateau'> Munga (Mupang) Plateau</option>
													<option value='Mushere Plateau'>Mushere Plateau</option>
													<option value='Mwahavul (Mwaghavul) Plateau'>Mwahavul (Mwaghavul) Plateau</option>
													<option value='Ndoro Taraba'>Ndoro Taraba</option>
													<option value='Ngamo Bauchi, Yobe'>Ngamo Bauchi, Yobe</option>
													<option value='Ngizim Yobe'>Ngizim Yobe</option>
													<option value='Ngweshe (Ndhang.Ngoshe-Ndhang) Adamawa, Borno'>Ngweshe (Ndhang.Ngoshe-Ndhang) Adamawa, Borno</option>
													<option value='Ningi (Ningawa) Bauchi'>Ningi (Ningawa) Bauchi</option>
													<option value='Ninzam (Ninzo) Kaduna, Plateau'>Ninzam (Ninzo) Kaduna, Plateau</option>
													<option value='Njayi Adamawa'>Njayi Adamawa</option>
													<option value='Nkim Cross River'>Nkim Cross River</option>
													<option value='Nkum Cross River'>Nkum Cross River</option>
													<option value='Nokere (Nakere) Plateau'>Nokere (Nakere) Plateau</option>
													<option value='Nunku Kaduna, Plateau'>Nunku Kaduna, Plateau</option>
													<option value='Nupe Niger'>Nupe Niger</option>
													<option value='Nyandang Taraba'>Nyandang Taraba</option>
													<option value='Ododop Cross River'>Ododop Cross River</option>
													<option value='Ogori Kwara'>Ogori Kwara</option>
													<option value='Okobo (Okkobor) Akwa lbom'>Okobo (Okkobor) Akwa lbom</option>
													<option value='Okpamheri Edo'>Okpamheri Edo</option>
													<option value='Olulumo Cross River'>Olulumo Cross River</option>
													<option value='Oron Akwa lbom'>Oron Akwa lbom</option>
													<option value='Owan Edo'>Owan Edo</option>
													<option value='Owe Kwara'>Owe Kwara</option>
													<option value='Oworo Kwara'>Oworo Kwara</option>
													<option value='Pa’a (Pa’awa Afawa) Bauchi'>Pa’a (Pa’awa Afawa) Bauchi</option>
													<option value='Pai Plateau'>Pai Plateau</option>
													<option value='Panyam Taraba'>Panyam Taraba</option>
													<option value='Pero Bauch'>Pero Bauch</option>
													<option value='Pire Adamawa'>Pire Adamawa</option>
													<option value='Pkanzom Taraba'>Pkanzom Taraba</option>
													<option value='Poll Taraba'>Poll Taraba</option>
													<option value='Polchi Habe Bauchi'>Polchi Habe Bauchi</option>
													<option value='Pongo (Pongu) Niger'>Pongo (Pongu) Niger</option>
													<option value='Potopo Taraba'>Potopo Taraba</option>
													<option value='Pyapun (Piapung) Plateau'>Pyapun (Piapung) Plateau</option>
													<option value='Qua Cross River'>Qua Cross River</option>
													<option value='Rebina (Rebinawa) Bauchi'>Rebina (Rebinawa) Bauchi</option>
													<option value='Reshe Kebbi, Niger'>Reshe Kebbi, Niger</option>
													<option value='Rindire (Rendre) Platea'>Rindire (Rendre) Platea</option>
													<option value='Rishuwa Kaduna'>Rishuwa Kaduna</option>
													<option value='Ron Piateau'>Ron Piateau</option>
													<option value='Rubu Niger'>Rubu Niger</option>
													<option value='Rukuba Plateau'>Rukuba Plateau</option>
													<option value='Rumada Kaduna'>Rumada Kaduna</option>
													<option value='Rumaya Kaduna'>Rumaya Kaduna</option>
													<option value='Sakbe Taraba'>Sakbe Taraba</option>
													<option value='Sanga Bauchi'>Sanga Bauchi</option>
													<option value='Sate Taraba'>Sate Taraba</option>
													<option value='Saya (Sayawa Za’ar) Bauchi'>Saya (Sayawa Za’ar) Bauchi</option>
													<option value='Segidi (Sigidawa) Bauchi'>Segidi (Sigidawa) Bauchi</option>
													<option value='Shanga (Shangawa) Sokoto'>Shanga (Shangawa) Sokoto</option>
													<option value='Shangawa (Shangau) Plateau'>Shangawa (Shangau) Plateau</option>
													<option value='Shan-Shan Plateau'>Shan-Shan Plateau</option>
													<option value='Shira (Shirawa) Kano'>Shira (Shirawa) Kano</option>
													<option value='Shomo Taraba'>Shomo Taraba</option>
													<option value='Shuwa Adamawa, Borno'>Shuwa Adamawa, Borno</option>
													<option value='Sikdi Plateau'>Sikdi Plateau</option>
													<option value='Siri (Sirawa) Bauchi'>Siri (Sirawa) Bauchi</option>
													<option value='Srubu (Surubu) Kaduna'>Srubu (Surubu) Kaduna</option>
													<option value='Sukur Adamawa'>Sukur Adamawa</option>
													<option value='Sura Plateau'>Sura Plateau</option>
													<option value='Tangale Bauchi'>Tangale Bauchi</option>
													<option value='Tarok Plateau, Taraba'>Tarok Plateau, Taraba</option>
													<option value='Teme Adamawa'>Teme Adamawa</option>
													<option value='Tera (Terawa) Bauchi, Bomo'>Tera (Terawa) Bauchi, Bomo</option>
													<option value='Teshena (Teshenawa) Kano'>Teshena (Teshenawa) Kano</option>
													<option value='Tigon Adamawa'>Tigon Adamawa</option>
													<option value='Tikar Taraba'>Tikar Taraba</option>
													<option value='Tiv Benue, Plateau, Taraba'>Tiv Benue, Plateau, Taraba</option>
													<option value='Tula Bauchi'>Tula Bauchi</option>
													<option value='Tur Adamawa'>Tur Adamawa</option>
													<option value='Ufia Benue'>Ufia Benue</option>
													<option value='Ukelle Cross River'>Ukelle Cross River</option>
													<option value='Ukwani (Kwale) Delta'>Ukwani (Kwale) Delta</option>
													<option value='Uncinda Kaduna, Kebbi, Niger, Sokoto'>Uncinda Kaduna, Kebbi, Niger, Sokoto</option>
													<option value='Uneme (Ineme) Edo'>Uneme (Ineme) Edo</option>
													<option value='Ura (Ula) Niger'>Ura (Ula) Niger</option>
													<option value='Urhobo Delta'>Urhobo Delta</option>
													<option value='Utonkong Benue'>Utonkong Benue</option>
													<option value='Uyanga Cross River'>Uyanga Cross River</option>
													<option value='Vemgo Adamawa'>Vemgo Adamawa</option>
													<option value='Verre Adamawa'>Verre Adamawa</option>
													<option value='Vommi Taraba'>Vommi Taraba</option>
													<option value='Wagga Adamawa'>Wagga Adamawa</option>
													<option value='Waja Bauchi'>Waja Bauchi</option>
													<option value='Waka Tarab'>Waka Tarab</option>
													<option value='Warja (Warja) Jigawa'>Warja (Warja) Jigawa</option>
													<option value='Warji Bauchi'>Warji Bauchi</option>
													<option value='Wula Adamawa'>Wula Adamawa</option>
													<option value='Wurbo Adamawa'>Wurbo Adamawa</option>
													<option value='Wurkun Taraba'>Wurkun Taraba</option>
													<option value='Yache Cross River'>Yache Cross River</option>
													<option value='Yagba Kwara'>Yagba Kwara</option>
													<option value='Yakurr (Yako) Cross River'>Yakurr (Yako) Cross River</option>
													<option value='Yalla Benue'>Yalla Benue</option>
													<option value='Yandang Taraba'>Yandang Taraba</option>
													<option value='Yergan (Yergum) Plateau'>Yergan (Yergum) Plateau</option>
													<option value='Yoruba'>Yoruba </option>
													<option value='Yott Taraba'>Yott Taraba</option>
													<option value='Yumu Niger'>Yumu Niger</option>
													<option value='Yungur Adamawa'>Yungur Adamawa</option>
													<option value='Yuom Plateau'>Yuom Plateau</option>
													<option value='Zabara Niger'>Zabara Niger</option>
													<option value='Zaranda Bauchi'>Zaranda Bauchi</option>
													<option value='Zarma (Zarmawa) Kebbi'>Zarma (Zarmawa) Kebbi</option>
													<option value='Zayam (Zeam) Bauchi'>Zayam (Zeam) Bauchi</option>
													<option value='Zul (Zulawa) Bauchi'>Zul (Zulawa) Bauchi</option>
												</select>
												<!-- <label>ETHNIC GROUP</label> -->
											</div>

											<div class="input-field col s12 l3">
												<select name="spouse_gender">
													<option value="" disabled selected>Choose your option</option>
													<option value="MALE">MALE</option>
													<option value="FEMALE">FEMALE</option>
													<option value="OTHERS">OTHERS</option>
												</select>
												<label>GENDER</label>
											</div>

											<div class="input-field col s12 l3">
												<select name="spouse_religion">
													<option value="" disabled selected>Choose your option</option>
													<option value="CHRISTIANITY">CHRISTIANITY</option>
													<option value="ISLAM">ISLAM</option>
													<option value="OTHERS">OTHERS</option>

												</select>
												<label>RELIGION</label>
											</div>

											<div class="input-field col s12 l3">
												<input type="text" class="datepicker" name="spouse_dob">
												<label for="dob">Date of Birth</label>
											</div>

											<div class="input-field col s12 l3">
												<input type="text" name="spouse_addr" id="" />
												<label for="">House Address</label>
											</div>
											<div class="input-field col s12 l3">
												<input type="text" name="spouse_town" id="" />
												<label for="">Town</label>
											</div>
											<div class="input-field col s12 l3">
												<?php
												$queryState = "SELECT * FROM state";
												$result = mysqli_query($conn, $queryState);
												?>
												<select name='spouse_residence_state' id="state">
													<option value="" disabled selected>Choose your option</option>
													<?php
													while ($row = mysqli_fetch_assoc($result)) {
													?>
														<option value="<?php echo $row['state'] . " "; ?> state"><?php echo $row['state'] . " "; ?>state</option>
													<?php
													}
													?>
												</select>
												<label>STATE OF RESIDENCE</label>
											</div>

											<div class="input-field col s12 l3">
												<input type="email" name="spouse_email" id="" />
												<label for="">Email Address</label>
											</div>

											<div class="input-field col s12 l3">
												<input type="text" name="spouse_phone" id="spouse_phone" />
												<label for="">Phone Number</label>
											</div>
											<div class="file-field input-field col s12 m6 l4">
												<div class="btn">
													<span>Passport Photograph</span>
													<input type="file" name="spouse_passport" id="passport">
												</div>
												<div class="file-path-wrapper">
													<input class="file-path validate" type="text" name="spouse_path">
												</div>
											</div>
										</div>
										<div class="step-actions">
											<button type="submit" class="btn gradient" name="submit">
												submit
											</button>
											<button class="btn-flat previous-step">
												BACK
											</button>
										</div>
									</div>
								</li>
							</ul>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>

<footer></footer>
<style>
	ul.stepper.horizontal {
		min-height: 550px;
	}
</style>

<script src="../assets/materialize/js/jquery.js"></script>
<script src="../assets/materialize/materialize.1.0.0.min.js"></script>
<script src="../assets/materialize/js/materialize.js"></script>
<script src="../assets/materialize/js/script.js"></script>
<script src="../assets/stepper/js/mstepper.min.js"></script>
<script src="../assets/materialize/js/select2.min.js"></script>
<script>
	var stepper = document.querySelector(".stepper");
	var stepperInstace = new MStepper(stepper, {
		// options
		firstActive: 0 // this is the default
	});


	// var currYear = (new Date()).getFullYear();

	$(document).ready(function() {
		$(".ethnic").select2({
			placeholder: "Select Ethnic Group",
			allowClear: true
		});

		$(".datepicker").datepicker({
			selectMonths: true, // Creates a dropdown to control month
			selectYears: 105, // Creates a dropdown of 15 years to control year,
			format: 'yyyy-mm-dd',
			today: 'Today',
			clear: 'Clear',
			close: 'Ok',
			max: true,
			closeOnSelect: false // Close upon selecting a date,
		});

		$(function() {
			$('#spouse_form').hide();
			$('#pat_type, #maritalstatus').change(function() {
				if ($('#pat_type').val() == 'STAFF' && $('#maritalstatus').val() == 'MARRIED') {
					$('#spouse_form').show();
				} else {
					$('#spouse_form').hide();
				}
			});
		});
	});
</script>
</body>

</html>