<?php 
	include 'header.php';
	$sql="SELECT * FROM feed_company WHERE activity = 1 ORDER BY DATETIME DESC";
	$result=mysqli_query($con,$sql);
	$feed=array();
	if($result)
		while($row = mysqli_fetch_array($result))
			array_push($feed, $row);
?>
<?php include 'main.php';?>