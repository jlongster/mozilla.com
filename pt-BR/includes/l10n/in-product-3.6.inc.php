<style type="text/css">
  #main-content .sub-feature li#connect-orkut a {
    background: url(data:image/gif;base64,<?php echo base64_encode(file_get_contents("{$config['file_root']}/img/firefox/3.6/firstrun/orkut.png")) ?>) no-repeat;
    background-position:0 50%;
  }
</style>
<div id="main-content">

  <div class="sub-feature" id="intro">

    <h2>Escolha a sua Persona.</h2>
    <p id="try">Passe o mouse para experimentar, clique para trocar</p>

    <a href="http://www.getpersonas.com/en-US/gallery/" id="personas-image-link">Personas</a>
    <iframe
        src="http://www.getpersonas.com/en-US/external/mozilla/firstrun.php"
        width="320"
        height="200">
    </iframe>

    <ul id="personas-link" class="link">
      <li>
          <a href="http://www.getpersonas.com/en-US/gallery/" id="see-all-personas">Ver todas <?=$personasnumber?>+</a>
      </li>
    </ul>
</div>

  <div class="sub-feature" id="sidebar">
    <h2>Mantenha-se em contato</h2>
    <ul class="link">
      <li id="connect-twitter"><a href="http://twitter.com/firefox">Seguir no Twitter</a></li>
      <li id="connect-orkut"><a href="http://www.orkut.com.br/Main#Community?cmm=1186175">Comunidade no Orkut</a></li>
      <li id="connect-facebook"><a href="http://www.facebook.com/Firefox">Tornar-se fã no Facebook</a></li>
      <li id="connect-blog"><a href="http://blog.mozilla.com/brasil/">Ler nosso blog</a></li>
    </ul>
  </div>

  <div class="sub-feature<?=$oop_class;?>" id="personalize"><div>
    <h2>Mais formas de personalizar</h2>
    <p>Adapte o Firefox à sua maneira de navegar com milhares de complementos gratuitos.</p>
    <ul class="link">
      <li>
          <a href="https://addons.mozilla.org/<?=$lang?>/firefox/">Explorar complementos</a>
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
      <a href="/<?=$lang?>/firefox/features/" id="features-link">Mais recursos do Firefox 3.6</a>
      <a href="http://support.mozilla.com" id="support-link">Suporte do Firefox</a>
  </p>

</div>