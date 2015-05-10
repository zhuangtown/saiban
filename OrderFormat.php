<?php
function addpriceformat($addtime,$time,$substracttime,$unitprice){
	$addprice=NULL;
	if($addtime!=""&&$time!=""&&$substracttime!=""&&$unitprice!=""){
	if($time>$addtimedd){
		$addprice=($time-$addtime)*($unitprice/$addtime);
		
	}
	elseif($time<$substracttime){
		$addprice=($time-$substracttime)*($unitprice/$substracttime);
	}
	elseif($substracttime<$time && $time<$addtimedd){
		$addprice=null;
	}
	return $addprice;
}
}

function priceformat($number,$unitprice,$stepContents){
	$price="";
	if($number!=""&&$unitprice!=""&&$stepContents!=""){
	
	$price=number_format($number*$unitprice);
	return $price;
	}
	
}

?>

