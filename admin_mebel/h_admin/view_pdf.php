<?php  

include('../k.php');

if ($_POST['id']) {
	
	$id = $_POST['id'];
	$url = $_POST['url'];
	//echo $url . $id;
	
	
	$query = mysqli_query($conn, "SELECT * FROM dokumen WHERE  id_dokumen = '$idd'");

	while ($data = mysqli_fetch_assoc($query)) { ?>
		
			<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title"></h4>
			</div>
			<div class="modal-body" id="">
				<div class="embed-responsive embed-responsive-16by9">
					<iframe src="<?php echo $url . $data['file']; ?>" frameborder="0" allowfullscreen></iframe>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
			</div>


		<?php
		
	}

}

?>