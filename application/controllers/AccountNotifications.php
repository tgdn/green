<?php

class AccountNotifications extends Account {

    protected function before_action() {
        Utils::login_required();

        $this->title = 'Account Password';
        $this->context['nav'] = 'account';
        $this->context['subnav'] = 'password';
    }

    protected function post() {
        global $user;

        $oldpass = isset($_POST['oldpass']) ? $_POST['oldpass'] : null;
        $password1 = isset($_POST['password1']) ? $_POST['password1'] : null;
        $password2 = isset($_POST['password2']) ? $_POST['password2'] : null;

        if (empty($oldpass) || empty($password1) || empty($password2)) {
            array_push($this->form_errors, "All fields are required");
            return;
        }

        $correct_oldpass = $user->instance_verify_password($oldpass);
        if (!$correct_oldpass) {
            array_push($this->form_errors, "Your current password did not match");
            return;
        }

        if (strcmp($password1, $password2) !== 0) {
            array_push($this->form_errors, "Both passwords do not match");
            return;
        }

        /* if everything is fine, update */
        UserModel::set_password($user->pk, $password1);
    }

}

?>
