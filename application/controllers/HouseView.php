<?php

class HouseView extends Page {

    protected $house;

    protected function before_action() {
        Utils::login_required();

        $this->title = 'View house';
    }

    protected function get() {
        $this->get_house();
        $this->get_context();
    }

    protected function get_house() {
        global $user, $page_request;

        $house_id = $page_request['params']['id'];
        $house = HouseModel::get_house_for_user($user->pk, $house_id)->fetchArray(SQLITE3_ASSOC);

        if ($house && gettype($house) == 'array') {
            /* it exists */
            $this->house = $house;
        } else {
            /* throw 404 if nothing was found
            this could be because user is not part of the household */
            throw new Http404Exception();
        }
    }

    protected function get_context() {
    }

}

?>
