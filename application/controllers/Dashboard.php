<?php

class Dashboard extends Page {

    protected function before_action() {
        Utils::login_required();

        $this->title = 'Dashboard';
        $this->context['nav'] = 'dashboard';
    }

    protected function get() {
        global $user;

        $houses = HouseModel::get_houses_for_user($user->pk);
        $h = $houses->fetchArray(SQLITE3_ASSOC);

        if ($h && gettype($h) == 'array') {
            $houses->reset();
            while ($house = $houses->fetchArray(SQLITE3_ASSOC)) {
                print_r($house);
                echo '<br>';
            }
        } else {
            header('Location: ' . Utils::url('h/create'));
        }
    }

}

?>
