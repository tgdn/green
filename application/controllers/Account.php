<?php

class Account extends Page {

    protected $form_errors = array();

    protected function update_instance() {
        $this->accepts_json = true;
    }

    protected function before_action() {
        Utils::login_required();

        $this->title = 'Account';
        $this->context['nav'] = 'account';
        $this->context['subnav'] = 'profile';
    }

    protected function post() {
        global $user;

        $full_name = isset($_POST['fname']) ? $_POST['fname'] : null;
        $email = isset($_POST['email']) ? $_POST['email'] : null;

        if (empty($full_name) || empty($email)) {
            array_push($this->form_errors, "Both your name and email are required");
            return;
        }

        /* now check email */
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            array_push($this->form_errors, "Please provide a valid email");
            return;
        }

        /* check email uniqueness */
        $u = UserModel::get_by_email($email, $user->email)->fetchArray(SQLITE3_ASSOC);;
        if ($u && gettype($u) == 'array') {
            array_push($this->form_errors, "This email is already in use");
            return;
        }

        /* if everything is fine, update */
        UserModel::update($user->pk, $email, $full_name);
    }

    protected function after_action() {
        /* make sure we catch latest changes */
        $this->authenticate_user();

        if ($this->json_response) {
            $this->context['messages'] = $this->form_errors;
            $this->context['success'] = sizeof($this->form_errors) == 0 ? true : false;
        }
    }

}

?>
