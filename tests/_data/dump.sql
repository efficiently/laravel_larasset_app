CREATE TABLE messages (id integer not null primary key autoincrement, title varchar not null, body text not null, created_at datetime not null, updated_at datetime not null);
CREATE TABLE migrations (migration varchar not null, batch integer not null);
INSERT INTO migrations VALUES('2015_02_28_172810_create_messages_table', 1);
