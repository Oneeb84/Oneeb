<?php

error_reporting(0);
$ch = curl_init();
curl_setopt( $ch, CURLOPT_URL, 'http://www.bancalavorofitness.com/provincia/'.$_GET['lnk']);
curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true);

$content = curl_exec($ch);


$dom = new DOMDocument();
@$dom->loadHTML($content);


$finder = new DomXPath($dom);

$nodes  = $finder->query('//*[@class = "nome_cognome"]');
$lnk    = $finder->query('//*[@class = "autore_attributo"]');
$tlnk    = $finder->query('//*[@class = "autore_attributo"]/a');

$ii = 0;
$ilnk = 0;
//var_dump($lnk->item(2)->nodeValue);
//die();
if ($nodes->length > 0) {
    for($i=0;$i<$nodes->length;$i++){
       $ii++;
       //$emaillnk = $lnk->item($ilnk)->nodeValue;
       $flink = explode("=",$tlnk->item($ilnk)->getAttribute('href'));
       
       $fflink = explode(",",$flink[1]);
       $url_email = "http://www.bancalavorofitness.com/contenuti/popup/email.aspx?istruttore=".intval($fflink[0])."";
        $ch1 = curl_init();
       curl_setopt( $ch1, CURLOPT_URL, $url_email);
       curl_setopt( $ch1, CURLOPT_RETURNTRANSFER, true);

       $content_email = curl_exec($ch1);
        
       $dom = new DOMDocument();
        @$dom->loadHTML($content_email);

        
        $finder = new DomXPath($dom);

        $nodes_email  = $finder->query('//*[@name = "hf_email"]');
       $final_email = $dom->getElementById('hf_email')->getAttribute('value');
       echo 'Name : '.$nodes->item($i)->nodeValue.'<br>';
       echo 'Email : '. $final_email.'<br >';
       echo 'Facebook : '.$lnk->item($ii)->nodeValue.'<br><br>';
       //echo 'ID : '. $flink.'<br><br>';
       $ii++;
       $ilnk = $ilnk + 1;
    }
}

die();
?>