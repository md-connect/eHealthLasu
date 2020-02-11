<?php
include("../security.php");
include("header.php");

?>

  <main>
    <div class="container">
      <div class="row">
        <div class="col s12">
          <div class="card-panel">
            <!-- <style>
                           .input-field .prefix{
                               right: 0;
                           }
                       </style> -->
            <form action="" class="row">
              <div class="input-field col s12 m12 l8 offset-l2">
                <i class="mdi mdi-card-search prefix"></i>
                <input type="text" name="" id="">
                <label for="">Hospital Number/Unique Number</label>
              </div>
              <div class="input-field center">
                <button type="submit" class="btn blue darken-4">search</button>
              </div>

            </form>
            <div class="center">
              <h5>You searched for 'frhjjhuff'</h5>
              <p>1 result(s) found</p>
            </div>
            <div>
              <div class="card horizontal">
                <div class="card-image">
                  <img src="../assets/images/matthew.png">
                </div>
                <div class="card-stacked">
                  <div class="card-content">
                    <p>Hospital Number:</p>
                    <p>Unique Identity:</p>
                    <p>Full Name: </p>
                    <p>Gender: </p>
                    <p>Category: </p>
                    <p>Reg. Date:</p>
                    <p>Reg. By:</p>
                    <p>Date Updated:</p>
                    <p>Updated By:</p>
                  </div>
                  <div class="card-action center">
                    <a id="#modal1" class="btn modal-trigger blue darken-4 "><i class="mdi mdi-account-edit"></i>edit</a>

                    <a href="" class="btn red darken-4"><i class="mdi mdi-delete"></i>delete</a>

                  </div>
                </div>
              </div>
            </div>

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