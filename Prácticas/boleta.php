<head>
  <meta charset="utf-8"></head>
  <?php
  include("html/menu.php")
?>
<body >
<br>
<form action="boleta.php" method="post" target="_blank" >
<div class="container" class="rounded">		
  <div class="row"  style="background-color:ECF0F1">
        <br>
        <h1>Boleta de calificaciones</h1>
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
                            <option value="BCCLL02">5to. Bachillerato en ciencias y letras</option></select><center><br>
            <center>Ingrese el código de alumno:<input  type="text" name="cod" placeholder="Ingrese Código" ><center><br>
            <br>
            <input class="btn btn-primary btn-large btn-block"  type="submit" id="bt1" name="bt1" value="Mostrar boleta de notas">
            <br>
            <input class="btn btn-primary btn-large btn-block"  type="submit" id="bt2" name="bt2"value="Imprimir boleta de notas">
            <br>
        </div>
  </div>  
</div>
</form>
<br><br>
<div class="row" >
  <div class="col-2 col-md-2" >
  </div>
  <div class="col-8 col-md-8" >
      
</nav>
<?php

  if(isset($_POST["bt1"])) //Botón de mostrar en la pantalla el reporte
  {
    $servername="localhost";
    $user="root";
    $password="";
    $db="aws";
    $conn=mysqli_connect($servername,$user,$password,$db);
    $cod=$_POST['cod'];
    $grado=$_POST['grado'];
    $_SESSION['grado_r3']=$grado;
    $_SESSION['codigo_r3']=$cod;
    $busqueda_grado="SELECT * FROM `datos_alumno` WHERE  `Código_alumno`='$cod'";// Buscar el registro que contiene el saldo actual
    $v2=mysqli_query($conn,$busqueda_grado);
    if(mysqli_num_rows($v2)==0)
    {
      echo'<script language="javascript">alert("El código no existe o es incorrecto");</script>';   
    }
    else
    {
      while($row=mysqli_fetch_array($v2)) //Búsqueda del curso al que pertenece en base al código ingresado
          {
            $c_cu=$row['Código_cu']; //verificar que el grado ingresado sea el correspondiente al código ingresado
            if($c_cu!=$grado)
            {
              echo'<script language="javascript">alert("El grado y codigo no coinciden");</script>';   
            }
          }
          //Imprimir fila de los campos correspondientes al el curso ingresado y devolver la tabla donde se encuentran las notas(la tabla de los grados)----------------------------------------------------------------
          if($c_cu=="BAS01" or $c_cu=="BAS02" or $c_cu=="BAS03" )
          {   $tabla="basicos";
            echo'
            <div class="container-fluid" style="font-family:Garamond;color:white;" >
            <center><p style="font: 35pt garamond; color:white;">Boleta de notas</p>
            <hr><br>
            <table class="table table-hover" style="font-family:Garamond;color:white;">
              <thead>
                <tr>
                  <th>Código de Alumno</th>
                  <th>Nombres</th>            
                  <th>Apellidos</th>
                  <th>Matemáticas</th>
                  <th>Lenguaje</th>
                  <th>Sociales</th>
                  <th>Ingles</th>
                  <th>Artes</th>
                  <th>Biología</th>
                  <th>Química</th>     
                  <th>Tecnología</th>                     
                  </tr>
              </thead>';
          }
          if($c_cu=="BACH01" or $c_cu=="BACH02" )
            {   $tabla="bachi_compu";
                if($grado=="BACH01")//para cambiar el nombre de la clase, aunque compartan el mismo espacio
                {
                    $p1="Programación 1";
                    $c1="Computación 1";
                }else{
                    $p1="Programación 2";
                    $c1="Computación 2";
                }
                echo'
                <div class="container-fluid" style="font-family:Garamond;color:white;" >
                <center><p style="font: 35pt garamond; color:white;">Boleta de notas</p>
                <table class="table table-hover" style="font-family:Garamond;color:white;">
                  <thead>
                    <tr>
                      <th>Código de Alumno</th>
                      <th>Nombres</th>            
                      <th>Apellidos</th>
                      <th>Matemáticas</th>
                      <th>Literatura</th>
                      <th>Filosofía</th>
                      <th>Ingles</th>
                      <th>Artes</th>
                      <th>'.$c1.'</th>
                      <th>'.$p1.'</th>  
                      <th>Tecnología</th>             
                      </tr>
                  </thead>';
              }
          if($c_cu=="PE01" or $c_cu=="PE02" or $c_cu=="PE03")
              {   $tabla="bachi_perito";
                  if($grado=="PE01")
                    {
                      $c="Contabilidad 1";
                    }if($grado=="PE02"){
                      $c="Contabilidad 2";
                    }
                    if($grado=="PE03"){
                      $c="Contabilidad 3";
                      }
                echo'
                <div class="container-fluid" style="font-family:Garamond;color:white;" >
                <center><p style="font: 35pt garamond; color:white;">Boleta de notas</p>
                <table class="table table-hover" style="font-family:Garamond;color:white;">
                  <thead>
                    <tr>
                      <th>Código de Alumno</th>
                      <th>Nombres</th>            
                      <th>Apellidos</th>
                      <th>Matemáticas</th>
                      <th>Literatura</th>
                      <th>Filosofía</th>
                      <th>Ingles</th>
                      <th>Artes</th>
                      <th>'.$c.'</th>
                      <th>Tecnología</th>             
                      </tr>
                  </thead>';
              }
          if($c_cu=="BCCLL01" or $c_cu=="BCCLL02")
            {   $tabla="bachi_letras";
                echo'
                <div class="container-fluid" style="font-family:Garamond;color:white;" >
                <center><p style="font: 35pt garamond; color:white;">Boleta de notas</p>
                <table class="table table-hover" style="font-family:Garamond;color:white;">
                  <thead>
                    <tr>
                      <th>Código de Alumno</th>
                      <th>Nombres</th>            
                      <th>Apellidos</th>
                      <th>Matemáticas</th>
                      <th>lenguaje</th>
                      <th>Sociales</th>
                      <th>Ingles</th>
                      <th>Artes</th>
                      <th>Biología</th>
                      <th>Química</th>    
                      <th>Tecnología</th>                      
                      </tr>
                  </thead>';
                }
     // ----------------------------------------------------------------------------------------------------------------------------------------
      $registro="SELECT * FROM `$tabla` WHERE `Código_alumno`='$cod' ";
      $r=mysqli_query($conn,$registro);
      while($row=mysqli_fetch_array($r)) // mostrar todos los datos del registro en una tabla dependiendo en la tabla donde se encuentre
                  {
                    if($grado=="BAS01" or $grado=="BAS02" or $grado=="BAS03" )
                    {
                      echo"
                      <tr>
                        <td>".$row["Código_alumno"]."</td>
                        <td>".$row["Nombres"]."</td>
                        <td>".$row["Apellidos"]."</td>
                        <td>".$row["matemáticas"]."</td>
                        <td>".$row["lenguaje"]."</td>
                        <td>".$row["sociales"]."</td>
                        <td>".$row["ingles"]."</td>
                        <td>".$row["artes"]."</td>
                        <td>".$row["biología"]."</td>
                        <td>".$row["química"]."</td>
                        <td>".$row["tecnología"]."</td>
                        </tr>";
                    }
                    if($grado=="BACH01" or $grado=="BACH02" )
                    {
                        echo"
                        <tr>
                          <td>".$row["Código_alumno"]."</td>
                          <td>".$row["Nombres"]."</td>
                          <td>".$row["Apellidos"]."</td>
                          <td>".$row["matemáticas"]."</td>
                          <td>".$row["literatura"]."</td>
                          <td>".$row["filosofía"]."</td>
                          <td>".$row["ingles"]."</td>
                          <td>".$row["artes"]."</td>
                          <td>".$row["computación"]."</td>
                          <td>".$row["programación"]."</td>
                          <td>".$row["tecnología"]."</td>
                          </tr>";
                    }
                    if($grado=="PE01" or $grado=="PE02" or $grado=="PE03")
                    {
                      echo"
                      <tr>
                        <td>".$row["Código_alumno"]."</td>
                        <td>".$row["Nombres"]."</td>
                        <td>".$row["Apellidos"]."</td>
                        <td>".$row["matemáticas"]."</td>
                        <td>".$row["literatura"]."</td>
                        <td>".$row["filosofía"]."</td>
                        <td>".$row["contabilidad"]."</td>
                        <td>".$row["ingles"]."</td>
                        <td>".$row["artes"]."</td>
                        <td>".$row["tecnología"]."</td>
                        </tr>";
                    }
                    if($grado=="BCCLL01" or $grado=="BCCLL02" )
                    {
                      echo"
                      <tr>
                        <td>".$row["Código_alumno"]."</td>
                        <td>".$row["Nombres"]."</td>
                        <td>".$row["Apellidos"]."</td>
                        <td>".$row["matemáticas"]."</td>
                        <td>".$row["literatura"]."</td>
                        <td>".$row["sociales"]."</td>
                        <td>".$row["ingles"]."</td>
                        <td>".$row["artes"]."</td>
                        <td>".$row["biología"]."</td>
                        <td>".$row["química"]."</td>
                        <td>".$row["tecnología"]."</td>
                        </tr>";
                    }
                  }
                  
    } //cierre del else
  }         
               ?>        
   </tbody>
