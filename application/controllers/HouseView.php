<?php

class HouseView extends Page {

    protected $house;
    protected $members10;

    protected function update_instance() {
        $this->accepts_json = true;
    }

    protected function before_action() {
        Utils::login_required();

        $this->title = 'View house';
    }

    protected function get() {
        $this->get_house();
        $this->get_context();
    }

    protected function get_house() {
        global $user, $page_request;

        $house_id = $page_request['params']['id'];
        $house = HouseModel::get_house_for_user($user->pk, $house_id)->fetchArray(SQLITE3_ASSOC);

        if ($house && gettype($house) == 'array') {
            /* it exists */
            $this->house = $house;
            $this->context['house'] = House::fromDbResult($house);
            $this->members10 = HouseModel::get_users_for_house($house_id, 10);

            $this->context['notifications_count'] = NotificationModel::count_notifications_for_user_house($user->pk, $house['id']);
        } else {
            /* throw 404 if nothing was found
            this could be because user is not part of the household */
            throw new Http404Exception();
        }
    }

    protected function get_members() {
        if ($this->house != null) {
            return HouseModel::get_users_for_house($this->house['id']);
        }
        return null;
    }

    protected function get_context() {
    }

}

?>
