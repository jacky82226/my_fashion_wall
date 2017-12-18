<?php 
date_default_timezone_set('Asia/Taipei');
$date = date('Y-m-d H:i:s', time());
 function getnowurl(){
 	return "http://myfashionwall.com/secretbeta/";
 }
 function getkind($num){
 	switch ($num) {
 		case 1:
 			return "商品";
 			break;
 		case 2:
 			return "折扣";
 			break;
 		case 3:
 			return "活動";
 			break;
  		case 4:
 			return "免郵";
 			break;
   		case 5:
 			return "新品";
 			break;
 	}
 }
function checkboxColor($num)
{
	switch($num%5)
	{
		case 0:
			$class="css-label";
			break;
		case 1:
			$class="css-label-yellow";
			break;
		case 2:
			$class="css-label-red";
			break;
		case 3:
			$class="css-label-blue";
			break;
		case 4:
			$class="css-label-purple";
			break;
	}
	return $class;
}
?>