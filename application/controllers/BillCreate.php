<?php

class BillCreate extends HouseView {

    protected $form_errors = array();
    protected $members = null;

    protected function update_instance() {
        $this->accepts_json = true;
    }

    protected function before_action() {
        Utils::login_required();

        $this->title = 'New Bill';
        $this->context['nav'] = 'bills';
    }

    protected function get() {
        global $user;

        /* no json should be rendered on GET */
        $this->template_less = false;
        $this->json_response = false;

        $this->get_house();
        $this->context['members'] = $this->get_members();
    }

    protected function post() {
        global $user;

        $this->get_house();
        $this->context['members'] = $this->get_members();
        $usercosts_final = array();

        /* some default values are not needed here */
        if ($this->json_response) {
            unset($this->context['members']);
            unset($this->context['house']);
            unset($this->context['nav']);
        }

        $opt = isset($_POST['opt']) ? $_POST['opt'] : null;
        $cost = isset($_POST['cost']) ? $_POST['cost'] : null;
        $name = isset($_POST['name']) ? $_POST['name'] : null;
        $userselect = isset($_POST['userselect']) ? $_POST['userselect'] : null;
        $usercosts = isset($_POST['usercosts']) ? $_POST['usercosts'] : null;

        /* check for errors */
        if (empty($opt)) {
            array_push($this->form_errors, "You need to specify a correct option");
        }
        if (empty($cost)) {
            array_push($this->form_errors, "You need to include a valid amount");
        }
        if (empty($name)) {
            array_push($this->form_errors, "You need to provide a valid description");
        }
        if (empty($userselect)) {
            array_push($this->form_errors, "You need to select at least one member");
        }
        if (empty($usercosts)) {
            array_push($this->form_errors, "You need to include the user specific amounts");
        }

        /* no need to go further */
        if (sizeof($this->form_errors) > 0) {
            return;
        }

        if ($opt != 'select' && $opt != 'split') {
            array_push($this->form_errors, "Provide a correct option");
        }

        if ( !is_numeric($cost) || (is_numeric($cost) && $cost <= 0) ) {
            array_push($this->form_errors, "You need to specify a valid amount");
        }

        foreach ($userselect as $userid) {
            /* check that user has corresponding amount */
            $key = 'user-' . $userid . '-cost';
            if (!isset($usercosts[$key])) {
                array_push($this->form_errors, "The data has been tampered with, refresh the page and start over");
                break;
            }

            /* check that user exists */
            $u = UserModel::get_user($userid, false);
            if (!$u || gettype($u) != 'array') {
                array_push($this->form_errors, "A user you specified does not exist");
                break;
            }

            /* check specific amount */
            $user_cost = $usercosts[$key];
            if ( !is_numeric($user_cost) || (is_numeric($user_cost) && $user_cost <= 0) ) {
                array_push($this->form_errors, "Please specify correct ratios");
                break;
            }

            /* here we normalize the amount from floating point to integer to
            store in db */
            /* cost should have two digits after the decimal point so we x100 */
            $user_cost_norm = $user_cost * 100;

            /* add user and its cost to array */
            array_push($usercosts_final, array(
                'userid' => $u['id'], 'cost' => $user_cost_norm
            ));
        }

        /* return now if there are errors */
        if (sizeof($this->form_errors) > 0) {
            return;
        }

        /* at this point everything should be correct */

        /* normalize cost from floating point to integer to store in db */
        /* cost should have two digits after the decimal point so we x100 */
        $cost_norm = $cost * 100;

        /* create house bill */
        $new_bill_id = BillModel::create($name, $cost_norm, $this->house['id']);

        /* then create a specific user bill for each selected user */
        foreach ($usercosts_final as $user_cost_arr) {
            BillModel::create_user_bill($user_cost_arr['cost'], $user_cost_arr['userid'], $new_bill_id);
        }

        $this->context['billid'] = $new_bill_id;
        $this->context['billurl'] = Utils::url('h/' . $this->house["id"] . '/bills/' . $new_bill_id);

    }

    protected function after_action() {
        $this->context['messages'] = $this->form_errors;
        $this->context['success'] = sizeof($this->form_errors) == 0 ? true : false;

        /* so it looks good */
        sleep(1);
    }
}

?>
