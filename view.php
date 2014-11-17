<?php 
	include('crawl.php');
	$cc = new mycurl();
	$cc->createCurl('http://'.$_GET['url'].'?p='.$_GET['cnt']);
	$cnt = $_GET['cnt'] + 1;
	$doc = $cc->__tostring();
	
	$html = str_get_html($doc);
	
	echo $html;
?> 