<?php 
	include 'header.php';
	$companyname=array();
	$friendname=array();
	$friend=array();
	$feed_user=array();
	$sql="SELECT FRIEND_ID FROM user_friend WHERE USER_ID= '$user'";
	$result=mysqli_query($con,$sql);
	if($result)
		while($row = mysqli_fetch_array($result))
			array_push($friend,$row['FRIEND_ID']);
	
	$sql="SELECT * FROM feed_user WHERE USER_ID IN (".implode(',', $friend).") ORDER BY DATETIME DESC";
	$result=mysqli_query($con,$sql);
	if($result)
		while($row = mysqli_fetch_array($result))
			array_push($feed_user,$row);

	$feed_user_num=0;
	$feed_user_max=count($feed_user);
			

	$likecompany=array();
	$sql="SELECT LIKER FROM user_like WHERE USER_ID= '$user' AND KIND =1";
	$result=mysqli_query($con,$sql);
	if($result)
		while($row = mysqli_fetch_array($result))
		{
			if(!$companyname[$row['LIKER']])
			{
				$sql="SELECT NAME FROM company WHERE ID= '$row[LIKER]'";
				$result2=mysqli_query($con,$sql);
				$row2 = mysqli_fetch_array($result2);
				$companyname[$row['LIKER']]=$row2['NAME'];
			}
			array_push($likecompany,$row['LIKER']);
		}
	$sql="SELECT * FROM feed_company WHERE COMPANY_ID IN (".implode(',',  $likecompany).") ORDER BY DATETIME DESC";
	$result=mysqli_query($con,$sql);
	$feed=array();
	if($result)
		while($row = mysqli_fetch_array($result))
		{
			if(rand()%2==0&&$feed_user_num<$feed_user_max)
				array_push($feed,$feed_user[$feed_user_num++]);
			array_push($feed, $row);
		}
?>
<?php include 'main.php';?>