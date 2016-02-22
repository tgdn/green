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
    }

    public static function escape($str) {
        return htmlspecialchars(strip_tags($str));
    }

    public static function get_include($filename) {
        require VIEWS . 'includes' . DIRECTORY_SEPARATOR . $filename . '.php';
    }

}

?>
