<?php
include "../k.php";
?>

<div class="main-content">
	<div class="main-content-inner">
		<div class="breadcrumbs ace-save-state" id="breadcrumbs">
			<ul class="breadcrumb">
				<li>
					<i class="ace-icon fa fa-home home-icon"></i>
					<a href="#">Home</a>
				</li>
				<li class="active">Laporan Penjualan YJ Mebel</li>
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
			<div class="row">
				<div class="col-xs-12">
					<div class="clearfix">
						<div class="pull-right tableTools-container"></div>
					</div>
					<div class="table-header">
						Tabel Data Laporan YJ Mebel Malang
					</div>
					<br>
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
					<div class="table-responsive">
						<table id="dynamic-table" class="table table-striped table-bordered table-hover">
							<thead>
								<tr>
									<th style="text-align: center;">No</th>
									<th style="text-align: center;">Tanggal Penjualan</th>
									<th style="text-align: center;">Nama Pembeli</th>
									<th style="text-align: center;">Total Harga</th>
									<th style="text-align: center;">Sudah Bayar</th>
									<th style="text-align: center;">Hutang</th>
									<th style="text-align: center;">Aksi</th>
								</tr>
							</thead>
							<tbody>
							<?php
								$querym = "SELECT 	j.id_penjualan, DATE_FORMAT(j.tgl_jual, '%d %M %Y') as tanggal, j.tgl_jual, c.telepon ,c.nama, j.total_harga, 
													(j.total_harga - SUM(b.nominal)) as hutang, d.nama_barang, SUM(b.nominal) as modal 
										   FROM 	transaksi_penjualan as j, transaksi_pembayaran as b, tb_customer as c, produk as d 
										   WHERE	j.id_cust = c.id_cust AND j.id_penjualan = b.id_penjualan AND d.id_barang = j.id_barang GROUP BY j.id_penjualan
										   ORDER BY j.tgl_jual ASC";

								$sqlm = mysqli_query($connect, $querym);

								if(isset($_POST['tanggal'])){
									$tgl1 = $_POST['tanggal1'];
									$tgl2 = $_POST['tanggal2'];
									$sqlm = mysqli_query($connect, "select j.id_penjualan, DATE_FORMAT(j.tgl_jual, '%d %M %Y') as tanggal, j.tgl_jual, c.telepon ,c.nama, j.total_harga, 
									(j.total_harga - SUM(b.nominal)) as hutang, d.nama_barang, SUM(b.nominal) as modal 
									FROM 	transaksi_penjualan as j, transaksi_pembayaran as b, tb_customer as c, produk as d 
									WHERE	j.id_cust = c.id_cust AND j.id_penjualan = b.id_penjualan AND d.id_barang = j.id_barang AND j.tgl_jual BETWEEN '$tgl1' AND '$tgl2' GROUP BY j.id_penjualan
									ORDER BY j.tgl_jual ASC");
								} else {
									$sqlm = mysqli_query($connect, "select	j.id_penjualan, DATE_FORMAT(j.tgl_jual, '%d %M %Y') as tanggal, j.tgl_jual, c.telepon ,c.nama, j.total_harga, 
									(j.total_harga - SUM(b.nominal)) as hutang, d.nama_barang, SUM(b.nominal) as modal 
									FROM 	transaksi_penjualan as j, transaksi_pembayaran as b, tb_customer as c, produk as d 
									WHERE	j.id_cust = c.id_cust AND j.id_penjualan = b.id_penjualan AND d.id_barang = j.id_barang GROUP BY j.id_penjualan
									ORDER BY j.tgl_jual ASC");
								}
								$no = 0;
								while ($datam = mysqli_fetch_array($sqlm)) { $no++;?>
									<tr>
										<td><?php echo $no; ?></td>
										<td><?php echo $datam['tanggal']; ?></td>
										<td><?php echo $datam['nama']; ?></td>
										<td><?php echo number_format($datam['total_harga'], 0, ',', '.'); ?></td>
										<td><?php echo number_format($datam['modal'], 0, ',', '.'); ?></td>
										<td><?php echo ($datam['hutang'] <= 0)? 0 : number_format($datam['hutang'], 0, ',', '.'); ?></td>
										<td><?php if($datam['id_penjualan']!=null){ ?>
											<?php } ?>
										<div class=" action-buttons">
											<a target="_blank" href="https://wa.me/<?php echo $datam['telepon']?>?text=<?php echo rawurlencode("Yth. ".$datam['nama'].", \n\nKami adalah YJ Mebel dan menginfokan bahwa bapak/ibu ".$datam['nama']." telah melakukan transaksi pembelian *".$datam['nama_barang']."* dengan kode *".setKode($datam['id_penjualan'])."* senilai *Rp. ".number_format($datam['total_harga'], 0, ',', '.')."*. \n Bapak/Ibu baru membayar transaksi sebesar *Rp. ".number_format($datam['modal'], 0, ',', '.')."* dan harap melunasi tagihan sebesar *Rp. ".number_format($datam['hutang'], 0, ',', '.')."*.  \n\nTerima kasih atas perhatiannya. \n\nSalam Admin YJ Mebel.")?>" role="button" class="green" data-toggle="modal"><i class="ace-icon fa fa-whatsapp bigger-130"></i></a>
										</div>
										</td>
									</tr>
									<div id="modal-delete<?php echo $datam['id_penjualan']; ?>" class="modal fade" tabindex="-1">
									<div class="modal-dialog" >
										<div class="modal-content">
											<div class="modal-header no-padding red">
												<div class="table-header" style="background-color: red;">
													<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
														<span class="white">&times;</span>
													</button>
													Delete Kategori "<?php echo $datam['id_penjualan']; ?>"
												</div>
											</div>
											<form class="form-horizontal" role="form" form action="" method="post" enctype="multipart/form-data">
											<div class="modal-body">
												<label class="col-sm-12 control-label " style="color: red;">Apakah Anda yakin akan menghapus kategori ini? "<?php echo $datam['id_penjualan']; ?>"</label>
												<input type="hidden" name="id_penjualan" value=<?= $datam["id_penjualan"] ?>>
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


								<!-- MODAL EDIT DATA LAPORAN -->
								<div id="modal-edit<?php echo $datam['id_penjualan']; ?>" class="modal fade" tabindex="-1">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header no-padding">
												<div class="table-header">
													<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
														<span class="white">&times;</span>
													</button>
													Form Edit Laporan "<?php echo $datam['id_penjualan']; ?>"
												</div>
											</div>
											<form class="form-horizontal" role="form" form action="" method="post" enctype="multipart/form-data">
											<div class="modal-body">
													<input type="hidden" name="id_penjualan" value="<?php echo $datam['id_penjualan']; ?>" />
													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Keterangan Produk </label>
														<div class="col-xs-12 col-sm-9">
															<input type="hidden" name="id_penjualan" value="<?php echo $datam['id_penjualan']; ?>" />
															<input type="text" name="keterangan" class="col-xs-12 col-sm-12" value="<?php echo $datam['keterangan']; ?>" required="" />
														</div>
													</div>
													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Total Harga </label>
														<div class="col-xs-12 col-sm-9">
															<input type="text" name="total_harga" class="col-xs-12 col-sm-12" value="<?php echo $datam['total_harga']; ?>" required="" />
														</div>
													</div>
													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Modal </label>
														<div class="col-xs-12 col-sm-9">
															<input type="text" name="modal" class="col-xs-12 col-sm-12" value="<?php echo $datam['modal']; ?>" required="" />
														</div>
													</div>
													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Hutang </label>
														<div class="col-xs-12 col-sm-9">
															<input type="text" name="modal" class="col-xs-12 col-sm-12" value="<?php echo $datam['nominal']; ?>" required="" />
														</div>
													</div>
													<div class="space-6"></div><div class="space-6"></div><div class="space-6"></div><div class="space-6"></div>
													
													<div class="space-6"></div><div class="space-6"></div><div class="space-6"></div><div class="space-6"></div>
												</div>
												<br>
												<br>
													
											<div class="modal-footer center">
												<input type="submit" name="ganti" class="btn btn-success" value="Edit Data Laporan">
											</div>	
											</form>
										</div><!-- /.modal-content -->
									</div><!-- /.modal-dialog -->
								</div>
								<?php $no++; }
								?>
									
							</tbody>
							<tfoot>
							<!-- <tr>
							<?php
								$querym = "SELECT YEAR(tgl_jual), SUM(total_harga) from transaksi_penjualan GROUP by YEAR(tgl_jual)";
								$sqlm = mysqli_query($connect, $querym);
								$no = 1;
								while ($datam = mysqli_fetch_array($sqlm)) { ?>
									<tr>
										<td><?php echo $datam['total_harga']; ?></td>
									</tr>
									<?php $no++; }
								?> 
								<th colspan="4">Total</th>
								<th colspan="2">12000000</th>
							</tr> -->
						</tfoot>
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
</div><!-- /.main-content -->
</div><!-- /.main-content -->

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
					  { "bSortable": true },
					  null, null,null, null, null,
					  { "bSortable": true }
					],
					"aaSorting": [],
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
	</body>
</html>
