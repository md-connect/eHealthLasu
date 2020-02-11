<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8" />
     <meta name="viewport" content="width=device-width, initial-scale=1.0" />
     <meta http-equiv="X-UA-Compatible" content="ie=edge" />
     <title>eHealthLasu | <?php echo $_SESSION['role']; ?></title>
     <link rel="stylesheet" href="../assets/materialize/css/materialize.css" />
     <link rel="stylesheet" href="../assets/materialize/css/admin.css" />
     <link rel="stylesheet" href="../assets/iconfont/material-icons.css" />
     <link rel="stylesheet" href="../assets/stepper/css/mstepper.min.css" />
     <link rel="stylesheet" href="../assets/materialize/css/style.css" />
     <link rel="stylesheet" href="../assets/Mdi/css/materialdesignicons.css">
     <link rel="stylesheet" href="../assets/datatable/style.css" />
     <link rel="stylesheet" href="../assets/materialize/css/materialize.min.css">
</head>

<body>
     <main>
          <div class="row mt-4">
               <div class="">
                    <div class=" col s12 m12 l6">
                         <div class="card-body">
                              <div class="row">
                                   <form>
                                        <label>Select Country:</label>
                                        <select class="country">
                                             <option value="usa">United States</option>
                                             <option value="india">India</option>
                                             <option value="uk">United Kingdom</option>
                                        </select>
                                   </form>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
          <div class="row mt-4">
               <div class="">
                    <div class=" col s12 m12 l6">
                         <div class="card-body">
                              <div class="row">
                                   <table id="mytable">
                                        <thead>
                                             <tr>
                                                  <th>Name</th>
                                                  <th>Item Name</th>

                                             </tr>
                                        </thead>

                                        <tbody>
                                             <tr id="add_item">
                                                  <!-- <td></td>
                                                  <td></td> -->
                                             </tr>
                                        </tbody>
                                   </table>
                              </div>
                         </div>
                    </div>
               </div>
          </div>

     </main>

     <script src="../assets/materialize/jquery.min.js"></script>
     <script src="../assets/datatable/jquery.dataTables.min.js"></script>
     <script src="../assets/materialize/js/materialize.min.js"></script>
     <script src="../assets/datatable/buttons.html5.min.js"></script>
     <script src="../assets/datatable/buttons.print.min.js"></script>
     <script src="../assets/datatable/dataTables.buttons.min.js"></script>
     <script src="../assets/datatable/jszip.min.js"></script>
     <script src="../assets/materialize/js/materialize.js"></script>
     <script src="../assets/materialize/js/script.js"></script>
     <script src="../assets/datatable/script.js"></script>

     <script>
          $(document).ready(function() {
               $("select.country").change(function() {
                         var selectedCountry = $(this).children("option:selected").val();
                         $("#mytable").find('tbody')
                              .append($('<tr>')
                                   .append($('<td>')
                                        .append($(this).children("option:selected").val())
                                        /* .attr('src', 'img.png')
                                        .text('Image cell') */
                                   )
                              )
                    ); alert("You have selected the country - " + selectedCountry);
               });
          });
     </script>
</body>

</html>