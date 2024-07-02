<?php
require_once 'dompdf/autoload.inc.php';

ob_start();

?>

<body>
    <h1>Hola mundo</h1>
</body>

<?php

$html = ob_get_clean();

// require "../../../vendor/autoload.php"; // Asegúrate de que la ruta a autoload.php sea correcta

use Dompdf\Dompdf;

$dompdf = new Dompdf();

$options = $dompdf->getOptions();
$options->set(array('isRemoteEnabled' => true));
$dompdf->setOptions($options);

$dompdf->loadHtml("$html");

$dompdf->setPaper("A4", "landscape");

$dompdf->render();

$dompdf->stream("clientes_pdf", array("Attachment" => false));
?>