<?php

class HouseNotifications extends HouseView {

    protected function update_instance() {
        $this->accepts_json = true;
    }

    protected function before_action() {
        Utils::login_required();

        $this->title = 'Your notifications';
        $this->context['nav'] = 'notif';
    }

    protected function get() {
        global $user;

        $this->get_house();
        $this->context['notifications'] = NotificationModel::get_all_for_user_house($user->pk, $this->house['id']);
    }
}

?>
