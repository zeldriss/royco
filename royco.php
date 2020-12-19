<?php

$headers = array();
$headers[] = 'Accept: application/json, text/plain, */*';
$headers[] = 'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.88 Safari/537.36';
$headers[] = 'sec-ch-ua: "Google Chrome";v="87", " Not;A Brand";v="99", "Chromium";v="87"';
$headers[] = 'Content-Type: application/json;charset=UTF-8"';


echo "[+] Bot Royco - Gaizka  \n";
echo 'Enter NO : '; 
$no = trim(fgets(STDIN)); 


echo 'Enter OTP : '; 
$otp = trim(fgets(STDIN)); 

$cek = curl('https://juaranutrimenu.royco.co.id/api/otp/request', '{"country":"ID","sessId":"abcdefghijklmn","phone_number":"'.$no.'"}', $headers);
if (strpos($cek[1], 'true')) {
	$cret = curl('https://juaranutrimenu.royco.co.id/api/otp/submit', '{"phone_number":"'.$no.'","sessId":"abcdefghijklmn","secret":"GX8EK519R783O8O7WX7NF0WLCJFD40QW","otp_token":"'.$otp.'","isNewUser":false}', $headers);
	if (strpos($cret[1], '"success":"true"')) {
		$otp = substr(json_decode($cret[1])->result->otp);
		$otp = substr($otp, 0, -3);
			$chg = curl('https://juaranutrimenu.royco.co.id/api/profiles/detail', '{"phone":"'.$nope.'","pin_new":"121212","pin_old":"'.$pin.'"}', $headers);
			if (strpos($chg[1], '"status":"success"')) {
			} else {
				die($chg[1]);
			}
	
	} else {
		die($cret[1]);
	}
} else {
	die($cek[1]);
}
function curl($url,$post,$headers,$follow=false,$method=null)
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		// curl_setopt($ch, CURLOPT_TIMEOUT, 60);
		if ($follow == true) curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_HEADER, 1);
		if ($method !== null) curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
		if ($headers !== null) curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		if ($post !== null) curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
		$result = curl_exec($ch);
		$header = substr($result, 0, curl_getinfo($ch, CURLINFO_HEADER_SIZE));
		$body = substr($result, curl_getinfo($ch, CURLINFO_HEADER_SIZE));
		preg_match_all('/^Set-Cookie:\s*([^;]*)/mi', $result, $matches);
		$cookies = array();
		foreach($matches[1] as $item) {
		  parse_str($item, $cookie);
		  $cookies = array_merge($cookies, $cookie);
		}
		return array (
		$header,
		$body,
		$cookies
		);
	}

function get_between($string, $start, $end) 
    {
        $string = " ".$string;
        $ini = strpos($string,$start);
        if ($ini == 0) return "";
        $ini += strlen($start);
        $len = strpos($string,$end,$ini) - $ini;
        return substr($string,$ini,$len);
    }

function random($length,$a) 
	{
		$str = "";
		if ($a == 0) {
			$characters = array_merge(range('0','9'));
		}elseif ($a == 1) {
			$characters = array_merge(range('0','9'),range('a','z'));
		}
		$max = count($characters) - 1;
		for ($i = 0; $i < $length; $i++) {
			$rand = mt_rand(0, $max);
			$str .= $characters[$rand];
		}
		return $str;
	}
