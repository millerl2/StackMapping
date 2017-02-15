<html>
<head>
<title><?php echo "hello world"; ?></title>
</head>
<body>
<?php 
//NEED TO GET THE SYS DOC # THEN ADD IT TO THIS URL
//$docnum = ;
$url = "http://library.newpaltz.edu/xaleph/?sys=";
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$curl_scraped_page = curl_exec($ch);
curl_close($ch);
echo $curl_scraped_page; 
?>
</body>
</html>