<head>
  <meta charset="utf-8"></head>
  <?php
  include("html/menu.php") //Incluir la página que muestra el menú correspondiente al alumno
?>
<body >

<br>
<form action="cobros.php" method="post" target="_blank" >
<div class="container" class="rounded">		
  <div class="row"  style="background-color:ECF0F1">
        <br>
        <h1>Cobros</h1>
        <br>
        <div class="col-lg-12">
            Ingrese el código de cuenta:<input  type="text" name="cod" placeholder="Ingrese Código" required><br>
            Ingrese el Nit:<input  type="text" name="nit" placeholder="Ingrese nit" required><br>
            Ingrese Nombre de facturación:<input  type="text" name="nombre" placeholder="Ingrese Nombre" required>
            <br>
            <input class="btn btn-primary btn-large btn-block"  type="submit" id="bt1" name="bt1" value="Seleccionar servicios para cobro">
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
    $nit=$_POST['nit'];    
    $name=$_POST['nombre'];
    $c_cuenta=$_POST['cod'];
    $_SESSION['nit']=$nit; 
    $_SESSION['name']=$name; 
    $_SESSION['c_cuenta']=$c_cuenta;
    $sql="SELECT * FROM `datos_alumno` WHERE `Código_cuenta`='$c_cuenta'";
    $servername="localhost";
    $user="root";
    $password="";
    $db="aws";
    $correlativoF=0;
    $conn=mysqli_connect($servername,$user,$password,$db);
    $r0=mysqli_query($conn,$sql);
    if(mysqli_num_rows($r0)==0)
    {
      //Validación de la existencia del código de cuenta
      echo'<script language="javascript">alert("El código de cuenta ingresado es incorrecto o inexistente");</script>';   
    }
    else
    {
      echo'<form action="cobros.php" method="post" target="_blank" " class="text-left">
      <div class="container" class="rounded">	
      <div class="row"  style="background-color:ECF0F1">';
      $correlativo=1;
      while($row=mysqli_fetch_array($r0))
        {
          echo'
                  <div class="col-lg-12" >
                  <br>
                  <p  class="text-left">Seleccione los servicios deseados para el alumno '.$row['Nombres'].' '.$row['Apellidos'].'</p>
                  <input  type="checkbox" value="v1"name="S1'.strval($correlativo).'">Internet y uso de laboratorios Q 300.00 mensual<br>
                  <input  type="checkbox" value="v2" name="S2'.strval($correlativo).'">Servicio de Bus Q 700.00 mensual<br>
                  <input  type="checkbox" value="v3" name="S3'.strval($correlativo).'">Excursión Q 150.00 anual<br>
                  <input  type="checkbox" value="v4" name="S4'.strval($correlativo).'">Campamento Q 350.00 anual<br>
                  <input  type="checkbox" value="v5" name="S5'.strval($correlativo).'">Almuerzos Q 400.00 mensual<br>
                  <input  type="checkbox" value="v6" name="S6'.strval($correlativo).'">Colegiatura Q 2500.00 mensual<br>
                  </div>';  
          $correlativo=$correlativo+1;
        }
        echo'<div class="col-lg-12">
                  <br>
                  <input class="btn btn-primary btn-large btn-block"  type="submit" id="factura" name="factura" value="Generar recibo">
                  <br>
              </div>
          </div>  
      </div>
      </form>';
        
    }
  }
