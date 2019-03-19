<?php

        $content        =   file_get_contents('http://192.168.1.106/project-test/xml_edit/xml/kaynak.xml');
        $xml            =   simplexml_load_string($content) or die("Error: Cannot create object");
        $imageurlhome   =   'https://www.siteniz.com/resimler/';
        $percent        =   '20';
        $finalarray     =   array('result'=>'true');
        foreach ($xml->data->row as $row){

            $imageurl       =   $row->stok_resim_url;

            $re = '/[\w-]+.(jpg|png|jpeg)/';
            preg_match_all($re, $imageurl, $matches, PREG_SET_ORDER, 0);

            $newimageurl    =   'resimler/'.$matches[0][0];

            copy($imageurl,$newimageurl);

            $row->stok_resim_url    =   $imageurlhome.$matches[0][0];
            $oldpriece              =   $row->fiyat;
            $onepercent             =   ($oldpriece*$percent)/100;
            $newpriece              =   $oldpriece+$onepercent;
            $row->fiyat             =   $newpriece;

            array_push($finalarray,array('row'=>$row));
        }

       function array_to_xml( $data, $xml_data ) {
           foreach ($data as $rows){
               $xml_data->addChild('',htmlspecialchars( row($rows,$xml_data) ) );
            }
        }

        function row($rows,$xml_data){
            foreach( $rows as $key => $value ) {
                if( is_numeric($key) ){ $key = 'item'.$key; }
                if( is_array($value) ) {
                    $subnode = $xml_data->addChild($key);
                    array_to_xml($value, $subnode);
                } else {
                    $xml_data->addChild("$key",htmlspecialchars("$value"));
                }
            }
        }

        $xml_data = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><response></response>');

        row($finalarray,$xml_data);


        $result = $xml_data->asXML('/var/www/html/project-test/xml_edit/xml/final.xml');

?>
