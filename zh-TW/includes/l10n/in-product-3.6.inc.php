<style type="text/css">
  #main-content .sub-feature li#connect-plurk a {
    background: url(data:image/gif;base64,<?php echo base64_encode(file_get_contents("{$config['file_root']}/img/firefox/3.6/firstrun/plurk.png")) ?>) no-repeat;
    background-position:0 50%;
  }
</style>
<div id="main-content">

  <div class="sub-feature" id="intro">

    <h2>選擇您的 Personas 面板</h2>
    <p id="try">滑鼠移上去試試，點一下套用</p>

    <a href="http://www.getpersonas.com/en-US/gallery/" id="personas-image-link">Personas</a>
    <iframe
        src="http://www.getpersonas.com/en-US/external/mozilla/firstrun.php"
        width="320"
        height="200">
    </iframe>

    <ul id="personas-link" class="link">
      <li>
          <a href="http://www.getpersonas.com/en-US/gallery/" id="see-all-personas">檢視全部 <?=$personasnumber?>+</a>
      </li>
    </ul>
</div>

  <div class="sub-feature" id="sidebar">
    <h2>保持聯繫</h2>
    <ul class="link">
      <li id="connect-plurk"><a href="http://www.plurk.com/foxmosa">追蹤 MozTW 小莎的 Plurk</a></li>
      <li id="connect-facebook"><a href="http://www.facebook.com/Firefox">加入 Facebook 粉絲團</a></li>
      <li id="connect-blog"><a href="http://blog.mozilla.com/">閱讀我們的部落格</a></li>
    </ul>
  </div>

  <div class="sub-feature<?=$oop_class;?>" id="personalize"><div>
    <h2>更豐富的個人化</h2>
    <p>數千個免費的附加元件，讓您自訂最合身的 Firefox。</p>
    <ul class="link">
      <li>
          <a href="https://addons.mozilla.org/<?=$lang?>/firefox/">探索附加元件</a>
      </li>
    </ul>
  </div></div>

<?=$oop;?>
</div>
<div id="footer">
    <div id="connect" class="sub-feature">
        <ul class="link social">
            <li id="connect-facebook"><a href="http://www.facebook.com/Firefox">Facebook</a></li>
            <li id="connect-twitter"><a href="http://twitter.com/firefox">Twitter</a></li>
        </ul>
    </div>
</div>
<div>

  <p id="sub-links">
      <a href="/<?=$lang?>/firefox/features/" id="features-link">更多 Firefox 3.6 的功能</a>
      <a href="http://support.mozilla.com" id="support-link">Firefox 線上支援</a>
  </p>

</div>
