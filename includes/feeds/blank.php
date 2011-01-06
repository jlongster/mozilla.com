<?php
$entry->rawBody = 'Test title:  here check out this embedded link http://www.foo.com';
$entry->rawLink = 'http://www.foo.com';
$entry->via->name = 'Example Blog';
$feed->entries = array($entry, $entry);
