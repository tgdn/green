<?php

class HouseDelete extends HouseView {

    protected $form_errors = array();

    protected function before_action() {
        Utils::login_required();

        $this->title = 'House Delete';
    }

    protected function get() {
        $this->get_house();
    }

    protected function post() {
        $this->get_house();

        # perform deletion
        HouseModel::delete($this->house['id']);

        # redirect
        header('Location: ' . Utils::url('dashboard'));
    }

}

?>
