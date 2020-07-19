<?php

include "../k.php";

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

if(isset($_POST['ganti'])){
	$id_penjualan  	= filterNumber($_POST['id_penjualan']);
	$id_pembayaran  = filterNumber($_POST['id_pembayaran']);
	$tgl_bayar     	= convertValidDate($_POST['tgl_bayar'], 'Y-m-d', 'Y-m-d');
	$nominal   		= filterNumber($_POST['nominal']);
	
	$check = uploadImage('bukti');
	
	$sisa 	= $datap['total_harga'] - $datap['bayar'] - $nominal;
	$status	= ($sisa > 0)? 'BELUM LUNAS' : 'LUNAS';
	
	if($check['status']){
		$query3 =  "UPDATE transaksi_pembayaran set status = CASE WHEN (SELECT ({$datap['total_harga']} - IFNULL(SUM(nominal),0) - {$nominal}) FROM transaksi_pembayaran WHERE id_penjualan = {$id_penjualan} AND id_pembayaran NOT IN ({$id_pembayaran})) > 0 THEN 'BELUM LUNAS' ELSE 'LUNAS' END, 
													nominal = {$nominal}, 
													tgl_bayar = '{$tgl_bayar}', 
													bukti_tf = '{$check['file']}' 
					WHERE id_pembayaran = {$id_pembayaran}";
	}else{
		$query3 =  "UPDATE transaksi_pembayaran set status = CASE WHEN (SELECT ({$datap['total_harga']} - IFNULL(SUM(nominal),0) - {$nominal}) FROM transaksi_pembayaran WHERE id_penjualan = {$id_penjualan} AND id_pembayaran NOT IN ({$id_pembayaran})) > 0 THEN 'BELUM LUNAS' ELSE 'LUNAS' END, 
													nominal = {$nominal}, 
													tgl_bayar = '{$tgl_bayar}'
					WHERE id_pembayaran = {$id_pembayaran}";
	}
		
	if (mysqli_query($connect, $query3)){
	?>
		<script type="text/javascript">
			alert("Sukses Memperbaharui Data Pesanan");
		</script>
		<?php
		echo"<script>window.history.back();</script>";
	}
	else{ 
	?>
		<script type="text/javascript">
			alert("GAGAL");
		</script>
		<?php
		echo"<script>window.history.back();</script>";
	}		
}

