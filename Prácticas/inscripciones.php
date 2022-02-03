<head>
  <meta charset="utf-8"></head>
  <?php
  include("html/menu.php")
?>
<body >
<br>
<?php
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
    $c_cuenta=$_POST['cfamilia'];
    $fecha_i=$_POST['fechaI'];
    $fecha_n=$_POST['fechaN'];
    $observaciones=$_POST['obser'];
    $g=$_POST['grado'];
    $grad="";
    $correlativo=0;
    $c_cu="";
    $fecha_A = new DateTime();  
    $Date = $fecha_A->format("Y-m-d");  
    $año=$fecha_A->format("Y"); 
    //Hacer correlativo
    $validar_correlativos="SELECT * FROM `correlativos` WHERE `uso`='si'"; 
    $r=mysqli_query($conn,$validar_correlativos);
        if(mysqli_num_rows($r)>0)
        {
          while($row=mysqli_fetch_array($r))
                {
                  $correlativo=$row['correlativo']+1;
                  $cambio = "UPDATE `correlativos` SET `correlativo`='$correlativo' WHERE `uso`='si'";   
                  $rc=mysqli_query($conn,$cambio);    
                }
       
        }
      else
        {
          $primero = "INSERT INTO `correlativos` (`correlativo`,`uso`)
          VALUES('$correlativo','si')";   
          $rc=mysqli_query($conn,$primero);  
        }
      $c_alumno=strval($año).strval($correlativo);
    //Hacer número de cuenta familiar
    if($c_cuenta=="")
    {
      $c_cuenta= $c_alumno;//Se le asigna el código de alumno como código de familia
    }
    else 
    {
      $validar_familiar="SELECT * FROM `datos_alumno` WHERE `Código_cuenta`='$c_cuenta'"; 
      $r0=mysqli_query($conn,$validar_familiar); //validación de que el número ingresado sea el de familia
      if(mysqli_num_rows($r0)==0)
        {
          echo'<script language="javascript">alert("El código familiar ingresado es incorrecto o inexistente");</script>';   
          exit;
        }
      else
        {
          while($row=mysqli_fetch_array($r))
                {
                  $c_cuenta=$row['Código_cuenta']; //Si esta el código de cuenta/familiar se le asigna de una vez el que encontró en el registro a este nuevo alumno  
                }   
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
            //Asignar la Sección
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
          //ingreso de datos en tablas
          $sql="INSERT INTO `datos_alumno`(`Código_alumno`,`Nombres`,`Apellidos`,`Correo electrónico`,`Código_cuenta`,`Dirección`,`Teléfono`,`Npadre`,`Nmadre`,`Fecha_N`,`Fecha_Ing`,`Fecha_Ins`,`Observaciones`,`Código_cu`,`Grado`,`Sección`)
          VALUES('$c_alumno','$name','$lastname','$correo','$c_cuenta','$direccion','$telefono','$npadre','$nmadre','$fecha_n','$fecha_i','$Date','$observaciones','$c_cu','$grad','$seccion')";
          $r6=mysqli_query($conn,$sql);
          $sql2="INSERT INTO `datos_ciclo`(`Código_alumno`,`Código_ciclo`,`ciclo_i`,`ciclo_f`,`n_ciclo`)
          VALUES('$c_alumno','$año','Enero','Noviembre','$año')";
          $r3=mysqli_query($conn,$sql2);
          $sql3="INSERT INTO `datos_pensum`(`Código_alumno`,`Código_cp`,`Código_ciclo`,`Código_cu`,`Código_ca`,`Descripción curso`,`Estado`)
          VALUES('$c_alumno','$c_cu','$año','$c_cu','$c_cu','$grad','ACTIVO')";
          $r4=mysqli_query($conn,$sql3);
          //ESCOGER A QUE TABLA VA A SER ENVIADO DE LAS NOTAS
          $temp=0;
          $saldo=39500; //Las cuentas mensuales * 10 + el precio de las tarifas anuales
          if($c_cu=="BAS01" or $c_cu=="BAS02" or $c_cu=="BAS03" )
          {
            $sql4="INSERT INTO `basicos`(`Código_cu`,`Código_cuenta`,`Código_alumno`,`saldo`,`Nombres`,`Apellidos`,`matemáticas`,`lenguaje`,`sociales`,`ingles`,`artes`,`biología`,`química`,`tecnología`)
            VALUES('$c_cu','$c_cuenta','$c_alumno','$saldo','$name','$lastname','$temp','$temp','$temp','$temp','$temp','$temp','$temp','$temp')";
          }
          if($c_cu=="BACH01" or $c_cu=="BACH02" )
          {
            $sql4="INSERT INTO `bachi_compu`(`Código_cu`,`Código_cuenta`,`Código_alumno`,`saldo`,`Nombres`,`Apellidos`,`matemáticas`,`literatura`,`filosofía`,`ingles`,`artes`,`computación`,`programación`,`tecnología`)
            VALUES('$c_cu','$c_cuenta','$c_alumno','$saldo','$name','$lastname','$temp','$temp','$temp','$temp','$temp','$temp','$temp','$temp')";
          }
          if($c_cu=="PE01" or $c_cu=="PE02" or $c_cu=="PE03")
          {
            $sql4="INSERT INTO `bachi_perito`(`Código_cu`,`Código_cuenta`,`Código_alumno`,`saldo`,`Nombres`,`Apellidos`,`matemáticas`,`literatura`,`contabilidad`,`ingles`,`artes`,`tecnología`)
            VALUES('$c_cu','$c_cuenta','$c_alumno','$saldo','$name','$lastname','$temp','$temp','$temp','$temp','$temp','$temp')";
          }
          if($c_cu=="BCCLL01" or $c_cu=="BCCLL02" or $c_cu=="BCCLL03" )
          {
            $sql4="INSERT INTO `bachi_letras`(`Código_cu`,`Código_cuenta`,`Código_alumno`,`saldo`,`Nombres`,`Apellidos`,`matemáticas`,`literatura`,`sociales`,`ingles`,`artes`,`biología`,`química`,`tecnología`)
            VALUES('$c_cu','$c_cuenta','$c_alumno','$saldo','$name','$lastname','$temp','$temp','$temp','$temp','$temp','$temp','$temp','$temp')";
          }
          $insertar=mysqli_query($conn,$sql4);

        }
      
   
?>
  <br>
<div class="container" class="rounded">		
  <div class="row"  style="background-color:ECF0F1">
        <br>
        <h1>Ingrese todos los campos solicitados</h1>
        <br>
        <form action="inscripciones.php" method="post" target="_blank" >
        <div class="half left cf">
            <input class="form-control"  type="text" name="nombre" placeholder="Ingrese Nombres" required><br>
            <input class="form-control" type="text" name="mail" placeholder="Ingrese Correo Electrónico" required><br>
            <input class="form-control" type="text" name="numero1" placeholder="Ingrese Número de Teléfono" required><br>
            <input class="form-control"  type="text" name="Npadre" placeholder="Ingrese Nombre del Padre" required><br>
            <br>
            <p>Ingrese Fecha de Nacimiento</p>
            <input class="form-control"  type="date" name="fechaN" required><br>
            <textarea class="form-control" name="obser" type="text" placeholder="Ingrese Observaciones" required></textarea>
            <br><br>
            <input class="btn btn-primary btn-large btn-block"  type="submit" id="bt3" name="bt3" value="Ingresar todos los datos">
          </div>
        <div class="half right cf" >
            <input class="form-control" type="text" name="apellido"  placeholder="Ingrese Apellidos" required><br>
            <textarea class="form-control"  name="direccion" type="text" placeholder="Ingrese Dirección" required></textarea><br>
            <input class="form-control" type="text" name="Nmadre" placeholder="Ingrese Nombre de la Madre" required><br>
            <br>
            <p style="text-align: left;">Ingrese Fecha de ingreso</p>
            <input class="form-control"  type="date" name="fechaI" required><br>
            <br>
            <p style="text-align: left;">Seleccione el grado/carrera</p>
            <select  class="form-control"  value=""  name="grado" required>
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
                            
        <br><br><input class="form-control"  type="text" name="cfamilia" placeholder="Ingrese Código familiar solo si tiene">
        </div> 
    </div>  
</div>  
</form>
<br>
