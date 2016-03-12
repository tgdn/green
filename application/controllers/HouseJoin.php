<?php

class HouseJoin extends Page {

    protected $form_errors = array();

    protected function update_instance() {
        $this->accepts_json = true;
    }

    protected function before_action() {
        Utils::login_required();

        $this->title = 'Join house';
    }

    protected function post() {
        global $user;

        $token = isset($_POST['token']) ? $_POST['token'] : null;

        if (empty($token) || strlen($token) != 20) {
            array_push($this->form_errors, 'Please provide a valid token');
            return;
        }

        $house = HouseModel::get_by_token($token);

        if (!$house || gettype($house) != 'array') {
            array_push($this->form_errors, 'The token seems invalid');
            return;
        }

        /* everything seems correct */
        if (!HouseModel::user_in_house($house['id'], $user->pk)) {
            /* add to household if not already in it */
            HouseModel::add_user_to_household($user->pk, $house['id']);
        }

        $redirect_url = Utils::url('h/' . $house['id']);

        if ($this->json_response) {
            $this->context['houseurl'] = $redirect_url;
        } else {
            /* redirect to the house */
            header('Location: ' . $redirect_url);
        }
    }

    protected function after_action() {
        $this->context['messages'] = $this->form_errors;
        $this->context['success'] = sizeof($this->form_errors) == 0 ? true : false;
    }

}

?>
