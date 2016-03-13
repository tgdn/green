<?php

class Logout extends Page {

    protected function update_instance() {
        $this->template_less = true;
    }

    protected function before_action() {
        Utils::login_required();
    }

    protected function get() {
        global $user, $config;

        // destroy session and current user
        $user = null;

        // Unset all of the session variables.
        $_SESSION = array();

        // If it's desired to kill the session, also delete the session cookie.
        // Note: This will destroy the session, and not just the session data!
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }
        session_unset();
        session_destroy();

        // redirect
        header('Location: ' . $config['LOGIN_URL']);
    }
}

?>
