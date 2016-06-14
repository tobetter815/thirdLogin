<?php
require("config.php");

if(isset($_GET['code'])){

    $code=$_GET['code'];
    $access_token=file_get_contents("https://api.weixin.qq.com/sns/oauth2/access_token?appid=".config::$appid
        ."&secret=".config::$secret."&code=".$code."&grant_type=authorization_code");

    $array=array();
    $array=json_decode($access_token,true);

    $access_token=$array['access_token'];
    $openid=$array['openid'];

    $userInfo=file_get_contents("https://api.weixin.qq.com/sns/userinfo?access_token=".$access_token
    ."&openid=".$openid);

    $array2=array();
    $array2=json_decode($userInfo,true);

    $openid=$array2['openid'];
    $nickname=$array2['nickname'];
    $headimgurl=$array2['headimgurl'];
    $unionid=$array2['unionid'];

    $domain=config::$url."?userName=".$openid
        ."&nickName=".$nickname."&imageUrl=".$headimgurl;

    header("Location: ".$domain);

}