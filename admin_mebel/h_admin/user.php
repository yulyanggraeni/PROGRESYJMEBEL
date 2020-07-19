
<?php

include "../k.php";

if(isset($_POST['kirim'])){
		//$id_cust=$_POST['id_cust'];
		$username_cust = $_POST['username'];
		$password = $_POST['password'];
		$password = md5($password);
		$nama = $_POST['nama'];
		$alamat = $_POST['alamat'];
		$telepon = $_POST['telepon'];
		
		$cekUsername = mysqli_query($connect,"SELECT * FROM tb_customer WHERE username_cust LIKE '$username_cust'");
		$rowUsername = mysqli_num_rows($cekUsername);
		
		if($rowUsername > 0){
            echo "<script>alert('Username Sudah Dipakai');document.location.href='index.php?user';</script>";
		}
		else {
			$query3 = "INSERT INTO tb_customer (username_cust, password_cust, nama, alamat, telepon) VALUES ('$username_cust','$password', '$nama', '$alamat', '$telepon')"; 

			if (mysqli_query($connect, $query3)){
			?>
				<script type="text/javascript">
					alert("Sukses insert Master User");
				</script>
				<?php
				echo"<script>document.location='index.php?user'</script>";
			}
			else{ 
			?>
				<script type="text/javascript">
					alert("GAGAL");
				</script>
				<?php
				echo"<script>document.location='index.php?user'</script>";
			}	
		}	
	}

if(isset($_POST['ganti'])){
		$id_cust=$_POST['id_cust'];
		$nama=$_POST['nama'];
		$username = $_POST['username'];
		$alamat=$_POST['alamat'];
		$telepon=$_POST['telepon'];

		$cekUsername = mysqli_query($connect,"SELECT * FROM tb_customer WHERE username_cust LIKE '$username'");
		$rowUsername = mysqli_num_rows($cekUsername);
		
		if($rowUsername > 0){
            echo "<script>alert('Username Sudah Dipakai');document.location.href='index.php?user';</script>";
		}
		else {
			$query3 = "UPDATE tb_customer SET nama='$nama', username_cust='$username', alamat='$alamat', telepon='$telepon' WHERE id_cust='$id_cust'"; 
			if (mysqli_query($connect, $query3)){
			?>
				<script type="text/javascript">
					alert("Sukses Update Master User");
				</script>
				<?php
				echo"<script>document.location='index.php?user'</script>";
			}
			else{ 
			?>
				<script type="text/javascript">
					alert("GAGAL");
				</script>
				<?php
				echo"<script>document.location='index.php?user'</script>";
			}	
		}	
	}

if(isset($_POST['delete'])){
		$id_cust=$_POST['id_cust'];

		$query3 = "DELETE FROM tb_customer WHERE id_cust='$id_cust'"; 

		if (mysqli_query($connect, $query3)){
		?>
			<script type="text/javascript">
				alert("Sukses Delete Master User");
			</script>
			<?php
			echo"<script>document.location='index.php?user'</script>";
        }
        else{ 
		?>
			<script type="text/javascript">
				alert("GAGAL");
			</script>
			<?php
			echo"<script>document.location='index.php?user'</script>";
        }		
	}

