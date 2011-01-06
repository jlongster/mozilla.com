<?php
    // This is the page title as shown in the browser tab
    $page_title = "Firefox Sync";
?>

<div id="main-feature">
    <h2>Mantenha-se sincronizado com o seu Firefox</h2>
    <p>Aceda ao seu histórico, senhas, marcadores e até aos separadores abertos em todos os seus dispositivos.</p>
    <p class="wide-button">
        <a href="<?=$amo_url?>">Obtenha agora de forma gratuita o Firefox Sync</a>
    </p>
</div>

<div id="main-content">
    <div class="container">

    <h3>Porquê sincronizar?</h3>

    <h4>Levante-se e vá</h4>
    <p>Está a fazer pesquisas no escritório, e dá conta que já são horas de ir para casa? Agora pode voltar aos seus separadores abertos e histórico de pesquisas num instante a partir de um qualquer PC. O seu Firefox está como o deixou, não importa onde esteja.</p>

    <h4>Backup da sua info</h4>
    <p>Todas as suas definições, senhas, marcadores e outras personalizações são guardadas de uma maneira mais universal, não se cingindo a uma única máquina. Se substituir um dispositivo, não perde o seu Firefox.</p>

    <h4>Segurança</h4>
    <p>A sua informação é cifrada e apenas você lhe pode aceder quando escrever a frase secreta. O Firefox coloca a sua segurança como a principal prioridade e a sincronização não é excepção.</p>

    <p id="mobile"><a href="/<?=$lang?>/mobile/sync/">Saiba mais sobre o Firefox Sync no seu telefone.</a></p>
    </div>
    <div id="main-content-footer"></div>

</div>
<div id="sidebar">
    <h3>Como começar</h3>
    <ol>
        <li>Instalar o extra gratuito <a href="<?=$amo_url?>">Firefox Sync</a>.</li>
        <li>Reinicie o Firefox e siga os passos para criar uma conta com senha e frase secreta.</li>
        <li>Instale o Firefox Sync em todos os outros dispositivos que utiliza.</li>
        <li>Inicie sessão e escolha o que sincronizar, depois comece a navegar onde ficou.</li>
    </ol>

    <p><a href="http://support.mozilla.com/kb/What+is+Firefox+Sync">Perguntas frequentes</a></p>


    <?php echo $download_box; ?>
</div>
