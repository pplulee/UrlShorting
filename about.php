<?php
if(!file_exists("install.lock")){
header("Refresh:0;url=\"./install.php\"");
exit("正在跳转到安装界面...");
}else{
}
require_once('header.php');
echo <<<EOF
<br />
<div class="mdui">
      <div class="mdui-card">
        <div class="mdui-card-header">
          <div class="mdui-card-header-title">短域|密语</div>
          <div class="mdui-card-header-subtitle">一款简洁美观的短域|密语平台</div>
        </div>
  <div class="mdui-card-content">
版本：$version<br/>
<br/>
原作者：XCSOFT(XSOT.CN)<br/>
二次开发：@baiyimiao<br/>
<br/>
使用语言(框架)：PHP HTML MDUI MYSQL<br/>
  </div>
  <div class="mdui-card-actions">
<a class="mdui-btn mdui-ripple" href="//github.com/soxft">原作者Github</a>
<a class="mdui-btn mdui-ripple" href="//github.com/pplulee/UrlShorting">二开版本</a>
  </div>
</div>
EOF;
require_once('footer.php');
?>