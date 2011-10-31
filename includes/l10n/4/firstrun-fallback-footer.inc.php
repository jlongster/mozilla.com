
<?php if($pageid == 'whatsnew-4'): ?>

<p id="sub-links">
    <a href="/<?=$lang;?>/firefox/<?=getVersionBySelf();?>/releasenotes/"><?=___('Release Notes');?>&nbsp;<span>»</span></a>
    <a href="/<?=$lang;?>/firefox/features/"><?=___('Features');?>&nbsp;<span>»</span></a>
    <a href="http://support.mozilla.com"><?=___('Support');?>&nbsp;<span>»</span></a>
</p>
<?php endif; ?>
</div> <!-- wrapper -->

    <script>
        document.getElementById('title-logo').className = 'start';
        document.getElementById('title-wordmark').className = 'start';
        document.getElementById('screenshot').className = 'start';
        document.body.className = 'start';
        window.onload = function() {
            document.body.className = 'go';
        };
    </script>

    <?
    // Webtrends stats, see bug 556384
    require "{$config['file_root']}/includes/js_stats.inc.php";
    echo $stats_js;
    ?>
</body>
</html>
