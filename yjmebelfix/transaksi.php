<?php 


session_start();
include "k.php";
include "function.php";

if(!isset($_GET['id'])){
	redirect_back();
}

$id = filterNumber($_GET['id']);

$queryp = 	"SELECT j.id_penjualan, date_format(j.tgl_jual, '%d %M %Y') as tanggal, p.nama_barang, c.nama, j.jenis, j.keterangan, j.status_pesanan, j.total_harga, c.alamat, ". 
			"		(SELECT IFNULL(SUM(b.nominal),0) FROM transaksi_pembayaran b WHERE b.id_penjualan = j.id_penjualan) as bayar ".
			"FROM 	transaksi_penjualan j ".
			"JOIN 	tb_customer c ON j.id_cust = c.id_cust ". 
			"JOIN 	produk p ON j.id_barang = p.id_barang ". 
			"WHERE  j.id_penjualan = {$id}";

$sqlp = mysqli_query($connect, $queryp);
$datap = mysqli_fetch_assoc($sqlp);


if (isset($_POST['kirim'])) {
	// $id_cust     = $_POST['nama'];
	// $id_barang   = $_POST['produk'];
	// $jenis   = $_POST['jenis'];
	// $keterangan   = $_POST['keterangan'];
    $tgl_bayar     	= convertValidDate($_POST['tgl_bayar'], 'Y-m-d', 'Y-m-d');
	$nominal   		= filterNumber($_POST['nominal']);
	
	$check = uploadImage('bukti');
	
	if($check['status']){
		
		$sisa 	= $datap['total_harga'] - $datap['bayar'] - $nominal;
		$status	= ($sisa > 0)? 'BELUM LUNAS' : 'LUNAS';
 		
		$queryy = "INSERT INTO transaksi_pembayaran (`id_penjualan`, `tgl_bayar`, `nominal`,`bukti_tf`, `status`) VALUES 
		('$id', '$tgl_bayar', '$nominal', '{$check['file']}' ,'$status')";
		
		if (mysqli_query($connect, $queryy)){
			echo '<script type="text/javascript">
				alert("Sukses Tambah Data Pesanan");
				window.history.back();</script>";';
		}else{ 
			echo '<script type="text/javascript">
				alert("GAGAL");
				window.history.back();</script>";';
		}		
	}else{
		echo '<script type="text/javascript">
			alert("GAGAL PROSES");
			window.history.back();</script>";';		
	}
}


// if ( isset( $_SESSION['id_cust'] ) ) {
// } else {
// }

  
//     // $no = 1;
    
//     $id = $_GET['id'];

//     $kodepenjualan = kodepenjualan();



//     $data1 = query("SELECT a.id_barang, a.id_kategori, a.nama_barang, a.harga, a.gambar FROM produk a 
//                     INNER JOIN kategori_produk b ON a.id_kategori = b.id_kategori
//                     WHERE a.id_barang = '$id'")[0];

       


    // $data = mysqli_query($connect,"select * from produk");
    
