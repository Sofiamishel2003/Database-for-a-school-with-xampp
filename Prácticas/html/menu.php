<head>

<link rel="icon" type="image/ico" href="https://jimdo-storage.freetls.fastly.net/image/230805635/b1158bfd-00a3-4e04-8fac-a07a9de0f8ea.png?quality=80&auto=webp&disable=upscale&width=139&height=160&trim=0,0,0,0">
<div class="cuadrado"><img aling="center" src="img/logo.png" width="90" height="100">----<img aling="center" src="img/logo2.png" width="300" height="25">--------------------</div>
<div class="cuadrado2">.</div>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<br>
</head>
<body>

<?php
session_start();
  if(isset($_SESSION['bandera']))
  {
    if($_SESSION['bandera']=="t")
    {
      $bandera=$_SESSION['bandera'];
        {$rol=$_SESSION['rolesito'];
        switch($rol)
            {
                case "Administrador":
                    if($rol=="Administrador" and $bandera="t")
                    {
                        echo('<nav role="navigation" class="primary-navigation" style="position:relative; z-index:1;">
                          <ul>
                              <li><a href="Index.php">Inicio</a></li>
                              <li><a href="centro_educativo.php">Nuestro Centro Educativo</a></li>
                              <li><a href="servicios.php">Servicios Educativos</a></li>
                              <li><a href="#">Atención al Alumno	 &dtrif;</a>
                                  <ul class="dropdown">
                                  <li><a href="login.php" id="Login">Login/Logout</a></li>
                                  <li><a href="new_role.php" id="grados">Nuevo Usuario</a></li>
                                  </ul>
                              </li>
                              <li><a href="#">Control Académico	 &dtrif;</a>
                                <ul class="dropdown" id="control_Ac" >
                                  <li><a href="inscripciones.php" id="inscripciones">Inscripciones</a></li>
                                  <li><a href="ingreso_notas.php" id="secciones">Ingreso de notas</a></li>
                                  <li><a href="boleta.php" id="reporte1">Reporte de calificaciones</a></li>
                                  <li><a href="modybaja.php" id="reporte2">Modificar datos y dar de baja</a></li>
                                  <li><a href="Gradoyseccion.php" id="reporte2">Reporte grado y sección</a></li>
                                  <li><a href="datos_alumnos.php" id="reporte2">Reporte alumnos y sus datos</a></li>
                                </ul>
                              </li>
                              <li><a href="#" id="control_A">Control Administrativo &dtrif;</a>
                                <ul class="dropdown">
                                  <li><a href="cuenta_corriente.php">Cuenta corriente</a></li>
                                  <li><a href="cobros.php">Cobros</a></li>
                                  <li><a href="reporte_cobros.php">Reporte de Cobros</a></li>
                                </ul>
                              </li>
                              <li><a href="contacto.php">Contáctanos</a></li>
                            </ul>
                          </nav>"');
                    }
                    case "Director":
                      if($rol=="Director")
                      {
                        echo('<nav role="navigation" class="primary-navigation" style="position:relative; z-index:1;">
                        <ul>
                          <li><a href="Index.php">Inicio</a></li>
                          <li><a href="centro_educativo.php">Nuestro Centro Educativo</a></li>
                          <li><a href="servicios.php">Servicios Educativos</a></li>
                          <li><a href="login.php">Atención al Alumno</a></li>
                          <li><a href="#">Control Académico	 &dtrif;</a>
                            <ul class="dropdown" id="control_Ac">
                              <li><a href="inscripciones.php" id="inscripciones">Inscripciones</a></li>
                              <li><a href="ingreso_notas.php" id="secciones">Ingreso de notas</a></li>
                              <li><a href="boleta.php" id="reporte1">Reporte de calificaciones</a></li>
                              <li><a href="modybaja.php" id="reporte2">Modificar datos y dar de baja</a></li>
                              <li><a href="Gradoyseccion.php" id="reporte2">Reporte grado y sección</a></li>
                              <li><a href="datos_alumnos.php" id="reporte2">Reporte alumnos y sus datos</a></li>
                            </ul>
                          </li>
                          <li><a href="contacto.php">Contáctanos</a></li>
                        </ul>
                      </nav>"');
                      }  
                    case "Secretaria":
                      if($rol=="Secretaria")
                      {
                        echo('<nav role="navigation" class="primary-navigation" style="position:relative; z-index:1;">
                        <ul>
                          <li><a href="Index.php">Inicio</a></li>
                          <li><a href="centro_educativo.php">Nuestro Centro Educativo</a></li>
                          <li><a href="servicios.php">Servicios Educativos</a></li>
                          <li><a href="login.php">Atención al Alumno</a></li>
                          <li><a href="#">Control Académico	 &dtrif;</a>
                            <ul class="dropdown" id="control_Ac">
                              <li><a href="ingreso_notas.php" id="secciones">Ingreso de notas</a></li>
                              <li><a href="reporte_notas.php" id="reporte1">Reporte de calificaciones</a></li>
                            </ul>
                          </li>
                          <li><a href="contacto.php">Contáctanos</a></li>
                        </ul>
                      </nav>"');
                      }
                    case "Financiero":
                      if($rol=="Financiero")
                        {
                          echo('<nav role="navigation" class="primary-navigation" style="position:relative; z-index:1;"> 
                          <ul>
                            <li><a href="Index.php">Inicio</a></li>
                            <li><a href="centro_educativo.php">Nuestro Centro Educativo</a></li>
                            <li><a href="servicios.php">Servicios Educativos</a></li>
                            <li><a href="login.php">Atención al Alumno</a></li>
                            <li><a href="#" id="control_A">Control Administrativo &dtrif;</a>
                              <ul class="dropdown">
                                <li><a href="cuenta_corriente.php">Cuenta corriente</a></li>
                                <li><a href="cobros.php">Cobros</a></li>
                                <li><a href="reporte_cobros.php">Reporte de Cobros</a></li>
                              </ul>
                            </li>
                            <li><a href="contacto.php">Contáctanos</a></li>
                            </ul>
                          </nav>"');
                        } 
            }  
          }
    }
    else
    {
        $_SESSION['bandera']="f"; 
        echo('<nav role="navigation" class="primary-navigation">
        <ul>
          <li><a href="Index.php">Inicio</a></li>
          <li><a href="centro_educativo.php">Nuestro Centro Educativo</a></li>
          <li><a href="servicios.php">Servicios Educativos</a></li>
          <li><a href="login.php">Atención al Alumno</a></li>
          <li><a href="contacto.php">Contáctanos</a></li>
          </ul>
        </nav>"');
    }
  }else
  {
      $_SESSION['bandera']="f"; 
      echo('<nav role="navigation" class="primary-navigation">
      <ul>
        <li><a href="Index.php">Inicio</a></li>
        <li><a href="centro_educativo.php">Nuestro Centro Educativo</a></li>
        <li><a href="servicios.php">Servicios Educativos</a></li>
        <li><a href="login.php">Atención al Alumno</a></li>
        <li><a href="contacto.php">Contáctanos</a></li>
        </ul>
      </nav>"');
    }

?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="js/java.js"></script>
<link rel="stylesheet" href="estilo/estilo-p.css">
</body>