CREATE TABLE users
(
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    # user’s id also table’s primary key
username VARCHAR(100),
    # user’s username
role VARCHAR(100),
    # manager or employee
 password VARCHAR(200),
    # user’s password
 salt VARCHAR(32)
);
#the salt has been used in order to encode/decode the password

CREATE TABLE logging
(
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    uid INT(11),
    # user’s id as foreign key of users’ id
fails INT(11),
    #   counter of fails
last_try DATE,
    #   the last date of the fail login
last_update DATE,
    #   the last date from the password’s update
FOREIGN KEY(uid) REFERENCES users(id)
);

CREATE TABLE vacation_request
(
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    uid INT(11),
    # user’s id as foreign key of users’ id
    date_from DATE,
    #   the initialization date of the vacation
    date_to DATE,
    #   the last date of the vacation
    FOREIGN KEY(uid) REFERENCES users(id)
);

