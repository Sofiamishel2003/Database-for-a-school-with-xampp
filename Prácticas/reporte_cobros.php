<head>
  <meta charset="utf-8"></head>
  <?php
  include("html/menu.php")
?>
<body >
<br>
<script src="http://code.jquery.com/jquery-2.1.4.min.js" type="text/javascript"></script>

<!-- Bootstrap core CSS -->
<link href="dist/css/bootstrap.min.css" rel="stylesheet">


<!--Funcion de jquery para el filtrado-->

<script type="text/javascript">
$(document).ready(function () {
   (function($) {
       $('#Filtrar').keyup(
        function () 
        {
            var ValorBusqueda = new RegExp($(this).val(), 'i');
            $('.BusquedaRapida tr').hide();                 
             $('.BusquedaRapida tr').filter(function () {
                return ValorBusqueda.test($(this).text());
              }).show();
              
                })
      }(jQuery));
});
</script> 
<form action="reporte_cobros.php" method="post" target="_blank" >
<div class="container" class="rounded">		
  <div class="row"  style="background-color:ECF0F1">
        <br>
        <h1>Reporte de cobros</h1>
        <br>
        <div class="half left cf">
            <p>Ingrese rango de fechas</p>
            Desesde:<input class="form-control"  type="date" name="fecha1"  ><br>
          </div>
        <div class="half right cf" >
            <p style="color:ECF0F1">..</p>
            Hasta:<input class="form-control"  type="date" name="fecha2" ><br>
            <br>
            <p style="text-align: left;">Ordenar por:</p>
            <select  class="form-control"  value=""  name="orden" required>
                            <option value="fecha">Fecha de emisión</option>
                            <option value="n_recibo">Número de recibo</option>
                            <option value="Código_cuenta">Número de cuenta</option></select>
        </div> 
        <div class="col-lg-12" style="background-color:ECF0F1">
            <input class="btn btn-primary btn-large btn-block"  type="submit" id="bt1" name="bt1" value="Mostrar reporte">
            <br>
            <input class="btn btn-primary btn-large btn-block"  type="submit" id="bt2" name="bt2" value="Imprimir reporte">            
            <br><br>
        </div> 
    </div>  
</div>  
<?php

  if(isset($_POST["bt1"]))
  {
    $servername="localhost";
    $user="root";
    $password="";
    $db="aws";
    $conn=mysqli_connect($servername,$user,$password,$db);
    $orden=$_POST['orden'];
    $fecha1=$_POST['fecha1'];
    $fecha2=$_POST['fecha2'];
    $_SESSION['orden']=$orden;
    $_SESSION['fecha1']=$fecha1;
    $_SESSION['fecha2']=$fecha2;
    $registro="SELECT * FROM `datos del cobro` WHERE `fecha` BETWEEN '$fecha1'  AND '$fecha2'  ORDER BY `$orden` ";
    $r=mysqli_query($conn,$registro);
    if(mysqli_num_rows($r)==0)
              {
                echo'<script language="javascript">alert("No hay alumnos cobros en ese rango o rango incorrecto");</script>';   
              }
    
    else{
        echo 
            "<br><br>
            <div class='container-fluid'>
            <div class='row' style='color:white'>
            <div class='col-lg-3' '>
            </div>
              <div class='col-lg-12' '>
              <p style='font: 30pt garamond;text-aling=left; box-shadow: inset 0 -1px;'>Historial de pagos y cobros entre ".$fecha1." y ".$fecha2." </p>
            <center><table class='table table-hover'style='font-family:Garamond; color:white'>
            <thead>
                <tr>
                <th>Recibo</th>
                <th>Código de cuenta</th>  
                <th>Nit</th>
                <th>Fecha</th>            
                <th>Servicios</th>   
                <th>Subtotal</th>               
                <th>Descuento</th>      
                <th>Total</th>  
                </tr>
            </thead>";
        while($row=mysqli_fetch_array($r))
                {
                    echo"
                    <tr>
                      <td>".$row["n_recibo"]."</td>
                      <td>".$row["Código_cuenta"]."</td>
                      <td>".$row["nit"]."</td>
                      <td>".$row["fecha"]."</td>
                      <td>".$row["servicios"]."</td>
                      <td>Q.".$row["subtotal"]."</td>
                      <td>Q.".$row["descuento"]."</td>
                      <td>Q.".$row["Total"]."</td>
                      </tr>";
                }   
            echo"</div>
            </div>
            </div>";
   }
}
if(isset($_POST["bt2"]))
{
    $servername="localhost";
    $user="root";
    $password="";
    $db="aws";
    $conn=mysqli_connect($servername,$user,$password,$db);
    if(isset($_SESSION['fecha1']) and $_SESSION['fecha1']!="T" )
      {
        $orden=$_SESSION['orden'];
        $fecha1=$_SESSION['fecha1'];
        $fecha2=$_SESSION['fecha2'];
      }
    else
    {
      $orden=$_POST['orden'];
      $fecha1=$_POST['fecha1'];
      $fecha2=$_POST['fecha2'];
    }
    $registro="SELECT * FROM `datos del cobro` WHERE `fecha` BETWEEN '$fecha1'  AND '$fecha2'  ORDER BY `$orden` ";
    $r=mysqli_query($conn,$registro);
    if(mysqli_num_rows($r)==0)
            {
              echo'<script language="javascript">alert("No hay alumnos en ese grado y sección");</script>';   
            }
  
  else{
    $_SESSION['orden']=$orden;
    $_SESSION['fecha1']=$fecha1;
    $_SESSION['fecha2']=$fecha2;
    echo "<script>location.href='reporte4.php';</script>";
    
 }
}

   
?>
</form>

<br>
