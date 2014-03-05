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

?>
