<?php 

function sacar_url($direccion){

	$array = array();
	$url = file_get_contents($direccion);
	 
	$dom = new DOMDocument();
	@$dom->loadHTML($url);
	 
	$xpath = new DOMXPath($dom);
	$hrefs = $xpath->evaluate("/html/body//a");
	// $hrefs = $xpath->evaluate("/html/body//a[@class='basic']");

	for ($i = 0; $i < $hrefs->length; $i++) {
		$href = $hrefs->item($i);
		array_push($array,$href->getAttribute('href'));
	}
	
	return limpiar_array($array);
}


function limpiar_array($array){


	if(count($array)>0){

		for($i=0;$i<count($array);$i++){
			if(strpos($array[$i],"http://webcams.cumlouder.com/join/") === false){
				unset($array[$i]);
			}
		}
	}

	$array = array_unique($array);

	// return array_slice($array,0,20);
	return array_values($array);

}

// 246


//************************************************** SACAR INFO DE CHICAS

// $lista_webs = array();
// for ($i=1; $i <=247; $i++) { 
// 	array_push($lista_webs,"http://webcams.cumlouder.com/ajax/".$i."/");
// }

// $webs = array();

// for($i=0;$i<=246;$i++){
// 	$webs[$i]=sacar_url($lista_webs[$i]);
// }

// $file = fopen("chicas.txt","w");

// for($i=0;$i<count($webs);$i++){
// 	for($x=0;$x<count($webs[$i]);$x++){
// 		fwrite($file, $webs[$i][$x] . PHP_EOL);
// 	}
// }



// print_r($webs);

//************************************************** SACAR INFO DE CHICAS

$file = fopen("chicas.txt","r");

$array_chicas = array();

while(!feof($file)) {
	array_push($array_chicas,fgets($file));
}
fclose($file);

$array_chicas = array_values(array_unique($array_chicas));
asort($array_chicas);

// for($i=0;$i<count($array_chicas);$i++){
// 	if(strpos($array_chicas[$i],"ajax")!==false){
// 		unset($array_chicas[$i]);
// 	}
// }

print_r($array_chicas);

$file = fopen("chicas2.txt","w");

for($i=0;$i<count($array_chicas);$i++){
	fwrite($file,$array_chicas[$i] . PHP_EOL);
}
fclose($file);


?>