<?php 

$url = 'http://mailer.localhost/api.php';
$data = ['data' =>
	[

	'secret' => 'vvas432',
	'subject' => 'İletişim Formu',
	'body' => 'Bu bir test maildir lütfen yanıt vermeyin.',
	'serverInfo' => [
		'hostname' => 'mail.hostname.com',
		'username' => 'user@hostname.com',
		'password' => '&GPassxw',
		'port' => 587
	],
	'address' => ['enesphp@gmail.com'], //maili alacak kişiler
	'reply' => 'info@test.com', //yanıt adresi
	'cc' => ['info@tetabilisim.com'],
	'bcc' => ['enes@tetabilisim.com']
	] 

];


// use key 'http' even if you send the request to https://...
$options = array(
    'http' => array(
        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
        'method'  => 'POST',
        'content' => http_build_query($data)
    )
);
$context  = stream_context_create($options);
$result = file_get_contents($url, false, $context);
if ($result === FALSE) {  }

var_dump($result);



 ?>