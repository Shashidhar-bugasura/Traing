-- 1. Create Database 
create Database facebookdb;

-- 2. Use Database
use facebookdb;

-- 3. Create Table
create table tUser(
    user_id int(11) PRIMARY KEY,
    name varchar(50) NOT NULL,
    email_id varchar(50) NOT NULL,
    password varchar(50) NOT NULL,
    address varchar(100) NULL,
    phone bigint(18) NULL 
);

create table tFriends(
    user_id int(11) NOT NULL,
    friend_id int(11) NOT NULL,
    FOREIGN KEY (user_id) REFERENCES tUser(user_id),
    FOREIGN KEY (friend_id) REFERENCES tUser(user_id)
);

create table tWall(
    user_id int(11) NOT NULL,
    posting_date datetime DEFAULT CURRENT_TIMESTAMP,
    post varchar(200) NOT NULL,
    FOREIGN KEY (user_id) REFERENCES tUser(user_id)
);

-- 4. Insert Data
insert into tUser values(1, 'John Doe','john.doe@example.com','johndoe123','123 Main St, Anytown, USA', 1234567890);
insert into tUser values(2, 'Jane mark','jane.mark@example.com','janemark456','456 Elm St, Othertown, USA', 9876543210);
insert into tUser values(3, 'Alice Johnson','alice.johnson@example.com','alicejohnson789','789 Oak St, Sometown, USA', 5555555555);
insert into tUser values(4, 'Bob Brown','bob.brown@example.com','bobbrown321','321 Pine St, Anycity, USA', 4444444444);
insert into tUser values(5, 'Charlie Davis','charlie.davis@example.com','charliedavis654','654 Maple St, Othercity, USA', 3333333333);

insert into tFriends values(1, 2);
insert into tFriends values(1, 3);
insert into tFriends values(1, 4);
insert into tFriends values(2, 4);
insert into tFriends values(3, 5);
insert into tFriends values(4, 2);
insert into tFriends values(4, 5);

insert into tWall values(1, NOW(), 'Hello, this is my first post!');
insert into tWall values(1, NOW(), 'Enjoying the sunny weather today!');
insert into tWall values(1, NOW(), 'Had a great day at the park!');
insert into tWall values(2, NOW(), 'Excited to join Facebook!');
insert into tWall values(3, NOW(), 'Had a great day with friends!');
insert into tWall values(3, NOW(), 'Just cooked a delicious meal!');
insert into tWall values(4, NOW(), 'Looking forward to the weekend!');
insert into tWall values(4, NOW(), 'Had a fantastic vacation!');
insert into tWall values(5, NOW(), 'Just finished a great book!');

-- Queries
-- 1. Query to fetch all information for a person given his name
select * from tUser where name = 'John Doe';

-- 2. Query to fetch all posts of a person given his name
select post from tWall where user_id = (select user_id from tUser where name = 'John Doe');

-- 3. Query to fetch all posts of a particular friend of a person, given his name and the friends name.
select post from tWall where user_id = (select friend_id from tFriends where user_id = (select user_id from tUser where name = 'John Doe') and friend_id = (select user_id from tUser where name = 'Jane mark'));

-- 4. Query to fetch all friends of a particular friend of a person, given the persons name and friend's name.
select name from tUser where user_id in (select friend_id from tFriends where user_id=(select user_id from tUser where name='John Doe') and friend_id !=(select user_id from tUser where name='Jane mark'));

-- 5. Query to remove a particular friend from a persons list, given the persons name
delete from tFriends where user_id = (select user_id from tUser where name = 'John Doe') and friend_id = (select user_id from tUser where name = 'Alice Johnson');

-- 6. Query to post something on his wall
insert into tWall values((select user_id from tUser where name = 'John Doe'), NOW(), 'Just posted a new update on my wall!');