<?php
//==============================================================
//==============================================================
//==============================================================

include("mpdf/mpdf.php");

$file_name = 'invoice_123.pdf';

//ob_clean();
// header('Content-type: application/pdf');
// header('Content-Disposition: inline; filename="' . $file_name . '"');
// header('Content-Transfer-Encoding: binary');
// header('Accept-Ranges: bytes');


$mpdf=new mPDF('A4'); 


//print_r($mpdf);

$res = file_get_contents('http://hotel.staffstarr.com/invoice.php?order_id=9');

//print_r($res);


$mpdf->WriteHTML($res);
$mpdf->Output('invoice_123.pdf','D');
exit;

//==============================================================
//==============================================================
//==============================================================


?>