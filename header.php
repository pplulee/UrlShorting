<!--
版权归属:XCSOFT
修改时间:2020/07/08
v1.8.0
邮箱:contact#xcsoft.top(用@替换#)
如有任何问题欢迎联系!
-->
<!DOCTYPE html>
<?php
require_once "config.php";
require_once "app/record.php";
require_once "app/code.php";
$id = $_GET['id'];
//获取id
if (empty($id)) {
  $status = "ok";
  //如果没有id就跳过判断
} else {
  //如果有id则搜索数据库
  $check1 = "SELECT *FROM `ban` where `content`='$ip' or `content`='$id';";
  $count1 = mysqli_query($conn,$check1);
  $arr1 = mysqli_fetch_assoc($count1);
  $type = $arr1['type'];
  if (!empty($type)) {
    echo("<br /><br /><center><img src=\"https://cdn.jsdelivr.net/gh/soxft/cdn@master/urlshorting/notice.png\" widht=\"85\"  height=\"85\" alt=\"错误\"></center>");
    echo('<center><h1>该短域已被管理员封禁</h1></center></div>');
    exit();
  }
  $comd = "SELECT * FROM `information` WHERE binary `shorturl`='$id'";
  //binary用于强制要求大小写一样
  $count = mysqli_query($conn,$comd);
  $arr1 = mysqli_fetch_array($count);
  $type = $arr1['type'];
  $information = $arr1['information'];
  $timemessage = $arr1['time'];
  //获取基础数据
  function getResult($conn,$type)
  {
    $retun = mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM `config` WHERE `type` = '$type'")); 
    return $retun['content'] == "true" ? true:false; 
  }
  if(getResult($conn,"QQ") && strpos($_SERVER['HTTP_USER_AGENT'],'QQ/') !== false)
  {
    $ifBrowser = true;
  }else if(getResult($conn,"wechat") && strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') !== false)
  {
    $ifBrowser = true;
  }else{
    $ifBrowser = false;
  }
  //判断用户选项
  if (empty($type)) {
    $status = "undefind";
    //无数据
  } else {
    if ($type == 'shorturl') {
      //如果数据库type读取为短域
      if ($ifBrowser) {
        //判断打开浏览器UA是否为微信或者QQ
        require_once("./app/openInBrowser.php");
        exit();
      } else {
      if (preg_match('/[\x{4e00}-\x{9fa5}]/u',$information) > 0) {
        $informations = parseurl($information);
        //转换url格式（endecode）
      } else {
        $informations = $information;
      }
      if ($access == 'on') {
        access($id,$information,'shorturl');
      }
      //access记录
      if(getResult($conn,"jump"))
      {  //如果打开
        require_once("./app/jump.php");
        exit();
      } else {
        header("Refresh:0;url=\"$informations\"");
        exit();
      }
    }
  }
  if ($type == 'passmessage') {
    $status = "passmessage";
    //passmessage
  }
}
}
//初始判断结束,进入增加url界面
?>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0, user-scalable=no">
  <meta http-equiv="Cache-Control" content="no-siteapp" />
  <title>
    <?php echo($title);?>
  </title>
  <link rel="shortcut icon" type="image/x-icon" href="https://cdn.jsdelivr.net/gh/soxft/cdn@1.9/urlshorting/favicon.ico" media="screen" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/soxft/cdn@master/mdui/css/mdui.min.css">
  <script src="https://cdn.jsdelivr.net/gh/soxft/cdn@master/mdui/js/mdui.min.js"></script>
  <script src="//instant.page/1.2.2" type="module" integrity="sha384-2xV8M5griQmzyiY3CDqh1dn4z3llDVqZDqzjzcY+jCBCk/a5fXJmuZ/40JJAPeoU"></script>
  </head>
  <header class="mdui-appbar mdui-appbar-fixed">
  <style>
    a {
      text-decoration:none
    }
    a:hover {
      text-decoration:none
    }
  </style>
  <body background="https://cdn.jsdelivr.net/gh/soxft/cdn@1.9/urlshorting/background.png" class="mdui-drawer-body-left mdui-appbar-with-toolbar">
    <div class="mdui-toolbar mdui-color-theme">
      <span class="mdui-btn mdui-btn-icon mdui-ripple" mdui-drawer="{target: '#main-drawer'}">
        <i class="mdui-icon material-icons">menu</i>
      </span>
      <a href="" class="mdui-typo-title">Urlshorting</a>
    </header>
    <div class="mdui-drawer" id="main-drawer">
      <div class="mdui-list" mdui-collapse="{accordion: true}" style="margin-bottom: 68px;">
        <div class="mdui-list">
          <a href="/" class="mdui-list-item">
            <i class="mdui-list-item-icon mdui-icon material-icons">filter_none</i>
            &emsp;主页
          </a>
          <a href="./help.php" class="mdui-list-item">
          <i class="mdui-list-item-icon mdui-icon material-icons">help_outline</i>
          &emsp;帮助
        </a>
        </div>
        <a href="./about.php" class="mdui-list-item">
          <i class="mdui-list-item-icon mdui-icon material-icons">info_outline</i>
          &emsp;关于
        </a>
        <div class="mdui-collapse-item ">
          <div class="mdui-collapse-item-header mdui-list-item mdui-ripple">
            <i class="mdui-list-item-icon mdui-icon material-icons">&#xe80d;</i>
            &emsp;友链
            <i class="mdui-collapse-item-arrow mdui-icon material-icons">keyboard_arrow_down</i>
          </div>
          <div class="mdui-collapse-item-body mdui-list">
            <a href="//" class="mdui-list-item mdui-ripple ">友链1</a>
          </div>
          <div class="mdui-collapse-item-body mdui-list">
            <a href="//" class="mdui-list-item mdui-ripple ">友链2</a>
          </div>
        </div>
      </div>
    </div>
  </div>