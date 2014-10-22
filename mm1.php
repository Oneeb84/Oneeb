<?php


$ch = curl_init();
curl_setopt( $ch, CURLOPT_URL, 'http://www.bancalavorofitness.com/province/tutte');
curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true);

$content = curl_exec($ch);


$dom = new DOMDocument();
@$dom->loadHTML($content);


$finder = new DomXPath($dom);

$nodes  = $finder->query('//*[@class = "provincia"]');

//var_dump($nodes->length);

if ($nodes->length > 0) {
    for($i=0;$i<5;$i++){
        
        ?>
        <a href="mm2.php?lnk=<?php echo $nodes->item($i)->nodeValue;?>"><?php echo $nodes->item($i)->nodeValue;?></a><br />
        <?php
    }
}



?>