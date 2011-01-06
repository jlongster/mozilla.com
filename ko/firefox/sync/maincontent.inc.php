<?php
    // This is the page title as shown in the browser tab
    $page_title = "Firefox Sync";
?>

<div id="main-feature">
    <h2>Firefox Sync</h2>
    <p>여러분이 사용하는 모든 기기에서 방문 기록, 웹 사이트 암호, 북마크, 탭 정보를 공유하실 수 있습니다.</p>
    <p class="wide-button">
        <a href="<?=$amo_url?>">무료 확장 기능 설치하기</a>
    </p>
</div>

<div id="main-content">
    <div class="container">

    <h3>왜 Firefox Sync를 써야 하나요?</h3>

    <h4>어디서나 똑같은 웹 여행</h4>
    <p>회사에서 웹 서핑하던 내용을 집에 가서 볼 수 없을까? 이제 어떤 PC에서든 여러분이 방문한 웹 사이트 기록이나 열어 놓은 탭 정보를 함께 공유할 수 있습니다. 어디에서 Firefox를 사용하든 똑같은 경험을 하실 수 있습니다.</p>

    <h4>소중한 나의 정보 백업</h4>
    <p>여러분의 모든 웹 브라우저 설정, 웹 사이트 암호, 북마크 및 웹 사용 정보를 한 PC에서 두고 잃어 버릴 수 있지만, Firefox Sync를 사용하시면 언제든지 복구 가능합니다.</p>

    <h4>확실한 개인 정보 보호</h4>
    <p>모든 개인 정보는 여러분만 접근할 수 있도록 암호화 되어 이중 암호를 통해 보안됩니다. Mozilla는 비영리 단체로서 여러분의 개인 정보를 상업적으로 이용하지 않으며, 보안을 최우선으로 생각합니다.</p>

    <p id="mobile"><a href="/<?=$lang?>/mobile/sync/">모바일 사용 방법 자세히 보기</a></p>
    </div>
    <div id="main-content-footer"></div>

</div>
<div id="sidebar">
    <h3>시작하기</h3>
    <ol>
        <li>무료 <a href="<?=$amo_url?>">Firefox Sync 확장 기능</a>을 설치합니다.</li>
        <li>Firefox를 다시 시작하여, 새로운 계정을 만듭니다. 계정은 암호 및 암호키를 이중으로 보안할 수 있습니다.</li>
        <li>Firefox Sync를 다른 기기에서도 설치 합니다.</li>
        <li>로그인 후 동기화 방법을 선택 하면, 여러분의 웹 이용 정보를 어디서나 공유할 수 있습니다.</li>
    </ol>

    <p><a href="http://support.mozilla.com/kb/What+is+Firefox+Sync">자주 묻는 질문(FAQ)</a></p>


    <?php echo $download_box; ?>
</div>
