<?php
function orderclass($type,$saiban_res){
	
	switch ($type){
		case "I":
			echo "window.open('seikyusoEdit.php?saiban_res=$saiban_res')";
			break;
		case "T":
			echo "window.open('tyumonsyo/TmsOrderEdit.php?saiban_res=$saiban_res')";
			break;
		case "S":
			echo "window.open('mitumori/MMOrderEdit.php?saiban_res=$saiban_res')";
			break;
		default:
			null;
	}
}