?>    

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>YJ Mebel</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito+Sans:200,300,400,700,900"> 
    <link rel="stylesheet" href="fonts/icomoon/style.css">

    <link rel="stylesheet" href="css/magnific-popup.css">
    <link rel="stylesheet" href="css/jquery-ui.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/bootstrap-datepicker.css">
    
    
    <link rel="stylesheet" href="fonts/flaticon/font/flaticon.css">
  
    <link rel="stylesheet" href="css/aos.css">

    <link rel="stylesheet" href="css/style.css">
    
  </head>
  <body>
  
  <div class="site-wrap">

    <div class="site-mobile-menu">
      <div class="site-mobile-menu-header">
        <div class="site-mobile-menu-close mt-3">
          <span class="icon-close2 js-menu-toggle"></span>
        </div>
      </div>
      <div class="site-mobile-menu-body"></div>
    </div> <!-- .site-mobile-menu -->
    
    
    <div class="site-navbar-wrap">
      <div class="site-navbar-top">
        <div class="container py-3">
          <div class="row align-items-center">
            <div class="col-6">
              <a href="#" class="p-2 pl-0"><span class="icon-twitter"></span></a>
              <a href="#" class="p-2 pl-0"><span class="icon-facebook"></span></a>
              <a href="#" class="p-2 pl-0"><span class="icon-instagram"></span></a>
            </div>
            <div class="col-6">
              <div class="d-flex ml-auto">
                <a href="#" class="d-flex align-items-center ml-auto mr-4">
                  <span class="icon-user mr-2"></span>
                  <span class="d-none d-md-inline-block"><?php
                    echo $_SESSION['username_cust'];?></span>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="site-navbar">
        <div class="container py-1">
          <div class="row align-items-center">
            <div class="col-2">
              <!-- <h1 class="mb-0 site-logo"><a href="index.html">YJ Furniture</a></h1> -->
            </div>
            <div class="col-10">
              <nav class="site-navigation text-right" role="navigation">
                <div class="container">
                  <div class="d-inline-block d-lg-none ml-md-0 mr-auto py-3"><a href="#" class="site-menu-toggle js-menu-toggle text-white"><span class="icon-menu h3"></span></a></div>

                  <ul class="site-menu js-clone-nav d-none d-lg-block">
                  <li><a href="index2.php">Home</a></li>
                  <li><a href="katalog2.php">Katalog</a></li>
                    <li><a href="keranjang.php">Data Pesanan</a></li>
                    <li><a href="kontak2.php">Kontak</a></li>
                    <li><a href="logout.php">Logout</a></li>
                  </ul>
                </div>
              </nav>
            </div>
          </div>
        </div>
      </div>
    </div>


