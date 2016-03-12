begin;

-- set foreign keys
PRAGMA foreign_keys = ON;

create table users (
    id integer NOT NULL PRIMARY KEY AUTOINCREMENT,
    email varchar(100) NOT NULL UNIQUE,
    full_name varchar(100) NOT NULL,
    password varchar(150) NOT NULL,

    created_at datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
    last_login datetime DEFAULT CURRENT_TIMESTAMP NOT NULL
);

create table houses (
    id integer NOT NULL PRIMARY KEY AUTOINCREMENT,
    name varchar(100) DEFAULT 'Household' NOT NULL,
    token varchar(20),

    created_at datetime default CURRENT_TIMESTAMP NOT NULL,
    modified_at datetime default CURRENT_TIMESTAMP NOT NULL
);

-- households link users and houses together
create table households (
    id integer NOT NULL PRIMARY KEY AUTOINCREMENT,
    user_id integer NOT NULL,
    house_id integer NOT NULL,

    created_at datetime default CURRENT_TIMESTAMP NOT NULL,

    FOREIGN KEY(user_id) REFERENCES users(id),
    FOREIGN KEY(house_id) REFERENCES houses(id)
);

-- bills are for each house
create table bills (
    id integer NOT NULL PRIMARY KEY AUTOINCREMENT,
    name varchar(100) NOT NULL,
    cost integer NOT NULL,
    paid boolean DEFAULT (0),
    house_id integer NOT NULL,

    created_by integer NOT NULL,
    created_at datetime default CURRENT_TIMESTAMP NOT NULL,

    FOREIGN KEY(created_by) REFERENCES users(id),
    FOREIGN KEY(house_id) REFERENCES houses(id)
);

create table user_bills (
    id integer NOT NULL PRIMARY KEY AUTOINCREMENT,
    cost integer NOT NULL,
    paid boolean DEFAULT (0),
    user_id integer NOT NULL,
    bill_id integer NOT NULL,

    created_at datetime default CURRENT_TIMESTAMP NOT NULL,
    modified_at datetime default CURRENT_TIMESTAMP NOT NULL,

    FOREIGN KEY(user_id) REFERENCES users(id),
    FOREIGN KEY(bill_id) REFERENCES bills(id)
);

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

create index users_emailindex on users(email);

create index houses_tokenindex on houses(token);

create index households_userindex on households(user_id);
create index households_houseindex on households(house_id);

create index bills_userindex on bills(created_by);
create index bills_houseindex on bills(house_id);

create index userbills_userindex on user_bills(user_id);
create index userbills_billindex on user_bills(bill_id);

create index notifications_userindex on notifications(user_id);
create index notifications_houseindex on notifications(house_id);
create index notifications_dateindex on notifications(created_at);

commit;
