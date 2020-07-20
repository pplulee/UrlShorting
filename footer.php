<!-- 本源码基于apache2开源，你可以在不修改版权的基础上任意修改其他内容 -->
<br />
<footer>
    <script>
    fetch('https://v1.hitokoto.cn')
        .then(function (res) {
        return res.json();
    })
        .then(function (data) {
        var hitokoto = document.getElementById('hitokoto');
        hitokoto.innerText = data.hitokoto;
    })
        .
    catch (function (err) {
        console.error(err);
    })
    console.log("\n %c 短域|密语");
    </script>
    <div style="text-align: center;">
        <div class="mdui-divider"></div>
        <p id="hitokoto">:D 获取中...</p>
        <div class="footer-copyright">Copyright ©
            <?php echo date( 'Y') ?> <a class="mdui-text-color-grey-800" href="http://xsot.cn">XCSOFT</a> & <a class="mdui-text-color-grey-800" href="https://github.com/pplulee">baiyimiao</a> All rights reserved.</div>
    </div>
</footer>