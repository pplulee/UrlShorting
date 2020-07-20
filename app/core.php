<?php
require_once('./config.php');
require_once('./app/record.php');
require_once('./app/time.php');
require_once('./app/ip.php');

//单用于生成链接
function GenerateLink(){
    global $pass; //短网址长度
    global $strPol; //短网址包含内容
    $shorturl = null;
    $max = strlen($strPol)-1;
    for ($i = 0;$i < $pass;$i++) {
        $shorturl.= $strPol[rand(0,$max)];
    }
    return $shorturl;
}

//检查重复
function CheckRepeat($url){
    global $conn; //数据库

    //检测随机生成的是否有重复
    if (mysqli_num_rows(mysqli_query($conn,"SELECT * FROM `information` WHERE shorturl='$url'")) == 0){
        return TRUE;    //没有重复
    }else{
        return FALSE;   //有重复
    }

}

function Urlshorting($content,$type,$customize) {
  global $ip;
  //ip
  global $conn;
  //数据库
  global $url;
  //网址域名
  global $time;
  //时间
  $arr1 = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM `ban` WHERE `content`='$ip';"));
  if (!empty($arr1)) {
    //检索用户ip或短域是否被封禁
    return array(1002);
    exit();
  }
  if (empty($content)) {
    //检测是否有输入
    return array(1001);
    exit();
  }

  if ($type == "shorturl") {
      if (!preg_match('#(http|https)://(.*\.)?.*\..*#i',$content) || strlen($content) > 1000 || strlen($content) < 10) {
          return array(1001);
          exit();
      }
  }
  if ($type == "passmessage") {
      if (strlen($content) > 3000 || strlen($content) < 3) {
          return array(1001);
          exit();
      }
  }

    //判断是否自定义，是否被占用
     if ($customize!="" && CheckRepeat($customize)==FALSE) {
         return array(1003);
         exit();
     }else if ($customize!="" && CheckRepeat($customize)==TRUE){
         mysqli_query($conn,"INSERT INTO `information` VALUES('$content','$customize','$type','$time','$ip');");
         return array(200,$url . $customize);
         exit();
     }

     $shorturl = GenerateLink();
     while (CheckRepeat($shorturl)==FALSE) {
         $shorturl = GenerateLink();
     }
     mysqli_query($conn,"INSERT INTO `information` VALUES('$content','$shorturl','$type','$time','$ip');");
     return array(200,$url . $shorturl);
     exit();
}
