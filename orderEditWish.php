<?php 
echo $_POST["saibanRes"];
include("./Includes/Components/orderToPdf.php");
orderToPdf();
?>