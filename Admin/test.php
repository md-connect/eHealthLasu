<?php
//include("../security.php");
//include("header.php");
include("../includes/dbconfig/dbconfig.php");

/* $query = "SELECT * FROM state WHERE state = 'xxxxxxxxxxxxx'";
$result = mysqli_query($conn, $query);
*/
//$myfile = fopen("lga.txt", "r") or die("Unable to open file!");
// Output one line until end-of-file
/* $myfile = fgets($myfile);
$myfile = explode("-", $myfile);
print_r($myfile);
echo "<br>"; */
/* foreach ($myfile as $lga) {
    while ($row = mysqli_fetch_assoc($result)) {
        $id = $row['id'];
         $statename = $row['state'];
        echo $id . "->" . $statename . "<br>"; 
    }
} */
// $insert = "INSERT INTO lg_area(lg_name, state_id) VALUES('$lga','$id')"; $run_this = mysqli_query($conn, $insert); if ($run_this) {

//}
/*     echo $lga."<br>"; */
// }


/* $state = "SELECT * FROM state";
$run = $mysqli_query($conn, $state);
while ($row = mysqli_fetch_assoc($run)) {
    $id = $row['id'];
    $statename = $row['state'];
    echo $id . "->" . $statename . "<br>";
} */
/* $myfile = fopen("lga.txt", "r") or die("Unable to open file!");
// Output one line until end-of-file
$myfile = fgets($myfile);
$myfile = explode(",", $myfile);
//print_r($myfile);
foreach ($myfile as $lga) {
    $state = "SELECT * FROM state";
    $run = $mysqli_query($conn, $state);
    while($row = mysqli_fetch_assoc($run)){
        $id = $row['id'];
        $statename = $row['state'];
        echo $id."->".$statename."<br>";
    }
}
fclose($myfile); */
if (isset($_POST['upload'])) {
    $img = $_FILES['passport']['name'];
    $temp = $_FILES['passport']['tmp_name'];
    $types = $_FILES['passport']['type'];
    //$dirpath = dirname(getcwd());
    //echo $dirpath;
    if (($types == "image/jpeg") || ($types == "image/jpg") || ($types == "image/bmp") || ($types == "image/png") || ($types == "")) {
        $tempx = explode(".", $img);
        $newname = "surname" . "_" . time() . "." . end($tempx); {
            if (file_exists('../passport/' . $_FILES['passport']['name'])) {
                $store = $_FILES['passport']['name'];
                echo "Image " . $store . " Already exists";
                //header('Location: test.php');
            } else {
                $query = "INSERT INTO img_test(img) 
                    VALUES ('$newname')";
                $query_run = mysqli_query($conn, $query);
                if ($query_run) {
                    move_uploaded_file($_FILES['passport']['tmp_name'], '../passport/' . $newname);
                    echo "Image Upload successfully!";
                } else {
                    echo "Error occured!";
                }
            }
        }
    } else {
        echo "Invalid image type";
    }
}

?>
<!-- <style>
    form label {
        display: inline-block;
        width: 100px;
    }

    form div {
        margin-bottom: 10px;
    }

    .error {
        color: red;
        font-family: verdana, Helvetica;
    }
    }

    label.error {
        display: inline;
    }
</style> -->
<form id="first_form" method="POST" action="" enctype="multipart/form-data">
    <div class="file-field input-field col s12 m6 l4">
        <div class="btn">
            <span>Passport Photograph</span>
            <input type="file" name="passport" id="passport">
        </div>
        <div class="file-path-wrapper">
            <input class="file-path validate" type="text" name="path">
        </div>
    </div>

    <div class="file-path-wrapper">
        <button class="form-control" type="submit" name="upload">Upload</button>
    </div>
</form>
<!-- <h2>Example 1:</h2>
<form method="post" name="productform" id="productform">
    <p>
        <label for='prodid'>Product ID: (maxlength 10)</label><br>
        <input type="text" name="prodid">
    </p>
    <p>
        <label for='email'>Email: (minlength 10)</label><br>
        <input type="text" name="email">
    </p>
    <p>
        <label for='address'>Address( length between 10 and 250)</label><br>
        <input type="text" name="address">
    </p>
    <p>
        <label for='message'>Message:( length between 50 and 1050)</label> <br>
        <textarea name="message"></textarea>
    </p>

    <input type="submit" name='submit' value="Post it !">
</form> -->

<script src="../assets/materialize/js/jquery.js"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.12.0/jquery.validate.min.js" type="text/javascript"></script>

<script src="../assets/materialize/js/materialize.js"></script>
<script src="../assets/materialize/js/script.js"></script>
<script>
    $(function() {
        $("#productform").validate({
            rules: {
                prodid: {
                    required: true,
                    maxlength: 10
                },
                email: {
                    required: true,
                    email: true,
                    minlength: 10
                },
                address: {
                    required: true,
                    rangelength: [10, 250]
                },
                message: {
                    rangelength: [50, 1050]
                }
            }
        });
    });
    /*  $(document).ready(function() {
         $('#first_form').submit(function(e) {
                 e.preventDefault();
                 var first_name = $('#first_name').val();
                 var last_name = $('#last_name').val();
                 var email = $('#email').val();
                 var password = $('#password').val();

                 $(".error").remove();

                 if (first_name.length < 1) {
                     alert("This field is required");
                     /*  }
                      if (last_name.length < 1) { $('#last_name').after('<span class="error">This field is required</span>');
                          }
                          if (email.length < 1) { $('#email').after('<span class="error">This field is required</span>');
                              } else {
                              var regEx = /^[A-Z0-9][A-Z0-9._%+-]{0,63}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/;
                              var validEmail = regEx.test(email);
                              if (!validEmail) {
                              $('#email').after('<span class="error">Enter a valid email</span>');
                              }
                              }
                              if (password.length < 8) { $('#password').after('<span class="error">Password must be at least 8 characters long</span>');
                                  } 
                 });
         }); 

     });*/
</script>