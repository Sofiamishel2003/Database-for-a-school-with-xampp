<head>
<link rel="icon" type="image/ico" href="https://jimdo-storage.freetls.fastly.net/image/230805635/b1158bfd-00a3-4e04-8fac-a07a9de0f8ea.png?quality=80&auto=webp&disable=upscale&width=139&height=160&trim=0,0,0,0">
<div class="cuadrado"><img aling="center" src="img/logo.png" width="90" height="100">----<img aling="center" src="img/logo2.png" width="300" height="25">--------------------</div>
<div class="cuadrado2">.</div>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
</head>
<body>
  <br>

<link href="https://fonts.googleapis.com/css?family=Arvo&display=swap" rel="stylesheet">

<?php

    if(isset($_POST["bt1"]))
    {
        $servername="localhost";
        $user="root";
        $password="";
        $db="aws";
        $conn=mysqli_connect($servername,$user,$password,$db);
        $usuario=$_POST['name'];
        $contraseña=$_POST['pass'];
        $validar="SELECT * FROM `rol_empleado` WHERE `usuario`='$usuario' and `contraseña`='$contraseña' ";
        $r=mysqli_query($conn,$validar);
        if(mysqli_num_rows($r)>0)
        {
            while($row=mysqli_fetch_array($r))
                {
                    $rol=$row['rol'];            
                }
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
            session_start();
            $_SESSION['rolesito']=$rol;
            $_SESSION['bandera']="t";
          }
        else
        {
            echo '<script language="javascript">alert("Contraseña o usuario incorrecto");</script>';                
            {
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
          }
        $conn->close();
    }
   

    if(isset($_POST["bt2"]))
    {
        echo('<nav role="navigation" class="primary-navigation">
                      <ul>
                      <li><a href="Index.php">Inicio</a></li>
                      <li><a href="centro_educativo.php">Nuestro Centro Educativo</a></li>
                      <li><a href="servicios.php">Servicios Educativos</a></li>
                      <li><a href="login.php">Atención al Alumno</a></li>
                      <li><a href="contacto.php">Contáctanos</a></li>
                        </ul>
                      </nav>"');
        session_start();
        $_SESSION['bandera']="f";

    }
    ?>
<br><br>
<br>

<div class="login">
		<div class="login-screen">
			<div class="app-title">
				<h1>Login</h1>
			</div>

			<div class="login-form">
      <form action="login2.php" method="POST">
				<div class="control-group">
				<input class="form-control" type="text" class="login-field" value="" placeholder="username"  name="name">
				<label class="login-field-icon fui-user" for="login-name"></label>
				</div>

				<div class="control-group">
				<input class="form-control" type="password" class="login-field" value="" placeholder="password" name="pass">
				<label class="login-field-icon fui-lock" for="login-pass"></label>
				</div>
        <div class="control-group">
				<label class="login-field-icon fui-lock" for="login-pass"></label>
				</div>
                <div>
                <input class="btn btn-primary btn-large btn-block" href="#" type="submit" id="bt1" name="bt1" value="Login"> <br>
                
                <input class="btn btn-primary btn-large btn-block"  type="submit" id="bt2" name="bt2" value="Logout">
                </div>
      </form>        
			</div>
		</div>
	</div>

</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="js/java.js"></script>
<link rel="stylesheet" href="estilo/estilo-p.css">