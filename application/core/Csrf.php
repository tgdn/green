<?php

class Csrf {

    public static function generate() {
        if (function_exists("hash_algos") && in_array("sha512", hash_algos())) {
            $token = hash("sha512", mt_rand(0, mt_getrandmax()));
        } else {
            $token = ' ';
            for ($i = 0; $i < 128; ++$i) {
                $r = mt_rand(0, 35);

                if ($r < 26) {
                    $c = chr(ord('a') + $r);
                } else {
                    $c = chr(ord('0') + $r - 26);
                }
                $token .= $c;
            }
        }
        $_SESSION['csrf_token'] = $token;
        return $token;
    }

    public static function get_token($force_refresh = false) {
        if (isset($_SESSION['csrf_token']) && !$force_refresh) {
            return $_SESSION['csrf_token'];
        } else {
            return self::generate();
        }
    }

    public static function validate($provided) {
        /* we can exit now */
        if ($provided == null) return false;

        $token = self::get_token();

        if ($provided === $token) {
            $r = true;
        } else {
            $r = false;
        }

        /* no need to keep the token */
        $_SESSION['csrf_token'] = '';
        unset($_SESSION['csrf_token']);

        /* unset cookie as well */
        if (isset($_COOKIE['csrf_token'])) {
            unset($_COOKIE['csrf_token']); /* unset */
            setcookie('csrf_token', null, time() - 3600); /* set to past */
        }

        return $r;
    }

}

?>
