<?php

class HouseNotificationsMarkRead extends HouseView {

    protected function update_instance() {
        $this->accepts_json = true;
        $this->json_response = true;
        $this->template_less = true;
    }

    protected function before_action() {
        Utils::login_required();
    }

    protected function get() {
        throw new Http404Exception();
    }

    protected function post() {

        if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
            global $page_request, $user;
            $this->get_house();
            unset($this->context['house']); // no need to have this

            $notif_id = $page_request['params']['notif_id'];

            $is_from_user = NotificationModel::belongs_to_user($notif_id, $user->pk);
            if (!$is_from_user) {
                $this->context['success'] = false;
                return; /* return now no need to throw anything */
            }

            /* mark notification as read */
            NotificationModel::mark_read($notif_id);

            $this->context['success'] = true;

            return;

        }
    }
}

?>
