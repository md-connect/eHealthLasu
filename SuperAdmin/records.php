<?php
include("../security.php");
include("header.php");

?>


  <main>
    <div class="row mt-4">
      <div class="col s12 m12 l6 offset-l6">
        <select>
          <option value="" disabled selected>Choose your option</option>
          <option value="1">Patients Records</option>
          <option value="2">Medical-Staff Records</option>
        </select>
        <label>Record Type</label>
      </div>
      <div class="col s12">
        <div class="row">
          <div id="admin" class="col s12">
            <div class="card material-table">
              <div class="table-header">
                <span class="table-title">All Patients Records</span>
                <div class="actions">
                  <a href="#" class="search-toggle waves-effect btn-flat nopadding"><i class="material-icons">search</i></a>
                </div>
              </div>
              <table class="centered" id="datatable">
                <thead>
                  <tr>
                    <th>STAFF ID</th>
                    <th>FULL NAME</th>
                    <th>ROLE</th>
                    <th>REG. DATE</th>
                    <th>VIEW MORE</th>
                    <th>EDIT</th>
                    <th>DELETE</th>


                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>Tiger Nixon</td>
                    <td>System Architect</td>
                    <td>Edinburgh</td>
                    <td>61</td>
                    <td>
                      <a href="#viewmore">VIEW</a>
                    </td>
                    <td>
                      <a href="#">
                        <i class="material-icons">mode_edit</i>
                      </a>
                    </td>
                    <td>
                      <a href="#">
                        <i class="material-icons">mode_edit</i>
                      </a>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal Structure -->
    <div id="viewmore" class="modal modal-fixed-footer">
      <div class="modal-content">
        <h4>Modal Header</h4>
        <p>A bunch of text</p>
      </div>
      <div class="modal-footer">
        <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat ">Agree</a>
      </div>
    </div>
  </main>


  <footer></footer>

  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
  <script src='https://cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js'></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.0/js/materialize.min.js'></script>
  <script src='https://cdn.datatables.net/buttons/1.3.1/js/buttons.html5.min.js'></script>
  <script src='https://cdn.datatables.net/buttons/1.3.1/js/buttons.print.min.js'></script>
  <script src='https://cdn.datatables.net/buttons/1.3.1/js/dataTables.buttons.min.js'></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js'></script>

  <script src="../assets/materialize/js/materialize.js"></script>
  <script src="../assets/materialize/js/script.js"></script>
  <script src="../assets/datatable/script.js"></script>

  <script>
    $(document).ready(function() {
      // the "href" attribute of the modal trigger must specify the modal ID that wants to be triggered
      $('.modal').modal();
    });
  </script>
</body>

</html>