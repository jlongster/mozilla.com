<style type="text/css">
  #main-content .sub-feature li#connect-bebo a {
    background: url(data:image/gif;base64,<?php echo base64_encode(file_get_contents("{$config['file_root']}/img/firefox/3.6/firstrun/bebo.png")) ?>) no-repeat;
    background-position:0 50%;
  }
</style>
<div id="main-content">

  <div class="sub-feature" id="intro">

    <h2>Rûpoşa Xwe Hilbijêre.</h2>
    <p id="try">Ji bo ceribandinê here ser, ji bo sepandinê bitikîne</p>

    <a href="http://www.getpersonas.com/en-US/gallery/" id="personas-image-link">Rûpoş</a>
    <iframe
        src="http://www.getpersonas.com/en-US/external/mozilla/firstrun.php"
        width="320"
        height="200">
    </iframe>

    <ul id="personas-link" class="link">
      <li>
          <a href="http://www.getpersonas.com/en-US/gallery/" id="see-all-personas"><?=$personasnumber?>+ bibîne</a>
      </li>
    </ul>
</div>

  <div class="sub-feature" id="sidebar">
    <h2>Girêdayî Bimîne</h2>
    <ul class="link">
      <li id="connect-twitter"><a href="http://twitter.com/firefox">Li ser Twitterê me bişopîne</a></li>
      <li id="connect-bebo"><a href="http://www.bebo.com/Profile.jsp?MemberId=6852125959
">Bibe Endamê/a Beboyê</a></li>
      <li id="connect-blog"><a href="http://blog.mozilla.com/">Bloga me bixwîne</a></li>
    </ul>
  </div>

  <div class="sub-feature<?=$oop_class;?>" id="personalize"><div>
    <h2>Ji bo Takekeskirinê Zêdetir Rêbaz</h2>
    <p>Bi 1,000'an pêvekan Firefoxa xwe takekes bike.</p>
    <ul class="link">
      <li>
          <a href="https://addons.mozilla.org/<?=$lang?>/firefox/">Li Pêvekan binêre</a>
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
      <a href="/<?=$lang?>/firefox/features/" id="features-link">Zêdetir taybetmendiyên Firefox 3.6</a>
      <a href="http://support.mozilla.com" id="support-link">Piştgiriya Firefoxê</a>
  </p>

</div>
