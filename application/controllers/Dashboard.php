<?php

class Dashboard extends Page {

    protected function before_action() {
        Utils::login_required();

        $this->title = 'Dashboard';
        $this->context['nav'] = 'dashboard';
    }

    protected function get() {
        global $user;

        $house_count = HouseModel::count_houses_for_user($user->pk);

        if ($house_count == 0) {
            // redirect to create house if none
            header('Location: ' . Utils::url('h/create'));
        } else if ($house_count == 1) {
            /* redirect to house if the user only has one
            get id from db and redirect */
            $house_id = HouseModel::get_houses_for_user($user->pk)->fetchArray(SQLITE3_ASSOC)['id'];
            header('Location: ' . Utils::url('h/' . $house_id));
        }

        $houses = HouseModel::get_houses_for_user($user->pk);

        /* setup context */
        $this->context['houses'] = $houses;
        $this->context['house_count'] = $house_count;
    }

}

?>
