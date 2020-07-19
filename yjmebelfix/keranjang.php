<?php 


session_start();
include "k.php";
include "function.php";

$queryp = "SELECT * FROM transaksi_penjualan";
$sqlp = mysqli_query($connect, $queryp);
$datap = mysqli_fetch_assoc($sqlp);


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
            <h1>List Data Pesanan "<?php
              echo $_SESSION['username_cust'];?>"</h1>
          </div>
        </div>
      </div>
    </div><br>
    <center>

    <div class="container">
    <table class="table table-bordered table-striped">
		<thead>
			<tr>
      <th style="text-align: center;">No</th>
									<th style="text-align: center;">Kode</th>
									<th style="text-align: center;">Tanggal</th>
									<th style="text-align: center;">Produk</th>
									<th style="text-align: center;">Jenis</th>
									<th style="text-align: center;">Keterangan</th>
									<th style="text-align: center;">Status Pesanan</th>
                  <th style="text-align: center;">Total Harga</th>
									<th style="text-align: center;">Sudah Bayar</th>
									<th style="text-align: center;">Hutang</th>
									<th style="text-align: center;">Aksi</th>		
			</tr>
		</thead>
		<tbody>
		<?php
    $username= $_SESSION['username_cust'];
								$query = "SELECT c.nama, p.id_barang, c.alamat, c.id_cust, c.telepon, p.keterangan, p.tgl_jual,p.jenis,
                 p.status_pesanan , p.total_harga, p.id_penjualan, r.nama_barang ,  p.total_harga, 
													(p.total_harga - SUM(b.nominal)) as hutang, SUM(b.nominal) as modal 
										  FROM transaksi_penjualan as p, tb_customer as c, produk as r, transaksi_pembayaran as b
									 	  WHERE p.id_cust = c.id_cust AND r.id_barang=p.id_barang AND c.username_cust = '$username' AND p.id_penjualan = b.id_penjualan  ORDER BY p.tgl_jual ASC";

								// $query = "SELECT * FROM transaksi_penjualan as A INNER JOIN tb_customer as B 
								// ON A.keterangan, A.tgl_jual, A.total_harga, B.nama, B.alamat, B.telepon WHERE id_penjualan='$id_p'";


								$sql = mysqli_query($connect, $query);
								$no = 1;

								while ($data = mysqli_fetch_array($sql)) { 
									$code = setKode($data['id_penjualan'], 'TRA');
								?>
									<tr>
										<td class="center"><?php echo $no; ?></td>
										<td class="center"><?php echo $code; ?></td>
										<td><?php echo tgl_indo($data['tgl_jual']); ?></td>
										<!-- <td><?php echo $data['nama']; ?></td> -->
										<!-- <td><?php echo $data['alamat']; ?></td>
										<td><?php echo $data['telepon']; ?></td> -->
										<td><?php echo $data['nama_barang']; ?></td>
										<td><?php echo $data['jenis']; ?></td>
										<td><?php echo $data['keterangan']; ?></td>
										<!-- <td><?php echo number_format($data["total_harga"], 2, ',', '.'); ?></td> -->
										<td><?php echo $data['status_pesanan']; ?></td>
                    <td><?php echo number_format($data['total_harga'], 0, ',', '.'); ?></td>
										<td><?php echo number_format($data['modal'], 0, ',', '.'); ?></td>
										<td><?php echo ($data['hutang'] <= 0)? 0 : number_format($data['hutang'], 0, ',', '.'); ?></td>
										<td><a href="https://api.whatsapp.com/send?phone=6287859345790" class="p-2 pl-0"><span class="icon-whatsapp"></span></a>
                        <a href="transaksi.php?id=<?php echo $data['id_penjualan']; ?>" class="p-2 pl-0"><span class="icon-list"></span></a>
                    </td>
									</tr>
									<!-- <div class="modal fade" id="modal-gambar<?php echo $data['id_barang']; ?>">
													<div class="modal-dialog" style="width:80%;">
													  <div class="modal-content" id="lihat">
														<embed src="../upload/<?php echo $data['gambar']; ?>" width="100%" height="700"> </embed>
													  </div>
													</div>
												</div> -->




									<!-- MODAL EDIT PESANAN -->
									<div id="modal-edit<?php echo $data['id_penjualan']; ?>" class="modal fade" tabindex="-1">
										<form class="form-horizontal" role="form" form action="" method="post" enctype="multipart/form-data">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header no-padding">
													<div class="table-header">
														<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
															<span class="white">&times;</span>
														</button>
														Form Edit Data Pesanan "<?php echo $code; ?>"
													</div>
												</div>
												<div class="modal-body">
													<div class="row">
														<div class="col-md-12">
															<div class="form-group mb10">
																<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Nama Pembeli </label>
																<div class="col-xs-12 col-sm-9">
																	<input type="text" name="nama" class="col-xs-12 col-sm-12" value="<?php echo $data['nama']; ?>" required="" readonly />
																</div>
															</div>
															<div class="form-group mb10">
																<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Alamat </label>
																<div class="col-xs-12 col-sm-9">
																	<input type="text" name="alamat" class="col-xs-12 col-sm-12" value="<?php echo $data['alamat']; ?>" required="" readonly />
																</div>
															</div>
															<div class="form-group mb10">
																<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Telepon </label>
																<div class="col-xs-12 col-sm-9">
																	<input type="text" name="telepon" class="col-xs-12 col-sm-12" value="<?php echo $data['telepon']; ?>" required="" readonly />
																</div>
															</div>
															<div class="form-group mb10">
																<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Keterangan </label>
																<div class="col-xs-12 col-sm-9">
																	<input type="text" name="keterangan" class="col-xs-12 col-sm-12" value="<?php echo $data['keterangan']; ?>" required="" />
																</div>
															</div>
															<div class="form-group mb10">
																<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Harga </label>
																<div class="col-xs-12 col-sm-9">
																	<input type="text" name="total_harga" class="col-xs-12 col-sm-12" value="<?php echo $data['total_harga']; ?>" required="" />
																</div>
															</div>
															<input type="hidden" name="id_penjualan" value="<?= $data["id_penjualan"]; ?>">
															<input type="hidden" name="id_cust" value="<?= $data["id_cust"]; ?>">
															<input type="hidden" name="id_barang" value="<?= $data["id_barang"]; ?>">
														</div>												
													</div>												
												</div>												
												<div class="modal-footer center">
													<input type="submit" name="ganti" class="btn btn-success" value="Edit Data Pesanan">
												</div>
											</div><!-- /.modal-content -->
										</div><!-- /.modal-dialog -->
										</form>
									</div>

									<!-- MODAL DELETE PESANAN -->
									<div id="modal-delete<?php echo $data['id_penjualan']; ?>" class="modal fade" tabindex="-1">
										<form class="form-horizontal" role="form" form action="" method="post" enctype="multipart/form-data">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header no-padding red">
													<div class="table-header" style="background-color: #013197;">
														<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
															<span class="white">&times;</span>
														</button>
														Delete Data Pesanan "<?php echo $code; ?>"
													</div>
												</div>
												<div class="modal-body">
													<div class="form-group">
														<label class="col-sm-12 control-label " style="color: red;">Apakah Anda yakin akan menghapus data pesanan ? "<?php echo $code; ?>"</label>
														<input type="hidden" name="id_penjualan" value="<?php echo $data['id_penjualan']; ?>" />
													</div>
												</div>
												<div class="modal-footer">
													<input name="delete" type="submit" class="btn btn-danger" Value="Yes">
													<button type="button" class="btn btn-primary" data-dismiss="modal">No</button>
												</div>
											</div><!-- /.modal-content -->
										</div><!-- /.modal-dialog -->
										</form>
									</div>

					<?php $no++;
									} ?>
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
    
  </body>
</html>    