<div class="site-blocks-cover overlay inner-page" style="background-image: url(images/hero_bg_1.jpg);" data-aos="fade" data-stellar-background-ratio="0.5">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-md-10">
            <!-- <span class="sub-text">Know Us</span> -->
            <h1>Riwayat Transaksi "<?php
              echo $_SESSION['username_cust'];?>"</h1>
          </div>
        </div>
      </div>
    </div><br>
    <center>

    <div class="container">
    <form name="form1" class="form-horizontal" role="form" action="" method="post" enctype="multipart/form-data">
					<div class="col-xs-6 col-xs-12">
						<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Kode  </label>
							<div class="col-sm-6">
								<input disabled type="text" class="form-control" name="" value="<?php echo setKode($datap['id_penjualan'], 'BYR')?>"/>
							</div>
						</div>					
						<div class="form-group">	
							<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Tanggal  </label>
							<div class="col-sm-6">
								<input disabled type="text" class="form-control" name="" value="<?php echo $datap['tanggal']?>"/>
							</div>
						</div>
						<div class="form-group"> 	
							<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Pelanggan</label>
							<div class="col-sm-6">
								<input disabled type="text" class="form-control" name="" value="<?php echo $datap['nama']?>"/>
							</div>
						</div>
						<div class="form-group"> 	
							<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Alamat</label>
							<div class="col-sm-6">
								<input disabled type="text" class="form-control" name="" value="<?php echo $datap['alamat']?>"/>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Nama Barang  </label>
							<div class="col-sm-6">
								<input disabled type="text" class="form-control" name="" value="<?php echo $datap['nama_barang']?>"/>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Jenis</label>
							<div class="col-sm-6">
								<input disabled type="text" class="form-control" name="" value="<?php echo $datap['jenis']?>"/>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Keterangan</label>
							<div class="col-sm-6">
								<input disabled type="text" class="form-control" name="" value="<?php echo $datap['keterangan']?>"/>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Total Harga</label>
							<div class="col-sm-6">
								<input disabled type="text" class="form-control" name="" value="<?php echo number_format($datap['total_harga'], 0, ',', '.')?>"/>
							</div>
						</div>
						<div class="form-group">	
							<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Sudah Bayar</label>
							<div class="col-sm-6">
								<input disabled type="text" class="form-control" name="" value="<?php echo number_format($datap['bayar'], 0, ',', '.')?>"/>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Status</label>
							<div class="col-sm-6">
								<input disabled type="text" class="form-control" name="" value="<?php echo $datap['status_pesanan']?>"/>
							</div>
						</div>
					</div>
					<div class="col-xs-6 col-xs-12">
						
						<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Tanggal Bayar  </label>
							<div class="col-sm-6">
								<input required type="date" value="<?php echo date('Y-m-d')?>" class="form-control" name="tgl_bayar" id="form-field-1-1"   />
							</div>
						</div>					
						<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Nominal </label>
							<div class="col-sm-6">
								<input required type="number" class="form-control" id="form-field-8" name="nominal" placeholder="Nominal yang dibayar">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Bukti Bayar </label>
							<div class="col-sm-6">
								<input required type="file" accept="image/*" class="form-control" id="form-field-8" name="bukti" placeholder="Bukti Bayar">
							</div>
						</div>	
						<div class="form-group">
							<label class="col-md-3 control-label no-padding-right" for="form-field-1-1"></label>
							<div class="col-md-9">
								<button type="submit" name="kirim" class="btn btn-sm btn-primary">Tambah</button>&nbsp;&nbsp;
								<a href="keranjang.php?id=<?php echo $datap['id_penjualan']; ?>" class="btn btn-sm btn-warning">Kembali</a>
							</div>
						</div>
					
					</div>
					</form>
    <table class="table table-bordered table-striped">
		<thead>
		<tr>
            <th style="text-align: center;">No</th>
			<th style="text-align: center;">Kode</th>
			<th style="text-align: center;">Tanggal Bayar</th>
			<th style="text-align: center;">Nominal</th>
			<th style="text-align: center;">Bukti Transfer</th>
			<th style="text-align: center;">Status</th>
			<th style="text-align: center;">Aksi</th>
		</tr>
		</thead>
		<tbody>
        <?php
								$query = "SELECT date_format(tgl_bayar, '%d %M %Y') as tanggal, date_format(tgl_bayar, '%Y-%m-%d') as tgl_bayar, bukti_tf, nominal, status, id_pembayaran
										  FROM transaksi_pembayaran 
										  where id_penjualan = {$id} 
										  ORDER BY tgl_bayar ASC";
										  
								$sql = mysqli_query($connect, $query);
								$no = 1;
								while ($data = mysqli_fetch_array($sql)) { ?>
										<tr>
											<td class="center"><?php echo $no; ?></td>
											<td class="center"><?php echo setKode($data['id_pembayaran'], 'BYR'); ?></td>
											<td><?php echo $data['tanggal']; ?></td>
											<td><?php echo number_format($data["nominal"],2,',','.'); ?></td>
											<td><a href="#modal-gambar<?php echo $data['id_pembayaran']; ?>" role="button" class="p-2 pl-0" data-toggle="modal"><span class="icon-eye"></span></a></td>
                                            <td><?php echo $data['status']; ?></td>
											<td>
                                                    <a href="transaksi.php?id=<?php echo $data['id_penjualan']; ?>" class="p-2 pl-0"><span class="icon-list"></span></a>
											</td> 
										</tr>
										<div class="modal fade" id="modal-gambar<?php echo $data['id_pembayaran']; ?>">
											<div class="modal-dialog" style="width:80%;">
											  <div class="modal-content" id="lihat">
												<img src="<?php echo $data['bukti_tf']; ?>" width="100%" height="700" alt=""/>
											  </div>
											</div>
										</div>
										
		<?php $no++; } ?>
		</tbody>
	</table>
    </div>
				 				<!-- <a href="index.php?dokumen" role="button" class="btn btn-sm btn-info" data-toggle="modal"><i class="ace-icon fa fa-mail-reply align-middle bigger-120"></i> Kembali &nbsp;</a> -->
							</div>
						</div><!-- /.page-header -->
						</form>
            </center>
						<div class="row">
							<div class="col-xs-12">
							</div>
                </div>
								</div>
              </div>
 
              <?php

              $queryp = "SELECT * FROM transaksi_penjualan";
              $sqlp = mysqli_query($connect, $queryp);
              $datap = mysqli_fetch_assoc($sqlp);

              if (isset($_POST['submit'])) {
                $id_penjualan     = $_POST['id_penjualan'];
                $id_cust     = $_POST['id_cust'];
                $id_barang   = $_POST['id_barang'];
                $jenis   = $_POST['jenis'];
                $keterangan   = $_POST['keterangan'];
                // $tgl_jual     = $_POST['tgl_jual'];
                $total_harga   = $_POST['total_harga'];
                // $status_pesanan   = $_POST['status_pesanan'];
                $queryy = "INSERT INTO transaksi_penjualan (`id_penjualan`, `id_cust`, `id_barang`, `keterangan`,`jenis`, `tgl_jual`, `total_harga`,`status_pesanan`) VALUES 
                ('$id_penjualan', '$id_cust', '$id_barang', '$keterangan', '$jenis' ,CURDATE(), '$total_harga', 'Pesan')";
                
                if (mysqli_query($connect, $queryy)){
                ?>
                  <script type="text/javascript">
                    alert("Sukses Tambah Data Pesanan");
                    document.location.href = 'katalog2.php';

                  </script>
                  <?php
                  echo"<script>window.history.back();</script>";
                }
                else{ 
                ?>
                  <script type="text/javascript">
                    alert("GAGAL");
                    document.location.href = 'pembelian.php';
                    
                  </script>
                  <?php
                  echo"<script>window.history.back();</script>";
                  }		
              }       


    // $data = mysqli_query($connect,"select * from produk");
            ?>

