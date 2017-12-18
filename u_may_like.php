<?php 
	require 'facebook-php-sdk/src/facebook.php';
	include 'db.php';
	include 'function.php';
	$facebook = new Facebook(array(
	  'appId'  => 'your_appID',
	  'secret' => 'your_scret',
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
		header( 'Location: login' ) ;
?>


<html style="overflow-y:hidden;">
	<div id="header">
		<div>
			<img id="user_pic" class="circle_pic" src="http://graph.facebook.com/<?php echo $user?>/picture"/>
			<div>
				<a href="."><div id="logo"><span>F</span>WALL</div></a>
			</div>
		</div>
	</div>
	<div id="content">
		<div id="middle">
			<form method="get" action="savelike.php">
				<?php 
				include 'db.php';
				$sql="SELECT * FROM company";
				$result = mysqli_query($con,$sql);
				while($row = mysqli_fetch_array($result))
				{
					?>
					<div class="like_div">
						<div class="do_u_like">你喜歡<span><?php echo $row['NAME']?></span>嗎?</div>
						<div id="choice_div">
							<div><img class="toscroll" width="40"src="img/icon/yes.png"/></div>
							<div><img class="notlike toscroll" width="40"src="img/icon/no.png"></div>
						</div>
						<img width="400" src="data/company/<?php echo $row['ID']?>"/>
						<input type="hidden" name="like[]" value="<?php echo $row['ID']?>"/>
					</div>
					<?php
				}
				?>
				<input type="hidden" name="user_id" value="<?php echo $user?>">

				<div class="like_div">
					<div class="choose_title">選擇你喜歡的風格</div>
					<?php
						$sql="SELECT * FROM style";
						$result = mysqli_query($con,$sql);
						$index=0;
						while($row = mysqli_fetch_array($result))
						{
					?>
					<div class="checkbox custom">
						<input id="box<?php echo $row['ID']?>" class="css-checkbox" type="checkbox" />
						<label for="box<?php echo $row['ID']?>" class="<?php echo checkboxColor($index++)?>"></label>
						<?php echo $row['NAME']?>
						<input type="hidden" name="likestyle[]" value="0" />
						<input type="hidden" name="style[]" value='<?php echo $row['ID']?>'/>
					</div>
					<?php }?>
					<br/>
					<br/>
					<br/>
					<div style="clear:both"><img class="toscroll" width="40"src="img/icon/yes.png"/></div>
				</div>


				<?php
				$friends = $facebook->api('/'.$user.'/friends');
				echo '<div class="like_div"">也有使用FWALL的朋友<br/><br/>';
				foreach ($friends["data"] as $value) {
				    $userid=$value["id"];
				    $sql="SELECT * FROM user WHERE USER_ID='$userid'";
				    $result = mysqli_query($con,$sql);
				    $rows = mysqli_fetch_array($result);
				    if($rows!=0)
				    {
				        echo '<div class="friend_line">';
				        echo '<img class="circle_pic"style="float:left"src="https://graph.facebook.com/'.$value["id"].'/picture"/>';
				        echo '<div style="padding-right:15px;">'.$value["name"].'</div>';       
				        echo '<div class="follow" style="margin-top:10px">追蹤</div>';
				        echo '</div>';
				        echo '<input type="hidden" name="follow[]" value="0" />';
				        echo '<input type="hidden" name="friend[]" value='.$value["id"].'/>';
				    }
				}

				echo '<br/><img class="toscroll" width="40"src="img/icon/yes.png"/></div>';?>


				<div class="like_div">
					<?php
			          $fbuser = $facebook->api('/'.$user);
			          echo $fbuser['name']."<br/><br/>";
					?>
					開啟你的時尚塗鴉牆吧
					<input id="like_submit"type="submit" value="→"/>
				</div>
		    </form>
		</div>
	</div>
	<?php mysqli_close($con);?>
</body>
</html>