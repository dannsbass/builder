#!/usr/bin/env php
<?php
/**
 * local side
 * script untuk membuat file secara remote via HTTP dengan metode POST
 * */

if(PHP_SAPI != 'cli') exit('file ini hanya bisa diakses via PHP CLI');

if(!isset($argv[1])) exit('cara pakai: php '.basename(__FILE__).' [namafile]'.PHP_EOL);

if(!file_exists($argv[1])) exit($argv[1].' tidak ada'.PHP_EOL);

$namafile = $argv[1];
$kode = base64_encode(file_get_contents($argv[1]));

$data = [
'namafile'=>$namafile,
'kode'=>$kode,
];

#$url = 'https://bot-pendaftaran.herokuapp.com/file_builder.php';
$url = 'http://localhost:8080';
$data = http_build_query($data);

$opts=[
'http'=>[
'method'=>"POST",
'header'=>'Content-Type:application/x-www-form-urlencoded',
'content'=>$data
   ]
];

$context=stream_context_create($opts);

$file=file_get_contents($url,false,$context);

echo $file;
