<?php
$xml = simplexml_load_file('product_details.xml');
  $length=count($xml->item);
  for($i=0;$i<$length;$i++)
  {
  	echo $i." ";
  	echo $xml->item[$i]->name;
  	echo "<br>";
  }
?>