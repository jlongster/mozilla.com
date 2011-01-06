<?php
    // This is the page title as shown in the browser tab
    $page_title = "Firefox Sync";
?>

<div id="main-feature">
    <h2>讓您的 Firefox 保持同步</h2>
    <p>使您所有的裝置都可以存取一樣的瀏覽紀錄、密碼、書籤，以及已開啟的分頁。</p>
    <p class="wide-button">
        <a href="<?=$amo_url?>">立刻取得免費的 Firefox Sync 附加元件</a>
    </p>
</div>

<div id="main-content">
    <div class="container">

    <h3>為什麼要同步？</h3>

    <h4>隨開即用</h4>
    <p>正在辦公室裡做研究，卻發現該回家了？您現在可以從任何電腦打開您在其他電腦上已經開啟的分頁與搜尋紀錄。不論您從哪裡登入，您的 Firefox 會跟您離開座位時一樣。</p>

    <h4>備份您的資訊</h4>
    <p>您所有的設定、密碼、書籤，以及其他自訂項目都可以用更通用的方式儲存起來，不會被侷限在單一台機器裡。就算您換了一台電腦，已存的 Firefox 資料也不會消失。</p>

    <h4>安全性</h4>
    <p>您的資訊會被完整加密，只有您可以透過您所設定的私密金鑰解開備份。Firefox 將安全性視為最高的要求，就算是同步也不會有例外。</p>

    <p id="mobile"><a href="/<?=$lang?>/mobile/sync/">了解更多在您手機上執行 Firefox Sync 的資訊。</a></p>
    </div>
    <div id="main-content-footer"></div>

</div>
<div id="sidebar">
    <h3>開始使用</h3>
    <ol>
        <li>安裝免費的 <a href="<?=$amo_url?>">Firefox Sync 附加元件</a>。</li>
        <li>重新啟動 Firefox 並依照指示輸入密碼與私密金鑰來建立一個帳號。</li>
        <li>在您其他的裝置也安裝 Firefox Sync。</li>
        <li>登入並選擇同步方式，並如往常繼續上網。</li>
    </ol>

    <p><a href="http://support.mozilla.com/kb/What+is+Firefox+Sync">常見問題</a></p>


    <?php echo $download_box; ?>
</div>
