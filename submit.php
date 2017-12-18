<?php 
	include 'header.php';
	
	if($user!='100000197606419'&&$user!='638829116'&&$user!='1442891543'&&$user!='1149491289'&&$user!='100000280323888'&&$user!='100000153794853'&&$user!='100000058843806')
		header( 'Location: .' );
	$sql="SELECT * FROM style";
	$result=mysqli_query($con,$sql);
	$style=array();
	if($result)
		while($row = mysqli_fetch_array($result))
			array_push($style,$row);
?>
<script type="text/javascript">
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#upload_img').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
<div id="submit_div">
<form enctype="multipart/form-data" name="submit"action="savesubmit.php" method="post" onsubmit="return testsubmit()">
	<img id="upload_img" /><input id="input_img" name="pic" type="file" onchange="readURL(this);" accept="image/*"><br/>
	<div style="margin-left:400px">動態類型：
	<input type="radio" name="type" value="activity" checked="checked"/>活動
	<input type="radio" name="type" value="merchandise"/>商品</div>
	<div id="submit_block">
		<div id="submit_activity">
			店名：<input name="company_a"type="text"/><br/>
			標題：<input name="title_a"type="text"/><br/>
			內容：<textarea name="content_a"></textarea><br/>
			連結：<input name="url_a"type="text"/><br/>
			是活動嗎: <input name="isright_a" type="checkbox"/><br/>
			<select name="kind_m">
				<option value="2">折扣</option>
				<option value="3">活動</option>
				<option value="4">免郵</option>
			</select><br/>
		</div>
		<div id="submit_merchandise">
			店名：<input name="company_m"type="text"/><br/>
			標題：<input name="title_m"type="text"/><br/>
			內容：<textarea name="content_m"></textarea><br/>
			連結：<input name="url_m"type="text"/><br/>
			<!--顏色：<input name="color_m"type="text"/><br/>
			尺寸：<input name="size_m"type="text"/><br/>
			價格：<input name="price_m"type="text"/><br/>-->
			是活動嗎: <input name="isright_m" type="checkbox"/><br/>
			風格：
			<select name="style_m">
				<?php for($i=0;$i<count($style);++$i):?>
					<option value="<?php echo $style[$i]['ID']?>"><?php echo $style[$i]['NAME']?></option>
				<?php endfor;?>
			</select>
		</div>
		<input id="button"type="submit" value="提交YA" />
	</div>

</form>
</div>
	<?php mysqli_close($con);?>
</body>
</html>
<script>
	$('input[name="type"]:radio').change(function() {
	    if($(this).attr('value')=='activity')
	    {
			$('#submit_merchandise').hide();
	    	$('#submit_activity').fadeIn();
	    }
	    else
	    {
			$('#submit_activity').hide();
	    	$('#submit_merchandise').fadeIn();	    	
	    }
	});
</script>