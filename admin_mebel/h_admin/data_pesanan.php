<?php 
include "../k.php";

$queryp = "SELECT * FROM transaksi_penjualan";
$sqlp = mysqli_query($connect, $queryp);
$datap = mysqli_fetch_assoc($sqlp);

if (isset($_POST['kirim'])) {
	$id_cust     	= filterNumber($_POST['nama']);
	$id_barang   	= filterNumber($_POST['produk']);
	$jenis   		= filterAlphaNumeric($_POST['jenis']);
	$keterangan   	= filterText($_POST['keterangan']);
	$tgl_jual     	= convertValidDate($_POST['tgl_jual'], 'Y-m-d', 'Y-m-d');
	$total_harga   	= filterNumber($_POST['total_harga']);
	
	$queryy = "INSERT INTO transaksi_penjualan (`id_cust`, `id_barang`, `keterangan`,`jenis`, `tgl_jual`, `total_harga`) VALUES 
	('$id_cust', '$id_barang', '$keterangan', '$jenis' ,'$tgl_jual', '$total_harga')";

	if (mysqli_query($connect, $queryy)) {
?>
		<script type="text/javascript">
			alert("Sukses Tambah Data Pesanan");
		</script>
	<?php
		echo "<script>window.history.back();</script>";
	} else {
	?>
		<script type="text/javascript">
			alert("GAGAL");
		</script>
	<?php
		echo "<script>window.history.back();</script>";
	}
}

if (isset($_POST['ganti'])) {
	$id_penjualan     	= filterNumber($_POST['id_penjualan']);
	//$id_cust     		= filterNumber($_POST['nama']);
	//$id_barang   		= filterNumber($_POST['produk']);
	$keterangan   		= filterText($_POST['keterangan']);
	$total_harga   		= filterNumber($_POST['total_harga']);
	$status_pesanan   = $_POST['status_pesanan'];

	$query3 = "UPDATE transaksi_penjualan set keterangan='$keterangan', total_harga='$total_harga', status_pesanan='$status_pesanan' WHERE id_penjualan='$id_penjualan'";

	if (mysqli_query($connect, $query3)) {
	?>
		<script type="text/javascript">
			alert("Sukses Memperbaharui Data Pesanan");
		</script>
	<?php
		echo "<script>window.history.back();</script>";
	} else {
	?>
		<script type="text/javascript">
			alert("GAGAL");
		</script>
	<?php
		echo "<script>window.history.back();</script>";
	}
}

if (isset($_POST['delete'])) {
	$id_penjualan = filterNumber($_POST['id_penjualan']);

	$query3 = "DELETE FROM transaksi_penjualan WHERE id_penjualan='$id_penjualan'";

	if (mysqli_query($connect, $query3)) {
	?>
		<script type="text/javascript">
			alert("Sukses Menghapus Data Pesanan");
		</script>
	<?php
		echo "<script>window.history.back();</script>";
	} else {
	?>
		<script type="text/javascript">
			alert("GAGAL");
		</script>
<?php
		echo "<script>window.history.back();</script>";
	}
}
?>

