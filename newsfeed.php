<?php
	include 'header.php';
	$id=$_GET['id'];
	$sql="SELECT * FROM feed_company WHERE ID= '$id'";
	$result=mysqli_query($con,$sql);
	$feed = mysqli_fetch_array($result);

	$sql="SELECT NAME FROM company WHERE ID= '$feed[COMPANY_ID]'";
	$result=mysqli_query($con,$sql);
	$name=mysqli_fetch_array($result);
?>
	<div id="main">
		<div id="middle" style="padding-top: 10px;">
			<img style="float:left"width="400"src="data/feed/<?php echo $feed['ID']?>.jpg"/>
			<div class="newsfeed_right">
				<img id="newsfeed_circle"class="circle_pic" src="data/company/<?php echo $feed['COMPANY_ID']?>"/>
				<div class="feed_title"><?php echo $name['NAME']?></div>
				<div><?php echo $feed['DATETIME']?></div>
				<div class="feed_content" style="width:400px">
					<?php echo $feed['TITLE']?>
					<br/>
					<?php echo $feed['CONTENT']?>
				</div>
				<a href="<?php echo $feed['url']?>"><div id="redirect">前往店家</div></a>
			</div>
		</div>
	</div>
	<?php mysqli_close($con);?>
</body>
</html>