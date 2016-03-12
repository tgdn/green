<?php

class Utils {

    public static function static_file($path) {
        return URL . 'static/' . $path;
    }

    public static function login_required() {
        global $user, $config;
        if (!$user->is_authenticated()) {
            // redirect
            header('Location: ' . $config['LOGIN_URL']);
        }
    }

    public static function anonymous_required() {
        global $user, $config;
        if (!$user->is_anonymous()) {
            header('Location: ' . $config['LOGIN_REDIRECT_URL']);
        }
    }

    public static function url($url) {
        return URL . $url;
        //return URL . 'public/index?url=' . $url;
    }

    public static function escape($str) {
        return htmlspecialchars(strip_tags($str), ENT_QUOTES, 'utf-8');
    }

    public static function get_include($filename) {
        require VIEWS . 'includes' . DIRECTORY_SEPARATOR . $filename . '.php';
    }

    public static function intword($n) {
        // first strip any formatting;
        $n = (0+str_replace(",","",$n));

        // is this a number?
        if(!is_numeric($n)) return 0;

        // now filter it;
        if($n>1000000000000) return round(($n/1000000000000),2).' trillion';
        else if($n>1000000000) return round(($n/1000000000),2).' billion';
        else if($n>1000000) return round(($n/1000000),2).' million';
        //else if($n>1000) return round(($n/1000),2).' K';

        return number_format($n, 2, '.', ',');
    }

}

?>
