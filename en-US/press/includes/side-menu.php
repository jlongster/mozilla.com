<?php
$items = array(
    '/'                  => 'Press Center',
    '/project-news.html' => 'Mozilla Project News',
    '/ataglance.html'    => 'Mozilla at a Glance',
    '/images.html'       => 'Image Library',
    '/awards.html'       => 'Awards',
    // '/buzz.html'         => 'The Buzz',
    '/kit-3-6.html'      => 'Firefox 3.6 Press Kit',
    '/kit-4b.html'      => 'Firefox 4 Beta Press Kit',
    '/kit-N900.html'     => 'Firefox for the Nokia N900 Press Kit',
    '/kit-android.html'     => 'Firefox 4 beta for Android and Nokia N900 Press Kit',
);
$saw_first = FALSE;
?>
<ul id="side-menu">
    <?php foreach ($items as $link => $title): ?>
        <?php if (!$saw_first): ?>
            <li class="first"><h3><a href="/<?=$lang?>/about/">About</a> / 
        <?php else: ?>
            <li>
        <?php endif ?>
        <?php if ($page_title === $title): ?>
            <span><?=$title?></span>
        <?php else: ?>
            <a href="/<?=$lang?>/press<?=$link?>"><?=$title?></a>
        <?php endif ?>
        <?php if (!$saw_first): ?></h3><?php endif ?>
            </li>
        <?php $saw_first = TRUE; ?>
    <?php endforeach ?>
</ul>
