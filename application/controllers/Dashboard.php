<?php

class Dashboard extends Page {

    protected function before_action() {
        Utils::login_required();

        $this->title = 'Dashboard';
        $this->context['nav'] = 'dashboard';
    }

    protected function get() {
        
    }

}

?>
