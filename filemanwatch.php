<?php
header("Content-type: application/pdf");
readfile("pdf_file/".$_POST['seqNo'].".pdf");

/*?>
header('Location: filemanMainten.php' );
header("Content-type:application/pdf");
readfile("pdf_file/S0011410001001.pdf");*/
?>
