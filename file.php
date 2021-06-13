<?php

if(file_exists($filepath = __DIR__ . ($part=urldecode($_SERVER['QUERY_STRING']))))
{
	$offset = 0;
	$parts = explode('/', $filepath);
	$filename = array_pop($parts);
	$partiallength = ($contentLength = $filesize = filesize($filepath))-1;

	if(isset($_SERVER['HTTP_RANGE'])&&preg_match('/bytes=(\d+)-(\d+)?/', $_SERVER['HTTP_RANGE'], $matches))
		{ header('HTTP/1.1 206 Partial Content'); $contentLength = (($partiallength = (empty($matches[2])?$partiallength:$matches[2])) - ($offset = $matches[1])) + 1; };

	header('Accept-Ranges: bytes');
	header('Content-Type: ' . mime_content_type($filepath));
	header('Content-Length: ' . $contentLength);
	header('Content-Disposition: inline; filename="' . $filename . '"');
	header('Content-Range: bytes ' . $offset . '-' . $partiallength . '/' . $filesize);
	if($file = fopen($filepath, 'r')){ fseek($file, $offset); echo fread($file, $partiallength); fclose($file); if($offset==0)file_put_contents('playlog.txt', time() . "\t" . $part . "\n", FILE_APPEND); }; 
};




?>