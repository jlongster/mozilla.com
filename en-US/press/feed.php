<?php
/**
 * RSS feed index generator based on Mozilla press releases.
 * Employs crude yet effective scraping of press release content.
 *
 * TODO: DB / Memcache needed?
 * TODO: Static generate on the authoring end?
 *
 * @author lorchard@mozilla.com
 */
$max_items = 7;
$base_url  = dirname($_SERVER['SCRIPT_URI']);
$base_dir  = dirname(__FILE__);

// Find all the press releases according to date-based filename convention.
$files = array();
if ($dh = opendir($base_dir)) {
    while (FALSE !== ($fn = readdir($dh))) {
        if (!is_file("{$base_dir}/{$fn}")) continue;
        $m = array();
        if (!preg_match('/mozilla-(\d{4})-(\d{2})-(\d{2}).html/', $fn, $m)) continue;
        $files[$fn] = $m;
    }
}

// Get the latest $max_items in alpha (coincidentally also date) order.
$names = array_keys($files);
rsort($names);
$names = array_slice($names, 0, $max_items);

// Start building the feed items.
$items = array();
foreach ($names as $name) {

    // Build an initial item structure...
    $m = $files[$name];
    $item = array(
        'title' => null,
        'link'  => "{$base_url}/{$name}",
        'date'  => date('r', strtotime("{$m[1]}-{$m[2]}-{$m[3]} 00:00:00")),
    );

    // Now, scrape each press release for title and content.
    $txt = file_get_contents($name);
    $lines = explode("\n", $txt);
    $content = null;
    foreach ($lines as $line) {

        // Look for the first header element as item title.
        $m = array();
        if (null == $item['title'] && preg_match('/<h\d>(.*)<\/h\d>/', $line, $m)) {
            $item['title'] = $m[1];
            continue;
        }

        // Find the content div and start capturing content...
        if (FALSE !== strpos($line, '<div id="content">')) {
            $content = array();
        }
        // Capture after the content div...
        if (is_array($content)) {
            $content[] = $line;
        }
        // Stop capturing after the end marker and drop it into the item.
        if (FALSE !== strpos($line, '<!-- end #content div -->')) {
            $item['description'] = join("\n", $content);
            $content = null;
        }
    }

    // Toss the finished item into the pile.
    $items[] = $item;
}

// Set some headers, last modified based on last recent release and 
// cache expiration at least an hour from now.
header('Content-Type: application/rss+xml');
header('Last-Modified: ' . $items[0]['date']);
header('Cache-Control: max-age=3600');
header('Expires: ' . date('r', time()+3600));

// HACK: Concatenated because PHP's not happy about the PI
echo '<'.'?xml version="1.0" encoding="UTF-8"?'.'>'."\n";
?>
<rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom">
    <channel>
        <title>Mozilla Press Center</title>
        <atom:link href="<?=$_SERVER['SCRIPT_URI']?>" 
            rel="self" type="application/rss+xml" />
        <link><?=str_replace('feed.php', '', $_SERVER['SCRIPT_URI'])?></link>
        <description>Mozilla News, Announcements and More</description>
        <lastBuildDate><?=$items[0]['date']?></lastBuildDate>
        <language>en</language>
        <?php foreach ($items as $item): ?>

            <item>
                <title><?=htmlspecialchars($item['title'])?></title>
                <pubDate><?=$item['date']?></pubDate>

                <link><?=$item['link']?></link>
                <guid isPermaLink="true"><?=$item['link']?></guid>
                <description><?=htmlspecialchars($item['description'])?></description>
            </item>

    <?php endforeach?>
    </channel>
</rss>