</table>		
   </div>
</div>
</div>

<?php

if(isset($_POST["bt2"]))
{
  $servername="localhost";
  $user="root";
  $password="";
  $db="aws";
  
  $conn=mysqli_connect($servername,$user,$password,$db);
  if(isset($_SESSION['codigo_r3']) and $_SESSION['codigo_r3']!="T" ) //para validar si hicieron el reporte no pdf antes, así toma los datos que se utilizaron para ese en vez de recogerlos con post
  {
    $cod=$_SESSION['codigo_r3']; //obtener los datos que se utilizaron en el registro el reporte visual no pdf para realizar el pdf
    $grado=$_SESSION['grado_r3'];
  }
  else
  {
    $cod=$_POST['cod'];
    $grado=$_POST['grado'];
  }

  $busqueda_grado="SELECT * FROM `datos_alumno` WHERE  `Código_alumno`='$cod'";// Buscar el registro que tenga el código de alumno y los datos del mismo
  $v2=mysqli_query($conn,$busqueda_grado);
  if(mysqli_num_rows($v2)==0) //verificar que si hayan registros en la búsqueda
  {
    echo'<script language="javascript">alert("El código no existe o es incorrecto");</script>';   
  }
  else{
  while($row=mysqli_fetch_array($v2))
      {
        $c_cu=$row['Código_cu'];  
        if($c_cu!=$grado) //verificar que ambos datos coincidan 
        {
          echo'<script language="javascript">alert("El grado y codigo no coinciden");</script>';   
        }
      }
    $_SESSION['grado_r3']=$grado; //enviar los valores por variables superglobales al pdf
    $_SESSION['codigo_r3']=$cod;
    echo "<script>location.href='reporte3.php';</script>"; //mandar a la página del pdf
  }
 
}

   
?>

<br>