<?php include 'header.php';?>
<?php
	$companyname=array();
	/*save like company*/
	$user_id=$user;
	for($i=0;$i<count($_GET[like]);++$i)
	{
		$like=$_GET[like][$i];
		$sql="INSERT INTO user_like (USER_ID, KIND,LIKER)
		VALUES
		('$user_id','1','$like')";
		if (!mysqli_query($con,$sql))
			die('Error: ' . mysqli_error($con));
		$sql="SELECT NAME FROM company WHERE ID= '$like'";
		$result=mysqli_query($con,$sql);
		$row= mysqli_fetch_array($result);
		$companyname[$like]=$row['NAME'];

	}
	/*save feed_user*/
	for($i=0;$i<count($_GET[like]);++$i)
	{
		$like=$_GET[like][$i];
		$title="訂閱了".$companyname[$like];
		$content=$like;
		$sql="INSERT INTO feed_user(USER_ID,TITLE,CONTENT,KIND,DATETIME)
		VALUES
		('$user_id','$title','$content','1','$date')";
		if (!mysqli_query($con,$sql))
			die('Error: ' . mysqli_error($con));
	}
	/*save like style*/
	for($i=0;$i<count($_GET[style]);++$i)
	{
		$likestyle=$_GET[likestyle][$i];
		$style=$_GET[style][$i];
		if($likestyle==1)
		{
			$sql="INSERT INTO user_like (USER_ID, KIND,LIKER)
			VALUES
			('$user_id','2','$style')";
				if (!mysqli_query($con,$sql))
					die('Error: ' . mysqli_error($con));
		}
	}
	/*save friend*/
	for($i=0;$i<count($_GET[friend]);++$i)
	{
		$follow=$_GET[follow][$i];
		$friend=$_GET[friend][$i];
		if($follow==1)
		{
			$sql="INSERT INTO user_friend (USER_ID, FRIEND_ID)
			VALUES
			('$user_id','$friend')";
			if (!mysqli_query($con,$sql))
				die('Error: ' . mysqli_error($con));
		}
	}
	/*save id*/
	$sql="SELECT USER_ID FROM user WHERE USER_ID='user_id'";
	$result=mysqli_query($con,$sql);
	$rows = mysqli_fetch_array($result);
	if($rows==0)
	{
		$sql="INSERT INTO user (USER_ID)
		VALUES
		('$user_id')";	
		if (!mysqli_query($con,$sql))
			die('Error: ' . mysqli_error($con));
	}

	mysqli_close($con);
	header( 'Location: .' );
?>