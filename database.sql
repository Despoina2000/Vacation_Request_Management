CREATE TABLE users
(
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    # user’s id also table’s primary key
username VARCHAR(100) NOT NULL,
    # user’s username
name VARCHAR(100) NOT NULL,
surname VARCHAR(100) NOT NULL,
role ENUM('manager', 'employee', 'other') NOT NULL,
    # manager/employee/other
 password VARCHAR(200) NOT NULL,
    # user’s password
);


CREATE TABLE logging
(
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    uid INT(11),
    # user’s id as foreign key of users’ id
fails INT(11) DEFAULT 0,
    #   counter of fails
last_try DATE,
    #   the last date of the fail login
last_update DATE,
    #   the last date from the password’s update
FOREIGN KEY(uid) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE vacation_requests
(
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    uid INT(11),
    # user’s id as foreign key of users’ id
    date_from DATE NOT NULL ,
    #   the initialization date of the vacation
    date_to DATE NOT NULL,
    #   the last date of the vacation
    reason VARCHAR(200) NOT NULL,
    is_approved BOOLEAN DEFAULT null,
    FOREIGN KEY(uid) REFERENCES users(id) ON DELETE CASCADE
);

