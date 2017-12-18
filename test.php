<?php
include 'header.php';
$user = $facebook->getUser();
    include 'db.php';
    if ($user) {
        $user_profile = $facebook->api('/me');
        $friends = $facebook->api('/me/friends');
        echo '<div class="like_div">也有使用FWALL的朋友<br/><br/>';
        foreach ($friends["data"] as $value) {
            $userid=$value["id"];
            $sql="SELECT * FROM user WHERE USER_ID='$userid'";
            $result = mysqli_query($con,$sql);
            $rows = mysqli_fetch_array($result);
            if($rows!=0)
            {
                echo '<div class="friend_line">';
                echo '<img style="float:left"src="https://graph.facebook.com/'.$value["id"].'/picture"/>';
                echo '<div>'.$value["name"].'</div>';       
                echo '<div class="follow" style="margin-top:10px">追蹤</div>';
                echo '</div>';
            }
        }
        echo '</div>';

        if($con)
            mysqli_close($con);
    }
?>