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
	if($_POST[add]=="true")
	{
		$sql="INSERT INTO follow(user,feed)
		VALUES
		('$user','$_POST[feed_id]')";
		if (!mysqli_query($con,$sql))
			die('Error: ' . mysqli_error($con));
	}
	else
	{
		$sql="DELETE FROM follow
		WHERE user='$user' AND feed='$_POST[feed_id]'";
		if ($con->query($sql) === TRUE) {
		    echo "Record deleted successfully";
		} else {
		    echo "Error deleting record: " . $con->error;
		}
	}
	mysqli_close($con);
?>