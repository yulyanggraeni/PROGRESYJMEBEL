<?PHP ob_start(); // buka library laporan

	error_reporting(E_ALL ^ E_NOTICE ^ E_DEPRECATED);
	//include "../conn.php";
	session_start();
	include "../k.php";

if(isset($_GET['id'])){
	$id_proyek = $_GET['id'];
	// $id_proyek = "R19MRPXA";
	
	$queryp = "SELECT * FROM proyek A INNER JOIN user B ON A.pemasar=B.nip WHERE id_proyek='$id_proyek' LIMIT 1";
	$sqlp = mysqli_query($connect, $queryp);
	$data_kapal = mysqli_fetch_assoc($sqlp);

	$querya = "SELECT * FROM `jenis` j LEFT JOIN dokumen d ON j.id_jenis=d.id_jenis AND d.id_proyek='$id_proyek' ORDER BY j.id_jenis ASC"; 
	$sqla = mysqli_query($connect, $querya);
	
	include(dirname(__FILE__).'/form_harkan_arsip.php');
	$content = ob_get_clean();

	// conversion HTML => PDF
	require_once('../html2pdf/html2pdf.class.php');
	try
	{
		$html2pdf = new HTML2PDF('P','A4', 'En', false, 'ISO-8859-15');
		$html2pdf->setTestTdInOnePage(false);
		$html2pdf->setDefaultFont('Arial');	
		$html2pdf->writeHTML($content, isset($_GET['vuehtml']));
	    $html2pdf->Output('Wifi_'.$area.'_Sesi'.$sesi.'.pdf');//output laporan setelah di download
	}
	catch(HTML2PDF_exception $e) { echo $e; }
}

?>
