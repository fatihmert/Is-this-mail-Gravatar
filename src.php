<?php

function is_gravatar($eposta) {
        $url = 'http://www.gravatar.com/';
        $url .= md5( strtolower(trim($eposta)));
		
	$icerik = get_headers($url);
	if($icerik[21] == "Location: /profiles/no-such-user"){
		return false;
	}else{
		return true;
	}
    }
    
//cUrl version, more fast

function is_gravatar($eposta) {
        $url = 'http://www.gravatar.com/';
        $url .= md5( strtolower(trim($eposta)));
		
	$curl = curl_init();
	curl_setopt_array( $curl, array(
		CURLOPT_HEADER => true,
		CURLOPT_NOBODY => true,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_CUSTOMREQUEST => 'GET',
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_URL => $url ) );
	$headers = explode("\n", curl_exec( $curl ));
	$link = curl_getinfo($curl, CURLINFO_EFFECTIVE_URL);
	
	if(preg_match("#no-such-user#",$link)){
		return false;
	}else{
		return true;
	}
	curl_close($curl);
}

?>
