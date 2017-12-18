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
	$token = $facebook->getAccessToken();
	$logoutUrl = 'https://www.facebook.com/logout.php?&access_token='.$token.'&next=' . getnowurl().'login.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html>
<head>
	<title>My Fashion Wall</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="content-type" content="text/html; charset=utf8">
	<link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
	<script src="js/jquery-2.1.0.min.js"></script>
	<script src="js/magic.js"></script>
	<script src="js/fb.js"></script>
	<script src="js/jquery-ui-1.10.4.custom.min.js"></script>
	<link rel=stylesheet type="text/css" href="style.css">
</head>
<?php 

	if(isset($_GET['action']) && $_GET['action'] === 'logout'){
	        $facebook->destroySession();
	    }
	if($user!=0)
	{
		try{
			$fbuser = $facebook->api('/me');
		}
		catch(FacebookApiException $e){
			error_log($e);
			//header( 'Location: login' );
		}
    }
	else
		header( 'Location: login.php' ) ;
		//header( 'Location: login' ) ;
?>
<div id="fb-root"></div>
<body>
	<div id="header">
		<div>
			<a href="<?php echo $logoutUrl?>"><img id="user_pic" class="circle_pic" src="http://graph.facebook.com/<?php echo $user?>/picture?type=large"/></a>
			<a href="<?php echo getnowurl()?>"><div id="logo"><span>F</span>WALL</div></a>
			<div></div>
<!--benefit-->
			<a href="<?php echo getnowurl()?>benefit.php?kind=2"><div class="menu_item" style="cursor:pointer">折扣</div></a>
			<a href="<?php echo getnowurl()?>benefit.php?kind=3"><div class="menu_item" style="cursor:pointer">活動</div></a>
			<a href="<?php echo getnowurl()?>benefit.php?kind=4"><div class="menu_item" style="cursor:pointer">免郵</div></a>
			<a href="<?php echo getnowurl()?>benefit.php?kind=5"><div class="menu_item" style="cursor:pointer">新品</div></a>
			<a href="<?php echo getnowurl()?>activity.php"><div class="activity menu_item">面試季!</div></a>
			<div id="header_right">
				<div id="profile_box"><img width="30"src="img/icon/profile.png"/></div>
				<div id="chart_box"><img width="30"src="img/icon/chart.png"/></div>
				<div id="notify_box"><img width="30"src="img/icon/notify.png"/></div>
				<div id="box">
					<?php 
						$sql="SELECT * FROM follow WHERE user= '$user'";
						$result=mysqli_query($con,$sql);
						if($result)
							while($row = mysqli_fetch_array($result))
							{
								$sql="SELECT * FROM feed_company WHERE ID= '$row[feed]'";
								$result1=mysqli_query($con,$sql);
								$feed_row = mysqli_fetch_array($result1)
								?>
								<a href="newsfeed.php?id=<?php echo $row[feed]?>"><div class="box_row"><img class="box_pic"src="data/feed/<?php echo $row[feed];?>.jpg"/><div class="feed_datetime"><?php echo date("n月j日 H:i", strtotime($feed_row['DATETIME']));?></div><br/><?php echo $feed_row['TITLE'];?><img class="box_pic" style="float:right;margin-top: -18px"src="data/company/<?php echo $feed_row[COMPANY_ID];?>.png"/></div></a>
								<?php
							}
					?>
				</div>
			</div>
		</div>
	</div>
<script>
	var chart_open=false;
	$('#chart_box').click(function(){
		if(!chart_open)
		{
			$('#box').html("");	
			follow=[];
			$.ajax({
                type: "POST",
                url: "getfollow.php",
                success: function(response){
                    follow=$.parseJSON(response);
					for(var i=0;i<follow.length;++i)
					{
						var element="<a href=\"newsfeed.php?id="+follow[i].id+"\"><div class=\"box_row\"><img class=\"box_pic\"src=\"data/feed/"+follow[i].id+".jpg\"\/><div class=\"feed_datetime\">"+follow[i].datetime+"<\/div><br/>"+follow[i].title+"<img class=\"box_pic box_right\"src=\"data/company/"+follow[i].company+".png\"\/><\/div><\/a>";
						$('#box').append(element);
					}
                }
            });
			chart_open=true;
			$('#box').stop().animate({
				"height":"500px"
			});
		}
		else
		{
			chart_open=false;
			$('#box').stop().animate({
				"height":"0px"
			});
		}
	});
</script>