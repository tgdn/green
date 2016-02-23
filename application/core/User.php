<?php


class BaseUser {

    private $pk = null;
    private $full_name = null;
    private $email = null;
    private $created_at = null;
    private $last_login = null;

    public function __get($name) {
        return $this->$name;
    }

    public static function fromID($uid) {
        $instance = new self();
        $instance->loadFromID($uid);
        return $instance;
    }

    protected function loadFromID($uid) {
        $db_query = UserModel::get_user($uid);
        UserModel::update_login_date($uid);
        $this->pk = $uid;
        $this->full_name = $db_query['full_name'];
        $this->email = $db_query['email'];
        $this->created_at = $db_query['created_at'];
        $this->last_login = $db_query['last_login'];

        // set instance variables here
    }

    public function is_authenticated() {
        global $user;
        if (array_key_exists('uid', $_SESSION) && !is_null($user)) {
            return ($_SESSION['uid'] == $user->pk);
        }
        return false;
    }

    public function is_anonymous() {
        return !$this->is_authenticated();
    }

    protected function verify_password($raw, $hash) {
        return password_verify($raw, $hash);
    }

    protected function hash_password($password) {
        return password_hash($password, PASSWORD_DEFAULT, ['cost' => 8]);
    }
}


class User extends BaseUser {

    public static function login($email, $raw_password) {
        global $database, $user;

        if ($user->is_authenticated()) {
            return true;
        }

        $password = $user->hash_password($raw_password);

        $result = UserModel::get_by_email($email)->fetchArray(SQLITE3_ASSOC);;

        if ($result && gettype($result) == 'array') {
            // found a match

            if ($user->verify_password($raw_password, $result['password'])) {
                /* passwords match */
                $uid = $result['id'];
                $user->loadFromID($uid);
                $_SESSION['uid'] = $uid;

                return true;
            }
        }

        return false;
    }

    public static function register($email, $name, $raw_password) {
        global $user;

        if ($user->is_authenticated()) {
            return false;
        }

        // do db stuff here
        /* at this point email is unique */
        $password = $user->hash_password($raw_password);
        $r = UserModel::register($email, $name, $password);

        // finally login user
        self::login($email, $raw_password);

        return true;
    }

}

?>
