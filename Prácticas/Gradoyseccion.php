<head>
  <meta charset="utf-8"></head>
  <?php
  include("html/menu.php")
?>
<body >
<br>
<form action="Gradoyseccion.php" method="post" target="_blank" >
<div class="container" class="rounded">		
  <div class="row"  style="background-color:ECF0F1">
        <br>
        <h1>Reporte por grado y sección</h1>
        <br>
        <div class="col-lg-12">
            <center>Ingrese un grado:<select  class="login-field2"  value=""  name="grado" required>
                            <option value="BAS01">Primero Básico</option>
                            <option value="BAS02">Segundo Básico</option>
                            <option value="BAS03">Tercero Básico</option>
                            <option value="BACH01">4to. Bachillerato en Computación</option> 
                            <option value="BACH02">5to. Bachillerato en Computación</option> 
                            <option value="PE01">4to. Perito Contador</option> 
                            <option value="PE02">5to. Perito Contador</option> 
                            <option value="PE03">6to. Perito Contador</option> 
                            <option value="BCCLL01">4to. Bachillerato en ciencias y letras</option> 
                            <option value="BCCLL02">5to. Bachillerato en ciencias y letras</option></select><center>
            <center>Ingrese sección:<select  class="login-field2"  value=""  name="seccion" required>
                            <option value="A">Sección A</option>
                            <option value="B">Sección B</option>
                            <option value="C">Sección C</option></select><center>
            <br>
            <input class="btn btn-primary btn-large btn-block"  type="submit" id="bt1" name="bt1" value="Mostrar reporte">
            <br>
            <input class="btn btn-primary btn-large btn-block"  type="submit" id="reporte_gys" name="reporte_gys" value="Imprimir reporte">
            <br>
        </div>
  </div>  
</div>
</form>
<?php

  if(isset($_POST["bt1"]))
  {
    $servername="localhost";
    $user="root";
    $password="";
    $db="aws";
    $conn=mysqli_connect($servername,$user,$password,$db);
    $seccion=$_POST['seccion'];
    $grado=$_POST['grado'];
    $registro="SELECT * FROM `datos_alumno` WHERE `Código_cu`='$grado' and `Sección`='$seccion' ORDER BY `Apellidos` "; //seleccionar los registros delimitados por los filtros sección y grado
    $r=mysqli_query($conn,$registro);
    if(mysqli_num_rows($r)==0)
              {
                echo'<script language="javascript">alert("No hay alumnos en ese grado y sección");</script>';   
              }
    
    else{
        echo //imprimir fila horizontal de la tabla con los campos necesarios
            "<br><br>
            <div class='container-fluid'>
            <div class='row' style='color:white'>
            <div class='col-lg-3' '>
            </div>
              <div class='col-lg-6'  style='background-color:rgb(68, 82, 139);'>
              <p style='font: 30pt garamond;text-aling=left; box-shadow: inset 0 -1px;'>Listado de los alumnos del grado ".$grado." que pertenecen a la sección ".$seccion." </p>
            <center><table class='table table-hover'style='font-family:Garamond; color:white'>
            <thead>
                <tr>
                <th>Código de alumno</th>
                <th>Código de cuenta</th>  
                <th>Nombres</th>
                <th>Apellidos</th>            
                <th>Sección</th>   
                <th>Fecha de nacimiento</th>               
                </tr>
            </thead>";
        while($row=mysqli_fetch_array($r)) //ingresar los datos a la tabla
                {
                    echo"
                    <tr>
                      <td>".$row["Código_alumno"]."</td>
                      <td>".$row["Código_cuenta"]."</td>
                      <td>".$row["Nombres"]."</td>
                      <td>".$row["Apellidos"]."</td>
                      <td>".$row["Sección"]."</td>
                      <td>".$row["Fecha_N"]."</td>
                      </tr>";
                }   
            echo"</div>
            </div>
            </div>";
        $_SESSION['seccion-gys']=$seccion; //guardar datos en superglobal por si acaso se hace primero el reporte visual que el pdf
        $_SESSION['grado-gys']=$grado;
   }
}
if(isset($_POST["reporte_gys"]))
{
    $servername="localhost";
    $user="root";
    $password="";
    $db="aws";
  if(isset($_SESSION['seccion-gys']) and $_SESSION['seccion-gys']!="T" ) //verificar si se hizo el reporte visual antes que el de pdf para ver si solicita los valores por post o valores globales
  {
    $seccion=$_SESSION['seccion-gys'];
    $grado=$_SESSION['grado-gys'];
  }
  else
  {
    $seccion=$_POST['seccion'];
    $grado=$_POST['grado'];
  }
  $conn=mysqli_connect($servername,$user,$password,$db);
  $registro="SELECT * FROM `datos_alumno` WHERE `Código_cu`='$grado' and `Sección`='$seccion' ORDER BY `Apellidos` ";
  $r=mysqli_query($conn,$registro);
  if(mysqli_num_rows($r)==0)
            {
              echo'<script language="javascript">alert("No hay alumnos en ese grado y sección");</script>';   
            }
  
  else{
    $_SESSION['seccion-gys']=$seccion; //enviar datos por superglobales al archivo de pdf
    $_SESSION['grado-gys']=$grado;
    echo "<script>location.href='reportegys.php';</script>"; //redireccionar al archivo de pdf
    
 }
}

   
?>

<br>