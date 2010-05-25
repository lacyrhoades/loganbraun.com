<?php

function web_request($ch, $url, $post=FALSE, $post_fields = array())
{
	$post_string = '';
	foreach($post_fields as $key=>$val) {
		$post_string .= $key.'='.$val.'&';
	}
	if (strlen($post_string)>0) $post_string = substr($post_string, 0, strlen($post_string)-1);
	
	curl_setopt($ch, CURLOPT_URL,$url); // set url to post to
	curl_setopt($ch, CURLOPT_FAILONERROR, 1);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);// allow redirects
	curl_setopt($ch, CURLOPT_RETURNTRANSFER,1); // return into a variable
	curl_setopt($ch, CURLOPT_COOKIEJAR, "/tmp/cookie");
	curl_setopt($ch, CURLOPT_COOKIE, "/tmp/cookie"); 
	curl_setopt($ch, CURLOPT_TIMEOUT, 3); // times out after 4s
	if ($post) {
		curl_setopt($ch, CURLOPT_POST, 1); // set POST method
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post_string); // add POST fields
	}
	$result = curl_exec($ch); // run the whole process
	return $result;
}