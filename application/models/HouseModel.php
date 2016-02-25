<?php

class HouseModel {

    public static function get_house($id) {
        global $database;

        $sql = 'select * from houses where id = :id';

        $st = $database->prepare($sql);
        $st->bindValue(':id', $id, SQLITE3_INTEGER);
        $st = $st->execute();

        return $st->fetchArray(SQLITE3_ASSOC);
    }

    public static function get_houses_for_user($uid) {
        global $database;

        $sql = 'select
        houses.id, houses.name, houses.created_at, houses.modified_at
        from houses
        inner join households
            on houses.id = households.house_id
        where households.user_id = :uid';

        $st = $database->prepare($sql);
        $st->bindValue(':uid', $uid, SQLITE3_INTEGER);

        return $st->execute();
    }

    public static function get_users_for_house($id) {
        global $database;

        $sql = 'select * from users
        inner join households
            on users.id = households.user_id
        where households.house_id = :house_id';

        $st = $database->prepare($sql);
        $st->bindValue(':house_id', $id, SQLITE3_INTEGER);

        return $st->execute();
    }

    public static function create($name) {
        global $database;

        $sql = 'insert into houses (name) values (:name)';

        $st = $database->prepare($sql);
        $st->bindValue(':name', $name, SQLITE3_TEXT);
        $st->execute();

        // get newly created house id
        $house_id = $database->get_db()->lastInsertRowID();

        // return house id for further manipulation
        return $house_id;
    }

    public static function add_user_to_household($uid, $house_id) {
        global $database;

        $sql = 'insert into households
        (user_id, house_id) values (:uid, :house_id)';

        $st = $database->prepare($sql);
        $st->bindValue(':uid', $uid, SQLITE3_INTEGER);
        $st->bindValue(':house_id', $house_id, SQLITE3_INTEGER);
        $st->execute();

        return true;
    }

    public static function remove_user_from_household($uid, $house_id) {
        global $database;

        $sql = 'delete from households
        where user_id = :uid and house_id = :house_id';

        $st = $database->prepare($sql);
        $st->bindValue(':user_id', $uid, SQLITE3_INTEGER);
        $st->bindValue(':house_id', $house_id, SQLITE3_INTEGER);

        return $st->execute();
    }

}

?>
