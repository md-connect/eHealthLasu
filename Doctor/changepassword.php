<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <title>Document</title>
  <link rel="stylesheet" href="../assets/materialize/css/materialize.css" />
  <link rel="stylesheet" href="../assets/materialize/css/admin.css" />
  <link rel="stylesheet" href="../assets/iconfont/material-icons.css" />
  <link rel="stylesheet" href="../assets/stepper/css/mstepper.min.css" />
</head>

<body>
  <ul id="slide-out" class="side-nav fixed">
    <li>
      <div class="user-view">
        <div class="background blue darken-2">
          <!-- <img src="images/office.jpg" /> -->
        </div>
        <a href="#!user"><img class="circle" src="../assets/images/matthew.png" /></a>
        <a href="#!name"><span class="white-text name">John Doe</span></a>
        <a href="#!email"><span class="white-text email">jdandturk@gmail.com</span></a>
      </div>
    </li>
    <li><a href="index.html">Prescribe Treatment</a></li>
    <li><a href="operations.html">Operations</a></li>
    <li>
      <div class="divider"></div>
    </li>

    <li class="active"><a href="changepassword.html">Change Password</a></li>
    <li><a href="#">Login</a></li>

  </ul>
  <header>
    <nav class="blue">
      <div class="nav-wrapper">
        <div class="container">
          <a href="#" data-activates="slide-out" class="button-collapse"><i class="material-icons">menu</i></a>

          <a href="#" class="brand-logo">Logo</a>
        </div>

      </div>
    </nav>
  </header>

  <main>
    <div class="container">
      <div class="row">
        <div class="col s12">
          <div class="card-panel">
            <form action="" class="row">
              <div class="input-field col s12">

                <input type="tel" name="" id="input" value="" required="required" title="">

                <label>Old Password</label>

              </div>

              <div class="input-field col s12">

                <input type="tel" name="" id="input" value="" required="required" title="">

                <label>Old Password</label>

              </div>

              <div class="input-field col s12">
                <div class="divider"></div>

              </div>

              <div class="input-field col s12">
                <button type="submit" class="btn blue block">Submit</button>

              </div>
            </form>
          </div>
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