<?php


class House implements JsonSerializable {

    private $id = null;
    private $name = null;
    private $created_at = null;
    private $modified_at = null;

    private $members = array();
    private $bills = array();

    public function __get($name) {
        return $this->$name;
    }

    public function jsonSerialize() {
        return array(
            'id' => $this->id,
            'name' => $this->name,
            'created_at' => $this->created_at,
            'modified_at' => $this->modified_at,
            'members' => $this->members,
            'bills' => $this->bills
        );
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

    protected function loadFromDbResult($db_result) {
        $this->id = $db_result['id'];
        $this->name = $db_result['name'];
        $this->created_at = $db_result['created_at'];
        $this->modified_at = $db_result['modified_at'];

        $users = HouseModel::get_users_for_house($this->id);
        while ($user = $users->fetchArray(SQLITE3_ASSOC)) {
            array_push($this->members, $user);
        }

        $bills = BillModel::get_bills_for_house($this->id);
        while ($bill = $bills->fetchArray(SQLITE3_ASSOC)) {
            array_push($this->bills, $bill);
        }
    }

    protected function loadFromID($house_id) {
        $db_query = HouseModel::get_house($house_id);
        $this->loadFromDbResult($db_query);
    }
}

?>
