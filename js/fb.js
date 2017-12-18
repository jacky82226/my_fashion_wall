
var appGetPermission = false;

window.fbAsyncInit = function() {
  FB.init({
    appId      : '646718488703000', // App ID
    channelUrl : '//jacky82226.no-ip.org/artfest/', // Channel File
    status     : true, // check login status
    cookie     : true, // enable cookies to allow the server to access the session
    xfbml      : true  // parse XFBML
  });

  FB.getLoginStatus(function(response)
  {
      if(response.status=="not_authorized") {
          appGetPermission = false;
      } else if(response.status=="connected") {
          appGetPermission = true;
          $("#step1").html("狀態：已登入");
      }
  });
};

(function(d){
   var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
   if (d.getElementById(id)) {return;}
   js = d.createElement('script'); js.id = id; js.async = true;
   js.src = "//connect.facebook.net/en_US/all.js";
   ref.parentNode.insertBefore(js, ref);
 }(document));

var fbLogin = function()
{
  if(!appGetPermission)
  {
      FB.login(function(response)
        {
        if(response.status=="not_authorized") {
            appGetPermission = false;
        } else if(response.status=="connected") {
            appGetPermission = true;
            $("#step1").html("狀態：已登入");
        }
      },{"scope":"email,publish_actions"})
  }
}

var fbHead = function()
{
  if(appGetPermission)
  {
    FB.api("/me/picture?type=large",function(response) { 
      if(!response || !response.data)
      {
        if(!response || response.error)
        {
          $("#postCallback").html("頭像取得失敗").addClass("alert-error");
          setTimeout( function() {
            $("#postCallback").fadeOut(800,function(){ $(this).removeClass("alert-error"); });
          } , 1900);
        }
      }
      else
      {
        $("#fbUserHead").attr("src",response.data.url).show();
      }

    })
  FB.api('/me', {fields: 'id'}, function(response) {
    console.log(response);
  });

  }
  else
  {
    $("#postCallback").html("請先登入！").addClass("alert-error");
    $("#postCallback").show();
    setTimeout( function() {
      $("#postCallback").fadeOut(800,function(){ $(this).removeClass("alert-error"); });
    } , 1900);
  }

}

var fbPostUI = function()
{
  FB.ui(
    {
      method: 'feed',
      name: 'Facebook UI Post Sample',
      link: 'http://www.csie.ntu.edu.tw/~b00902062/artfest/',
      description: 'Facebook UI Post Sample desc.'
    },
    function(response) {
      if(!response || response.error)
      {
        $("#postCallback").html("發布失敗！").addClass("alert-warn");
      }
      else
      {
        $("#postCallback").html("發布成功！").addClass("alert-success");
        $("#fbPostField").hide();
      }
      $("#postCallback").show();
      setTimeout( function() {
        $("#postCallback").fadeOut(800,function(){ $(this).removeClass("alert-warn alert-success"); });
      } , 1900);
    }
  );
}

var fbPost = function()
{

  var fbMessage = $("#fbPost_text").val();
  FB.api("/me/feed","post",{message: fbMessage} ,function(response) { 
    if(!response || response.error)
    {
      $("#postCallback").html("發布失敗！").addClass("alert-warn");
    }
    else
    {
      $("#postCallback").html("發布成功！").addClass("alert-success");
      $("#fbPostField").hide();
    }
    $("#postCallback").show();
    setTimeout( function() {
      $("#postCallback").fadeOut(800,function(){ $(this).removeClass("alert-warn alert-success"); });
    } , 1900);
  });
  return false;

}

var show_fbPost_field = function()
{
  if(appGetPermission)
  {
    if($("#fbPostField").css("display").toLowerCase()=="block")
    {
      $("#fbPostField").hide();
    }
    else
    {
      $("#fbPostField").show();
      $("body").animate( { scrollTop: $("#fbPostField").offset().top } );
    }
  }
  else
  {
    $("#postCallback").html("請先取得登入！").addClass("alert-error");
    $("#postCallback").show();
    setTimeout( function() {
      $("#postCallback").fadeOut(800,function(){ $(this).removeClass("alert-error"); });
    } , 1900);
  }
}

var removePermission = function()
{
  /*
  if(appGetPermission)
  {
    FB.api("/me/permissions","delete", function(response) { location.reload(); });
  }
  else
  {
    return false;
  }*/
  FB.api("/me/permissions","delete", function(response) { location.reload(); });
}

function test_map(){
  if(document.addmap.MAP_NAME.value=="")
  {
    alert("地圖名稱不能為空!");
    document.addmap.MAP_NAME.focus();
    return false;
  }
  return true;  
}
