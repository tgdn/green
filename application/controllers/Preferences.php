<?php

class Preferences extends Dashboard {

    protected function before_action() {
        Utils::login_required();

        $this->title = 'Preferences';
        $this->context['nav'] = 'preferences';
    }

    protected function get() {

    }

    protected function post() {

    }

}

?>
