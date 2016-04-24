<?php

/**
 * Class containing common functions
 */
class F
{

    public static $CURRENT_PAGE;

    public static function HEAD($head)
    {
        if(isset(self::$CURRENT_PAGE))
        {
            echo str_replace("data-m9-link-name=\"".self::$CURRENT_PAGE."\"","class=\"current\"", $head);
        } else {
            echo $head;
        }
    }

    public static function Token($len) {
		if(function_exists('openssl_random_pseudo_bytes')) {
			$token = base64_encode(openssl_random_pseudo_bytes($len,$strong));
			if($strong==TRUE)
				return strtr(substr($token,0,$len),'+/=','AVM');
		} else {
			$chars = '0123456789';
			$chars.= 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz/+';
			$charsLen = strlen($chars)-1;
			$token = '';
			for($i=0;$i<$len;$i++) {
				$token.= $chars[mt_rand(0,$charsLen)];
			}
			return $token;
		}
	}

}
