<?php

class BillViewPay extends HouseView {

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

            $bill_id = $page_request['params']['ubillid'];

            $ubill = BillModel::get_user_bill_for_id($bill_id, $user->pk);

            if ($ubill && gettype($ubill) == 'array') {
                $this->context['success'] = true;
                BillModel::pay_user_bill($ubill['id']);
                return; /* return now no need to throw anything */
            }

            $this->context['success'] = false;
        }
    }

}

?>