<footer class="site-footer border-top">
      <div class="container">
        <div class="row">
          <div class="col-lg-4 mb-5 mb-lg-0">
            <div class="row mb-5">
              <div class="col-md-12">
                <h3 class="footer-heading mb-4">Navigasi</h3>
              </div>
              <div class="col-md-6 col-lg-6">
                <ul class="list-unstyled">
                <li><a href="index.php">Home</a></li>
                    <li><a href="about.php">Tentang Kami</a></li>
                    <li><a href="katalog.php">Katalog</a></li>
                    
                </ul>
              </div>
              <div class="col-md-6 col-lg-6">
                <ul class="list-unstyled">
                <li><a href="layanan.php">Pelayanan</a></li>
                    <li><a href="kontak.php">Kontak</a></li>
                </ul>
              </div>
            </div>

            
          </div>
          <div class="col-lg-4">
           

            <div class="mb-5">
              <h3 class="footer-heading mb-4">Berita Baru</h3>
              <div class="block-25">
                <ul class="list-unstyled">
                  <li class="mb-3">
                    <a href="#" class="d-flex">
                      <figure class="image mr-4">
                        <img src="images/kitchen.jpg" alt="" class="img-fluid">
                      </figure>
                      <div class="text">
                        <span class="small text-uppercase date">16 November 2019</span>
                        <h3 class="heading font-weight-light">Kitchen set berbahan alumunium dengan polesan warna natural</h3>
                      </div>
                    </a>
                  </li>
                  <li class="mb-3">
                    <a href="#" class="d-flex">
                      <figure class="image mr-4">
                        <img src="images/setmeja.jpg" alt="" class="img-fluid">
                      </figure>
                      <div class="text">
                        <span class="small text-uppercase date">20 Februari 2020</span>
                        <h3 class="heading font-weight-light">Set meja makan untuk keluarga jumlah 4 orang</h3>
                      </div>
                    </a>
                  </li>
                  <li class="mb-3">
                    <a href="#" class="d-flex">
                      <figure class="image mr-4">
                        <img src="images/img_5.jpg" alt="" class="img-fluid">
                      </figure>
                      <div class="text">
                        <span class="small text-uppercase date">12 April 2020</span>
                        <h3 class="heading font-weight-light">Perabot interior</h3>
                      </div>
                    </a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
            </div>
        <div class="row pt-5 mt-5 text-center">
          <div class="col-md-12">
            <p>
            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
            Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | YJ Mebel Kota Malang</a>
            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
            </p>
          </div>
          
        </div>
      </div>
    </footer>
  </div>

  <script src="js/jquery-3.3.1.min.js"></script>
  <script src="js/jquery-migrate-3.0.1.min.js"></script>
  <script src="js/jquery-ui.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/jquery.stellar.min.js"></script>
  <script src="js/jquery.countdown.min.js"></script>
  <script src="js/jquery.magnific-popup.min.js"></script>
  <script src="js/bootstrap-datepicker.min.js"></script>
  <script src="js/aos.js"></script>

  <script src="js/main.js"></script>
  <script>

$(document).ready(function () {

  $('.sidebar-menu').tree()


  $('.view').click(function(){

    var id = $(this).attr("id");
    var url = $(this).attr("url");

    $.ajax({

      url: 'page/view_pdf.php',
      method: 'post',
      data: {id:id , url:url},
      success:function(data){
        $('#lihat').html(data);
        $('#modal-default').modal("show");
      }

    });

  });

})
</script>    
  </body>
</html>    

