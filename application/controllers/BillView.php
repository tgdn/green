<?php

class BillView extends HouseView {

    protected function before_action() {
        Utils::login_required();

        $this->title = 'View bill';
        $this->context['nav'] = 'bills';
    }

    protected function get() {
        $this->get_house();
        $this->get_bill();
    }

    protected function get_bill() {
        global $user, $page_request;

        $bill_id = $page_request['params']['billid'];
        $bill = BillModel::get_for_house($bill_id, $this->house['id'])->fetchArray(SQLITE3_ASSOC);

        if ($bill && gettype($bill) == 'array') {
            /* it exists */
            $this->context['bill'] = $bill;
            $this->context['user_bills'] = BillModel::get_userbills_for_bill($this->context['bill']['id']);
            $this->context['can_pay'] = BillModel::can_pay($bill['id'], $user->pk);
            if ($this->context['can_pay']) {
                $this->context['ubill'] = BillModel::get_user_bill_for_id($bill['id'], $user->pk);
            }
        } else {
            /* throw 404 if nothing was found
            this could be because the bill is not linked to this house */
            throw new Http404Exception();
        }
    }

}

?>
