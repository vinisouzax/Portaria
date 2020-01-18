<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$this->mytcpdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);






// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
	$this->mytcpdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$this->mytcpdf->SetFont('dejavusans', '', 10);

// add a page
$this->mytcpdf->AddPage();

// writeHTML($html, $ln=true, $fill=false, $reseth=false, $cell=false, $align='')
// writeHTMLCell($w, $h, $x, $y, $html='', $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true)

// create some HTML content
$html = '<html><head></head><body><img src="'. base_url('assets/imagens/logoGoverno.png') . '"  width="710" height="220"><br><p align="center"><strong>PORTARIA Nº XXX, DE XX DE X DE XXXX</strong></p><br><br><div>'.$texto .'</div></body></html>';

// output the HTML content
$this->mytcpdf->writeHTML($html, true, false, true, false, '');

$this->mytcpdf->Output($numero,'D');


?>
