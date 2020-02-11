<?php
include("header.php");
?>
<div class="slider">
  <ul class="slides">
    <li>
      <img src="assets/images/online-marketing-hIgeoQjS_iE-unsplash.jpg" />
      <!-- random image -->
      <div class="caption center-align">
        <h3>We care for your Health</h3>
        <h5 class="light grey-text text-lighten-3">
          We care, but God heals.
        </h5>
      </div>
    </li>
    <li>
      <img src="assets/images/checklist-3222079_1920.jpg" />
      <!-- random image -->
      <div class="caption left-align">
        <h3>Do you know?</h3>
        <h5 class="light grey-text text-lighten-3">
          Health is Wealth, so, maintain it.
        </h5>
      </div>
    </li>
    <li>
      <img src="assets/images/woman-3187087_1920.jpg" />
      <!-- random image -->
      <div class="caption right-align">
        <h3>Prevention is better than cure</h3>
        <h5 class="light grey-text text-lighten-3">
          Stay away from contaminations.
        </h5>
      </div>
    </li>
    <li>
      <img src="assets/images/lasu1.jpg" />
      <!-- random image -->
      <div class="caption center-align">
        <h3>We care for your Health</h3>
        <h5 class="light grey-text text-lighten-3">
          Here's our small slogan.
        </h5>
      </div>
    </li>
    <li>
      <img src="assets/images/lasu2.jpg" />
      <!-- random image -->
      <div class="caption center-align">
        <h3>We care for your Health</h3>
        <h5 class="light grey-text text-lighten-3">
          Here's our small slogan.
        </h5>
      </div>
    </li>
    <li>
      <img src="assets/images/lasu3.jpg" />
      <!-- random image -->
      <div class="caption center-align">
        <h3>We care for your Health</h3>
        <h5 class="light grey-text text-lighten-3">
          Here's our small slogan.
        </h5>
      </div>
    </li>
    <li>
      <img src="assets/images/Medical-Courses.jpg" />
      <!-- random image -->
      <div class="caption center-align">
        <h3>We care for your Health</h3>
        <h5 class="light grey-text text-lighten-3">
          Always do medical check up
        </h5>
      </div>
    </li>
  </ul>
</div>

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
              <input id="username" type="text" name="username" class="validate" maxlength="15" />
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
    <div class="row">
      <!-- <div class="col s12" style="margin-bottom: 2%;">
        <h3 class="uppercase center">about us</h3>
        <div class="divider"></div>
      </div>
      <br />
      <div class="col s12 m12 l6">
        <img src="assets/images/lasu.png" class="responsive-img" alt="" />
      </div>
      <div class="col s12 m12 l6">
        <h4>
          Lorem ipsum dolor sit, amet consectetur adipisicing elit. Commodi,
          aut!
        </h4>
        <p>
          Lorem ipsum dolor sit amet consectetur adipisicing elit. Minima
          repudiandae molestias maiores eum ipsum quasi sit, ducimus ad
          perferendis recusandae explicabo harum, asperiores iure assumenda
          consequatur reiciendis, nihil facere! Consequatur.
        </p>
      </div> -->

      <div class="col s12" style="margin-bottom: 2%;">
        <h3 class="uppercase center">our staff</h3>
        <div class="divider"></div>
      </div>
      <br />
      <div class="col s12 m12 l3">
        <div class="card">
          <div class="card-image">
            <img width="200" height="200" class="" src="assets/images/md.jpg" alt="" />
          </div>
          <div class="card-content">
            <div class="center">
              <h6>Oke Monday</h6>
              <p>Director, Health Services</p>
            </div>
          </div>
        </div>
      </div>
      <div class="col s12 m12 l3">
        <div class="card">
          <div class="card-image">
            <img width="200" height="200" class="" src="assets/images/Lizzy pic.jpg" alt="" />
          </div>
          <div class="card-content">
            <div class="center">
              <h6>Oke Monday</h6>
              <p>Head Doctor</p>
            </div>
          </div>
        </div>
      </div>

      <div class="col s12 m12 l3">
        <div class="card">
          <div class="card-image">
            <img width="200" height="200" class="" src="assets/images/140561032.jpg" alt="" />
          </div>
          <div class="card-content">
            <div class="center">
              <h6>Oke Monday</h6>
              <p>Head Nurse</p>
            </div>
          </div>
        </div>
      </div>

      <div class="col s12 m12 l3">
        <div class="card">
          <div class="card-image">
            <img width="200" height="200" class="" src="assets/images/Adebayo.jpg" alt="" />
          </div>
          <div class="card-content">
            <div class="center">
              <h6>Oke Monday</h6>
              <p>Head Lab Scientist</p>
            </div>
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