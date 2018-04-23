/* TODO: create tables */
BEGIN TRANSACTION;

CREATE TABLE `users` (
	`id`	INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
	`username`	TEXT NOT NULL,
	`password`	TEXT NOT NULL,
	`session`	TEXT UNIQUE
);

CREATE TABLE `photos` (
	`id`	INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
	`photo_name`	TEXT NOT NULL,
	`ext`	TEXT NOT NULL,
	`description`	TEXT,
	`author_id`	INTEGER NOT NULL,
	FOREIGN KEY(`author_id`) REFERENCES `users`(`id`)
);


CREATE TABLE `tags` (
	`id`	INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
	`tag_name`	TEXT NOT NULL UNIQUE,
	`author_id`	INTEGER NOT NULL,
	FOREIGN KEY(`author_id`) REFERENCES `users`(`id`)
);

CREATE TABLE `tag_photo` (
	`id`	INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
	`tag_id`	INTEGER NOT NULL,
	`photo_id`	INTEGER NOT NULL,
	FOREIGN KEY(`tag_id`) REFERENCES `tags`(`id`),
	FOREIGN KEY(`photo_id`) REFERENCES `photos`(`id`)
);
/* TODO: initial seed data */
INSERT INTO users (username, password) VALUES ('tim', '$2y$10$ysrT34K8hL7puwOwmmQ4xO67O40TL/GyxCXcNN30YVLsesS5LgcQ2'); /*password:info2300*/
INSERT INTO users (username, password) VALUES ('abby', '$2y$10$jpIQS9qhXGMEF9OSRhdQ6.GYVnZrDn3tSLrPlp1GYm6t6.pTl9fGq'); /*password:nba5301*/
INSERT INTO photos (photo_name, ext, description,author_id) VALUES ('facebook.png', 'png', 'facebook', '2');
INSERT INTO photos (photo_name, ext, description,author_id) VALUES ('linkedin.png', 'png', 'linkedin', '2');
INSERT INTO photos (photo_name, ext, description,author_id) VALUES ('weibo.png', 'png', 'weibo', '2');
INSERT INTO photos (photo_name, ext, description,author_id) VALUES ('google_drive.png', 'png', 'google drive', '2');
INSERT INTO photos (photo_name, ext, description,author_id) VALUES ('gmail.png', 'png', 'gmail', '2');
INSERT INTO photos (photo_name, ext, description,author_id) VALUES ('google.png', 'png', 'google', '2');
INSERT INTO photos (photo_name, ext, description,author_id) VALUES ('eevee.png', 'png', 'pokemon', '1');
INSERT INTO photos (photo_name, ext, description,author_id) VALUES ('jigglypuff.png', 'png', 'pokemon', '1');
INSERT INTO photos (photo_name, ext, description,author_id) VALUES ('pikachu.png', 'png', 'pokemon','1');
INSERT INTO photos (photo_name, ext, description,author_id) VALUES ('pokeball.png', 'png', 'pokemon','1');
INSERT INTO tags (tag_name, author_id) VALUES ('flow icon', '2');
INSERT INTO tags (tag_name, author_id) VALUES ('google', '2');
INSERT INTO tags (tag_name, author_id) VALUES ('social media','2');
INSERT INTO tags (tag_name, author_id) VALUES ('game', '1');
INSERT INTO tags (tag_name, author_id) VALUES ('pokemon','1');
INSERT INTO tags (tag_name, author_id) VALUES ('cartoon','1');
INSERT INTO tag_photo (tag_id, photo_id) VALUES ('1','1');
INSERT INTO tag_photo (tag_id, photo_id) VALUES ('1','2');
INSERT INTO tag_photo (tag_id, photo_id) VALUES ('1','3');
INSERT INTO tag_photo (tag_id, photo_id) VALUES ('1','4');
INSERT INTO tag_photo (tag_id, photo_id) VALUES ('1','5');
INSERT INTO tag_photo (tag_id, photo_id) VALUES ('1','6');
INSERT INTO tag_photo (tag_id, photo_id) VALUES ('2','4');
INSERT INTO tag_photo (tag_id, photo_id) VALUES ('2','5');
INSERT INTO tag_photo (tag_id, photo_id) VALUES ('2','6');
INSERT INTO tag_photo (tag_id, photo_id) VALUES ('3','1');
INSERT INTO tag_photo (tag_id, photo_id) VALUES ('3','2');
INSERT INTO tag_photo (tag_id, photo_id) VALUES ('3','3');
INSERT INTO tag_photo (tag_id, photo_id) VALUES ('4','7');
INSERT INTO tag_photo (tag_id, photo_id) VALUES ('4','8');
INSERT INTO tag_photo (tag_id, photo_id) VALUES ('4','9');
INSERT INTO tag_photo (tag_id, photo_id) VALUES ('4','10');
INSERT INTO tag_photo (tag_id, photo_id) VALUES ('5','7');
INSERT INTO tag_photo (tag_id, photo_id) VALUES ('5','8');
INSERT INTO tag_photo (tag_id, photo_id) VALUES ('5','9');
INSERT INTO tag_photo (tag_id, photo_id) VALUES ('5','10');
INSERT INTO tag_photo (tag_id, photo_id) VALUES ('6','7');
INSERT INTO tag_photo (tag_id, photo_id) VALUES ('6','8');
INSERT INTO tag_photo (tag_id, photo_id) VALUES ('6','9');
INSERT INTO tag_photo (tag_id, photo_id) VALUES ('6','10');

COMMIT;
