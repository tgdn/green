<?php

class HouseCreate extends Page {

    protected $form_errors = array();

    protected function before_action() {
        Utils::login_required();

        $this->title = 'New house';
        #$this->context['nav'] = 'dashboard';
    }

    protected function post() {
        global $user;

        $errors = false;
        $valid_emails = array(); /* emails of potential household members */
        $final_emails = array(); /* emails of final household members */

        /* name of future household */
        $name = isset($_POST['name']) ? $_POST['name'] : null;

        /* raw submitted emails */
        $emails = array(
            isset($_POST['email1']) ? $_POST['email1'] : null,
            isset($_POST['email2']) ? $_POST['email2'] : null,
            isset($_POST['email3']) ? $_POST['email3'] : null
        );

        if (empty($name)) {
            array_push($this->form_errors, 'You need to specify a name');
            return;
        }

        /* check for valid emails */
        foreach ($emails as $email) {
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                array_push($valid_emails, $email);
            }
        }

        /* at this point we have a name and emails to add */

        /* create house */
        $house_id = HouseModel::create($name);

        /* add current user to household */
        HouseModel::add_user_to_household($user->pk, $house_id);
        /* add other users */
        foreach ($valid_emails as $email) {
            /* get user from db */
            $u = UserModel::get_by_email($email)->fetchArray(SQLITE3_ASSOC);
            /* add if he exists */
            if ($u && gettype($u) == 'array') {
                HouseModel::add_user_to_household($u['id'], $house_id);
                array_push($final_emails, $email);
            }
        }

        $this->context['final_emails'] = $final_emails;
        $this->context['house_name'] = $name;

        /* redirect to the house */
        header('Location: ' . Utils::url('h/' . $house_id));
    }

}

?>
