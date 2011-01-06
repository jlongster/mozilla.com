<?php
    // This is the page title as shown in the browser tab
    $page_title = "Firefox Sync";
?>

<div id="main-feature">
    <h2>保持您的 Firefox 时时同步</h2>
    <p>从各种设备随意访问您的历史记录，密码，书签以及打开的标签页。</p>
    <p class="wide-button">
        <a href="<?=$amo_url?>">立刻获取免费的 Firefox Sync 附加组件</a>
    </p>
</div>

<div id="main-content">
    <div class="container">

    <h3>为何要保持同步？</h3>

    <h4>随时随地，再无限制</h4>
    <p>试想您正在办公室在线研究，但是已经到了回家的时间，怎么办？现在，您可以在任何一台 PC 中打开您刚才打开的标签页和历史记录了。
不管您身在何方，您的 Firefox 就和您刚离开它的时候一模一样。</p>

    <h4>备份您的信息</h4>
    <p>您的全部设置，密码，书签以及其它定制内容均已更普遍的方式来保存，不局限于单一的设备。如果您更换了设备，您不会丢掉属于您自己的
Firefox。</p>

    <h4>安全性</h4>
    <p>您的信息已被加密，并且只有在您输入密码短语之后才允许访问。Firefox 总是将安全视为最重要的，数据同步亦不例外。</p>

    <p id="mobile"><a href="/<?=$lang?>/mobile/sync/">了解可运行于移动电话的 Firefox
Sync。</a></p>
    </div>
    <div id="main-content-footer"></div>

</div>
<div id="sidebar">
    <h3>如何开始</h3>
    <ol>
        <li>安装免费的 <a href="<?=$amo_url?>">Firefox Sync 附加组件</a>.</li>
        <li>重启 Firefox 并根据提示来创建帐号，需要设置一个密码以及一个密码短语。</li>
        <li>安装 Firefox Sync 至您需要使用的任意其它设备</li>
        <li>登录并选择同步方式，然后继续您的网络浏览旅途。</li>
    </ol>

    <p><a
href="http://support.mozilla.com/kb/What+is+Firefox+Sync">常见问题</a></p>


    <?php echo $download_box; ?>
</div>
