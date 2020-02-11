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
        <div class="container">
            <div class="row">
                <div class="col s12" style="margin-bottom: 2%;">
                    <h3 class="uppercase center">about LASU Health Centre lab unit</h3>
                    <div class="divider"></div>
                </div>
                <br />
                <div class="col s12 m12 l6">
                    <img src="assets/images/lasu_logo.png" class="responsive-img" alt="" />
                </div>

                <div class="col s12 m12 l6">
                    <h4>
                        Name and other info here .............................................................................................
                    </h4>
                    <p>
                        Contact: *****************************

                    </p>
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

</html>