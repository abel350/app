<?php
//Reanudamos la sesión
session_start();

//Comprobamos si el usario está logueado
//Si no lo está, se le redirecciona al index
//Si lo está, definimos el botón de cerrar sesión y la duración de la sesión
if(!isset($_SESSION['usuario']) and $_SESSION['estado'] != 'Autenticado') {
  header('Location: index.php');
} else {
  $estado = $_SESSION['usuario'];
  $token = $_SESSION['token'];
  require('recursos/sesiones.php');
};
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Tablero</title>

  <!-- Bootstrap core CSS -->
  <link href="dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
  <link href="assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

  <link href="dist/css/tablero.css" rel="stylesheet">

  <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
  <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
  <script src="assets/js/ie-emulation-modes-warning.js"></script>

  <!-- Estilo Data Tables -->
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap4.min.css">


  <!-- HTML5 shim and Respond  .js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->

      <!-- JQUERY -->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

      <script src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap4.min.js"></script>

      <script src="dist/js/Chart.bundle.js"></script>
      <script src="dist/js/utils.js"></script>

      <script type="text/javascript" language="javascript" class="init">
        $(document).ready(function(){
          $('#tabla').DataTable({
           "searching": false,
           "paging": false,
           "info":false,
           "responsive": true,
           "ajax": "dist/json/usuarios.json",          
           "columns": [
           { "data": "id" },
           { "data": "name" },
           { "data": "username" },
           { "data": "email" }
           ],
           "language": idioma_espanol            
         });
        });
        var idioma_espanol = {
            "sProcessing":     "Procesando...",
            "sLengthMenu":     "Mostrar _MENU_ registros",
            "sZeroRecords":    "No se encontraron resultados",
            "sEmptyTable":     "Ningún dato disponible en esta tabla",
            "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix":    "",
            "sSearch":         "Buscar:",
            "sUrl":            "",
            "sInfoThousands":  ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst":    "Primero",
                "sLast":     "Último",
                "sNext":     "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
        }
      </script>

    </head>

    <body>
      <!-- MENU -->
      <!-- Static navbar -->
      <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/"><img src="images/logo.png" height="30px"></a>
          </div>
          <div id="navbar" class="navbar-collapse collapse">          
            <ul class="nav navbar-nav navbar-right">
              <li class="active"><a href="/">Home</a></li>
              <li><a href="#">Casos</a></li>
              <li><a href="#">Mi cuenta</a></li>
              <li><a href="recursos/salir.php">Cerrar Sesión</a></li>                           
            </ul>            
          </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
      </nav> <!--/Static navbar -->
      <!-- / MENU -->
      
      <!-- Panel de usuario -->
      <div class="panel panel-primary">
        <div class="panel-heading"><h2>Mi tablero</h2></div>
        <div class="panel-body">Bienvenido ACM Produce</div>
      </div>
      <!-- / Panel de usuario -->
      
      <div class="container">
        <div class="row">

          <div class="col-lg-6 col-md-6 col-sm-12 ">
            <div class="row" style="margin-bottom: 60px;">
              <div class="col-lg-6 col-md-12 col-sm-12">
                <h3>Estados de Productos</h3> 
                <button id="detalles" class="btn btn-success" type="button">Mostrar/Ocultar</button>
              </div>

              <div class="col-lg-6 col-md-6 col-sm-12">
                <h3>Filtrar por Agricultor</h3>
                <div class="dropdown">
                  <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Elije <span class="caret"></span></button>
                  <ul class="dropdown-menu">
                    <li><a href="#">Sin filtrar</a></li>
                    <li><a href="#">Solo mis embarques</a></li>
                    <li><a href="#">Jose Paramo</a></li>
                    <li><a href="#">Laura Preciado</a></li>
                  </ul>            
                </div><!-- /div .dropdown -->
              </div> <!-- /div .col -->
            </div><!-- /div .row -->
            
            <!-- Tablas de DATOS (DETALLES) -->
            <div class="row">
              <div class="col-lg-12 col-md-12 col-sm-12">
                <table id="tabla" class=" table table-striped table-bordered display" cellspacing="0" width="100%">
                  <thead>
                    <tr>
                      <th>Bodega</th>
                      <th>Código Producto</th>
                      <th>Cultivo</th>
                      <th>F. Embarque</th
                      </tr>
                    </thead>                    
                  </table>
                </div>
              </div> <!-- /div .row -->
            </div> <!-- /div .col -->

            <div class="col-lg-6 col-md-6 col-sm-12">                
              <div id="canvas-holder" >
                <canvas id="chart-area"></canvas>
              </div>            
            </div> <!-- /div .col -->

          </div><!-- /div .row -->
        </div><!-- /div .container -->



        <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
        <script src="assets/js/ie10-viewport-bug-workaround.js"></script>      

        <!-- <script src="dist/js/bootstrap.min.js"></script> -->
        <script src="dist/js/jquery.dataTables.min.js"></script>
        <script src="dist/js/dataTables.bootstrap.js"></script>
        <!--botones DataTables--> 
        <script src="dist/js/dataTables.buttons.min.js"></script>
        <script src="dist/js/buttons.bootstrap.min.js"></script>
        <!--Libreria para exportar Excel-->
        <script src="dist/js/jszip.min.js"></script>
        <!--Librerias para exportar PDF-->
        <script src="dist/js/pdfmake.min.js"></script>
        <script src="dist/js/vfs_fonts.js"></script>
        <!--Librerias para botones de exportación-->
        <script src="dist/js/buttons.html5.min.js"></script>

        <!-- Funciones -->
        <script src="dist/js/productos_graph.js"></script>
        <script src="dist/js/tablero.js"></script>
      </body>
      </html>
