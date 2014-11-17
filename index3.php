<?php 
	include('crawl.php');
	$cc = new mycurl();
	$cc->createCurl('http://'.$_GET['url'].'?p='.$_GET['cnt']);
	$cnt = $_GET['cnt'] + 1;
	$doc = $cc->__tostring();
	
	$html = str_get_html($doc);
	
	function clean($content)
	{
		return strtolower( preg_replace('/\s\s+/', ' ', preg_replace('/-/', ' ', $content) ) );
	}
	$flag = 0;
	
	//db connection
	$con=mysqli_connect("localhost","root","","myntra");

// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

	foreach($html->find('div[class="product"]') as $e)
	{
		
		foreach($e->find('a') as $e1)
		{
			$flag++;
			$temp = explode("/", $e1->href);
			$query = 'insert into `products` (`product`) values ("'.clean($temp[3]).'")';
			mysqli_query($con, $query);
		}
	}
	if( $flag != 0)
		header('Location: index3.php?url='.$_GET['url'].'&cnt='.$cnt);
	else
		echo 'reached end!';
?> 