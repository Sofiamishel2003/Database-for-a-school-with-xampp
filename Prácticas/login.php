<head>
  <meta charset="utf-8"></head>
  <?php
  include("html/menu.php")
?>
</head>
<body>
<br>
<link href="https://fonts.googleapis.com/css?family=Arvo&display=swap" rel="stylesheet">

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
				<input class="form-control"  type="password" class="login-field" value="" placeholder="password" name="pass">
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

