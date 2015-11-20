CREATE TABLE IF NOT EXISTS users
(
	id INTEGER PRIMARY KEY,
	email TEXT NOT NULL,
	password TEXT NOT NULL,
	first_name TEXT NOT NULL,
	last_name TEXT NOT NULL,
	UNIQUE (email COLLATE NOCASE)
);

CREATE TABLE IF NOT EXISTS events
(
	id INTEGER PRIMARY KEY,
	name TEXT NOT NULL,
	image TEXT NOT NULL,
	creation_date DATETIME DEFAULT(DATETIME('now')),
	date DATETIME NOT NULL,
	description TEXT NOT NULL,
	type_id INTEGER REFERENCES types(id),
	user_id INTEGER REFERENCES users(id)
);

CREATE TABLE IF NOT EXISTS event_types
(
	id INTEGER PRIMARY KEY,
	type TEXT UNIQUE NOT NULL
);

DELETE FROM event_types;
INSERT INTO event_types(id,type) VALUES (1,'PARTY');
INSERT INTO event_types(id,type) VALUES (2,'BUSINESS');
INSERT INTO event_types(id,type) VALUES (3,'MEETING');
INSERT INTO event_types(id,type) VALUES (4,'CEREMONY');
INSERT INTO event_types(id,type) VALUES (5,'EDUCATIONAL');