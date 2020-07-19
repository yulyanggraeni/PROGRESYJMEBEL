<html>
<head>
<title>Register</title>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
		<script src="js/jquery.js"></script>
    <script src="js/bootstrap.js"></script>
    <style>
		#index{
   		margin-top: 20px;
			margin-left: 420px;
		}
	</style>
</head>
<body class="login-layout" style="background-image: url('images/bg2.jpg');background-size:cover">
    <div id="index"> <!-- supaya latar kotak bisa berada ditengah, diatur menggunakan css -->
        <div class="container">
            <div class="card col-sm-6">
			    <div class="card-body">
                    <form action="registersql.php" method="POST">
                        <b><center><h3>Register Member Baru</b></center></h3><br>
                            <div class="form-group">
				                <label for="input-id" class="cal-sm-2">USERNAME</label> <!-- untuk input username baru -->
                                <input type "text" name="username_cust" class="form-control" value="">
                            </div>
                            <div class="form-group">
				                <label for="input-id" class="cal-sm-2">NAMA</label> <!-- untuk input username baru -->
                                <input type "text" name="nama" class="form-control" value="">
                            </div>
                            <div class="form-group">
				                <label for="input-id" class="cal-sm-2">ALAMAT</label> <!-- untuk input username baru -->
                                <input type "text" name="alamat" class="form-control" value="">
                            </div>
                            <div class="form-group">
				                <label for="input-id" class="cal-sm-2">TELEPON</label> <!-- untuk input username baru -->
                                <input type "text" name="telepon" class="form-control" value="">
                            </div>                            
                            <div class="form-group">
				                <label for="input-id" class="cal-sm-2">PASSWORD</label> <!-- untuk input password baru -->
                                <input type="password" name="password_cust" class="form-control" value="">
			                </div>
                              
                                    <center> <!-- Tombol simpan, batal, dan back  -->
                                    <th colspan="2" scope="row"><input type="submit" class="btn btn-info" name="simpan" 
                                    id="simpan" value="Simpan" />
                                    <input type="reset" class="btn btn-success" name="button2" id="button2" value="Reset" />
                                    <a class="btn btn-info" href="index.php">Kembali</a></th>
                                    <center>
                                    <br>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </body>
</html>