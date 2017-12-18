<?php include 'header.php';?>
<?php
	if($_POST[type]=="activity")
	{
		$sql="SELECT * FROM company WHERE NAME= '$_POST[company_a]'";
		$result=mysqli_query($con,$sql);
		$row= mysqli_fetch_array($result);
		if(empty($row['NAME']))
		{
			$sql="INSERT INTO company(NAME)
			VALUES
			('$_POST[company_a]')";
			if (!mysqli_query($con,$sql))
				die('Error: ' . mysqli_error($con));
			$sql="SELECT * FROM company WHERE NAME= '$_POST[company_a]'";
			$result=mysqli_query($con,$sql);
			$row= mysqli_fetch_array($result);
		}
		$content=nl2br($_POST[content_a]);
		preg_replace('/<br\\s*?\/??>/i','',$text);
		$sql="INSERT INTO feed_company(COMPANY_ID, TITLE, CONTENT,url,ACTIVITY,KIND,DATETIME)
		VALUES
		('$row[ID]','$_POST[title_a]','$content','$_POST[url_a]','$_POST[isright_a]','$_POST[kind_m]',NOW())";
		if (!mysqli_query($con,$sql))
			die('Error: ' . mysqli_error($con));

	}
	else
	{
		$sql="SELECT * FROM company WHERE NAME= '$_POST[company_m]'";
		$result=mysqli_query($con,$sql);
		$row= mysqli_fetch_array($result);
		if(empty($row['NAME']))
		{
			$sql="INSERT INTO company(NAME)
			VALUES
			('$_POST[company_a]')";
			if (!mysqli_query($con,$sql))
				die('Error: ' . mysqli_error($con));
			$sql="SELECT * FROM company WHERE NAME= '$_POST[company_m]'";
			$result=mysqli_query($con,$sql);
			$row= mysqli_fetch_array($result);
		}
		$content=nl2br($_POST[content_m]);
		$sql="INSERT INTO feed_company(COMPANY_ID, TITLE, CONTENT,url,ACTIVITY,KIND,style,DATETIME)
		VALUES
		('$row[ID]','$_POST[title_m]','$content','$_POST[url_m]','$_POST[isright_m]',1,'$_POST[style_m]',NOW())";
		if (!mysqli_query($con,$sql))
			die('Error: ' . mysqli_error($con));
	}
	copy($_FILES['pic']['tmp_name'], "data/feed/".mysqli_insert_id($con).".jpg"); 
	mysqli_close($con);
	//header( 'Location: submit' );
	header( 'Location: submit.php' );
?>