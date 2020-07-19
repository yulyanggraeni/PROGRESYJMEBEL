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
                  <span class="icon-phone mr-2"></span>
                  <span class="d-none d-md-inline-block">yjfurniture@gmail.com</span>
                </a>
                <a href="#" class="d-flex align-items-center">
                  <span class="icon-envelope mr-2"></span>
                  <span class="d-none d-md-inline-block">+62 878 593 457 90</span>
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
                  <li><a href="index.php">Home</a></li>
                    <li><a href="about.php">Tentang Kami</a></li>
                    <li><a href="katalog.php">Katalog</a></li>
                    <li><a href="layanan.php">Layanan</a></li>
                    <li><a href="kontak.php">Kontak</a></li>
                    <li><a href="login.php">Login</a></li>
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
          </div>
        </div>
      </div>
    </div>  

<br><br>



<!-- dropdown filter -->
<!-- <form method="POST" action="">
<?php 
    include "k.php"; ?>
<div class="form-group">
	<label class="col-sm-2 control-label no-padding-right" for="form-field-1-1"> Filter </label>
		<?php
		$queryp = "SELECT nama_barang from produk
		ORDER BY nama_barang ASC";
		$sqlp = mysqli_query($connect, $queryp);
		?>
	<div class="col-sm-6 col-sm-4">
		<select name="id_barang" class="chosen-select col-xs-8 col-sm-12 form-control">
		<option value="">-Pilih Kategori-</option>
		<?php
		while ($datap = mysqli_fetch_array($sqlp)) { ?>
		<option value="<?php echo $datap['id_barang'] ?>" ><?php echo $datap['nama_barang']; ?></option>
		<?php
		}
		?>
		</select>
		</div>
		</div>
		</div>
		 <div class="col-sm-4" >
		        <button id="search" name="search" class="btn btn-warning">Cari</button>
		    </div>
		</div>
	</form> -->
	
<p><section id="news" class="news">
	<div class="container">
	<div class="row">
	<?php 
    include "k.php";
		// $no = 1;
		$data = mysqli_query($connect,"select * from produk");
		while($d = mysqli_fetch_array($data)){
			?>
					<div class="col-md-3 col-xs-12">
						<div class="latest-post">
							<div class="latest-post-media">
								<a class="gallery-popup" href="images/<?php echo $d['gambar']; ?>" class="latest-post-img">
									
									<img  class="img-responsive" src="images/<?php echo $d['gambar']; ?>" width="250" height="250">
								</a>
							
							<div class="modal fade" id="modal-gambar<?php echo $d['id_barang']; ?>">
														<div class="modal-dialog" style="width:80%;">
														  <div class="modal-content" id="lihat">
															<embed src="images/<?php echo $d['gambar']; ?>" width="100%" height="700"> </embed>
														  </div>
														</div>
													</div>
							</div>
							<div class="post-body">
								<h4 class="post-title">
									<a href=""><?php echo $d['nama_barang']; ?></a>
									<p><a href=""><?php echo $d['harga']; ?></a></p>
									<a href="pembelian.php" name="search" class="btn btn-warning">Pesan</a>
									<button id="search" name="search" class="btn btn-info">Pesan Custom</button>
								</h4>
							</div>
						</div><!-- Latest post end -->
					</div><!-- 1st post col end -->
					<?php } ?>
				</div>
				<!--/ Content row end -->

			</div>
			<!--/ Container end -->
		</section>
		<!--/ News end -->



    <div class="site-section">
      <div class="container">
        <p><center><i><span class="sub-text">Silahkan Login Untuk Memesan Produk dan Melihat Katalog Lebih Lengkap</span></i></center>
      </div>
    </div>

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