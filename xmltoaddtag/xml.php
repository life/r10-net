<?php
 
    $icerik = file_get_contents('https://site.com/kaynak.xml');
    $dosya = fopen('yeni.xml', 'w+');
    fwrite($dosya, '<?xml version="1.0" encoding="UTF-8"?>'.$icerik);
    fclose($dosya);
 
?>
