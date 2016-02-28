<?php

class Preferences extends HouseView {

    protected function before_action() {
        Utils::login_required();

        $this->title = 'Preferences';
        $this->context['nav'] = 'preferences';
    }

    protected function get() {
        $this->get_house();
    }

    protected function post() {

    }

}

?>
