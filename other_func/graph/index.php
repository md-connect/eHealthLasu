<!DOCTYPE html>
<html lang="en">
    <head>

        <title>Graph</title>

    </head>
    <script src="js/jquery.js" type="text/javascript"></script>


    <script type="application/javascript" src="js/awesomechart.js"> </script>

<?php
mysql_select_db('product',mysql_connect('localhost','root',''))or die(mysql_error());
?>
  
<body>

   
         

            <div class="container" >

                <div class="row-fluid" >
                   
                    <div class="span12">

                        <div class="hero-unit-table">   


                            <div class="charts_container">
                                <div align=center class="chart_container">
                                     
                                    <canvas id="chartCanvas1" width="500" height="400">
                                        Your web-browser does not support the HTML 5 canvas element.
                                    </canvas>

                                </div>
                            </div>


	 
       

            
        </div>




                            <script type="application/javascript">

                                var chart1 = new AwesomeChart('chartCanvas1');


                                chart1.data = [
                                <?php
                                $query = mysql_query("select * from product") or die(mysql_error());
                                while ($row = mysql_fetch_array($query)) {
                                    ?>
                                    <?php echo $row['Qty'] . ','; ?>	
                                <?php }; ?>
                                ];

                                chart1.labels = [
                                <?php
                                $query = mysql_query("select * from product") or die(mysql_error());
                                while ($row = mysql_fetch_array($query)) {
                                    ?>
                                    <?php echo "'" . $row['name'] . "'" . ','; ?>	
                                <?php }; ?>
                                ];
                                chart1.colors = ['#006CFF', '#FF6600', '#34A038', '#945D59', '#93BBF4', '#F493B8'];
                                chart1.randomColors = true;
                                chart1.animate = true;
                                chart1.animationFrames = 30;
                                chart1.draw();


                               
                            </script>


                        </div>

                    </div>
                </div>



            </div>
        </div>
    </div>



   
</body>
</html>


