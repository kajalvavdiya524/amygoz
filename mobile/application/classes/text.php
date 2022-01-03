<?php defined('SYSPATH') or die('No direct script access.');

class Text extends Kohana_Text {

    public static function parse_text($post, $show_url = true) { // Disclaimer: This "URL plucking" regex is far from ideal.
        $pattern = "/(http:\/\/|ftp:\/\/|https:\/\/|www\.)([^\s,]*)/i";
        if($show_url) {
            $replace='Text::handle_URL_callback';
        } else {
            $replace='Text::handle_URL_callback_no';
        }
        return preg_replace_callback($pattern,$replace, $post);
    }

    public static function handle_URL_callback($matches) { 
        // preg_replace_callback() is passed one parameter: $matches.
        $url = $matches[0];
        if (preg_match('/^(http:\/\/|ftp:\/\/|https:\/\/)/i', $url) !== 1) {
            $url = 'http://'.$url;
        }

        $str = '<a href="'. $url .'" target="_blank">'. $matches[0] .'</a>';
        if (preg_match('/\.(?:jpe?g|png|gif)(?:$|[?#])/', $matches[0])) { 
        // This is an image if path ends in .GIF, .PNG, .JPG or .JPEG.
            $str .= '<span class="image padTopBottom5"><a href="'. $url .'" class="img-pop">'.'<img src="'. $matches[0] .'"></a></span>';
        } // Otherwise handle as NOT an image.
        
        return $str;
    }

    public static function handle_URL_callback_no($matches) { 
        // preg_replace_callback() is passed one parameter: $matches.
        $url = $matches[0];
        if (preg_match('/^(http:\/\/|ftp:\/\/|https:\/\/)/i', $url) !== 1) {
            $url = 'http://'.$url;
        }

        $str = '';
        if (preg_match('/\.(?:jpe?g|png|gif)(?:$|[?#])/', $matches[0])) { 
        // This is an image if path ends in .GIF, .PNG, .JPG or .JPEG.
            $str = '<span class="image padTopBottom5"><a href="'. $url .'" class="img-pop">'.'<img src="'. $matches[0] .'"></a></span>';
        } // Otherwise handle as NOT an image.
        
        return $str;
    }

    public static function get_url_contents($url){
        $ch = curl_init ();
        $timeout = 5;
        curl_setopt ($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_USERAGENT, Request::$user_agent);
        curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        $response = curl_exec ($ch);
        curl_close($ch);
        
        return $response;
    }
}
