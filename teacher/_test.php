<?php

	require_once '../admin/dompdf/autoload.inc.php';
	
	use Dompdf\Dompdf;

  $dompdf = new Dompdf();

  $html = "<h1> hii </h1>";

  $dompdf -> loadHtml($html);

  $dompdf -> setPaper("A4", 'lnandscape');

  $dompdf->render();

  $dompdf->stream("new_file", array("Attachment" => false));

?>

