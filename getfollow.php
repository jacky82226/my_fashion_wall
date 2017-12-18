<?php
	require 'facebook-php-sdk/src/facebook.php';
	$facebook = new Facebook(array(
	'appId'  => '646718488703000',
	'secret' => 'f1b33c883b6675856be61de8cd00499b',
	'cookie' => true,
	));
	$user = $facebook->getUser();
	include 'db.php';
	include 'function.php';


	$sql="SELECT * FROM follow WHERE user= '$user'";
	$result=mysqli_query($con,$sql);
	$follow=array();
	if($result)
		while($row = mysqli_fetch_array($result))
		{
			$sql="SELECT * FROM feed_company WHERE ID= '$row[feed]'";
			$result1=mysqli_query($con,$sql);
			$feed_row = mysqli_fetch_array($result1);
			array_push($follow,array(
					"id"=>$row[feed],
					"datetime"=>date("n月j日 H:i", strtotime($feed_row[DATETIME])),
					"company"=>$feed_row[COMPANY_ID],
					"title"=>$feed_row[TITLE]
				));
		}
	echo json_encode($follow);
	mysqli_close($con);
?>