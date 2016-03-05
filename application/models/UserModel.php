<?php

class UserModel {

    public static function get_user($uid, $password = true) {
        global $database;

        if ($password) {
            $sql = 'select
            id, full_name, email, password, created_at, last_login
            from users where id = :id limit 1';
        } else {
            $sql = 'select
            id, full_name, email, created_at, last_login
            from users where id = :id limit 1';
        }

        $st = $database->prepare($sql);

        $st->bindValue(':id', $uid, SQLITE3_INTEGER);
        $st = $st->execute();

        return $st->fetchArray(SQLITE3_ASSOC);
    }

    public static function update_login_date() {
        global $database, $user;

        $sql = "update users set last_login=datetime('now') where id = :id";
        $st = $database->prepare($sql);
        $st->bindValue(':id', $user->pk, SQLITE3_INTEGER);

        // return bool
        return $st->execute();
    }

    public static function get_by_email($email) {
        global $database;

        $sql = 'select
        id, email, full_name, created_at, last_login, password
        from users where email = :email limit 1';
        $st = $database->prepare($sql);
        $st->bindValue(':email', $email, SQLITE3_TEXT);

        return $st->execute();
    }

    public static function register($email, $name, $password) {
        global $database;

        $sql = 'insert into users
        (full_name, email, password, created_at, last_login)
        values
        (:full_name, :email, :password, datetime("now"), datetime("now"))';
        $st = $database->prepare($sql);

        $st->bindValue(':full_name', $name, SQLITE3_TEXT);
        $st->bindValue(':email', $email, SQLITE3_TEXT);
        $st->bindValue(':password', $password, SQLITE3_TEXT);

        return $st->execute();
    }

}

?>
