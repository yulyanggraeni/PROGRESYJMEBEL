<!DOCTYPE html>
<html lang="en">
<head>
	<title>Form Login</title>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.js"></script>
	<style> /* css untuk mengatur tampilan login menjadi ke tengah */
		#index{
   			margin-top: 100px;
			margin-left: 390px;
		}
	</style>
</head>
<body class="login-layout" style="background-image: url('images/bg1.jpg');background-size:cover" >
<div id="index"> <!-- memanggil id css index -->
	<div class="container"> <!-- agar tampilan tidak sepenuh layar, jadi ada jarak tepinya -->
    	<div class="card col-sm-6"> <!-- membuat tabel latar -->
			<div class="card-body"> 
			<center>
			<form action="ceklogin.php" class="inner-login" method="post"> <!--memanggil ceklogin.php
																			 supaya bisa di proses di ceklogin.php -->
        		<h2 class="text-center title-login">LOGIN</h2> 
            	<div class="form-group"> <!-- agar tulisan username dan inputan bisa satu grup -->
					<label for="input-id" class="cal-sm-2">USERNAME</label>
               		<input type "text" name="username" class="form-control" value="">
           		</div>
        		<div class="form-group"><!-- agar tulisan password dan inputan bisa satu grup -->
					<label for="input-id" class="cal-sm-2">PASSWORD</label>
                	<input type="password" name="password" class="form-control" value="">
				</div>
					<input type="submit" name="submit" class="btn btn-info" value="LOGIN" /><br><br>
			</form>
			<form action="register.php"  method="post"> <!-- untuk beralih ke tampilan register -->
				<input type="submit" class="btn btn-success" value="Register" /><br> <!-- Button menuju tampilan register -->
			</form>
			</center>
			</div>
		</div>
	</div>
</div>

</center> 	
</body>
</html>