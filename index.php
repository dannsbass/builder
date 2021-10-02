<?php
/**
 * remote side
 * script sederhana untuk membuat file baru secara remote via HTTP dengan metode POST 
 * */
 
# kalau kode dan namafile tersedia
if(isset($_POST['kode']) and isset($_POST['namafile'])){
  
  # parsing base64-encrypted data
  $namafile = $_POST['namafile'];
  $kode = base64_decode($_POST['kode']);
  echo cek($namafile,$kode);
}

# kalau kode atau namafile tidak tersedia
else{
  $respon = [
    'ok' => false,
    'pesan' => 'kode atau namafile tidak ada',
  ];
  return json_encode($respon);
}

function cek($namafile,$kode){
  
  # kalau file sudah ada
  if(file_exists($namafile)){
    $respon = [
      'ok'=>false,
      'pesan'=>"$namafile sudah ada",
    ];
    return json_encode($respon);
  } 
  
  # kalau berhasil membuat file
  if(file_put_contents($namafile,$kode)){
    $respon = [
      'ok' => true,
      'pesan' => "berhasil membuat $namafile",
    ];
    return json_encode($respon);
  }
  
  # kalau gagal membuat file
  else {
    $respon = [
      'ok' => false,
      'pesan' => "gagal membuat $namafile",
    ];
    return json_encode($respon);
  }
}