?>

			<div class="main-content">
				<div class="main-content-inner">
					<div class="breadcrumbs ace-save-state" id="breadcrumbs">
						<ul class="breadcrumb">
							<li>
								<i class="ace-icon fa fa-home home-icon"></i>
								<a href="#">Home</a>
							</li>
							<li class="active">Master User</li>
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
								Master User YJ Mebel
							</h1>
						</div><!-- /.page-header -->

						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->
								<div class="row">
									<div class="col-xs-12">
									<a href="#modal-insert" role="button" class="btn btn-info" data-toggle="modal">
										<i class="ace-icon fa fa-plus align-middle bigger-120"></i>
										Tambah Master User 
									</a>

									<div id="modal-insert" class="modal fade" tabindex="-1">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header no-padding">
													<div class="table-header">
														<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
															<span class="white">&times;</span>
														</button>
														Form Input Master User
													</div>
												</div>
												<div class="modal-body">
													<form class="form-horizontal" role="form" form action="" method="post" enctype="multipart/form-data">
														<div class="form-group">
															<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Nama </label>
															<div class="col-xs-12 col-sm-6">
																<input type="text" name="nama" class="col-xs-12 col-sm-12" required="" />
															</div>
														</div>
														<div class="form-group">
															<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Username </label>
															<div class="col-xs-12 col-sm-6">
																<input type="text" name="username" class="col-xs-12 col-sm-12" required="" />
															</div>
														</div>
														<div class="form-group">
															<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Password </label>
															<?php
															
															?>
															<div class="col-xs-12 col-sm-6">
																<input type="text" name="password" class="col-xs-12 col-sm-12" required="" />
															</div>
															<br><br><br>
														<div class="form-group">
															<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Alamat </label>
															<div class="col-xs-12 col-sm-6">
																<input type="text" name="alamat" class="col-xs-12 col-sm-12" required="" />
															</div>
														</div>
														</div>
														<div class="form-group">
															<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Telepon </label>
															<div class="col-xs-12 col-sm-6">
																<input type="text" name="telepon" class="col-xs-12 col-sm-12" required="" />
															</div>
														</div>

														<div class="modal-footer center">
															<input type="submit" name="kirim" class="btn btn-success" value="Submit Master User">
														</div>	
													</form>
												</div>
											</div>
										</div>
									</div>
									<br><br>
									</div>
								</div>

								

								<div class="row">
									<div class="col-xs-12">

										<div class="table-header">
											
										</div>
										<div style="overflow: auto;">
											<table id="dynamic-table" class="table table-striped table-bordered table-hover">
												<thead>
													<tr>
														<th style="text-align: center;">No.</th>
														<th style="text-align: center;">Nama</th>
														<th style="text-align: center;">Username</th>
														<th style="text-align: center;">Alamat</th>
														<th style="text-align: center;">Telepon</th>
														<th style="text-align: center;"><i class="ace-icon fa fa-gear bigger-110 hidden-480"></i> Action</th>
													</tr>
												</thead>

												<tbody>
													<?php
													$querym = "SELECT * FROM tb_customer";
													$sqlm = mysqli_query($connect, $querym);
													$no = 1;
													while ($datam = mysqli_fetch_array($sqlm)) { ?>
														<tr>
															<td>
																<?php echo $no++; ?>
															</td>
															<td><?php echo $datam['nama']; ?></td>
															<td><?php echo $datam['username_cust']; ?></td>
															<td><?php echo $datam['alamat']; ?></td>
															<td><?php echo $datam['telepon']; ?></td>

															<td style="text-align: center;">
																<div class="hidden-sm hidden-xs action-buttons">
																	<a href="#modal-edit<?php echo $datam['id_cust']; ?>" role="button" class="green" data-toggle="modal">
																		<i class="ace-icon fa fa-pencil bigger-130"></i>
																	</a>

																	<a class="red" href="#modal-delete<?php echo $datam['id_cust']; ?>" role="button" data-toggle="modal">
																		<i class="ace-icon fa fa-trash-o bigger-130"></i>
																	</a>
																</div>

																<div class="hidden-md hidden-lg">
																	<div class="inline pos-rel">
																		<button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown" data-position="auto">
																			<i class="ace-icon fa fa-caret-down icon-only bigger-120"></i>
																		</button>

																		<ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
																			<li>
																				<a href="#modal-edit<?php echo $datam['id_cust']; ?>" role="button" class="" data-toggle="modal" title="Edit">
																					<span class="green">
																						<i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
																					</span>
																				</a>
																			</li>

																			<li>
																				<a href="#modal-delete<?php echo $datam['id_cust']; ?>" role="button" class="" data-toggle="modal" title="Delete">
																					<span class="red">
																						<i class="ace-icon fa fa-trash-o bigger-120"></i>
																					</span>
																				</a>
																			</li>
																		</ul>
																	</div>
																</div>
															</td>

												<!-- MODAL EDIT MASTER USER -->
												<div id="modal-edit<?php echo $datam['id_cust']; ?>" class="modal fade" tabindex="-1">
													<div class="modal-dialog">
														<div class="modal-content">
															<div class="modal-header no-padding">
																<div class="table-header">
																	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
																		<span class="white">&times;</span>
																	</button>
																	Form Edit Master User " <?php echo $datam['nama'] . " - " . $datam['username_cust']; ?> "
																</div>
															</div>
															<form class="form-horizontal" role="form" form action="" method="post" enctype="multipart/form-data">
															<div class="modal-body">
																	<input type="hidden" name="id_cust" value=<?= $datam["id_cust"] ?>>
																	<div class="form-group">
																		<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Nama </label>
																		<div class="col-xs-12 col-sm-9">
																			<input type="text" name="nama" class="col-xs-12 col-sm-12" value="<?php echo $datam['nama']; ?>" required="" />
																		</div>
																	</div>
																	<div class="space-6"></div><div class="space-6"></div><div class="space-6"></div><div class="space-6"></div>
																	<div class="form-group">
																		<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Username </label>
																		<div class="col-xs-12 col-sm-9">
																			<input type="text" name="username" class="col-xs-12 col-sm-12" value="<?php echo $datam['username_cust']; ?>" required="" />
																		</div>
																	</div>
																	<div class="space-6"></div><div class="space-6"></div><div class="space-6"></div><div class="space-6"></div>
																	<div class="form-group">
																		<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Alamat </label>
																		<div class="col-xs-12 col-sm-9">
																			<input type="text" name="alamat" class="col-xs-12 col-sm-12" value="<?php echo $datam['alamat']; ?>" required="" />
																		</div>
																	</div>
																	<div class="space-6"></div><div class="space-6"></div><div class="space-6"></div><div class="space-6"></div>
																	<div class="form-group">
																		<label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Telepon </label>
																		<div class="col-xs-12 col-sm-9">
																			<input type="text" name="telepon" class="col-xs-12 col-sm-12" value="<?php echo $datam['telepon']; ?>" required="" />
																		</div>
																	</div>
																	<div class="space-6"></div><div class="space-6"></div><div class="space-6"></div><div class="space-6"></div>

															</div>
															<div class="modal-footer center">
																<input type="submit" name="ganti" class="btn btn-success" value="Edit Master User">
															</div>	
															</form>
														</div><!-- /.modal-content -->
													</div><!-- /.modal-dialog -->
												</div>

												<!-- delete modal -->
												<div id="modal-delete<?php echo $datam['id_cust']; ?>" class="modal fade" tabindex="-1">
													<div class="modal-dialog" >
														<div class="modal-content">
															<div class="modal-header no-padding red">
																<div class="table-header" style="background-color: red;">
																	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
																		<span class="white">&times;</span>
																	</button>
																	Delete Data Master Proyek "<?php echo $datam['nama'] . " " . $datam['username_cust']; ?>"
																</div>
															</div>
															<form class="form-horizontal" role="form" form action="" method="post" enctype="multipart/form-data">
															<div class="modal-body">
																<label class="col-sm-12 control-label " style="color: red;">Apakah Anda yakin akan menghapus data master proyek "<?php echo $datam['nama']; ?> - <?php echo $datam['username_cust']; ?>"</label>
																<input type="hidden" name="id_cust" value="<?php echo $datam['id_cust']; ?>" />	
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
														</tr>
													<?php }
													?>
														
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
					  { "bSortable": false },
					  null, null,null, 
					  { "bSortable": false }
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
