<?php

class HouseMembersRemove extends HouseView {

    protected function update_instance() {
        $this->accepts_json = false;
    }

    protected function before_action() {
        Utils::login_required();

        $this->title = 'Remove member';
        $this->context['nav'] = 'members';
    }

    protected function check_user() {
        global $user, $page_request;
        $user_id = $page_request['params']['userid'];

        $user_in_house = HouseModel::user_in_house($this->house['id'], $user_id);

        if (!$user_in_house) {
            throw new Http404Exception;
        } else {
            $this->context['member'] = UserModel::get_user($user_id, false);
        }
    }

    protected function get() {
        global $user;

        $this->get_house();
        $this->check_user();
    }

    protected function post() {
        global $user;
        $this->get();

        if (!isset($_POST['remove_confirmation'])) {
            return;
        }

        $house_users_count = HouseModel::count_users_for_house($this->house['id']);

        /* are you the only one left ? */
        if ($house_users_count == 1) {
            /* you can't leave your own house - delete it instead */
            // TODO add error message
            return;
        }

        /* proceed to household deletion */
        HouseModel::remove_user_from_household($this->context['member']['id'], $this->house['id']);

        /* was this yourself ? */
        if ($this->context['member']['id'] == $user->pk) {
            /* then redirect to dashboard */
            header('Location: ' . Utils::url('dashboard'));
        } else {
            /* otherwise simply redirect to members' list */
            header('Location: ' . Utils::url('h/' . $this->house['id'] . '/members'));
        }
    }
}

?>