<div class="main-content">
	<div class="main-content-inner">
		<div class="breadcrumbs ace-save-state" id="breadcrumbs">
			<ul class="breadcrumb">
				<li>
					<i class="ace-icon fa fa-home home-icon"></i>
					<a href="index.php?dashboard">Home</a>
				</li>
				<li class="active">List Data Pesanan</li>
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
		<div class="col-sm-15 alert alert-info">
			<div class="row">
				<div class="col-md-12 col-md-12 col-xs-12">
					<!-- PAGE CONTENT BEGINS -->
					<form name="form1" class="form-horizontal" role="form" action="" method="post" enctype="multipart/form-data">
					<div class="col-md-6">
						<div class="form-group">
							<label class="col-md-3 control-label no-padding-right" for="form-field-1-1"> Tanggal </label>
							<div class="col-md-9">
								<input required type="date" name="tgl_jual" class="form-control" id="form-field-1-1" />
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label no-padding-right" for="form-field-1-1"> Customer </label>
							<?php
								$queryp = "SELECT * FROM tb_customer ORDER BY nama ASC";
								$sqlp = mysqli_query($connect, $queryp);
							?>
							<div class="col-md-9">
								<select required name="nama" class="chosen-select col-xs-12 col-sm-12 form-control">
									<option value="">-----Pilih Anggota-----</option>
									<?php
									while ($datap = mysqli_fetch_array($sqlp)) { ?>
										<option value="<?php echo $datap['id_cust'] ?>"><?php echo $datap['nama']; ?></option>
									<?php
									}
									?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label no-padding-right" for="form-field-1-1"> Produk </label>
							<?php
								$queryp = "SELECT * FROM produk ORDER BY nama_barang ASC";
								$sqlp = mysqli_query($connect, $queryp);
							?>
							<div class="col-md-9">
								<select required name="produk" class="chosen-select col-xs-12 col-sm-12 form-control">
									<option value="">-----Pilih Produk-----</option>
									<?php
									while ($datap = mysqli_fetch_array($sqlp)) { ?>
										<option value="<?php echo $datap['id_barang'] ?>"><?php echo $datap['nama_barang']; ?></option>
									<?php
									}
									?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label no-padding-right" for="form-field-1-1"> Jenis </label>
							<div class="col-md-9">
								<select required name="jenis" class="chosen-select col-xs-12 col-sm-12 form-control">
									<option value="">-----Pilih Jenis-----</option>
									<option value='CUSTOM'>Custom</option>
									<option value='SESUAI'>Sesuai</option>
								</select>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label class="col-md-3 control-label no-padding-right" for="form-field-1-1"> Keterangan </label>
							<div class="col-md-9">
								<textarea required class="form-control" id="form-field-8" name="keterangan" placeholder="Keterangan Pesanan" style="height:100px"></textarea>
							</div>

						</div>
						<div class="form-group">
							<label class="col-md-3 control-label no-padding-right" for="form-field-1-1"> Harga </label>
							<div class="col-md-9">
								<input required type="number" class="form-control" id="form-field-8" name="total_harga" placeholder="Harga Produk">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label no-padding-right" for="form-field-1-1"></label>
							<div class="col-md-9">
								<button type="submit" name="kirim" class="btn btn-sm btn-primary">Tambah</button>
							</div>
						</div>
					</div>
					</form>
				</div>
			</div>
		</div>
		<form method="post">
			<label>Cari berdasarkan :</label>
			<br>
			<label>Dari Tanggal : </label>
			<input type="date" name="tanggal1">
			<label>Sampai Tanggal: </label>
			<input type="date" name="tanggal2">
			<input type="submit" name="tanggal" value"FILTER" class="btn btn-sm btn-primary">
		</form>
		<br>
		<div class="row">
			<div class="col-xs-12">
				<div class="table-header">List Data Pesanan</div>
					<div class="table-responsive">
						<table id="dynamic-table" class="table table-striped table-bordered table-hover">
							<thead>
								<tr>
									<th style="text-align: center;">No</th>
									<th style="text-align: center;">Kode</th>
									<th style="text-align: center;">Tanggal</th>
									<th style="text-align: center;">Nama Pembeli</th>
									<th style="text-align: center;">Alamat</th>
									<th style="text-align: center;">Telepon</th>
									<th style="text-align: center;">Produk</th>
									<th style="text-align: center;">Jenis</th>
									<th style="text-align: center;">Keterangan</th>
									<th style="text-align: center;">Harga</th>
									<th style="text-align: center;">Status Pesanan</th>
									<th style="text-align: center;">Aksi</th>
								</tr>
							</thead>

							<tbody>
								<?php
								$query = "SELECT c.nama, p.id_barang, c.alamat, c.id_cust, c.telepon, p.keterangan, p.tgl_jual,p.jenis, p.status_pesanan , p.total_harga, p.id_penjualan, r.nama_barang 
										  FROM transaksi_penjualan as p, tb_customer as c, produk as r
									 	  WHERE p.id_cust = c.id_cust AND r.id_barang=p.id_barang";

								// $query = "SELECT * FROM transaksi_penjualan as A INNER JOIN tb_customer as B 
								// ON A.keterangan, A.tgl_jual, A.total_harga, B.nama, B.alamat, B.telepon WHERE id_penjualan='$id_p'";


								$sql = mysqli_query($connect, $query);
								$no = 1;
								
								if(isset($_POST['tanggal'])){
									$tgl1 = $_POST['tanggal1'];
									$tgl2 = $_POST['tanggal2'];
									$sql = mysqli_query($connect, "select c.nama, p.id_barang, c.alamat, c.id_cust, c.telepon, p.keterangan, p.tgl_jual, p.jenis, p.status_pesanan, p.total_harga, p.id_penjualan, r.nama_barang
									 from transaksi_penjualan as p, tb_customer as c, produk as r
									 where p.id_cust = c.id_cust AND r.id_barang = p.id_barang AND p.tgl_jual BETWEEN '$tgl1' AND '$tgl2'");
								} else {
									$sql = mysqli_query($connect, "select c.nama, p.id_barang, c.alamat, c.id_cust, c.telepon, p.keterangan, p.tgl_jual, p.jenis, p.status_pesanan, p.total_harga, p.id_penjualan, r.nama_barang
									from transaksi_penjualan as p, tb_customer as c, produk as r
									where p.id_cust = c.id_cust AND r.id_barang = p.id_barang");
								}

								while ($data = mysqli_fetch_array($sql)) { 
									$code = setKode($data['id_penjualan'], 'TRA');
								?>
									<tr>
										<td class="center"><?php echo $no; ?></td>
										<td class="center"><?php echo $code; ?></td>
										<td><?php echo tgl_indo($data['tgl_jual']); ?></td>
										<td><?php echo $data['nama']; ?></td>
										<td><?php echo $data['alamat']; ?></td>
										<td><?php echo $data['telepon']; ?></td>
										<td><?php echo $data['nama_barang']; ?></td>
										<td><?php echo $data['jenis']; ?></td>
										<td><?php echo $data['keterangan']; ?></td>
										<td><?php echo number_format($data["total_harga"], 2, ',', '.'); ?></td>
										<td><?php echo $data['status_pesanan']; ?></td>
										<td><?php if ($data['id_penjualan'] != null) { ?>
												<div class=" action-buttons">
													<a href="#modal-edit<?php echo $data['id_penjualan']; ?>" role="button" class="green" data-toggle="modal"><i class="ace-icon fa fa-pencil bigger-130"></i></a>
													<a class="red" href="#modal-delete<?php echo $data['id_penjualan']; ?>" role="button" data-toggle="modal"><i class="ace-icon fa fa-trash-o bigger-130"></i></a>
													<a href="index.php?transaksi_pembayaran&id=<?php echo $data['id_penjualan']; ?>" role="button" class="blue" data-toggle="modal"><i class="ace-icon fa fa-list bigger-130"></i></a>
												</div>
											<?php } ?>
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
															<div class="form-group mb10">
                        									<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1">Status Pesanan</label>
                       											 <div class="col-md-6">
																<select name="status_pesanan" class="col-md-6 form-control">
																<option value="">-----Status Pesanan-----</option>
																<option value='Pesan'>Pesan</option>
																	<option value='Sedang Diproses'>Sedang Diproses</option>
																	<option value='Selesai'>Selesai</option>
																	<option value='Dibatalkan'>Dibatalkan</option>
																</select>
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
				</div>
			</div>
		</div><!-- /.col -->
	
		</div>
		</div><!-- /.row -->
</div><!-- /.page-content -->
</div>
</div><!-- /.main-content -->

<script src="../assets/js/jquery-2.1.4.min.js"></script>
<script type="text/javascript">
	if ('ontouchstart' in document.documentElement) document.write("<script src='../assets/js/jquery.mobile.custom.min.js'>" + "<" + "/script>");
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


<script src="../assets/js/jquery-ui.custom.min.js"></script>
<script src="../assets/js/jquery.ui.touch-punch.min.js"></script>
<script src="../assets/js/chosen.jquery.min.js"></script>
<script src="../assets/js/spinbox.min.js"></script>
<script src="../assets/js/bootstrap-datepicker.min.js"></script>
<script src="../assets/js/bootstrap-timepicker.min.js"></script>
<script src="../assets/js/moment.min.js"></script>
<script src="../assets/js/daterangepicker.min.js"></script>
<script src="../assets/js/bootstrap-datetimepicker.min.js"></script>
<script src="../assets/js/bootstrap-colorpicker.min.js"></script>
<script src="../assets/js/jquery.knob.min.js"></script>
<script src="../assets/js/autosize.min.js"></script>
<script src="../assets/js/jquery.inputlimiter.min.js"></script>
<script src="../assets/js/jquery.maskedinput.min.js"></script>
<script src="../assets/js/bootstrap-tag.min.js"></script>

<!-- ace scripts -->
<script src="../assets/js/ace-elements.min.js"></script>
<script src="../assets/js/ace.min.js"></script>


</body>

</html>