CREATE TABLE messages (id integer not null primary key autoincrement, title varchar not null, body text not null, created_at datetime not null, updated_at datetime not null);
CREATE TABLE migrations (migration varchar not null, batch integer not null);
INSERT INTO migrations VALUES('2014_07_16_152623_create_messages_table', 1);
