<?php defined('SYSPATH') or die('No direct script access.');

class Date extends Kohana_Date {

    public static function time2string($timeline) {
        $periods = array('d' => 86400, 'h' => 3600, 'm' => 60, 's' => 1);
        $ret = '';
        
        foreach($periods AS $name => $seconds){
            $num = floor($timeline / $seconds);
            if ($num > 0) {
                return trim($num.$name.' ago');
            }
            $timeline -= ($num * $seconds);
            $ret .= $num.' '.$name.(($num > 1) ? 's' : '').' ';
            
        }

        return trim('just now');
    }

}