if(isset($_POST['delete'])){
	$id_pembayaran  = filterNumber($_POST['id_pembayaran']);
	
	$query3 = "DELETE FROM transaksi_pembayaran WHERE id_pembayaran = '$id_pembayaran'"; 

	if (mysqli_query($connect, $query3)){
	?>
		<script type="text/javascript">
			alert("Sukses Menghapus Data Pesanan");
		</script>
		<?php
		echo"<script>window.history.back();</script>";
	}
	else{ 
	?>
		<script type="text/javascript">
			alert("GAGAL");
		</script>
		<?php
		echo"<script>window.history.back();</script>";
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
				<li class="active">Transaksi Pembayaran</li>
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
					<form name="form1" class="form-horizontal" role="form" action="" method="post" enctype="multipart/form-data">
					<div class="col-md-6 col-xs-12">
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
					<div class="col-md-6 col-xs-12">
						
						<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Tanggal Bayar  </label>
							<div class="col-sm-6">
								<input required type="date" value="<?php echo date('Y-m-d')?>" class="form-control" name="tgl_bayar" id="form-field-1-1"   />
							</div>
						</div>					
						<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Nominal </label>
							<div class="col-sm-6">
								<input required type="number" class="form-control" id="form-field-8" name="nominal" placeholder="Harga Produk">
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
								<a href="index.php?data_pesanan" class="btn btn-sm btn-warning">Kembali</a>
							</div>
						</div>
					
					</div>
					</form>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12">
					<div class="table-header">
						Riwayat Transaksi
					</div>
					<div class="table-responsive">
						<table id="dynamic-table" class="table table-striped table-bordered table-hover">
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
											<td><a href="#modal-gambar<?php echo $data['id_pembayaran']; ?>" role="button" class="green" data-toggle="modal"><i class="ace-icon fa fa-eye bigger-130"></i></a></td>
											<td><?php echo $data['status']; ?></td>
											<td><div class=" action-buttons">
													<a href="#modal-edit<?php echo $data['id_pembayaran']; ?>" role="button" class="green" data-toggle="modal"><i class="ace-icon fa fa-pencil bigger-130"></i></a>
													<a class="red" href="#modal-delete<?php echo $data['id_pembayaran']; ?>" role="button" data-toggle="modal"><i class="ace-icon fa fa-trash-o bigger-130"></i></a>
												</div>
											</td> 
										</tr>
										<div class="modal fade" id="modal-gambar<?php echo $data['id_pembayaran']; ?>">
											<div class="modal-dialog" style="width:80%;">
											  <div class="modal-content" id="lihat">
												<img src="<?php echo base_url($data['bukti_tf']); ?>" width="100%" height="700" alt=""/>
											  </div>
											</div>
										</div>
										
										<!-- MODAL EDIT PESANAN -->
										<div id="modal-edit<?php echo $data['id_pembayaran']; ?>" class="modal fade" tabindex="-1">
											<div class="modal-dialog">
												<div class="modal-content">
													<div class="modal-header no-padding">
														<div class="table-header">
															<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
																<span class="white">&times;</span>
															</button>
															Form Edit Data Pesanan "<?php echo setKode($data['id_pembayaran']); ?>"
														</div>
													</div>
													<form class="form-horizontal" role="form" form action="" method="post" enctype="multipart/form-data">
													<div class="modal-body">
														<div class="form-group">
															<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Tanggal Bayar  </label>
															<div class="col-sm-6">
																<input required type="date" value="<?php echo $data['tgl_bayar']?>" class="form-control" name="tgl_bayar" id="form-field-1-1"   />
															</div>
														</div>					
														<div class="form-group">
															<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Nominal </label>
															<div class="col-sm-6">
																<input required type="number" class="form-control" value="<?php echo $data['nominal']?>" id="form-field-8" name="nominal" placeholder="Harga Produk">
															</div>
														</div>
														<div class="form-group">
															<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Bukti Bayar </label>
															<div class="col-sm-6">
																<input type="file" accept="image/*" class="form-control" id="form-field-8" name="bukti" placeholder="Bukti Bayar">
															</div>
														</div>	
													</div>
													<div class="modal-footer center">
														<input type="hidden" name="id_pembayaran" value="<?php echo $data['id_pembayaran']?>">
														<input type="hidden" name="id_penjualan" value="<?php echo $id?>">
														<input type="submit" name="ganti" class="btn btn-success" value="Edit Data Pesanan">
													</div>	
													</form>
												</div><!-- /.modal-content -->
											</div><!-- /.modal-dialog -->
										</div>
										
										<div id="modal-delete<?php echo $data['id_pembayaran']; ?>" class="modal fade" tabindex="-1">
											<div class="modal-dialog" >
												<div class="modal-content">
													<div class="modal-header no-padding red">
														<div class="table-header" style="background-color: #013197;">
															<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
																<span class="white">&times;</span>
															</button>
															Delete Data Pembayran <?php echo setKode($data['id_pembayaran']); ?>"
														</div>
													</div>
													<form class="form-horizontal" role="form" form action="" method="post" enctype="multipart/form-data">
													<div class="modal-body">
														<label class="col-sm-12 control-label " style="color: red;">Apakah Anda yakin akan menghapus data pesanan ?"<?php echo $data['id_pembayaran']; ?>"</label>
														<input type="hidden" name="id_pembayaran" value="<?php echo $data['id_pembayaran']; ?>" />
														<!-- <input type="hidden" name="file" value="<?php echo $data['file']; ?>" />																 -->
														<div class="space-6"></div><div class="space-6"></div><div class="space-6"></div>
													</div>
													 <div class="modal-footer">
														<input name="delete" type="submit" class="btn btn-danger" Value="Yes">
														<button type="button" class="btn btn-primary" data-dismiss="modal">No</button>
													</div>
													</form>
												</div><!-- /.modal-content -->
											</div><!-- /.modal-dialog -->
										</div>

										
										<?php $no++; } ?>			
									</tbody>
								</table>
							</div>
						</div>
					</div>

					

					<!-- PAGE CONTENT ENDS -->
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.page-content -->
	</div>
</div><!-- /.main-content -->

		<script src="../assets/js/jquery-2.1.4.min.js"></script>
		<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='../assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
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

		
		

		<!-- inline scripts related to this page -->
		<script type="text/javascript">
			jQuery(function($) {
				//initiate dataTables plugin
				var myTable = 
				$('#dynamic-table')
				//.wrap("<div class='dataTables_borderWrap' />")   //if you are applying horizontal scrolling (sScrollX)
				.DataTable( {
					bAutoWidth: false,
					"aoColumns": [
					  { "bSortable": false },
					  null, null,null, null, null,
					  { "bSortable": false }
					],
					"aaSorting": [],
					
					
			
			
					select: {
						style: 'multi'
					}
			    } );
			
				
				
				$.fn.dataTable.Buttons.defaults.dom.container.className = 'dt-buttons btn-overlap btn-group btn-overlap';
				
				new $.fn.dataTable.Buttons( myTable, {
					buttons: [
					  {
						"extend": "colvis",
						"text": "<i class='fa fa-search bigger-110 blue'></i> <span class='hidden'>Show/hide columns</span>",
						"className": "btn btn-white btn-primary btn-bold",
						columns: ':not(:first):not(:last)'
					  },
					  {
						"extend": "copy",
						"text": "<i class='fa fa-copy bigger-110 pink'></i> <span class='hidden'>Copy to clipboard</span>",
						"className": "btn btn-white btn-primary btn-bold"
					  },
					  {
						"extend": "csv",
						"text": "<i class='fa fa-database bigger-110 orange'></i> <span class='hidden'>Export to CSV</span>",
						"className": "btn btn-white btn-primary btn-bold"
					  },
					  {
						"extend": "excel",
						"text": "<i class='fa fa-file-excel-o bigger-110 green'></i> <span class='hidden'>Export to Excel</span>",
						"className": "btn btn-white btn-primary btn-bold"
					  },
					  {
						"extend": "pdf",
						"text": "<i class='fa fa-file-pdf-o bigger-110 red'></i> <span class='hidden'>Export to PDF</span>",
						"className": "btn btn-white btn-primary btn-bold"
					  },
					  {
						"extend": "print",
						"text": "<i class='fa fa-print bigger-110 grey'></i> <span class='hidden'>Print</span>",
						"className": "btn btn-white btn-primary btn-bold",
						autoPrint: false,
						message: 'This print was produced using the Print button for DataTables'
					  }		  
					]
				} );
				myTable.buttons().container().appendTo( $('.tableTools-container') );
				
				//style the message box
				var defaultCopyAction = myTable.button(1).action();
				myTable.button(1).action(function (e, dt, button, config) {
					defaultCopyAction(e, dt, button, config);
					$('.dt-button-info').addClass('gritter-item-wrapper gritter-info gritter-center white');
				});
				
				
				var defaultColvisAction = myTable.button(0).action();
				myTable.button(0).action(function (e, dt, button, config) {
					
					defaultColvisAction(e, dt, button, config);
					
					
					if($('.dt-button-collection > .dropdown-menu').length == 0) {
						$('.dt-button-collection')
						.wrapInner('<ul class="dropdown-menu dropdown-light dropdown-caret dropdown-caret" />')
						.find('a').attr('href', '#').wrap("<li />")
					}
					$('.dt-button-collection').appendTo('.tableTools-container .dt-buttons')
				});
			
				////
			
				setTimeout(function() {
					$($('.tableTools-container')).find('a.dt-button').each(function() {
						var div = $(this).find(' > div').first();
						if(div.length == 1) div.tooltip({container: 'body', title: div.parent().text()});
						else $(this).tooltip({container: 'body', title: $(this).text()});
					});
				}, 500);
				
				
				
				
				
				myTable.on( 'select', function ( e, dt, type, index ) {
					if ( type === 'row' ) {
						$( myTable.row( index ).node() ).find('input:checkbox').prop('checked', true);
					}
				} );
				myTable.on( 'deselect', function ( e, dt, type, index ) {
					if ( type === 'row' ) {
						$( myTable.row( index ).node() ).find('input:checkbox').prop('checked', false);
					}
				} );
			
			
			
			
				/////////////////////////////////
				//table checkboxes
				$('th input[type=checkbox], td input[type=checkbox]').prop('checked', false);
				
				//select/deselect all rows according to table header checkbox
				$('#dynamic-table > thead > tr > th input[type=checkbox], #dynamic-table_wrapper input[type=checkbox]').eq(0).on('click', function(){
					var th_checked = this.checked;//checkbox inside "TH" table header
					
					$('#dynamic-table').find('tbody > tr').each(function(){
						var row = this;
						if(th_checked) myTable.row(row).select();
						else  myTable.row(row).deselect();
					});
				});
				
				//select/deselect a row when the checkbox is checked/unchecked
				$('#dynamic-table').on('click', 'td input[type=checkbox]' , function(){
					var row = $(this).closest('tr').get(0);
					if(this.checked) myTable.row(row).deselect();
					else myTable.row(row).select();
				});
			
			
			
				$(document).on('click', '#dynamic-table .dropdown-toggle', function(e) {
					e.stopImmediatePropagation();
					e.stopPropagation();
					e.preventDefault();
				});
				
				
				
				//And for the first simple table, which doesn't have TableTools or dataTables
				//select/deselect all rows according to table header checkbox
				var active_class = 'active';
				$('#simple-table > thead > tr > th input[type=checkbox]').eq(0).on('click', function(){
					var th_checked = this.checked;//checkbox inside "TH" table header
					
					$(this).closest('table').find('tbody > tr').each(function(){
						var row = this;
						if(th_checked) $(row).addClass(active_class).find('input[type=checkbox]').eq(0).prop('checked', true);
						else $(row).removeClass(active_class).find('input[type=checkbox]').eq(0).prop('checked', false);
					});
				});
				
				//select/deselect a row when the checkbox is checked/unchecked
				$('#simple-table').on('click', 'td input[type=checkbox]' , function(){
					var $row = $(this).closest('tr');
					if($row.is('.detail-row ')) return;
					if(this.checked) $row.addClass(active_class);
					else $row.removeClass(active_class);
				});
			
				
			
				/********************************/
				//add tooltip for small view action buttons in dropdown menu
				$('[data-rel="tooltip"]').tooltip({placement: tooltip_placement});
				
				//tooltip placement on right or left
				function tooltip_placement(context, source) {
					var $source = $(source);
					var $parent = $source.closest('table')
					var off1 = $parent.offset();
					var w1 = $parent.width();
			
					var off2 = $source.offset();
					//var w2 = $source.width();
			
					if( parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2) ) return 'right';
					return 'left';
				}
				
				
				
				
				/***************/
				$('.show-details-btn').on('click', function(e) {
					e.preventDefault();
					$(this).closest('tr').next().toggleClass('open');
					$(this).find(ace.vars['.icon']).toggleClass('fa-angle-double-down').toggleClass('fa-angle-double-up');
				});
				/***************/
				
				
				
				
				
				/**
				//add horizontal scrollbars to a simple table
				$('#simple-table').css({'width':'2000px', 'max-width': 'none'}).wrap('<div style="width: 1000px;" />').parent().ace_scroll(
				  {
					horizontal: true,
					styleClass: 'scroll-top scroll-dark scroll-visible',//show the scrollbars on top(default is bottom)
					size: 2000,
					mouseWheelLock: true
				  }
				).css('padding-top', '12px');
				*/
			
			
			})
		</script>
		
		<!-- inline scripts related to this page -->
		<script type="text/javascript">
			jQuery(function($) {
				$('#id-disable-check').on('click', function() {
					var inp = $('#form-input-readonly').get(0);
					if(inp.hasAttribute('disabled')) {
						inp.setAttribute('readonly' , 'true');
						inp.removeAttribute('disabled');
						inp.value="This text field is readonly!";
					}
					else {
						inp.setAttribute('disabled' , 'disabled');
						inp.removeAttribute('readonly');
						inp.value="This text field is disabled!";
					}
				});
			
			
				if(!ace.vars['touch']) {
					$('.chosen-select').chosen({allow_single_deselect:true}); 
					//resize the chosen on window resize
			
					$(window)
					.off('resize.chosen')
					.on('resize.chosen', function() {
						$('.chosen-select').each(function() {
							 var $this = $(this);
							 $this.next().css({'width': $this.parent().width()});
						})
					}).trigger('resize.chosen');
					//resize chosen on sidebar collapse/expand
					$(document).on('settings.ace.chosen', function(e, event_name, event_val) {
						if(event_name != 'sidebar_collapsed') return;
						$('.chosen-select').each(function() {
							 var $this = $(this);
							 $this.next().css({'width': $this.parent().width()});
						})
					});
			
			
					$('#chosen-multiple-style .btn').on('click', function(e){
						var target = $(this).find('input[type=radio]');
						var which = parseInt(target.val());
						if(which == 2) $('#form-field-select-4').addClass('tag-input-style');
						 else $('#form-field-select-4').removeClass('tag-input-style');
					});
				}
			
			
				$('[data-rel=tooltip]').tooltip({container:'body'});
				$('[data-rel=popover]').popover({container:'body'});
			
				autosize($('textarea[class*=autosize]'));
				
				$('textarea.limited').inputlimiter({
					remText: '%n character%s remaining...',
					limitText: 'max allowed : %n.'
				});
			
				$.mask.definitions['~']='[+-]';
				$('.input-mask-date').mask('99/99/9999');
				$('.input-mask-phone').mask('(999) 999-9999');
				$('.input-mask-eyescript').mask('~9.99 ~9.99 999');
				$(".input-mask-product").mask("a*-999-a999",{placeholder:" ",completed:function(){alert("You typed the following: "+this.val());}});
			
			
			
				$( "#input-size-slider" ).css('width','200px').slider({
					value:1,
					range: "min",
					min: 1,
					max: 8,
					step: 1,
					slide: function( event, ui ) {
						var sizing = ['', 'input-sm', 'input-lg', 'input-mini', 'input-small', 'input-medium', 'input-large', 'input-xlarge', 'input-xxlarge'];
						var val = parseInt(ui.value);
						$('#form-field-4').attr('class', sizing[val]).attr('placeholder', '.'+sizing[val]);
					}
				});
			
				$( "#input-span-slider" ).slider({
					value:1,
					range: "min",
					min: 1,
					max: 12,
					step: 1,
					slide: function( event, ui ) {
						var val = parseInt(ui.value);
						$('#form-field-5').attr('class', 'col-xs-'+val).val('.col-xs-'+val);
					}
				});
			
			
				
				//"jQuery UI Slider"
				//range slider tooltip example
				$( "#slider-range" ).css('height','200px').slider({
					orientation: "vertical",
					range: true,
					min: 0,
					max: 100,
					values: [ 17, 67 ],
					slide: function( event, ui ) {
						var val = ui.values[$(ui.handle).index()-1] + "";
			
						if( !ui.handle.firstChild ) {
							$("<div class='tooltip right in' style='display:none;left:16px;top:-6px;'><div class='tooltip-arrow'></div><div class='tooltip-inner'></div></div>")
							.prependTo(ui.handle);
						}
						$(ui.handle.firstChild).show().children().eq(1).text(val);
					}
				}).find('span.ui-slider-handle').on('blur', function(){
					$(this.firstChild).hide();
				});
				
				
				$( "#slider-range-max" ).slider({
					range: "max",
					min: 1,
					max: 10,
					value: 2
				});
				
				$( "#slider-eq > span" ).css({width:'90%', 'float':'left', margin:'15px'}).each(function() {
					// read initial values from markup and remove that
					var value = parseInt( $( this ).text(), 10 );
					$( this ).empty().slider({
						value: value,
						range: "min",
						animate: true
						
					});
				});
				
				$("#slider-eq > span.ui-slider-purple").slider('disable');//disable third item
			
				
				$('#id-input-file-1 , #id-input-file-2').ace_file_input({
					no_file:'No File ...',
					btn_choose:'Choose',
					btn_change:'Change',
					droppable:false,
					onchange:null,
					thumbnail:false //| true | large
					//whitelist:'gif|png|jpg|jpeg'
					//blacklist:'exe|php'
					//onchange:''
					//
				});
				//pre-show a file name, for example a previously selected file
				//$('#id-input-file-1').ace_file_input('show_file_list', ['myfile.txt'])
			
			
				$('#id-input-file-3').ace_file_input({
					style: 'well',
					btn_choose: 'Drop files here or click to choose',
					btn_change: null,
					no_icon: 'ace-icon fa fa-cloud-upload',
					droppable: true,
					thumbnail: 'small'//large | fit
					//,icon_remove:null//set null, to hide remove/reset button
					/**,before_change:function(files, dropped) {
						//Check an example below
						//or examples/file-upload.html
						return true;
					}*/
					/**,before_remove : function() {
						return true;
					}*/
					,
					preview_error : function(filename, error_code) {
						//name of the file that failed
						//error_code values
						//1 = 'FILE_LOAD_FAILED',
						//2 = 'IMAGE_LOAD_FAILED',
						//3 = 'THUMBNAIL_FAILED'
						//alert(error_code);
					}
			
				}).on('change', function(){
					//console.log($(this).data('ace_input_files'));
					//console.log($(this).data('ace_input_method'));
				});
				
				
				//$('#id-input-file-3')
				//.ace_file_input('show_file_list', [
					//{type: 'image', name: 'name of image', path: 'http://path/to/image/for/preview'},
					//{type: 'file', name: 'hello.txt'}
				//]);
			
				
				
			
				//dynamically change allowed formats by changing allowExt && allowMime function
				$('#id-file-format').removeAttr('checked').on('change', function() {
					var whitelist_ext, whitelist_mime;
					var btn_choose
					var no_icon
					if(this.checked) {
						btn_choose = "Drop images here or click to choose";
						no_icon = "ace-icon fa fa-picture-o";
			
						whitelist_ext = ["jpeg", "jpg", "png", "gif" , "bmp"];
						whitelist_mime = ["image/jpg", "image/jpeg", "image/png", "image/gif", "image/bmp"];
					}
					else {
						btn_choose = "Drop files here or click to choose";
						no_icon = "ace-icon fa fa-cloud-upload";
						
						whitelist_ext = null;//all extensions are acceptable
						whitelist_mime = null;//all mimes are acceptable
					}
					var file_input = $('#id-input-file-3');
					file_input
					.ace_file_input('update_settings',
					{
						'btn_choose': btn_choose,
						'no_icon': no_icon,
						'allowExt': whitelist_ext,
						'allowMime': whitelist_mime
					})
					file_input.ace_file_input('reset_input');
					
					file_input
					.off('file.error.ace')
					.on('file.error.ace', function(e, info) {
						//console.log(info.file_count);//number of selected files
						//console.log(info.invalid_count);//number of invalid files
						//console.log(info.error_list);//a list of errors in the following format
						
						//info.error_count['ext']
						//info.error_count['mime']
						//info.error_count['size']
						
						//info.error_list['ext']  = [list of file names with invalid extension]
						//info.error_list['mime'] = [list of file names with invalid mimetype]
						//info.error_list['size'] = [list of file names with invalid size]
						
						
						/**
						if( !info.dropped ) {
							//perhapse reset file field if files have been selected, and there are invalid files among them
							//when files are dropped, only valid files will be added to our file array
							e.preventDefault();//it will rest input
						}
						*/
						
						
						//if files have been selected (not dropped), you can choose to reset input
						//because browser keeps all selected files anyway and this cannot be changed
						//we can only reset file field to become empty again
						//on any case you still should check files with your server side script
						//because any arbitrary file can be uploaded by user and it's not safe to rely on browser-side measures
					});
					
					
					/**
					file_input
					.off('file.preview.ace')
					.on('file.preview.ace', function(e, info) {
						console.log(info.file.width);
						console.log(info.file.height);
						e.preventDefault();//to prevent preview
					});
					*/
				
				});
			
				$('#spinner1').ace_spinner({value:0,min:0,max:200,step:10, btn_up_class:'btn-info' , btn_down_class:'btn-info'})
				.closest('.ace-spinner')
				.on('changed.fu.spinbox', function(){
					//console.log($('#spinner1').val())
				}); 
				$('#spinner2').ace_spinner({value:0,min:0,max:10000,step:100, touch_spinner: true, icon_up:'ace-icon fa fa-caret-up bigger-110', icon_down:'ace-icon fa fa-caret-down bigger-110'});
				$('#spinner3').ace_spinner({value:0,min:-100,max:100,step:10, on_sides: true, icon_up:'ace-icon fa fa-plus bigger-110', icon_down:'ace-icon fa fa-minus bigger-110', btn_up_class:'btn-success' , btn_down_class:'btn-danger'});
				$('#spinner4').ace_spinner({value:0,min:-100,max:100,step:10, on_sides: true, icon_up:'ace-icon fa fa-plus', icon_down:'ace-icon fa fa-minus', btn_up_class:'btn-purple' , btn_down_class:'btn-purple'});
			
				//$('#spinner1').ace_spinner('disable').ace_spinner('value', 11);
				//or
				//$('#spinner1').closest('.ace-spinner').spinner('disable').spinner('enable').spinner('value', 11);//disable, enable or change value
				//$('#spinner1').closest('.ace-spinner').spinner('value', 0);//reset to 0
			
			
				//datepicker plugin
				//link
				$('.date-picker').datepicker({
					autoclose: true,
					todayHighlight: true
				})
				//show datepicker when clicking on the icon
				.next().on(ace.click_event, function(){
					$(this).prev().focus();
				});
			
				//or change it into a date range picker
				$('.input-daterange').datepicker({autoclose:true});
			
			
				//to translate the daterange picker, please copy the "examples/daterange-fr.js" contents here before initialization
				$('input[name=date-range-picker]').daterangepicker({
					'applyClass' : 'btn-sm btn-success',
					'cancelClass' : 'btn-sm btn-default',
					locale: {
						applyLabel: 'Apply',
						cancelLabel: 'Cancel',
					}
				})
				.prev().on(ace.click_event, function(){
					$(this).next().focus();
				});
			
			
				$('#timepicker1').timepicker({
					minuteStep: 1,
					showSeconds: true,
					showMeridian: false,
					disableFocus: true,
					icons: {
						up: 'fa fa-chevron-up',
						down: 'fa fa-chevron-down'
					}
				}).on('focus', function() {
					$('#timepicker1').timepicker('showWidget');
				}).next().on(ace.click_event, function(){
					$(this).prev().focus();
				});
				
				
			
				
				if(!ace.vars['old_ie']) $('#date-timepicker1').datetimepicker({
				 //format: 'MM/DD/YYYY h:mm:ss A',//use this option to display seconds
				 icons: {
					time: 'fa fa-clock-o',
					date: 'fa fa-calendar',
					up: 'fa fa-chevron-up',
					down: 'fa fa-chevron-down',
					previous: 'fa fa-chevron-left',
					next: 'fa fa-chevron-right',
					today: 'fa fa-arrows ',
					clear: 'fa fa-trash',
					close: 'fa fa-times'
				 }
				}).next().on(ace.click_event, function(){
					$(this).prev().focus();
				});
				
			
				$('#colorpicker1').colorpicker();
				//$('.colorpicker').last().css('z-index', 2000);//if colorpicker is inside a modal, its z-index should be higher than modal'safe
			
				$('#simple-colorpicker-1').ace_colorpicker();
				//$('#simple-colorpicker-1').ace_colorpicker('pick', 2);//select 2nd color
				//$('#simple-colorpicker-1').ace_colorpicker('pick', '#fbe983');//select #fbe983 color
				//var picker = $('#simple-colorpicker-1').data('ace_colorpicker')
				//picker.pick('red', true);//insert the color if it doesn't exist
			
			
				$(".knob").knob();
				
				
				var tag_input = $('#form-field-tags');
				try{
					tag_input.tag(
					  {
						placeholder:tag_input.attr('placeholder'),
						//enable typeahead by specifying the source array
						source: ace.vars['US_STATES'],//defined in ace.js >> ace.enable_search_ahead
						/**
						//or fetch data from database, fetch those that match "query"
						source: function(query, process) {
						  $.ajax({url: 'remote_source.php?q='+encodeURIComponent(query)})
						  .done(function(result_items){
							process(result_items);
						  });
						}
						*/
					  }
					)
			
					//programmatically add/remove a tag
					var $tag_obj = $('#form-field-tags').data('tag');
					$tag_obj.add('Programmatically Added');
					
					var index = $tag_obj.inValues('some tag');
					$tag_obj.remove(index);
				}
				catch(e) {
					//display a textarea for old IE, because it doesn't support this plugin or another one I tried!
					tag_input.after('<textarea id="'+tag_input.attr('id')+'" name="'+tag_input.attr('name')+'" rows="3">'+tag_input.val()+'</textarea>').remove();
					//autosize($('#form-field-tags'));
				}
				
				
				/////////
				$('#modal-form input[type=file]').ace_file_input({
					style:'well',
					btn_choose:'Drop files here or click to choose',
					btn_change:null,
					no_icon:'ace-icon fa fa-cloud-upload',
					droppable:true,
					thumbnail:'large'
				})
				
				//chosen plugin inside a modal will have a zero width because the select element is originally hidden
				//and its width cannot be determined.
				//so we set the width after modal is show
				$('#modal-form').on('shown.bs.modal', function () {
					if(!ace.vars['touch']) {
						$(this).find('.chosen-container').each(function(){
							$(this).find('a:first-child').css('width' , '210px');
							$(this).find('.chosen-drop').css('width' , '210px');
							$(this).find('.chosen-search input').css('width' , '200px');
						});
					}
				})
				/**
				//or you can activate the chosen plugin after modal is shown
				//this way select element becomes visible with dimensions and chosen works as expected
				$('#modal-form').on('shown', function () {
					$(this).find('.modal-chosen').chosen();
				})
				*/
			
				
				
				$(document).one('ajaxloadstart.page', function(e) {
					autosize.destroy('textarea[class*=autosize]')
					
					$('.limiterBox,.autosizejs').remove();
					$('.daterangepicker.dropdown-menu,.colorpicker.dropdown-menu,.bootstrap-datetimepicker-widget.dropdown-menu').remove();
				});
			
			});
		</script>
		
		
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
