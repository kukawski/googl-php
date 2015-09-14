<?php
function googl ($url, $mode = 'shorten') {
	$googlUrl = 'https://www.googleapis.com/urlshortener/v1/url';
	$isUrl = filter_var($url, FILTER_VALIDATE_URL, FILTER_FLAG_SCHEME_REQUIRED) == $url && preg_match('/^https?$/i', parse_url($url, PHP_URL_SCHEME));
	
	if (!$isUrl) {
		return false;
	}
	
	$method = 'GET';
	$headers = array('Content-type: application/json', 'Accept: application/json');
	$query = array();
	$body = null;
	
	$apiKey = defined('GOOGL_API_KEY') ? GOOGL_API_KEY : null;
	
	if ($apiKey !== null) {
		$query []= 'key=' . urlencode($apiKey);
	}
	
	switch ($mode) {
		case 'expand':
			$query []= 'shortUrl=' . urlencode($url);
			break;
		case 'stats':
			$query []= 'shortUrl=' . urlencode($url);
			$query []= 'projection=FULL';
			break;
		case 'shorten':
		case null:
			$method = 'POST';
			$body = json_encode(array('longUrl' => $url));
			break;
		default:
			return false;
	}
	
	if (!empty($query)) {
		$googlUrl .= '?' . join('&', $query);
	}
	
	$ch = curl_init();
	$options = array(
		CURLOPT_URL => $googlUrl,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_POST => $method === 'POST',
		CURLOPT_SSL_VERIFYPEER => false,
		CURLOPT_SSL_VERIFYHOST => 2,
		CURLOPT_SSLVERSION => 3,
		CURLOPT_HEADER => false,
		CURLOPT_HTTPHEADER => $headers
	);
	
	if ($options[CURLOPT_POST] && (is_string($body) || is_array($body))) {
		$options[CURLOPT_POSTFIELDS] = $body;
	}
	
	curl_setopt_array($ch, $options);
	
	$response = curl_exec($ch);
	$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
	$error = curl_error($ch);
	
	curl_close($ch);
	unset($ch);
	
	if ($response === false) {
		return false;
	}
	
	$data = json_decode($response, true);
	
	if ($data === null || isset($data['error']) || $httpCode !== 200) {
		return false;
	}
	
	switch ($mode) {
		case 'expand':
			return $data['longUrl'];
		case 'stats':
			return $data;
		case 'shorten':
		case null:
			return $data['id'];
	}
}
?>