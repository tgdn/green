<?php

class HouseMembersAdd extends HouseView {

    protected function update_instance() {
        $this->accepts_json = true;
    }

    protected function before_action() {
        Utils::login_required();

        $this->title = 'Add member';
        $this->context['nav'] = 'members';
    }

    protected function get() {
        global $user;

        $this->get_house();
    }

    protected function post() {
        global $user;
        $this->get_house();

        $valid_emails = array();
        $emails = isset($_POST['email']) ? $_POST['email'] : array();

        foreach($emails as $email) {
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                /* add if not already in array */
                if (!in_array($email, $valid_emails)) {
                    array_push($valid_emails, $email);
                }
            }
        }

        foreach ($valid_emails as $email) {
            /* get user from db */
            $u = UserModel::get_by_email($email)->fetchArray(SQLITE3_ASSOC);
            /* add if he exists */
            if ($u && gettype($u) == 'array') {
                /* add if the this user and current user are not the same
                and if the user is not already in the household */
                $user_in_house = HouseModel::user_in_house($this->house['id'], $u['id']);
                if ($user->pk != $u['id'] && !$user_in_house) {
                    HouseModel::add_user_to_household($u['id'], $this->house['id']);
                }
            }
        }

        header('Location: ' . Utils::url('h/' . $this->house['id'] . '/members'));
    }
}

?>
