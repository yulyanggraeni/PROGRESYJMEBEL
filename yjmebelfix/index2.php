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
              <!-- <h1 class="mb-0 site-logo"><a href="index.html">YJ Malang</a></h1> -->
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

    <div class="site-blocks-cover overlay" style="background-image: url(images/slider.png);" data-aos="fade" data-stellar-background-ratio="0.5">
      <div class="container">
        <div class="row align-items-center text-center justify-content-center">
          <div class="col-md-8">
            <h1>YJ Mebel Kota Malang</h1>
          </div>
        </div>
      </div>
    </div>  

    <div class="site-block-1">
      <div class="container">
        <div class="row">
          <div class="col-lg-4">
            <a href="#" class="site-block-feature d-flex p-4 rounded mb-4">
              <div class="mr-3">
                <span class="icon flaticon-window font-weight-light h2"></span>
              </div>
              <div class="text">
                <h3>Arsitektur Interior</h3>
                <p>Dekorasi rumah impian anda bersama kami</p>
              </div>
            </a>   
          </div>
          <div class="col-lg-4">
            <a href="#" class="site-block-feature d-flex p-4 rounded mb-4">
              <div class="mr-3">
                <span class="icon flaticon-measuring font-weight-light h2"></span>
              </div>
              <div class="text">
                <h3>Desain Interior</h3>
                <p>Desain rumah impian anda, dan kami siap mewujudkannya!</p>
              </div>
            </a>
          </div>
          <div class="col-lg-4">
            <a href="#" class="site-block-feature d-flex p-4 rounded mb-4">
              <div class="mr-3">
                <span class="icon flaticon-interior-design font-weight-light h2"></span>
              </div>
              <div class="text">
                <h3>Meubel</h3>
                <p>Siap menerima berbagai jenis model sesuai kebutuhan</p>
              </div>
            </a>
          </div>
        </div>
      </div>
    </div>
<br><br>
  <center>
    <h2 class="font-weight-bold text-black mb-5">Kategori</h2></center>
      <div class="container">
        <div class="row">
          <div class="col-lg-6 mb-5 mb-lg-0">
            <div class="img-border">
              <img src="images/img1.jpg" alt="Image" class="img-fluid">
            </div>
          </div>
          <div class="col-lg-6">
            <div class="row row-items">
              <div class="col-6">
                <a href="#" class="d-flex text-center feature active p-4 mb-4 bg-white">
                  <span class="align-self-center w-100">
                    <span class="d-block mb-3">
                      <span class="flaticon-step-ladder display-3"></span>
                    </span>
                    <h5>Set Pintu &amp; Jendela</h5>
                  </span>
                </a>
              </div>
              <div class="col-6">
                <a href="#" class="d-flex text-center feature active p-4 mb-4 bg-white">
                  <span class="align-self-center w-100">
                    <span class="d-block mb-3">
                      <span class="flaticon-sit-down display-3"></span>
                    </span>
                    <h5>Set Meja &amp; Kursi</h5>
                  </span>
                </a>
              </div>
            </div>
            <div class="row row-items last">
              <div class="col-6">
                <a href="#" class="d-flex text-center feature active p-4 mb-4 bg-white">
                  <span class="align-self-center w-100">
                    <span class="d-block mb-3">
                      <span class="flaticon-turned-off display-3"></span>
                    </span>
                    <h5>Perlengkapan Rumah</h5>
                  </span>
                </a>
              </div>
              <div class="col-6">
                <a href="#" class="d-flex text-center active feature active p-4 mb-4 bg-white">
                  <span class="align-self-center w-100">
                    <span class="d-block mb-3">
                      <span class="flaticon-window display-3"></span>
                    </span>
                    <h5>Dekorasi Lain</h5>
                  </span>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="site-section">
      <div class="container">
        <div class="row">
          <div class="col-12 text-center">
            <h2 class="font-weight-bold text-black mb-5">Katalog Produk</h2>
          </div>
        </div>
        <div class="row mb-5">
          <div class="col-lg-4 col-md-6 mb-4 mb-lg-0 post-entry">
            <a href="#" class="d-block figure">
              <img src="images/almari.jpeg" alt="Image" class="img-fluid">
            </a>
            <span class="text-muted d-block mb-2">23 Januari 2020</span>
            <h3><a href="#">Almari pakaian berbahan kayu jati dengan polesan natural</a></h3>
          </div>
          <div class="col-lg-4 col-md-6 mb-4 mb-lg-0 post-entry">
            <a href="#" class="d-block figure">
              <img src="images/kitchen.jpg" alt="Image" class="img-fluid">
            </a>
            <span class="text-muted d-block mb-2">12 Februari 2020</span>
            <h3><a href="#">Kitchen set modern berbahan alumunium </a></h3>
          </div>
          <div class="col-lg-4 col-md-6 mb-4 mb-lg-0 post-entry">
            <a href="#" class="d-block figure">
              <img src="images/pintu.jpg" alt="Image" class="img-fluid">
            </a>
            <span class="text-muted d-block mb-2">15 April 2020</span>
            <h3><a href="#">Pintu set jendela model sesuai keinginan pelanggan</a></h3>
          </div>

        </div>
        <div class="row mt-5 text-center">
          <div class="col-12">
            <p><a href="projects.php" class="btn btn-primary btn-lg rounded-0">View All Posts</a></p>
          </div>
        </div>
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