$(function(){ 
	/*index*/
	uiflow();
	$( window ).resize(function() {
	  uiflow();
	});

	function uiflow(){
		var interval=51;
		var each=($(window).width()-interval*4)/3;
		$( 'div.each_width' ).stop().animate({ "width": each-7 ,"margin-left":interval}, 300 );
		$( 'img.each_width' ).stop().animate({ "width": each-7}, 300 );
		$( '.right_tri' ).stop().animate({ "left": each-7-60}, 300 );
		$( '.right_tri_word').stop().animate({ "left": each-7-40}, 300 );
	}
/*
	window.onscroll = function(){
		    var t = document.documentElement.scrollTop || document.body.scrollTop; 
		    if(t>0)
		    {
		    	$('#header').stop().animate({
		    		paddingTop:"5px",
		    		height:"65px"
		    	},300);
		    }
		    else
			{
				$('#header').stop().animate({
				paddingTop:"15px",
				height:"70px"
				},300);
			}
		}
		*/
	$('.feed').hover(function(){
		$(this).find('.mask,.feed_word').css({
			"display":"block",
			"width":$(this).width(),
			"height":$(this).height()*4/5,
			"padding-top":$(this).height()*1/5,
			"opacity":"0"
		});
		$(this).find('.mask').stop().animate({"opacity":"0.85"},500);
		if($(this).height()/30>12)
			$(this).find('.feed_word').stop().animate({"opacity":"1","font-size":$(this).height()/30},500);
		else
			$(this).find('.feed_word').stop().animate({"opacity":"1","font-size":"12px"},500);
		$(this).find('.feed_word').find(".feed_detail").stop().animate({"height":$(this).height()/19},500);
	},function(){
		$(this).find('.mask,.feed_word').stop().animate({"opacity":0},500,function(){
			$(this).css("display","none");
		});
	});
	$("#chart_box,#notify_box,#profile_box").hover(function(){
		$(this).find('img').stop().effect( "shake", { direction: "up", times: 1, distance: 4}, 200 );
	},function(){
		$(this).find('img').stop();
	});
	
	/*index end*/
	/*u_may_like*/
	$('.toscroll').click(function(){
		$('#content').animate({"top":"-=1020px"});
	});
	$('.toscroll').hover(function(){
		$(this).stop().animate({"margin-top":"-5px","width":"50px"});
	},function(){
		$(this).stop().animate({"margin-top":"0px","width":"40px"});
	});
	$('.notlike').click(function(){
		console.log("delete");
		$(this).parent().parent().parent().find('input').each(function(){
			$(this).remove();
		});
	});
	$('.follow').click(function(){
		if($(this).hasClass("hasfollow"))
		{
			$(this).removeClass("hasfollow").html("追蹤");
			$(this).parent().parent().find('input:first').val("0");
		}
		else
		{
			$(this).addClass("hasfollow").html("✔追蹤中");		
			$(this).parent().parent().find('input:first').val("1");
		}
	});
	$('.css-checkbox').click(function(){
		if($(this).hasClass("hasstyle"))
		{
			$(this).removeClass("hasstyle");
			$(this).parent().find('input').eq(1).val("0");
		}
		else
		{
			$(this).addClass("hasstyle");		
			$(this).parent().find('input').eq(1).val("1");
		}		
	});
	/*u_may_like end*/
	/*header start*/
	$('.addtobox').click(function(){
		var now=$(this).find('.feed_detail');
		if(now.html()=="追蹤")
		{
			$.ajax({
	            type: 'post',
	            url: 'savebox.php',
	            data: {add:true,feed_id:$(this).find('input').val()},
	            success: function () {
	              now.html("追蹤中");
	            }
	          });
		}
		else
		{
			$.ajax({
	            type: 'post',
	            url: 'savebox.php',
	            data: {add:false,feed_id:$(this).find('input').val()},
	            success: function () {
	              now.html("追蹤");
	            }
	          });
		}
	});
	/*header end*/
});
function testsubmit(){
  if($("#input_img").val().lastIndexOf("png")!=$("#input_img").val().length-3&&$("#input_img").val().lastIndexOf("jpg")!=$("#input_img").val().length-3&&$("#input_img").val().lastIndexOf("jpeg")!=$("#input_img").val().length-4)
  {
      alert("Upload file isn't jpg/png/jpeg!");
      document.submit.pic.focus();
      return false; 
  }
  if($('input[name=type]:checked').val()=="activity")
  {
	  if(document.submit.company_a.value=="")
	  {
	    alert("店名不能為空！");
	    document.submit.company_a.focus();
	    return false;
	  }
	  else if(document.submit.title_a.value=="")
	  {
	    alert("標題不能為空！");
	    document.submit.title_a.focus();
	    return false;
	  }
	  else if(document.submit.content_a.value=="")
	  {
	    alert("內容不能為空！");
	    document.submit.content_a.focus();
	    return false;
	  }
	  else if(document.submit.url_a.value=="")
	  {
	    alert("連結不能為空！");
	    document.submit.url_a.focus();
	    return false;
	  }
  }
  else
  {
	  if(document.submit.company_m.value=="")
	  {
	    alert("店名不能為空！");
	    document.submit.company_m.focus();
	    return false;
	  }
	  else if(document.submit.title_m.value=="")
	  {
	    alert("標題不能為空！");
	    document.submit.title_m.focus();
	    return false;
	  }
	  else if(document.submit.content_m.value=="")
	  {
	    alert("內容不能為空！");
	    document.submit.content_m.focus();
	    return false;
	  }
	  else if(document.submit.url_m.value=="")
	  {
	    alert("連結不能為空！");
	    document.submit.url_m.focus();
	    return false;
	  }
  }
  return true;  
}
