<?php

class HouseMembers extends HouseView {


    protected function before_action() {
        Utils::login_required();

        $this->title = 'House Members';
        $this->context['nav'] = 'members';
    }

    protected function get() {
        $this->get_house();

        $this->context['members'] = HouseModel::get_users_for_house($this->house['id']);
    }

}

?>
