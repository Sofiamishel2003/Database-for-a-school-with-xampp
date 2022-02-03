<head>
  <meta charset="utf-8"></head>
  <?php
  include("html/menu.php")
?>
<body >
<br>

<form action="modybaja.php" method="post" target="_blank" >
<div class="container" class="rounded">		
  <div class="row"  style="background-color:ECF0F1">
        <br>
        <h1>Modificar datos y dar de baja a alumnos</h1>
        <br>
        <div class="col-lg-12">
            <center>Ingrese el código de alumno:<input  type="text" name="cod" placeholder="Ingrese Código" required><center><br>
            <br>
            <input class="btn btn-primary btn-large btn-block"  type="submit" id="bt1" name="bt1" value="Modificar datos">
            <br>
            <input class="btn btn-primary btn-large btn-block"  type="submit" id="bt2" name="bt2" value="Dar de baja al alumno">
            <br>
        </div>
  </div>  
</div>
</form>
<?php
$cod="";
$c_cu="";
  if(isset($_POST["bt1"]))
        {
        $servername="localhost";
        $user="root";
        $password="";
        $db="aws";
        $conn=mysqli_connect($servername,$user,$password,$db);
        $cod=$_POST['cod'];
        $sql="SELECT * FROM `datos_alumno` WHERE `Código_alumno`='$cod'";// Buscar el registro que contiene el saldo actual
        $r=mysqli_query($conn,$sql);
        if(mysqli_num_rows($r)>0)
        {
          while($row=mysqli_fetch_array($r))// darle valor a las tareas
                {
                  $names=$row['Nombres'];
                  $lastnames=$row['Apellidos'];
                  $email=$row['Correo electrónico'];
                  $Dirección=$row['Dirección'];
                  $Teléfono=$row['Teléfono'];
                  $Npadre=$row['Npadre'];
                  $Nmadre=$row['Nmadre'];
                  $Fecha_N=$row['Fecha_N'];
                  $Observaciones=$row['Observaciones'];
                  $Fecha_Ing=$row['Fecha_Ing'];
                  $Código_cu=$row['Código_cu'];
                }
            $_SESSION['codigo_para']=$cod; //enviar valor por
            echo'  <br>
            <div class="container" class="rounded">		
            <div class="row"  style="background-color:ECF0F1">
                    <br>
                    <h1>Ingrese todos los campos solicitados</h1>
                    <br>
                    <form name="f1" id="f1" action="modybaja.php" method="post" target="_blank" >
                    <div class="half left cf">
                        <input class="form-control" type="text" value='.$names.' name="nombre" placeholder="Ingrese Nombres" required><br>
                        <input class="form-control" type="text" value='.$email.' name="mail" placeholder="Ingrese Correo Electrónico" required><br>
                        <input class="form-control" type="text" value='.$Teléfono.' name="numero1" placeholder="Ingrese Número de Teléfono" required><br>
                        <input class="form-control" type="text" value='.$Npadre.' name="Npadre" placeholder="Ingrese Nombre del Padre" required><br>
                        <br>
                        <p>Ingrese Fecha de Nacimiento</p>
                        <input class="form-control" value='.$Fecha_N.' type="date" name="fechaN" required><br>
                        <textarea class="form-control" value='.$Observaciones.'  name="obser" type="text" placeholder="Ingrese Observaciones" required></textarea>
                        <br><br>
                        <input class="btn btn-primary btn-large btn-block"  type="submit" id="bt3" name="bt3" value="Guardar modificaciones">
                    </div>
                    <div class="half right cf" >
                        <input class="form-control" type="text" value='.$lastnames.' name="apellido"  placeholder="Ingrese Apellidos" required><br>
                        <textarea class="form-control" value='.$Dirección.' name="direccion" type="text" placeholder="Ingrese Dirección" required></textarea><br>
                        <input class="form-control"  value='.$Nmadre.' type="text" name="Nmadre" placeholder="Ingrese Nombre de la Madre" required><br>
                        <br>
                        <p style="text-align: left;">Ingrese Fecha de ingreso</p>
                        <input class="form-control" value='.$Fecha_Ing.' type="date" name="fechaI" required><br>
                        <br>
                        <p style="text-align: left;">Seleccione el grado/carrera</p>
                        <select  class="form-control"  value='.$Código_cu.'   name="grado" required>
                                        <option value="BAS01">Primero Básico</option>
                                        <option value="BAS02">Segundo Básico</option>
                                        <option value="BAS03">Tercero Básico</option>
                                        <option value="BACH01">4to. Bachillerato en Computación</option> 
                                        <option value="BACH02">5to. Bachillerato en Computación</option> 
                                        <option value="PE01">4to. Perito Contador</option> 
                                        <option value="PE02">5to. Perito Contador</option> 
                                        <option value="PE03">6to. Perito Contador</option> 
                                        <option value="BCCLL01">4to. Bachillerato en ciencias y letras</option> 
                                        <option value="BCCLL02">5to. Bachillerato en ciencias y letras</option></select>
                                        
                    </div> 
                </div>  
            </div>  
            </form>

            <br>';
    }
    else
    {
        echo'<script language="javascript">alert("El código familiar ingresado es incorrecto o inexistente");</script>';   
          exit;
    }
}
  if(isset($_POST["bt3"]))
  {
    $servername="localhost";
    $user="root";
    $password="";
    $db="aws";
    $conn=mysqli_connect($servername,$user,$password,$db);
    $name=$_POST['nombre'];
    $lastname=$_POST['apellido'];
    $correo=$_POST['mail'];
    $telefono=$_POST['numero1'];
    $npadre=$_POST['Npadre'];
    $nmadre=$_POST['Nmadre'];
    $direccion=$_POST['direccion'];
    $fecha_i=$_POST['fechaI'];
    $fecha_n=$_POST['fechaN'];
    $observaciones=$_POST['obser'];
    $g=$_POST['grado'];
    $cod=$_SESSION['codigo_para'];
    $grad="";
    $correlativo=0;
    $c_cu="";
    $busqueda_grado="SELECT * FROM `datos_alumno` WHERE `Código_alumno`='$cod'";// Buscar el registro que contiene el saldo actual
    $v2=mysqli_query($conn,$busqueda_grado);
    while($row=mysqli_fetch_array($v2))
    {
      $c_cu=$row['Código_cu'];
    }
    if($c_cu=="BAS01" or $c_cu=="BAS02" or $c_cu=="BAS03" )
    {   $tabla="basicos";
    }
    if($c_cu=="BACH01" or $c_cu=="BACH02" )
    {   $tabla="bachi_compu";
    }
    if($c_cu=="PE01" or $c_cu=="PE02" or $c_cu=="PE03")
    {   $tabla="bachi_perito";
    }
    if($c_cu=="BCCLL01" or $c_cu=="BCCLL02")
    {   $tabla="bachi_letras";
    }
    $sql0="SELECT * FROM `$tabla` WHERE `Código_alumno`='$cod'";
    $r01= mysqli_query($conn,$sql0);
    while($row=mysqli_fetch_array($r01))
                {
                  $saldo=$row['saldo'];
                }
    $sqll="SELECT * FROM `datos_alumno` WHERE `Código_alumno`='$cod'"; 
    $r=mysqli_query($conn,$sqll);
    if(mysqli_num_rows($r)>0)
        {
          while($row=mysqli_fetch_array($r))
                {
                  $seccion=$row['Sección'];
                  $c_cuenta=$row['Código_cuenta'];
                  $gradol=$row['Grado'];
                  $Código_cu=$row['Código_cu'];
                }
        }
    
 //Seleccionar el grado
        if  ($g=="BAS01")
              {
                $c_cu="BAS01";
                $grad="Primero Básico";
                }
            if  ($g=="BAS02")
              {
                $c_cu="BAS02";
                $grad="Segundo Básico";
              }
            if  ($g=="BAS03")
              { 
                $c_cu="BAS03";
                $grad="Tercero Básico";
              }
            if  ($g=="BACH01")
              {  $c_cu="BACH01";
                $grad="4to. Bachillerato en Computación";
              }
            if  ($g=="BACH02")
              { $c_cu="BACH02";
                $grad="5to. Bachillerato en Computación";
              }
            if  ($g=="PE01")
              {  $c_cu="PE01";
                $grad="4to. Perito Contador";
              }
            if  ($g=="PE02")
              {  $c_cu="PE02";
                $grad="5to. Perito Contador";
              }
            if  ($g=="PE03")
              { $c_cu="PE03";
                $grad="6to. Perito Contador";
              }
            if  ($g=="BCCLL01")
              {  $c_cu="BCCLL01";
                $grad="4to. Bachillerato en ciencias y letras";
              }
            if  ($g=="BCCLL02")
              {  $c_cu="BCCLL02";
                $grad="5to. Bachillerato en ciencias y letras";
                }
            //Sección
            if($Código_cu!=$c_cu)
            {
                $seccion="";
                $validar_sección="SELECT * FROM `datos_alumno` WHERE `Sección`='A' and `Código_cu`='$c_cu' "; 
                $r2=mysqli_query($conn,$validar_sección);
                    if(mysqli_num_rows($r2)<21)
                    {
                        $seccion="A";     
                    }else
                    {
                        $validar_sección2="SELECT * FROM `datos_alumno` WHERE `Sección`='B'"; 
                        $r3=mysqli_query($conn,$validar_sección2);
                        if(mysqli_num_rows($r3)<21)
                        {
                            $seccion="B";     
                        }
                        else
                        {
                        $seccion="C";   
                        }
                    }
              }
              
          //ingreso de datos en tablas
            
          $sql="UPDATE `datos_alumno` SET `Nombres`='$name',`Apellidos`='$lastname',`Correo electrónico`='$correo',`Dirección`='$direccion',`Teléfono`='$telefono',`Npadre`='$npadre',`Nmadre`='$nmadre',`Fecha_N`='$fecha_n',`Fecha_Ing`='$fecha_i',`Observaciones`='$observaciones',`Código_cu`='$c_cu',`Grado`='$grad',`Sección`='$seccion' WHERE `Código_alumno`='$cod' ";
          $r6=mysqli_query($conn,$sql);
          //ESCOGER A QUE TABLA VA A SER ENVIADO DE LAS NOTAS
          $temp=0;
          //Las cuentas mensuales * 10 + el precio de las tarifas anuales
          if($gradol!=$grad) //si el grado es diferente que elimine los registros en los otros grados
          {
            if($c_cu=="BAS01" or $c_cu=="BAS02" or $c_cu=="BAS03" )
            {
                $sql4="INSERT INTO `basicos`(`Código_cu`,`Código_cuenta`,`Código_alumno`,`saldo`,`Nombres`,`Apellidos`,`matemáticas`,`lenguaje`,`sociales`,`ingles`,`artes`,`biología`,`química`,`tecnología`)
                VALUES('$c_cu','$c_cuenta','$cod','$saldo','$name','$lastname','$temp','$temp','$temp','$temp','$temp','$temp','$temp','$temp')";
            }
            if($c_cu=="BACH01" or $c_cu=="BACH02" )
            {
                $sql4="INSERT INTO `bachi_compu`(`Código_cu`,`Código_cuenta`,`Código_alumno`,`saldo`,`Nombres`,`Apellidos`,`matemáticas`,`literatura`,`filosofía`,`ingles`,`artes`,`computación`,`programación`,`tecnología`)
                VALUES('$c_cu','$c_cuenta','$cod','$saldo','$name','$lastname','$temp','$temp','$temp','$temp','$temp','$temp','$temp','$temp')";
            }
            if($c_cu=="PE01" or $c_cu=="PE02" or $c_cu=="PE03")
            {
                $sql4="INSERT INTO `bachi_perito`(`Código_cu`,`Código_cuenta`,`Código_alumno`,`saldo`,`Nombres`,`Apellidos`,`matemáticas`,`literatura`,`contabilidad`,`ingles`,`artes`,`tecnología`)
                VALUES('$c_cu','$c_cuenta','$cod','$saldo','$name','$lastname','$temp','$temp','$temp','$temp','$temp','$temp')";
            }
            if($c_cu=="BCCLL01" or $c_cu=="BCCLL02" or $c_cu=="BCCLL03" )
            {
                $sql4="INSERT INTO `bachi_letras`(`Código_cu`,`Código_cuenta`,`Código_alumno`,`saldo`,`Nombres`,`Apellidos`,`matemáticas`,`literatura`,`sociales`,`ingles`,`artes`,`biología`,`química`,`tecnología`)
                VALUES('$c_cu','$c_cuenta','$cod','$saldo','$name','$lastname','$temp','$temp','$temp','$temp','$temp','$temp','$temp','$temp')";
            }
            $insertar=mysqli_query($conn,$sql4);
            if($Código_cu=="BAS01" or $Código_cu=="BAS02" or $Código_cu=="BAS03" )
            {
                $sql9="DELETE FROM`basicos`WHERE `Código_alumno`='$cod' and `Código_cu`='$Código_cu' ";
            }
            if($Código_cu=="BACH01" or $Código_cu=="BACH02" )
            {
                $sql9="DELETE FROM `bachi_compu`WHERE `Código_alumno`='$cod'  and `Código_cu`='$Código_cu'";
            }
            if($Código_cu=="PE01" or $Código_cu=="PE02" or $Código_cu=="PE03")
            {
                $sql9="DELETE FROM `bachi_perito` WHERE `Código_alumno`='$cod' and `Código_cu`='$Código_cu'";
            }
            if($Código_cu=="BCCLL01" or $Código_cu=="BCCLL02" or $Código_cu=="BCCLL03" )
            {
                $sql9="DELETE FROM `bachi_letras` WHERE `Código_alumno`='$cod' and `Código_cu`='$Código_cu'";
            }
            $eliminar=mysqli_query($conn,$sql9);
        }
        if($c_cu=="BAS01" or $c_cu=="BAS02" or $c_cu=="BAS03" )
            {
                $sql4="UPDATE `basicos` SET `Nombres`='$name',`Apellidos`='$lastname'  WHERE `Código_alumno`='$cod'";
            }
            if($c_cu=="BACH01" or $c_cu=="BACH02" )
            {
                $sql4="UPDATE `bachi_compu`SET `Nombres`='$name',`Apellidos`='$lastname'  WHERE `Código_alumno`='$cod'";
            }
            if($c_cu=="PE01" or $c_cu=="PE02" or $c_cu=="PE03")
            {
                $sql4="UPDATE `bachi_perito` SET `Nombres`='$name',`Apellidos`='$lastname'  WHERE `Código_alumno`='$cod'";
            }
            if($c_cu=="BCCLL01" or $c_cu=="BCCLL02" or $c_cu=="BCCLL03" )
            {
                $sql4="UPDATE `bachi_letras` SET `Nombres`='$name',`Apellidos`='$lastname'  WHERE `Código_alumno`='$cod'";
            }
            $insertar=mysqli_query($conn,$sql4);
    }
      
   

  if(isset($_POST["bt2"]))
  {  
    $servername="localhost";
    $user="root";
    $password="";
    $db="aws";
    $conn=mysqli_connect($servername,$user,$password,$db);
    $cod=$_POST['cod'];
    $busqueda_grado="SELECT * FROM `datos_alumno` WHERE `Código_alumno`='$cod'";// Buscar el registro que contiene el saldo actual
    $v2=mysqli_query($conn,$busqueda_grado);
    if(mysqli_num_rows($v2)==0)
    {
      echo'<script language="javascript">alert("El código  ingresado es incorrecto o inexistente");</script>';   
          exit;
    }
    else{
    while($row=mysqli_fetch_array($v2))
    {
      $c_cu=$row['Código_cu'];
    
    }
    if($c_cu=="BAS01" or $c_cu=="BAS02" or $c_cu=="BAS03" )
    {   $tabla="basicos";
    }
    if($c_cu=="BACH01" or $c_cu=="BACH02" )
    {   $tabla="bachi_compu";
    }
    if($c_cu=="PE01" or $c_cu=="PE02" or $c_cu=="PE03")
    {   $tabla="bachi_perito";
    }
    if($c_cu=="BCCLL01" or $c_cu=="BCCLL02")
    {   $tabla="bachi_letras";
    }

    $sql1="DELETE FROM `datos_alumno` WHERE `Código_alumno`='$cod';";
    $r1=mysqli_query($conn,$sql1);  
    $sql2="DELETE FROM `$tabla` WHERE `Código_alumno`='$cod';";
    $r2=mysqli_query($conn,$sql2);  
   // $sql3="DELETE FROM `datos del cobro` WHERE `Código_alumno`='$cod';";
//$r3=mysqli_query($conn,$sql3);  
    $sql4="DELETE FROM `datos_ciclo` WHERE `Código_alumno`='$cod';";
    $r4=mysqli_query($conn,$sql4);  
    $sql5="DELETE FROM `datos_servicio` WHERE `Código_alumno`='$cod';";
    $r5=mysqli_query($conn,$sql5);  
    $sql6="UPDATE `datos_pensum` SET `Estado`='INACTIVO' WHERE `Código_alumno`='$cod';";
    $r6=mysqli_query($conn,$sql6);  
    }
   }


   
?>
<br>
0