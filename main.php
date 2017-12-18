	<div id="main">
		<?php 
			for($j=0;$j<3;++$j):?>
			<div id="feed_<?php echo $j;?>" class="feed_div each_width">
				<?php for($i=$j;$i<count($feed);$i+=3):?>
				<div class="feed">
					<?php if($feed[$i]['ACTIVITY']==1):?>
						<div class="triangle left_tri"></div>
						<div class="triangle_word">面試季</div>
					<?php endif;?>
					<div class="triangle right_tri"></div>
					<?php if(!empty($feed[$i]['COMPANY_ID'])):?>
						<div class="triangle_word right_tri_word"><?php echo getkind($feed[$i]['KIND'])?></div>
					<?php else:?>
						<div class="triangle_word right_tri_word">朋友</div>
					<?php endif;?>
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
							<a style="color:black"href="user?id=<?php echo $feed[$i]['USER_ID']?>"><img class="circle_pic" src="https://graph.facebook.com/<?php echo $feed[$i]['USER_ID']?>/picture?type=large"/>
							<div class="feed_title"><?php echo json_decode(file_get_contents('http://graph.facebook.com/'.$feed[$i]['USER_ID']))->name?></div></a>
						<?php endif;?>
						<div class="feed_datetime"><?php echo date("n月j日 H:i", strtotime($feed[$i]['DATETIME']));?></div>
						<div class="feed_title">
							<?php echo $feed[$i]['TITLE']?>
						</div>
						<a href="newsfeed.php?id=<?php echo $feed[$i]['ID']?>"><div class="feed_detail">看詳細</div></a>
						<div class="addtobox"><div class="feed_detail">追蹤</div><input type="hidden" value="<?php echo $feed[$i]['ID']?>"/></div>
					</div>
				</div>
				<?php endfor;?>
			</div>
		<?php endfor;?>
	</div>
	<?php mysqli_close($con);?>
</body>
</html>