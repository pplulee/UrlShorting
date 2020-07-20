<?php
    session_start();
    require_once('./app/core.php');
    //引入核心文件
    $content = $_POST['content'];
    //获取一大堆post
    $type = $_POST['type'];
    $link = $_POST['customize']; //自定义链接

    if ($type == 'shorturl') {
        $arr = Urlshorting($content, "shorturl", $_POST['customize']);
    }else {
        $arr = Urlshorting($content,"passmessage",$_POST['customize']);
    }

    if ($arr[0] == 200) {
        echo "200";
        $_SESSION['shorturl'] = $arr[1];
    } elseif ($arr[0] == 1001) {
        echo "非法的URL";
    } elseif ($arr[0] == 1002) {
        echo "您输入的域名或您的IP已被封禁!";
    }elseif ($arr[0] == 1003) {
        echo "您输入的自定义短链已被占用";
    }else{
        echo "发生了未知错误";

    }

?>