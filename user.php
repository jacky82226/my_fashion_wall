<?php 
	include 'header.php';
	$user_id=$_GET['id'];
	$feed_user=array();
	$sql="SELECT * FROM feed_user WHERE USER_ID= '$user_id'";
	$result=mysqli_query($con,$sql);
	if($result)
		while($row = mysqli_fetch_array($result))
			array_push($feed_user,$row);

	$feed_user_num=0;
	$feed_user_max=count($feed_user);
			
	$companyname=array();
	$likecompany=array();
	$sql="SELECT LIKER FROM user_like WHERE USER_ID= '$user_id' AND KIND =1";
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
	$sql="SELECT * FROM feed_company WHERE COMPANY_ID IN (".implode(',',  $likecompany).") ORDER BY DATETIME";
	$result=mysqli_query($con,$sql);
	$feed=array();
	if($result)
		while($row = mysqli_fetch_array($result))
		{
			if(rand()%4==0&&$feed_user_num<$feed_user_max)
				array_push($feed,$feed_user[$feed_user_num++]);
			array_push($feed, $row);
		}
?>
	<div id="main">
		<?php 
		for($j=0;$j<3;++$j):?>
		<div id="feed_1" class="feed_div each_width">
			<?php 		
				for($i=$j;$i<count($feed);$i+=3):?>
					<div class="feed">
						<?php if(!empty($feed[$i]['COMPANY_ID'])):?>
							<img class="each_width"src="data/feed/<?php echo $feed[$i]['ID']?>.jpg"/>
						<?php else:?>
							<img class="each_width"src="data/company/<?php echo $feed[$i]['CONTENT']?>.png"/>
						<?php endif;?>
						<div class="mask">
						</div>
						<div class="feed_word">
							<?php if(!empty($feed[$i]['COMPANY_ID'])):?>
								<img class="circle_pic" src="data/company/<?php echo $feed[$i]['COMPANY_ID']?>"/>
								<div class="feed_title"><?php echo $companyname[$feed[$i]['COMPANY_ID']]?></div>
							<?php else:?>
								<img class="circle_pic" src="https://graph.facebook.com/<?php echo $feed[$i]['USER_ID']?>/picture?type=large"/>
								<div class="feed_title"><?php echo json_decode(file_get_contents('http://graph.facebook.com/'.$feed[$i]['USER_ID']))->name?></div>
							<?php endif;?>
							<div><?php echo $feed[$i]['DATETIME']?></div>
							<div class="feed_content">
								<?php echo $feed[$i]['TITLE']?>
							</div>
							<a href="newsfeed?id=<?php echo $feed[$i]['ID']?>"><div class="feed_detail">看詳細</div></a>
						</div>
					</div>
			<?php endfor;?>
		</div>
		<?php endfor;?>
	</div>
	<?php mysqli_close($con);?>
</body>
</html>