?>
<?php
     $servername="localhost";
     $username="root";
     $password="";
     $bd="aws";
     $conn=mysqli_connect($servername,$username,$password,$bd);
 if (isset($_POST["factura"]))
 {
    $nit=$_SESSION['nit'];    
    $name=$_SESSION['name'];
    $c_cuenta=$_SESSION['c_cuenta'];
    $fecha = new DateTime();  
    $Date = $fecha->format("d/m/Y"); 
    $date2= $fecha->format("Y-m-d"); 
    $correlativo=0;
    $costo=0;
    $día=$fecha->format("d");
    $SE1="Internet y uso de laboratorios, ";
    $SE2="Servicio de Bus, ";
    $SE3="Excursión, ";
    $SE4="Campamento, ";
    $SE5="Almuerzos, ";
    $SE6="Colegiatura, ";
    $correlativoF=0;
    //FACTURA: SUS CORRELATIVOS Y VALIDACIONES
    $validar_correlativos="SELECT * FROM `correlativos` WHERE `uso`='fact'"; //Números correlativos de lafactura y su devida validación
    $r=mysqli_query($conn,$validar_correlativos);
        if(mysqli_num_rows($r)>0) //si no es primera factura emitida
            {
            while($row=mysqli_fetch_array($r))
                    {
                    $correlativoF=$row['correlativo']+1;
                    $cambio = "UPDATE `correlativos` SET `correlativo`='$correlativoF' WHERE `uso`='fact'";   
                    $rf=mysqli_query($conn,$cambio);    
                    }
            }
        else //Si es primera factura emitida
            {
            $primero = "INSERT INTO `correlativos` (`correlativo`,`uso`)
            VALUES('$correlativoF','fact')";   
            $rf=mysqli_query($conn,$primero);  
            }
    $Nfactura="AWS00".strval($correlativoF); 
    //asignación de descuento
    if (intval($día)<16)
    {
        $descuento=0.10;
    }
    else
    {
        $descuento=0;
    }
        
    //Ingreso de valores a la tabla con validaciones
    $sql="SELECT * FROM `datos_alumno` WHERE `Código_cuenta`='$c_cuenta'";//registros de la cuenta
    $r0=mysqli_query($conn,$sql);
    $servicios="";
    $acu=0;
    if(mysqli_num_rows($r0)>0)
          {
            $CO=1;
            $servicios_parapdf=array("","","","","",""); //Arreglo para guardar cuantos servicios se cancelan y a que cuenta corresponden
            while($row=mysqli_fetch_array($r0))
                { for ($i = 1; $i <=6; $i++) {
                  ${"entro".strval($i)}=0;
                  }
                    $coda=$row['Código_alumno'];
                    $cn=strval($CO);
                    //Para definir la tabla a donde se dirigirá el resto de saldo
                    $busqueda_grado="SELECT * FROM `datos_alumno` WHERE `Código_cuenta`='$c_cuenta' and `Código_alumno`='$coda'";// Buscar el registro que contiene el saldo actual
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
                    //Las acciones a realizar por cada checkbox/servicio seleccionado
                    if (isset($_POST['S1'.$cn.''])) 
                        {
                        $validacion_1="SELECT * FROM `datos_servicio` WHERE `Código_cuenta`='$c_cuenta' and `Código_alumno`='$coda' and `Código_servicio`='S1'";// Buscar cuantos cobros se han realizado del primer servicio
                        $v1=mysqli_query($conn,$validacion_1);
                        if(mysqli_num_rows($v1)>9)//validación de que no se cobren más tarifas de las que deberían de ser anualmente
                            {
                               // echo'<script language="javascript">alert("Las tarifas de '.$row['Nombres'].' '.$row['Apellidos'].' de Internet y uso de laboratorios de todo el año han sido canceladas ya, por lo que no se cancelaran nuevamente, porfavor vuelva a cancelar solo si aún no se han cancelado las tarifas");</script>'; 
                            }
                        else{
                                $entro1=1;
                                $servicios_parapdf[0]=$servicios_parapdf[0].strval($CO);
                                $cods="S1";
                                $costo=300;   
                                $s1 = "INSERT INTO `datos_servicio` (`Código_alumno`,`Código_cuenta`,`Código_servicio`,`descuento`,`costo`,`fecha`)
                                VALUES($coda,'$c_cuenta','$cods','$descuento','$costo','$date2')"; 
                                $sql1=mysqli_query($conn,$s1); 
                                $acu=$acu+$costo; //Acumula los costos de cada servicio
                                $servicios=$servicios.$SE1;//Acumula los servicios textualmente
                            }
                        }
                    if (isset($_POST['S2'.$cn.''])) 
                        {
                          $validacion_1="SELECT * FROM `datos_servicio` WHERE `Código_cuenta`='$c_cuenta' and `Código_alumno`='$coda' and `Código_servicio`='S2'";// Buscar cuantos cobros se han realizado del primer servicio
                          $v1=mysqli_query($conn,$validacion_1);
                          if(mysqli_num_rows($v1)>9)
                              {
                              }
                          else {
                              $entro2=1;
                              $servicios_parapdf[1]=$servicios_parapdf[1].strval($CO);
                              $cods="S2";
                              $costo=700 ; 
                              $s1 = "INSERT INTO `datos_servicio` (`Código_alumno`,`Código_cuenta`,`Código_servicio`,`descuento`,`costo`,`fecha`)
                              VALUES($coda,'$c_cuenta','$cods','$descuento','$costo','$date2')"; 
                              $sql1=mysqli_query($conn,$s1); 
                              $acu=$acu+$costo;
                              $servicios=$servicios.$SE2;
                              }
                        }
                    if (isset($_POST['S3'.$cn.''])) 
                        {
                          $validacion_1="SELECT * FROM `datos_servicio` WHERE `Código_cuenta`='$c_cuenta' and `Código_alumno`='$coda' and `Código_servicio`='S3'";// Buscar cuantos cobros se han realizado del primer servicio
                          $v1=mysqli_query($conn,$validacion_1);
                          if(mysqli_num_rows($v1)>0)// porque es tarifa anual
                              {
                              }
                          else {
                              $entro3=1;
                              $servicios_parapdf[2]=$servicios_parapdf[2].strval($CO);
                              $cods="S3";
                              $costo=150 ;   
                              $s1 = "INSERT INTO `datos_servicio` (`Código_alumno`,`Código_cuenta`,`Código_servicio`,`descuento`,`costo`,`fecha`)
                              VALUES($coda,'$c_cuenta','$cods','$descuento','$costo','$date2')"; 
                              $sql1=mysqli_query($conn,$s1); 
                              $acu=$acu+$costo;
                              $servicios=$servicios.$SE3;
                              }
                        }  
                    if (isset($_POST['S4'.$cn.''])) 
                        {
                          $validacion_1="SELECT * FROM `datos_servicio` WHERE `Código_cuenta`='$c_cuenta' and `Código_alumno`='$coda' and `Código_servicio`='S4'";// Buscar cuantos cobros se han realizado del primer servicio
                          $v1=mysqli_query($conn,$validacion_1);
                          if(mysqli_num_rows($v1)>0)// porque es tarifa anual
                              {
                              }
                          else {
                              $entro4=1;
                              $servicios_parapdf[3]=$servicios_parapdf[3].strval($CO);
                              $cods="S4";
                              $costo=350;
                              $s1 = "INSERT INTO `datos_servicio` (`Código_alumno`,`Código_cuenta`,`Código_servicio`,`descuento`,`costo`,`fecha`)
                              VALUES($coda,'$c_cuenta','$cods','$descuento','$costo','$date2')"; 
                              $sql1=mysqli_query($conn,$s1); 
                              $acu=$acu+$costo;
                              $servicios=$servicios.$SE4;
                              }
                        }
                    if (isset($_POST['S5'.$cn.''])) 
                        {
                          $validacion_1="SELECT * FROM `datos_servicio` WHERE `Código_cuenta`='$c_cuenta' and `Código_alumno`='$coda' and `Código_servicio`='S5'";// Buscar cuantos cobros se han realizado del primer servicio
                          $v1=mysqli_query($conn,$validacion_1);
                          if(mysqli_num_rows($v1)>9)
                              {
                              }
                          else {
                                $entro5=1;
                                $servicios_parapdf[4]=$servicios_parapdf[4].strval($CO);
                                $cods="S5";
                                $costo=400 ; 
                                $s1 = "INSERT INTO `datos_servicio` (`Código_alumno`,`Código_cuenta`,`Código_servicio`,`descuento`,`costo`,`fecha`)
                                VALUES($coda,'$c_cuenta','$cods','$descuento','$costo','$date2')"; 
                                $sql1=mysqli_query($conn,$s1);
                                $acu=$acu+$costo;  
                                $servicios=$servicios.$SE5;
                              } 
                        }  
                    if (isset($_POST['S6'.$cn.''])) 
                        {
                          $validacion_1="SELECT * FROM `datos_servicio` WHERE `Código_cuenta`='$c_cuenta' and `Código_alumno`='$coda' and `Código_servicio`='S6'";// Buscar cuantos cobros se han realizado del primer servicio
                          $v1=mysqli_query($conn,$validacion_1);
                          if(mysqli_num_rows($v1)>9)
                              {
                              }
                          else {
                                $entro6=1;
                                $servicios_parapdf[5]=$servicios_parapdf[5].strval($CO);
                                $cods="S6";
                                $costo=2500;
                                $s1 = "INSERT INTO `datos_servicio` (`Código_alumno`,`Código_cuenta`,`Código_servicio`,`descuento`,`costo`,`fecha`)
                                VALUES($coda,'$c_cuenta','$cods','$descuento','$costo','$date2')"; 
                                $sql1=mysqli_query($conn,$s1);
                                $acu=$acu+$costo; 
                                $servicios=$servicios.$SE6;
                              }
                        }
                        $busqueda_saldo="SELECT * FROM `".$tabla."` WHERE `Código_cuenta`='$c_cuenta' and `Código_alumno`='$coda'";// Buscar el registro que contiene el saldo actual
                        $v2=mysqli_query($conn,$busqueda_saldo);
                        while($row=mysqli_fetch_array($v2))
                        {
                          $saldo_actual=$row['saldo'];
                        }
                        $saldo_restado=$saldo_actual-$costo;
                        $saldo = "UPDATE `".$tabla."` SET `saldo`='$saldo_restado' WHERE `Código_alumno`='$coda'";   
                        $rsa=mysqli_query($conn,$saldo); 
                        $CO=$CO+1;
                        for ($i = 0; $i <6; $i++) { //este for es para rellenar el arreglo de strings donde no entro con 0 para no ser tomados en cuenta para el alumno
                          if(${"entro".strval($i+1)}==0)
                            {
                              $servicios_parapdf[$i]=$servicios_parapdf[$i]."0";
                            }
                        }
                      
                      
                }
                $_SESSION['ubi_servicios']=$servicios_parapdf;  //enviar por variables superglobales los datos al archivo de pdf
                $_SESSION['Nrecibo']=$Nfactura;
                $descuentoF=$acu*$descuento;
                $total=$acu-$descuentoF;
                $_SESSION['total']=$total;
                $i1 = "INSERT INTO `datos del cobro` (`n_recibo`,`Código_cuenta`,`nit`,`fecha`,`servicios`,`subtotal`,`descuento`,`Total`)
                VALUES('$Nfactura','$c_cuenta','$nit','$date2','$servicios','$acu','$descuentoF','$total')";
                $sqli1=mysqli_query($conn,$i1); 
                echo "<script>location.href='recibo.php';</script>"; //ir al archivo pdf
          }
          
 }
?>
