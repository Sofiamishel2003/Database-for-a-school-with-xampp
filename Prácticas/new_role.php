
<head>
  <meta charset="utf-8"></head>
  <?php
  include("html/menu.php")
?>
<body >
<br>
  <br>
  <?php
    if(isset($_POST["bt3"]))
        {
            $n=$_POST["name1"];
            $p=$_POST["pass1"];
            $r=$_POST["login-rol"];
            $servername="localhost";
            $user="root";
            $password="";
            $db="aws";
            $conn=mysqli_connect($servername,$user,$password,$db);
            if($r=="Administrador")
            {
                $rol="Administrador";
            }
            if($r=="Director")
            {
                $rol="Director";
            }
            if($r=="Secretaria")
            {
                $rol="Secretaria";
            }
            if($r=="Financiero")
            {
                $rol="Financiero";
            }
            $validar="SELECT `usuario` FROM `rol_empleado` WHERE `usuario`='$n'  ";
            $r=mysqli_query($conn,$validar);
            if(mysqli_num_rows($r)>0) //buscar los datos
            {
                echo '<script language="javascript">alert("El usuario ingresado ya existe");</script>';         
            }
            else
            {
                $sql="INSERT INTO `rol_empleado`(`usuario`,`contraseña`,`rol`)
                VALUES('$n','$p','$rol')";
                if(mysqli_query($conn,$sql))
                {
                    echo'<script language="javascript">alert("Los datos fueron ingresados exitosamente");</script>';     
                }else
                {
                    echo'<script language="javascript">alert("Los datos no se lograron ingresar");</script>';     
                }            
            }
            
            $conn->close();
        
            }
?>
<div class="login">
		<div class="login-screen">
			<div class="app-title">
				<h1>Registrar</h1>
			</div>

			<div class="login-form">
      <form action="new_role.php" method="POST">
				<div class="control-group">
				<input type="text" class="form-control" value="" placeholder="username"  name="name1" required>
				<label class="login-field-icon fui-user" for="login-name"></label>
				</div>

				<div class="control-group">
				<input type="password" class="form-control" value="" placeholder="password" name="pass1" required>
				<label class="login-field-icon fui-lock" for="login-pass"></label>
				</div>
        <div class="control-group">
				<select  class="form-control" value="" placeholder="rol(solo si es nuevo usuario)" name="login-rol">
                    <option value="Administrador">Administrador</option>
                    <option value="Director">Director</option>
                    <option value="Secretaria">Secretaria</option>
                    <option value="Financiero">Financiero</option> 
        </select>
				<label class="login-field-icon fui-lock" for="login-pass"></label>
				</div>
                <div>
                <input class="btn btn-primary btn-large btn-block" href="#" type="submit" id="bt1" name="bt3" value="Ingresar"> <br>
      </form>        
			</div>
		</div>
	</div>
</body>

