<?php

class HouseMembers extends HouseView {


    protected function update_instance() {
        $this->accepts_json = true;
    }

    protected function before_action() {
        Utils::login_required();

        $this->title = 'House Members';
        $this->context['nav'] = 'members';
    }

    protected function get() {
        global $user;

        $this->get_house();
        $members = $this->get_members();

        if (!$this->json_response) {
            $this->context['members'] = $members;
        }
    }
}

?>
