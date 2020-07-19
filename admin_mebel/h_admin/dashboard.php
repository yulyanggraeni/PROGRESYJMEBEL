<?php  
include "../k.php";

$query = "SELECT COUNT(p.id_proyek) as jml, u.nama, u.nip FROM `proyek` p INNER JOIN user u ON p.pemasar=u.nip GROUP BY p.pemasar";
$sql = mysqli_query($connect, $query);
$pemasar = array();
$data_pemasar = array();
// while ($pem = mysqli_fetch_array($sql)) {
// 	$pemasar['name'] = $pem['nama'];
// 	$pemasar['y'] = (intval($pem['jml']));
// 	array_push($data_pemasar, $pemasar);
// }

?>

<div class="main-content">
  <div class="main-content-inner">
    <div class="breadcrumbs ace-save-state" id="breadcrumbs">
      <ul class="breadcrumb">
        <li>
          <i class="ace-icon fa fa-home home-icon"></i>
          <a href="#">Home</a>
        </li>
        <li class="active">Dashboard</li>
      </ul><!-- /.breadcrumb -->

      <div class="nav-search" id="nav-search">
        <form class="form-search">
          <span class="input-icon">
            <input type="text" placeholder="Search ..." class="nav-search-input" id="nav-search-input" autocomplete="off" />
            <i class="ace-icon fa fa-search nav-search-icon"></i>
          </span>
        </form>
      </div><!-- /.nav-search -->
    </div>

    <div class="page-content">

      <div class="page-header">
        <h1>
          Dashboard
          <small>
            <i class="ace-icon fa fa-angle-double-right"></i>
            Admin Toko YJ Mebel
          </small>
        </h1>
      </div><!-- /.page-header -->

      <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="i_box bg-re">
            <span class="i_box-icon"><i class="fa fa-bell"></i></span>
            <?php
            $queryp = "SELECT COUNT(id_penjualan) as jml FROM transaksi_penjualan";
            $sqlp = mysqli_query($connect, $queryp);
            $c_proyek = mysqli_fetch_assoc($sqlp);
            ?>
            <div class="i_box-content">
              <span class="i_box-text">Pesanan</span>
              <span class="i_box-number"><?php echo $c_proyek['jml']; ?></span>
              <span class="progress-description">
              Data Pesanan
              </span>
            </div>
          </div>
        </div>

        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="i_box bg-ye">
            <span class="i_box-icon"><i class="fa fa-image"></i></span>
            <?php
            $queryu = "SELECT COUNT(id_kategori) as jml FROM kategori_produk";
            $sqlu = mysqli_query($connect, $queryu);
            $c_user = mysqli_fetch_assoc($sqlu);
            ?>
            <div class="i_box-content">
              <span class="i_box-text">Lunas</span>
              <span class="i_box-number"><?php echo $c_user['jml']; ?></span>
              <span class="progress-description">
                Lunas Transaksi
              </span>
            </div>
          </div>
        </div>

        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="i_box bg-gr">
            <span class="i_box-icon"><i class="fa fa-image"></i></span>
            <?php
            $queryu = "SELECT COUNT(id_barang) as jml FROM produk";
            $sqlu = mysqli_query($connect, $queryu);
            $c_user = mysqli_fetch_assoc($sqlu);
            ?>
            <div class="i_box-content">
              <span class="i_box-text">Piutang</span>
              <span class="i_box-number"><?php echo $c_user['jml']; ?></span>
              <span class="progress-description">
                Piutang Customer
              </span>
            </div>
          </div>
        </div>

        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="i_box bg-aq">
            <span class="i_box-icon"><i class="fa fa-group"></i></span>
            <?php
            $queryu = "SELECT COUNT(id_cust) as jml FROM tb_customer";
            $sqlu = mysqli_query($connect, $queryu);
            $c_user = mysqli_fetch_assoc($sqlu);
            ?>
            <div class="i_box-content">
              <span class="i_box-text">Pendapatan</span>
              <span class="i_box-number"><?php echo $c_user['jml']; ?></span>
              <span class="progress-description">
                Pendapatan Toko
              </span>
            </div>
          </div>
        </div>

       
      </div>
    </div><!-- /.page-content -->
  </div>
</div>

<script src="../assets/js/jquery-2.1.4.min.js"></script>
			<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>
		<script src="../assets/js/bootstrap.min.js"></script>

		<script src="../assets/js/jquery.dataTables.min.js"></script>
		<script src="../assets/js/jquery.dataTables.bootstrap.min.js"></script>
		<script src="../assets/js/dataTables.buttons.min.js"></script>
		<script src="../assets/js/buttons.flash.min.js"></script>
		<script src="../assets/js/buttons.html5.min.js"></script>
		<script src="../assets/js/buttons.print.min.js"></script>
		<script src="../assets/js/buttons.colVis.min.js"></script>
		<script src="../assets/js/dataTables.select.min.js"></script>

		<!-- ace scripts -->
		<script src="../assets/js/ace-elements.min.js"></script>
		<script src="../assets/js/ace.min.js"></script>

<script>
	var data = <?php echo json_encode($data_pemasar)?>;
  $("#loading").show();
	setTimeout(function(){ 
		var chart = Highcharts.chart('container', {
      chart: {
        type: 'column'
      },
      title: {
        text: 'Data Proyek Harkan'
      },
      subtitle: {
        text: ''
      },
      xAxis: {
        type: 'category'
      },
      yAxis: {
        title: {
          text: 'Total Proyek'
        },
        allowDecimals: false,
      },
      legend: {
        enabled: false
      },
      plotOptions: {
        series: {
          borderWidth: 0,
          dataLabels: {
            enabled: true,
            format: '{point.y}'
          }
        }
      },

      tooltip: {
        headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
        pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y}</b> proyek<br/>'
      },

      series: [
      {
        name: "Pemasar",
        colorByPoint: true,
        data: data,
      }
      ],
    });
    $("#loading").hide();
	}, 2000);

</script>