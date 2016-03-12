<?php


class Bill implements JsonSerializable {

    private $data;

    private $user_bills = array();

    public function __get($name) {
        /* avoid errors */
        return isset($this->data[$name]) ? $this->data[$name] : null;
    }

    public function jsonSerialize() {
        return $this->data;
    }

    public static function fromID($house_id) {
        $instance = new self();
        $instance->loadFromID($house_id);
        return $instance;
    }

    public static function fromDbResult($db_result) {
        $instance = new self();
        $instance->loadFromDbResult($db_result);
        return $instance;
    }

    public static function array_from_db_result($sqlite_result) {
        $arr = array();
        while ($bill = $sqlite_result->fetchArray(SQLITE3_ASSOC)) {
            array_push($arr, Bill::fromDbResult($bill));
        }
        return $arr;
    }

    protected function loadFromDbResult($db_result) {
        $this->data = $db_result;

        $user_bills = BillModel::get_user_bills_for_id($db_result['id']);
        while ($user_bill = $user_bills->fetchArray(SQLITE3_ASSOC)) {
            array_push($this->user_bills, $user_bill);
        }

        $this->data['user_bills'] = $this->user_bills;
    }

    protected function loadFromID($id) {
        $db_query = BillModel::get($id);
        $this->loadFromDbResult($db_query);
    }
}

?>
