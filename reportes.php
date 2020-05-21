<?php
require_once("conexion.php");
 $query = $conn->prepare("select count(*) as total from publicacion where id_valoracion = 1");
 $query->execute();
 $q2 = $conn->prepare("select * from categoria");
 $q2->execute();
 $total;
 $categorias = [];
 $num = [];
 while($res = $query->fetch()) {$total= $res['total'];}

 while($cat = $q2->fetch()) {$categorias[]= $cat['titulo'];
   $c= $cat['titulo'];
 $q = $conn->prepare("select count(*) as total from publicacion p inner join
  categoria c on p.id_categoria = c.id_Categoria where c.titulo = '$c' and id_valoracion = 1");
  $q->execute();
  while($n = $q->fetch()) {$num[]= $n['total'];}

 }
 
 //echo " [' ". $categorias[0] . "'," .$num[0]." ], "
?>
<html>
  <head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
      <script type="text/javascript">
        google.charts.load("current", {packages:["corechart"]});
        google.charts.setOnLoadCallback(drawChart);
        function drawChart() {
          var data = google.visualization.arrayToDataTable([
            ['Task', 'Hours per Day'],
            ['Total',    <?php echo $total ?> ],
            
          ]);

          var options = {
            title: 'Total de publicaciones <?php echo $total ?>',
            is3D: true,
          };

          var chart = new google.visualization.PieChart(document.getElementById('total'));
          chart.draw(data, options);
        }

      </script>


        <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          <?php for($i=0; $i< sizeof($categorias); $i++ ){  echo " [' ". $categorias[$i] . "'," .$num[$i]." ], "; } ?>
          
        ]);

        var options = {
          title: 'Publicaciones por tema',
          is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('temas'));
        chart.draw(data, options);
      }

    </script>

     <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Year', 'Bien', 'Regular', 'Mal'],
          ['2014', 100, 40, 20],
          ['2015', 170, 40, 50],
          ['2016', 60, 120, 30],
          ['2017', 130, 54, 35]
        ]);

        var options = {
          chart: {
            title: 'Publicaciones',
            subtitle: 'Grafica de cada publicacion con sus reacciones',
          },
          bars: 'horizontal' // Required for Material Bar Charts.
        };

        var chart = new google.charts.Bar(document.getElementById('valoracion'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>
  </head>
  <body>
  <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
    <ul class="navbar-nav">
      <li class="nav-item ">
        <a class="nav-link" href="admin.php">Usuarios</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="reportes.php">Reportes</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="aprobarModerador.php">Aprobar Moderador</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="temas.php">Temas</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="cerrarsesion.php">Salir</a>
      </li>
  </ul>
</nav>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
            <div id="total" style="width: 600px; height: 500px;"></div>
            </div>
            <div class="col-md-6">
            <div id="temas" style="width: 600px; height: 500px;"></div>
            </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <center>  <div id="valoracion" style="width: 60%; height: 500px;"></div></center>
          </div>
        </div>
    </div>
  </body>
</html>