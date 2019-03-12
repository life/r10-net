<?php
        if (isset($_GET['kontrol']) and !empty($_GET['kontrol'])){
 
            $array      =   explode("\n", file_get_contents('dosya.txt'));
 
            $kontrol    =   strip_tags($_GET['kontrol']);
            $final      =   $kontrol+10;
 
            if ($kontrol == 1){
                for ( $i = 0; $i < $final ; $i++ ){
                    echo $array[$i];
                    echo '<br>';
                }
            }else{
                for ( $i = $kontrol; $i < $final ; $i++ ){
                    echo $array[$i];
                    echo '<br>';
                }
            }
 
 
        }
 
?>
