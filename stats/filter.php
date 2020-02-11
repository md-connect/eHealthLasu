<?php
session_start();
include('../includes/dbconfig/dbconfig.php');

if (isset($_POST["from_date"], $_POST["to_date"])) {


     function logstat($pat_type, $gender)
     {
          include('../includes/dbconfig/dbconfig.php');
          $query = "SELECT * FROM pat_stats WHERE pat_type='$pat_type' AND gender='$gender' AND log_date BETWEEN '" . $_POST["from_date"] . "' AND '" . $_POST["to_date"] . "' ";

          $result = mysqli_query($conn, $query);
          $row = mysqli_num_rows($result);
          return $row;
     }
     $total_male_pat = logstat('STUDENT', 'MALE') + logstat('STAFF', 'MALE') + logstat('DEPENDANT', 'MALE');
     $total_female_pat = logstat('STUDENT', 'FEMALE') + logstat('STAFF', 'FEMALE') + logstat('DEPENDANT', 'FEMALE');
     $total_std_pat = logstat('STUDENT', 'MALE') + logstat('STUDENT', 'FEMALE');
     $total_staff_pat = logstat('STAFF', 'MALE') + logstat('STAFF', 'FEMALE');
     $total_depdnt = logstat('DEPENDANT', 'MALE') + logstat('DEPENDANT', 'FEMALE');
     $overall_pat = $total_std_pat + $total_staff_pat + $total_depdnt;

     ?>
     <span class="table-title" style="text-align:center;">TOTAL OF PATIENT PATIENTS ATTEND TO BETWEEN <?php echo $_POST['from_date']. " TO ". $_POST["to_date"]; ?></span>
     <table class="centered" id="datatable">
          <thead>
               <tr>
                    <th>PATIENT TYPE</th>
                    <th>MALE</th>
                    <th>FEMALE</th>
                    <th>TOTAL</th>
               </tr>
          </thead>
          <tbody>
               <tr>
                    <th>STAFF</th>
                    <td><?php echo logstat('STAFF', 'MALE'); ?></td>
                    <td><?php echo logstat('STAFF', 'FEMALE'); ?></td>
                    <td><?php echo $total_staff_pat; ?></td>
               </tr>
               <tr>
                    <th>STUDENT</th>
                    <td><?php echo logstat('STUDENT', 'MALE'); ?></td>
                    <td><?php echo logstat('STUDENT', 'FEMALE'); ?></td>
                    <td><?php echo $total_std_pat; ?></td>
               </tr>
               <tr>
                    <th>DEPENDANT</th>
                    <td><?php echo logstat('DEPENDANT', 'MALE'); ?></td>
                    <td><?php echo logstat('DEPENDANT', 'FEMALE'); ?></td>
                    <td><?php echo $total_depdnt; ?></td>
               </tr>
               <tr>
                    <th>OVERALL TOTAL</th>
                    <td><?php echo $total_male_pat; ?></td>
                    <td><?php echo $total_female_pat; ?></td>
                    <td><?php echo $overall_pat; ?></td>
               </tr>

          <?php
          }
          ?>