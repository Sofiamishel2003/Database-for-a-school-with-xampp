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
<form action="datos_alumnos.php" method="post">
<div class="container-fluid" style="font-family:Garamond;color:white;" >
 <center><p style='font: 30pt garamond;color:white;'>Búsqueda por datos de alumnos</p>
 <hr>
<div class="row" >
  <div class="col-12 col-md-12" >
        <div class="input-group mb-3">

          <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">Buscar registros</span>
          </div>

          <input id="Filtrar" type="text" name="dato" class="form-control" placeholder="Ingrese filtro" >
        </div>
</nav>

<table class="table table-hover" style="font-family:Garamond;color:white;">
  <thead>
    <tr>  <!--Fila horizontal con los campos del registro de búsqueda-->
      <th>Código de Alumno</th>
      <th>Código de cuenta</th>
      <th>Nombres</th>            
      <th>Apellidos</th>
      <th>Nacimiento</th>
      <th>Grado</th>
      <th>Sección</th>            
      </tr>
  </thead>

  <tbody class="BusquedaRapida">
       
       <!-- Muestra el contenido de la base -->
    
       <?php
       $lista=array("");
       $conn = mysqli_connect("localhost","root","","aws");
 
       $consulta = "SELECT * FROM datos_alumno ORDER BY `Apellidos` " ;
       $resultado = mysqli_query($conn , $consulta); 
       while($row = mysqli_fetch_array($resultado)) 
       {  
       echo"
       <tr>
         <td>".$row["Código_alumno"]."</td>
         <td>".$row["Código_cuenta"]."</td>
         <td>".$row["Nombres"]."</td>
         <td>".$row["Apellidos"]."</td>
         <td>".$row["Fecha_N"]."</td>
         <td>".$row["Grado"]."</td>
         <td>".$row["Sección"]."</td>
         </tr>";
        }
        print(implode(",",$lista));
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
    $sql="SELECT Código_alumno,Nombres,Apellidos,Fecha_N,Grado,Sección FROM `datos_alumno` WHERE `Código_alumno` LIKE '%".$dato."%' OR `Nombres` LIKE '%".$dato."%' OR `Apellidos` LIKE '%".$dato."%' OR `Fecha_N` LIKE '%".$dato."%' OR `Grado` LIKE '%".$dato."%' OR `Sección` LIKE '%".$dato."%'"; 
    $r1=mysqli_query($conn,$sql); //buscar entre todos los campos si tienen el filtro ingresado y devolver los registros donde encontró
    if(mysqli_num_rows($r1)>0)
        {
            while($row=mysqli_fetch_array($r1))
                    {
                      $cod=$row['Código_alumno'];
                    }

        }
        
    if(mysqli_num_rows($r1)==0 or $dato=="" or mysqli_num_rows($r1)>1 )
        {
            echo'<script language="javascript">alert("Filtro incorrecto");</script>';
            exit;   
        }
    $_SESSION['codigo_r1']=$cod; //mandar por superglobal la varible de código para el archivo de pdf
    echo "<script>location.href='reporte1.php';</script>";  //redireccionar al pdf
       } 
    
       ?>          

</form  >

<br></center>}

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>