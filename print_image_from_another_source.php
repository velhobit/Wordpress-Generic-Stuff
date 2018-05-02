<?php
//Não sei se deveria ensinar a solução porque a galera pode querer usar para blackhat, mas...

$file = 'https://site.com/minha-imagem.jpg';
$file = fopen($file);
$type = 'image/jpeg';
header('Content-Type:'.$type);
header('Content-Length: ' . filesize($file));
readfile($file);

//E falei que o allow_url_fopen deve estar em ON, no PHP.ini e, se estiver bloqueado a nível de servidor, tem que usar o cURL para fazer uma cópia temporária local.
?>