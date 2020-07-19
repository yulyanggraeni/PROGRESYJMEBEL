<?php
  session_start();
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
              <!-- <h1 class="mb-0 site-logo"><a href="index.html">Interior</a></h1> -->
            </div>
            <div class="col-10">
              <nav class="site-navigation text-right" role="navigation">
                <div class="container">
                  <div class="d-inline-block d-lg-none ml-md-0 mr-auto py-3"><a href="#" class="site-menu-toggle js-menu-toggle text-white"><span class="icon-menu h3"></span></a></div>

                  <ul class="site-menu js-clone-nav d-none d-lg-block">
                  <li><a href="index2.php">Home</a></li>
                    <!-- <li><a href="about.php">Tentang Kami</a></li> -->
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
            <!-- <span class="sub-text">Produk Mebel yang pernah kami buat</span> -->
            <h1>Katalog</h1>
            <!-- <span class="sub-text">Klik Tombol Dibawah ini Untuk Memesan Produk</span> -->
            <!-- <p><a href="https://api.whatsapp.com/send?phone=6287859345790" class="btn btn-warning btn-lg rounded-0">Pesan Disini</a> -->
          </div>
        </div>
      </div>
    </div>  
    
    <!-- <?php 
    include "k.php";
		// $no = 1;
		$data = mysqli_query($connect,"select * from produk");
		while($d = mysqli_fetch_array($data)){
			?>
    <div class="site-section">
      <div class="container">
        <div class="row">
          <div class="col-lg-4 col-md-6 mb-4 project-entry">
            <a href="#" class="d-block figure">
              <img src="images/<?php echo $d['gambar']; ?>" alt="Image" class="img-fluid">
            </a> 
            <h3 class="mb-0"><a href="#">Meja Belajar</a></h3>
            <span class="text-muted">Rp. </span>
          </div>
          <div class="col-lg-4 col-md-6 mb-4 project-entry">
            <a href="#" class="d-block figure">
              <img src="images/kt-sofabusa.jpg" alt="Image" class="img-fluid">
            </a>
            <h3 class="mb-0"><a href="#">Sofa Busa</a></h3>
            <span class="text-muted">Interior</span>
          </div>
        </div>
      </div>
    </div>
    <?php 
		}
		?> -->
    <p><section id="news" class="news">
	<div class="container">
  <form method="post">
			<label>Cari berdasarkan</label>
			<br>

              <?php
								$querypp = "SELECT * FROM kategori_produk ORDER BY nama_kategori ASC";
								$sqlp = mysqli_query($connect, $querypp);
							?>
							<div class="col-md-9">
								<select required name="kategori" class="chosen-select col-xs-12 col-sm-12 form-control">
									<option value="">-----Pilih Kategori-----</option>
									<?php
									while ($datap = mysqli_fetch_array($sqlp)) { ?>
										<option value="<?php echo $datap['id_kategori'] ?>"><?php echo $datap['nama_kategori']; ?></option>
									<?php
									}
									?>
								</select>
							</div>
              <br>
			<input type="submit" name="tanggal" value"FILTER" class="btn btn-sm btn-primary">
		</form>
    <br>
	<div class="row">
	<?php 
    // include "k.php";
    // $no = 1;
    if(isset($_POST['tanggal'])){
      $kategori = $_POST['kategori'];
      // $tgl2 = $_POST['tanggal2'];
      $data = mysqli_query($connect, "select * from produk where id_kategori = '$kategori'");
    } else {
      $data = mysqli_query($connect, "select * from produk");
    }

		// $data = mysqli_query($connect,"select * from produk");
		while($d = mysqli_fetch_array($data)){
			?>
					<div class="col-md-3 col-xs-12">
						<div class="latest-post">
							<div class="latest-post-media">
								<a class="gallery-popup" href="<?php echo $d['gambar']; ?>" class="latest-post-img">
									
									<img  class="img-responsive" src="<?php echo $d['gambar']; ?>" width="250" height="250">
								</a>
							
							<div class="modal fade" id="modal-gambar<?php echo $d['id_barang']; ?>">
														<div class="modal-dialog" style="width:80%;">
														  <div class="modal-content" id="lihat">
															<embed src="<?php echo $d['gambar']; ?>" width="100%" height="700"> </embed>
														  </div>
														</div>
													</div>
							</div>

              <!-- DETAIL PRODUK -->
              <div class="modal fade" id="detail_produk" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel"><?php echo $d['nama_barang']; ?></h4>
                </div>
                <div class="modal-body">
                <a href="" span style="color: black; font-family: Sans Serif">Keterangan: <?php echo $d['keterangan']; ?></a>
                <p><a href="" span style="color: black; font-family: Sans Serif">Harga : <?php echo $d['harga']; ?></a>
                </div>
              </div>
              </div>
              </div>

							<div class="post-body">
              <div class="latest-post">
								<center><h5 class="post-title" span style="font-family: Sans Serif; font-size: 19px;">
									<a href="" span style="color: black; font-family: Sans Serif"><?php echo $d['nama_barang']; ?></a>
									<p><a href="" span style="color: black; font-family: Sans Serif"><?php echo $d['harga']; ?></a></p>
									<p><a href="pembelian.php?id=<?php echo $d['id_barang']; ?>" name="search" class="btn btn-info">Pesan Sekarang</a>
                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#detail_produk">Detail</button></p>
								</h5></center>
							</div>
              </div>
						</div><!-- Latest post end -->
            <center>
					</div><!-- 1st post col end -->
					<?php } ?>
				</div>
				<!--/ Content row end -->

			</div>
			<!--/ Container end -->
		</section>
		<!--/ News end -->


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
                    <li><a href="katalog2.php">Katalog</a></li>
                    
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