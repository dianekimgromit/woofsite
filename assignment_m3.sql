DROP DATABASE if exists dainkim_woofsite;
CREATE DATABASE dainkim_woofsite;

USE dainkim_woofsite;
CREATE TABLE Users (
	userID int(20) primary key not null auto_increment,
	email varchar(50) not null unique,
    password varchar(50) not null,
    fname varchar(50) not null,
    lname varchar(50) not null,
    description varchar(800)
);

INSERT INTO Users (email, password, fname, lname, description) VALUES ('dainkim@usc.edu', '123', 'Diane', 'Kim', 'Please update your description');
INSERT INTO Users (email, password, fname, lname, description) VALUES ('sarahliu@usc.edu', 'backward', 'Sarah', 'Liu', 'Please update your description');


CREATE TABLE SavedImages (
    id varchar(10) not null,
	userID int(20) not null,
    imageLink varchar(200) not null,
    PRIMARY KEY (id, userID),
    FOREIGN KEY fk(userID) REFERENCES Users(userID)
);

INSERT INTO SavedImages(id, userID, imageLink) VALUES ('test000', 1, 'https://www.shutterstock.com/image-photo/beautiful-jack-russell-puppy-dog-600nw-2335044269.jpg');
INSERT INTO SavedImages(id, userID, imageLink) VALUES ('test001', 1, 'https://cdn.thecoolist.com/wp-content/uploads/2022/01/Agile-Dogs-Great-for-First-Time-Owners.jpg');
INSERT INTO SavedImages(id, userID, imageLink) VALUES ('test002', 1, 'https://images.pexels.com/photos/1108099/pexels-photo-1108099.jpeg?cs=srgb&dl=pexels-chevanon-photography-1108099.jpg&fm=jpg');
INSERT INTO SavedImages(id, userID, imageLink) VALUES ('test003', 1, 'https://spca.bc.ca/wp-content/uploads/2023/06/happy-samoyed-dog-outdoors-in-summer-field.jpg');
INSERT INTO SavedImages(id, userID, imageLink) VALUES ('test004', 1, 'https://d3544la1u8djza.cloudfront.net/APHI/Blog/2021/07-06/small+white+fluffy+dog+smiling+at+the+camera+in+close-up-min.jpg');
INSERT INTO SavedImages(id, userID, imageLink) VALUES ('test005', 1, 'https://www.thesprucepets.com/thmb/NG5rknpapfUIUVnf21agWTU1C9g=/2121x0/filters:no_upscale():strip_icc()/GettyImages-155368806-b067f56589d24c65b61d0ad0b9854e74.jpg');
INSERT INTO SavedImages(id, userID, imageLink) VALUES ('test006', 1, 'https://www.thedogandfriends.com/assets/img/index/img-hero_dog.png');


CREATE TABLE History (
    historyID int(20) primary key not null auto_increment,
	userID int(20) not null,
    date datetime not null,
	action varchar(1000) not null,
	FOREIGN KEY fk(userID) REFERENCES Users(userID)
);

-- INSERT INTO History(userID, date, action) VALUES (1, NOW(), 'added');
-- INSERT INTO History(userID, date, action) VALUES (1, NOW(), 'deleted');
-- INSERT INTO History(userID, date, action) VALUES (2, NOW(), 'added');
-- INSERT INTO History(userID, date, action) VALUES (1, NOW(), 'added');
-- INSERT INTO History(userID, date, action) VALUES (1, NOW(), 'added');
-- INSERT INTO History(userID, date, action) VALUES (2, NOW(), 'deleted');
-- INSERT INTO History(userID, date, action) VALUES (2, NOW(), 'added');
-- INSERT INTO History(userID, date, action) VALUES (2, NOW(), 'added');
-- INSERT INTO History(userID, date, action) VALUES (2, NOW(), 'added');
-- INSERT INTO History(userID, date, action) VALUES (2, NOW(), 'updated description');
