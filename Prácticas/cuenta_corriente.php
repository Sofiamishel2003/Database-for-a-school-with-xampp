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
<form action="cuenta_corriente.php" method="post">
<div class="container-fluid" style="font-family:Garamond;color:white;" >
 <center><p style='font: 30pt garamond;color:white;'>Historial de pagos y cobros</p>
 <hr><br><br>
<div class="row" >
  <div class="col-12 col-md-12" >
        <div class="input-group mb-3">

          <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">Buscar registros</span>
          </div>

          <input id="Filtrar" type="text" name="dato" class="form-control" placeholder="Ingrese código de alumno" >
        </div>
</nav>

<table class="table table-hover" style="font-family:Garamond;color:white;">
  <thead>
    <tr>
      <th>Código de Alumno</th>
      <th>Servicio</th>            
      <th>Descuento</th>
      <th>Costo</th>
      <th>Total</th>
      <th>Fecha</th>             
      </tr>
  </thead>

  <tbody class="BusquedaRapida">
       
       <!-- Muestra el contenido de la base -->
    
       <?php
       $conn = mysqli_connect("localhost","root","","aws");
 
       $consulta = "SELECT * FROM datos_servicio";
       $resultado = mysqli_query($conn , $consulta); 
       while($row = mysqli_fetch_array($resultado)) 
       {  
        if($row["Código_servicio"]=="S1")
        {
            $servicio="Internet y uso de laboratorios";
        }
        if($row["Código_servicio"]=="S2")
        {
            $servicio="Servicio de Bus";
        }
        if($row["Código_servicio"]=="S3")
        {
            $servicio="Excursión";
        }
        if($row["Código_servicio"]=="S4")
        {
            $servicio="Campamento";
        }
        if($row["Código_servicio"]=="S5")
        {
            $servicio="Almuerzos";
        }
        if($row["Código_servicio"]=="S6")
        {
            $servicio="Colegiatura";
        }
       echo"
       <tr>
         <td>".$row["Código_alumno"]."</td>
         <td>".$servicio."</td>
         <td> Q.".strval($row['costo']*$row['descuento'])."</td>
         <td> Q.".$row["costo"]."</td>
         <td> Q.".strval($row["costo"]-($row['costo']*$row['descuento']))."</td>
         <td>".$row["fecha"]."</td>
         </tr>";
 
        }
        ?>    
   </tbody>
</table>		
   </div>
</div>
</div>
<input class="btn btn-primary btn-large btn-block"  type="submit" id="bt1" name="bt1" value="Imprimir reporte">

<?php
if (isset($_POST["bt1"]))
 {
    $cod="";
    $dato=$_POST['dato']; 
    $sql="SELECT * FROM `datos_alumno` WHERE `Código_alumno` LIKE '%".$dato."%'";  //verifica los registros donde el filtro se encuentra en cualquiera de los campos
    $r1=mysqli_query($conn,$sql);
    if(mysqli_num_rows($r1)>0)
        {
            while($row=mysqli_fetch_array($r1))
                    {
                      $cod=$row['Código_alumno']; //guardar el código de alumno correspondiente al registro
                    }

        }
        
    if(mysqli_num_rows($r1)==0 or $dato==""  )
        {
            echo'<script language="javascript">alert("Filtro incorrecto");</script>';
            exit;   
        }
    $_SESSION['codigo_r2']=$cod; //envíar el código por una variable superglobal al archivo de pdf
    echo "<script>location.href='reporte2.php';</script>";  //redireccionar al archivo del pdf
       } 
    
       ?>          

</form  >

<br></center>}

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>