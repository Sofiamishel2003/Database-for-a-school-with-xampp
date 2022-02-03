<head>
  <meta charset="utf-8"></head>
  <?php
  include("html/menu.php")
?>
<body >
<br>
<form action="ingreso_notas.php" method="post" target="_blank" >
<div class="container" class="rounded">		
  <div class="row"  style="background-color:ECF0F1">
        <br>
        <h1>Ingreso de notas</h1>
        <br>
        <div class="col-lg-12">
            <center>Ingrese el código de alumno:<input  type="text" name="cod" placeholder="Ingrese Código" required><center><br>
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
            <br>
            <input class="btn btn-primary btn-large btn-block"  type="submit" id="bt4" name="bt4" value="Ir a ingreso de notas">
            <br>
            <input class="btn btn-primary btn-large btn-block"  type="submit" id="bt3" name="bt3" value="Modficar">
            <br>
        </div>
  </div>  
</div>
</form>
<form action="ingreso_notas.php" method="post" target="_blank" >
<?php
$cod="";
$c_cu="";
if(isset($_POST["bt4"]))
{
  global $cod; $c_cu;
  $servername="localhost";
  $user="root";
  $password="";
  $db="aws";
  $conn=mysqli_connect($servername,$user,$password,$db);
  $cod=$_POST['cod'];
  $grado=$_POST['grado'];
  $registro="SELECT * FROM `datos_alumno` WHERE `Código_alumno`='$cod'";
  $r=mysqli_query($conn,$registro);
  if(mysqli_num_rows($r)==0)
            {
              echo'<script language="javascript">alert("El código ingresado es incorrecto o inexistente");</script>';   
            }
  
  else{
      while($row=mysqli_fetch_array($r))
              {
                $c_cu=$row['Código_cu'];   
              }   
      if($c_cu!=$grado)
      {
          echo'<script language="javascript">alert("Grado ingresado incorrecto");</script>';   
      }
      else{ //imprimir la primer fila horizontal con los campos correspondientes con el grado
          if($grado=="BAS01" or $grado=="BAS02" or $grado=="BAS03" )
          {
          echo'<form action="ingreso_notas.php" method="post" target="_blank" >
                  <div class="container" class="rounded">	
                  <div class="row"  style="background-color:ECF0F1">
                          <div class="col-lg-9">
                          <br>
                          Matemáticas:<input type="text" name="mate" placeholder="Ingrese Materia" required><br>
                          Lenguaje:<input type="text" name="lenguaje" placeholder="Ingrese Materia" required><br>
                          Sociales:<input type="text" name="sociales" placeholder="Ingrese Materia" required><br>
                          Ingles:<input type="text" name="ingles" placeholder="Ingrese Materia" required><br>
                          Artes:<input type="text" name="artes" placeholder="Ingrese Materia" required><br>
                          Biología:<input type="text" name="biolo" placeholder="Ingrese Materia" required><br>
                          Química:<input type="text" name="quimi" placeholder="Ingrese Materia" required><br>
                          Tecnología:<input type="text" name="tec" placeholder="Ingrese Materia" required><br>
                          </div> 
                          <div class="col-lg-12">
                          <br>
                          <input class="btn btn-primary btn-large btn-block"  type="submit" id="bt5" name="bt5" value="Ingresar notas">
                          <br>
                      </div>
                  </div>  
              </div>
              </form>';
          }
          if($grado=="BACH01" or $grado=="BACH02" )
          {
          if($grado=="BACH01")
          {
              $p1="Programación 1";
              $c1="Computación 1";
          }else{
              $p1="Programación 2";
              $c1="Computación 2";
          }
          echo'<form action="ingreso_notas.php" method="post" target="_blank" >
                  <div class="container" class="rounded">	
                  <div class="row"  style="background-color:ECF0F1">
                          <div class="col-lg-9">
                          <br>
                          Matemáticas:<input type="text" name="mate" placeholder="Ingrese Materia" required><br>
                          Literatura:<input type="text" name="lenguaje" placeholder="Ingrese Materia" required><br>
                          Filosofía:<input type="text" name="filo" placeholder="Ingrese Materia" required><br>
                          Ingles:<input type="text" name="ingles" placeholder="Ingrese Materia" required><br>
                          Artes:<input type="text" name="artes" placeholder="Ingrese Materia" required><br>
                          '.$c1.':<input type="text" name="compu" placeholder="Ingrese Materia" required><br>
                          '.$p1.':<input type="text" name="progra" placeholder="Ingrese Materia" required><br>
                          Tecnología:<input type="text" name="tec" placeholder="Ingrese Materia" required><br>
                          </div> 
                          <div class="col-lg-12">
                          <br>
                          <input class="btn btn-primary btn-large btn-block"  type="submit" id="bt5" name="bt5" value="Ingresar notas">
                          <br>
                      </div>
                  </div>  
              </div>
              </form>';
          }
          if($grado=="PE01" or $grado=="PE02" or $grado=="PE03")
          {
              if($grado=="PE01")
              {
                  $c="Contabilidad 1";
              }if($grado=="PE02"){
              $c="Contabilidad 2";
              }
              if($grado=="PE03"){
                  $c="Contabilidad 3";
              }
              echo'<form action="ingreso_notas.php" method="post" target="_blank" >
                  <div class="container" class="rounded">	
                  <div class="row"  style="background-color:ECF0F1">
                          <div class="col-lg-9">
                          <br>
                          Matemáticas:<input type="text" name="mate" placeholder="Ingrese Materia" required><br>
                          Literatura:<input type="text" name="lite" placeholder="Ingrese Materia" required><br>
                          Filosofía:<input type="text" name="filo" placeholder="Ingrese Materia" required><br>
                          Ingles:<input type="text" name="ingles" placeholder="Ingrese Materia" required><br>
                          Artes:<input type="text" name="artes" placeholder="Ingrese Materia" required><br>
                          '.$c.':<input type="text" name="conta" placeholder="Ingrese Materia" required><br>
                          Tecnología:<input type="text" name="tec" placeholder="Ingrese Materia" required><br>
                          </div> 
                          <div class="col-lg-12">
                          <br>
                          <input class="btn btn-primary btn-large btn-block"  type="submit" id="bt5" name="bt5" value="Ingresar notas">
                          <br>
                      </div>
                  </div>  
              </div>
              </form>';
          }
          if($grado=="BCCLL01" or $grado=="BCCLL02" or $grado=="BCCLL03" )
          {
              echo'<form action="ingreso_notas.php" method="post" target="_blank" >
                  <div class="container" class="rounded">	
                  <div class="row"  style="background-color:ECF0F1">
                      <div class="col-lg-9">
                      <br>
                      Matemáticas:<input type="text" name="mate" placeholder="Ingrese Materia" required><br>
                      Literatura:<input type="text" name="lite" placeholder="Ingrese Materia" required><br>
                      Sociales:<input type="text" name="sociales" placeholder="Ingrese Materia" required><br>
                      Ingles:<input type="text" name="ingles" placeholder="Ingrese Materia" required><br>
                      Artes:<input type="text" name="artes" placeholder="Ingrese Materia" required><br>
                      Biología:<input type="text" name="biolo" placeholder="Ingrese Materia" required><br>
                      Química:<input type="text" name="quimi" placeholder="Ingrese Materia" required><br>
                      Tecnología:<input type="text" name="tec" placeholder="Ingrese Materia" required><br>
                      </div> 
                      <div class="col-lg-12">
                      <br>
                      <input class="btn btn-primary btn-large btn-block"  type="submit" id="bt5" name="bt5" value="Ingresar notas">
                      <br>
                  </div>
              </div>  
          </div>
          </form>';
          }
      }
      //enviar los datos por si se hace primero el reporte visual que el de pdf
      $_SESSION['codi']=$cod; 
      $_SESSION['grad']=$grado;
}
}
  if(isset($_POST["bt3"]))
  {
    global $cod; $c_cu;
    $servername="localhost";
    $user="root";
    $password="";
    $db="aws";
    $conn=mysqli_connect($servername,$user,$password,$db);
    $cod=$_POST['cod'];
    $grado=$_POST['grado'];
    $registro="SELECT * FROM `datos_alumno` WHERE `Código_alumno`='$cod'";
    $r=mysqli_query($conn,$registro);
    if(mysqli_num_rows($r)==0)
              {
                echo'<script language="javascript">alert("El código ingresado es incorrecto o inexistente");</script>';   
                exit;
            }

    
    else{
        while($row=mysqli_fetch_array($r))
        {
                  $c_cu=$row['Código_cu'];   
                }    
//Ifs para verificar a la tabla en donde se encuentran las ntoas actuales
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
    $registro="SELECT * FROM `$tabla` WHERE `Código_alumno`='$cod'";
    $r2=mysqli_query($conn,$registro);  
    while($row=mysqli_fetch_array($r2))
                { 
        if($c_cu!=$grado)
        {
            echo'<script language="javascript">alert("Grado ingresado incorrecto");</script>';   
        }
        else{//imprimir los datos en la tabla generada
            if($grado=="BAS01" or $grado=="BAS02" or $grado=="BAS03" )
            {
            echo'<form action="ingreso_notas.php" method="post" target="_blank" >
                    <div class="container" class="rounded">	
                    <div class="row"  style="background-color:ECF0F1">
                            <div class="col-lg-9">
                            <br>
                            Matemáticas:<input type="text" name="mate" value='.$row['matemáticas'].' placeholder="Ingrese Materia" required><br>
                            Lenguaje:<input type="text" name="lenguaje" value='.$row['lenguaje'].' placeholder="Ingrese Materia" required><br>
                            Sociales:<input type="text" name="sociales" value='.$row['sociales'].' placeholder="Ingrese Materia" required><br>
                            Ingles:<input type="text" name="ingles" value='.$row['ingles'].' placeholder="Ingrese Materia" required><br>
                            Artes:<input type="text" name="artes" value='.$row['artes'].' placeholder="Ingrese Materia" required><br>
                            Biología:<input type="text" name="biolo" value='.$row['biología'].' placeholder="Ingrese Materia" required><br>
                            Química:<input type="text" name="quimi" value='.$row['química'].' placeholder="Ingrese Materia" required><br>
                            Tecnología:<input type="text" name="tec" value='.$row['tecnología'].' placeholder="Ingrese Materia" required><br>
                            </div> 
                            <div class="col-lg-12">
                            <br>
                            <input class="btn btn-primary btn-large btn-block"  type="submit" id="bt5" name="bt5" value="Guardar modificaciones">
                            <br>
                        </div>
                    </div>  
                </div>
                </form>';
            }
            if($grado=="BACH01" or $grado=="BACH02" )
            {
            if($grado=="BACH01")
            {
                $p1="Programación 1";
                $c1="Computación 1";
            }else{
                $p1="Programación 2";
                $c1="Computación 2";
            }
            echo'<form action="ingreso_notas.php" method="post" target="_blank" >
                    <div class="container" class="rounded">	
                    <div class="row"  style="background-color:ECF0F1">
                            <div class="col-lg-9">
                            <br>
                            Matemáticas:<input type="text" name="mate" value='.$row['matemáticas'].' placeholder="Ingrese Materia" required><br>
                            Literatura:<input type="text" name="lenguaje" value='.$row['literatura'].' placeholder="Ingrese Materia" required><br>
                            Filosofía:<input type="text" name="filo" value='.$row['filosofía'].' placeholder="Ingrese Materia" required><br>
                            Ingles:<input type="text" name="ingles" value='.$row['ingles'].' placeholder="Ingrese Materia" required><br>
                            Artes:<input type="text" name="artes" value='.$row['artes'].' placeholder="Ingrese Materia" required><br>
                            '.$c1.':<input type="text" name="compu" value='.$row['computación'].' placeholder="Ingrese Materia" required><br>
                            '.$p1.':<input type="text" name="progra" value='.$row['programación'].' placeholder="Ingrese Materia" required><br>
                            Tecnología:<input type="text" name="tec" value='.$row['tecnología'].' placeholder="Ingrese Materia" required><br>
                            </div> 
                            <div class="col-lg-12">
                            <br>
                            <input class="btn btn-primary btn-large btn-block"  type="submit" id="bt5" name="bt5" value="Ingresar notas">
                            <br>
                        </div>
                    </div>  
                </div>
                </form>';
            }
            if($grado=="PE01" or $grado=="PE02" or $grado=="PE03")
            {
                if($grado=="PE01")
                {
                    $c="Contabilidad 1";
                }if($grado=="PE02"){
                $c="Contabilidad 2";
                }
                if($grado=="PE03"){
                    $c="Contabilidad 3";
                }
                echo'<form action="ingreso_notas.php" method="post" target="_blank" >
                    <div class="container" class="rounded">	
                    <div class="row"  style="background-color:ECF0F1">
                            <div class="col-lg-9">
                            <br>
                            Matemáticas:<input type="text" name="mate" value='.$row['matemáticas'].' placeholder="Ingrese Materia" required><br>
                            Literatura:<input type="text" name="lite" value='.$row['literatura'].' placeholder="Ingrese Materia" required><br>
                            Filosofía:<input type="text" name="filo" value='.$row['filosofía'].' placeholder="Ingrese Materia" required><br>
                            Ingles:<input type="text" name="ingles" value='.$row['ingles'].' placeholder="Ingrese Materia" required><br>
                            Artes:<input type="text" name="artes" value='.$row['artes'].' placeholder="Ingrese Materia" required><br>
                            '.$c.':<input type="text" name="conta" value='.$row['contabilidad'].' placeholder="Ingrese Materia" required><br>
                            Tecnología:<input type="text" name="tec" value='.$row['tecnología'].' placeholder="Ingrese Materia" required><br>
                            </div> 
                            <div class="col-lg-12">
                            <br>
                            <input class="btn btn-primary btn-large btn-block"  type="submit" id="bt5" name="bt5" value="Ingresar notas">
                            <br>
                        </div>
                    </div>  
                </div>
                </form>';
            }
            if($grado=="BCCLL01" or $grado=="BCCLL02" )
            {
                echo'<form action="ingreso_notas.php" method="post" target="_blank" >
                    <div class="container" class="rounded">	
                    <div class="row"  style="background-color:ECF0F1">
                        <div class="col-lg-9">
                        <br>
                        Matemáticas:<input type="text" name="mate" value='.$row['matemáticas'].' placeholder="Ingrese Materia" required><br>
                        Literatura:<input type="text" name="lite" value='.$row['literatura'].'  placeholder="Ingrese Materia" required><br>
                        Sociales:<input type="text" name="sociales"  value='.$row['sociales'].' placeholder="Ingrese Materia" required><br>
                        Ingles:<input type="text" name="ingles"  value='.$row['ingles'].' placeholder="Ingrese Materia" required><br>
                        Artes:<input type="text" name="artes"  value='.$row['artes'].' placeholder="Ingrese Materia" required><br>
                        Biología:<input type="text" name="biolo" value='.$row['biología'].'  placeholder="Ingrese Materia" required><br>
                        Química:<input type="text" name="quimi"  value='.$row['química'].' placeholder="Ingrese Materia" required><br>
                        Tecnología:<input type="text" name="tec"  value='.$row['tecnología'].' placeholder="Ingrese Materia" required><br>
                        </div> 
                        <div class="col-lg-12">
                        <br>
                        <input class="btn btn-primary btn-large btn-block"  type="submit" id="bt5" name="bt5" value="Ingresar notas">
                        <br>
                    </div>
                </div>  
            </div>
            </form>';
            }
        } 
    }
    //enciar datos superglobales
        $_SESSION['codi']=$cod; 
        $_SESSION['grad']=$grado;
  }
}
  if(isset($_POST["bt5"]))
  {  
    $cod=$_SESSION['codi'];
    $c_cu=$_SESSION['grad'];
    $servername="localhost";
    $user="root";
    $password="";
    $db="aws";
    $conn=mysqli_connect($servername,$user,$password,$db);
    $registro="SELECT * FROM `datos_alumno` WHERE `Código_alumno`='$cod'"; 
    $mate=$_POST['mate'];
    $ingles=$_POST['ingles'];
    $artes=$_POST['artes'];
    $tec=$_POST['tec'];
    $registro="SELECT * FROM `datos_alumno` WHERE `Código_alumno`='$cod'";
    $r=mysqli_query($conn,$registro);
                          
    
        if($c_cu=="BAS01" or $c_cu=="BAS02" or $c_cu=="BAS03" ) //verificar por gradolos cambos y sus llaves
        {   $sociales=$_POST['sociales'];
            $biolo=$_POST['biolo'];
            $quimi=$_POST['quimi'];
            $lenguaje=$_POST['lenguaje'];
            $cambio = "UPDATE `basicos` SET `matemáticas`='$mate',`lenguaje`='$lenguaje',`sociales`='$sociales',`ingles`='$ingles',`artes`='$artes',`biología`='$biolo',`química`='$quimi',`tecnología`='$tec' WHERE `Código_alumno`='$cod'";   
            $rc=mysqli_query($conn,$cambio); 
        }
        if($c_cu=="BACH01" or $c_cu=="BACH02" )
        {   $filo=$_POST['filo'];
            $compu=$_POST['compu'];
            $progra=$_POST['progra'];
            $lenguaje=$_POST['lenguaje'];
            $cambio = "UPDATE `bachi_compu` SET `matemáticas`='$mate',`literatura`='$lenguaje',`filosofía`='$filo',`ingles`='$ingles',`artes`='$artes',`computación`='$compu',`programación`='$progra',`tecnología`='$tec' WHERE `Código_alumno`='$cod'";   
            $rc=mysqli_query($conn,$cambio);
        }
        if($c_cu=="PE01" or $c_cu=="PE02" or $c_cu=="PE03")
        {   $filo=$_POST['filo'];
            $conta=$_POST['conta'];
            $lite=$_POST['lite'];
            $cambio = "UPDATE `bachi_perito` SET `matemáticas`='$mate',`literatura`='$lite',`filosofía`='$filo',`contabilidad`='$conta',`ingles`='$ingles',`artes`='$artes',`tecnología`='$tec' WHERE `Código_alumno`='$cod'";   
            $rc=mysqli_query($conn,$cambio);
        }
        if($c_cu=="BCCLL01" or $c_cu=="BCCLL02" )
        {   $sociales=$_POST['sociales'];
            $lite=$_POST['lite'];
            $biolo=$_POST['biolo'];
            $quimi=$_POST['quimi'];
            $cambio = "UPDATE `bachi_letras` SET `matemáticas`='$mate',`literatura`='$lite',`sociales`='$sociales',`ingles`='$ingles',`artes`='$artes',`biología`='$biolo',`química`='$quimi',`tecnología`='$tec' WHERE `Código_alumno`='$cod'";   
            $rc=mysqli_query($conn,$cambio); 
        }
   }


   
?>
<br>
