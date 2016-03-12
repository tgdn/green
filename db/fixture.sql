create table notifications (
    id integer NOT NULL PRIMARY KEY AUTOINCREMENT,
    user_id integer NOT NULL,
    house_id integer NOT NULL,
    pending boolean DEFAULT (1),

    name varchar(100) NOT NULL,
    message text,

    source_table varchar(50),
    source_id integer,

    created_at datetime default CURRENT_TIMESTAMP NOT NULL,

    FOREIGN KEY(user_id) REFERENCES users(id),
    FOREIGN KEY(house_id) REFERENCES houses(id)
);

create index notifications_userindex on notifications(user_id);
create index notifications_houseindex on notifications(house_id);
create index notifications_dateindex on notifications(created_at);
