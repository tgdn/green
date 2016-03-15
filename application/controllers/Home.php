<?php

class Home extends FormPage {

    protected $login_errors = array();

    protected function before_action() {
        Utils::anonymous_required();

        $this->title = "Home";
        $this->context['nav'] = 'home';
    }

    protected function post() {
        global $user;

        $email = isset($_POST['email']) ? $_POST['email'] : '';
        $raw_pass = isset($_POST['password']) ? $_POST['password'] : '';

        if (empty($email) || empty($raw_pass)) {
            array_push($this->login_errors, 'All fields are required');
            return;
        }

        // try to log user in
        $r = User::login($email, $raw_pass);

        if (!$r) {
            array_push($this->login_errors, "Incorrect email or password");
        }
    }

    protected function after_action() {
        // automatically redirect after login
        Utils::anonymous_required();
    }
}

?>
