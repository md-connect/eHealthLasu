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
    <link rel="stylesheet" href="../assets/Mdi/css/materialdesignicons.css">
  </head>
  <body>
 <ul id="slide-out" class="side-nav fixed">
      <li>
        <div class="user-view">
          <div class="background blue darken-2">
            <!-- <img src="images/office.jpg" /> -->
          </div>
          <a href="#!user"
            ><img class="circle" src="../assets/images/matthew.png"
          /></a>
          <a href="#!name"><span class="white-text name">John Doe</span></a>
          <a href="#!email"
            ><span class="white-text email">jdandturk@gmail.com</span></a
          >
        </div>
      </li>
      <li class="active"><a href="index.html">DASHBOARD</a></li>

      <li><div class="divider"></div></li>

      <li><a class="subheader">OPERATIONS</a></li>

      <li>
        <a class="waves-effect uppercase" href="registerpatient.html"
          >Register Patient</a
        >
      </li>


     
       <li>
        <a class="waves-effect uppercase" href="view_patient.html"
          >View Patients</a
        >
      </li>
       

       <li>
        <a class="waves-effect uppercase" href="allpatients.html"
          >View All Patients</a
        >
      </li>

      <li><div class="divider"></div></li>
       <li>
        <a class="waves-effect uppercase" href="changepassword.html"
          >Change Password</a
        >
      </li>
       <li>
        <a class="waves-effect uppercase" href="#"
          >LOG OUT</a
        >
      </li>
    </ul>
    <header>
      <nav class="blue">
        <div class="nav-wrapper">
          <div class="container">
            <a href="#" data-activates="slide-out" class="button-collapse"
              ><i class="material-icons">menu</i></a
            >

            <a href="#" class="brand-logo">Logo</a>
          </div>
        </div>
      </nav>
    </header>
     <main>
        <div class="container">
          <div class="card-panel">
                <table class="bordered highlight">
        <thead>
          <tr>
              <th>S/N</th>
              <th>CARD NUMBER</th>
              <th>FIRST NAME</th>
              <th>LAST NAME</th>
              <th>MATRIC NUMBER</th>
              <th>OPERATIONS</th>

          </tr>
        </thead>

        <tbody>
          <tr>
            <td>1</td>
            <td>LHC/2016/03536	</td>
            <td>MONDAY</td>
             <td>OKE</td>
            <td>150591000</td>
            <td>
                
                <button type="button" class="btn-flat modal-trigger waves-effect waves-dark">view</button>
                
            </td>
          </tr>
        </tbody>
      </table>
          </div>
          <div class="card-panel center">
              <ul class="pagination">
    <li class="disabled"><a href="#!"><i class="material-icons">chevron_left</i></a></li>
    <li class="active"><a href="#!">1</a></li>
    <li class="waves-effect"><a href="#!">2</a></li>
    <li class="waves-effect"><a href="#!">3</a></li>
    <li class="waves-effect"><a href="#!">4</a></li>
    <li class="waves-effect"><a href="#!">5</a></li>
    <li class="waves-effect"><a href="#!"><i class="material-icons">chevron_right</i></a></li>
  </ul>
          </div>
        </div>
    </main>


  
    <script src="../assets/materialize/js/jquery.js"></script>
    <script src="../assets/materialize/js/materialize.js"></script>
    <script src="../assets/materialize/js/script.js"></script>
  </body>
</html>
