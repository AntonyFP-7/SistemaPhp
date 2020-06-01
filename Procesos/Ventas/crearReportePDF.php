<?php 
//voy a utilizar la libreria dompdf
//cargamos la libreria dompdf que emos instalado en la carpeta dompdf

require_once "../../Librerias/dompdf/autoload.inc.php";
use Dompdf\Dompdf;
$idventa=$_GET['idventa'];

//introducimos HTML de prueba

function file_get_contents_curl($url){
	$ch=curl_init();

	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_URL, $url);

	$data=curl_exec($ch);
	curl_close($ch);
	return $data;

}

$html=file_get_contents("http://localhost/ventas/Vistas/Ventas/reporteVentaPDF.php?id=".$idventa);

//instanciamos un objeto de la clase DOMPDF
 $pdf= new DOMPDF();

 //DEFINIMOS EL tamaño y la orientacion del papel que queremos
 $pdf->set_paper("letter","portrait");
 //$pdf->set´paper(array(0,0,104,250))

 //cargamos el contenido html
 $pdf->load_html(utf8_decode($html));

 //renderizamos el docuemto pdf
 $pdf->render();

 //enviamos el fichero PDF al navegador
 $pdf->stream('reporteVenta.pdf');



 ?>