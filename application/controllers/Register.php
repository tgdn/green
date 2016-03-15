<?php

class Register extends FormPage {

    protected $register_errors = array();

    protected function before_action() {
        Utils::anonymous_required();

        $this->title = "Register";
        $this->context['nav'] = 'register';
    }

    protected function get() {}

    protected function post() {
        /* allows for future implementation of
        multiple validations */
        $errors = false;

        $form = array(
            'email' => isset($_POST['email']) ? $_POST['email'] : '',
            'fn' => isset($_POST['fullname']) ? $_POST['fullname'] : '',
            'password' => isset($_POST['password']) ? $_POST['password'] : ''
        );

        /* do not query db if empty */
        foreach ($form as $key => $val) {
            if (empty($val)) {
                array_push($this->register_errors, 'All fields are required');
                return;
            }
        }

        /* at this point we have all fields */

        /* validate email */
        if (!$this->validate_email($form['email'])) {
            $errors = true;
        }

        if ($errors) {
            return;
        }

        /* do register */
        User::register(
            $form['email'], $form['fn'], $form['password']
        );
    }

    protected function validate_email($email) {

        /* check if true email */
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            array_push($this->register_errors, 'Please provide a valid email address');
            return false;
        }

        /* check if exists */
        $r = UserModel::get_by_email($email)->fetchArray(SQLITE3_ASSOC);

        if ($r && gettype($r) == 'array') {
            /* already exists */
            array_push($this->register_errors, 'This email address is already in use');
            return false;
        }
        return true;
    }

    protected function after_action() {
        // automatically redirect after registration
        Utils::anonymous_required();
    }
}

?>
