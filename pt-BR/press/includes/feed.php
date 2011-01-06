<?php
setlocale(LC_TIME, "pt_BR", "ptb");

$feed = "http://blog.mozilla.com/brasil/feed";
$xml = new SimpleXMLElement($feed, null, LIBXML_NOCDATA);
$feed_items = array();

foreach ($xml->channel->item as $post) {
	$unixtime = strtotime($post->pubDate);

	$item = array (
		'title' => (string)$post->title,
		'date' => utf8_encode(strftime('%d de %B de %Y', $unixtime)),
		'dateISO8601' =>  date('Y-m-d\TH:i:s', $unixtime),
	    'link' => (string)$post->link,
    	'summary' => (string)$post->description
	);

	array_push($feed_items, $item);
}
?>