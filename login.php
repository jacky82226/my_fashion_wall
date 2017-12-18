<?php 
	require 'facebook-php-sdk/src/facebook.php';
	$facebook = new Facebook(array(
	  'appId'  => '646718488703000',
	  'secret' => 'f1b33c883b6675856be61de8cd00499b',
	  'cookie' => true,
	));
	$user = $facebook->getUser();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="content-type" content="text/html; charset=utf8">
	<script src="js/jquery-2.1.0.min.js"></script>
	<script src="js/magic.js"></script>
	<script src="js/fb.js"></script>
	<link rel=stylesheet type="text/css" href="style.css">
</head>
<?php 

	if($user!=0)
	{
		include 'db.php';
		$sql="SELECT * FROM user WHERE USER_ID='$user'";
		$result = mysqli_query($con,$sql);
		$row=mysqli_fetch_array($result);
		?>
		<?php
		if(!mysqli_fetch_array($result))
		{
			mysqli_close($con);
			//header( 'Location: u_may_like' );
			header( 'Location: u_may_like.php' );
			exit(0);
		}
		if($con)
	    	mysqli_close($con);
		try{
		  header( 'Location: .' );
		}
		catch (FacebookApiException $e) {
		    error_log($e);
		  }
	}
?>

<body>
	<div id="fb-root"></div>
	<div id="header">
		<div>
			<div id="logo"><span>F</span>WALL</div>
		</div>
	</div>
	<div id="middle">
		<div>立即連結Facebook找到屬於你的時尚塗鴉牆</div>
		<a href="<?php echo $facebook->getLoginUrl(array('next' => "http://www.yourdomain.com/facebooklogin_success", 'req_perms' => 'email,read_stream,publish_stream,offline_access'))?>"><img id="fb_login"width="300"src="img/fb_login.png"/></a>
	</div>
</body>
</html>