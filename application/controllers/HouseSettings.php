<?php

class HouseSettings extends HouseView {

    protected $form_errors = array();

    protected function before_action() {
        Utils::login_required();

        $this->title = 'House Settings';
        $this->context['nav'] = 'prefs';
    }

    protected function get() {
        $this->get_house();
    }

    protected function post() {
        $this->get();

        /* get name in post */
        $name = isset($_POST['name']) ? $_POST['name'] : null;

        if (empty($name)) {
            array_push($this->form_errors, 'You need to specify a name');
            return;
        }

        /* at this point everything is correct */
        HouseModel::update($this->house['id'], $name);

        // we need to update our house instance
        $this->get_house();
    }

}

?>
