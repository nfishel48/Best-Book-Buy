DROP TABLE IF EXISTS Customer;
DROP TABLE IF EXISTS Review;
DROP TABLE IF EXISTS Book;

CREATE TABLE Customer( 
    ID SERIAL,
    Username VARCHAR(225) UNIQUE,
    First_Name VARCHAR(225),
    Last_Name VARCHAR(225),
    PIN int,
    Address VARCHAR(225),
    City VARCHAR(225),
    State VARCHAR(225),
    Zip VARCHAR(225),
    CCtype VARCHAR(225),
    CCnum VARCHAR(225),
    ExpDate VARCHAR(225),
    PRIMARY KEY(ID)
);


CREATE TABLE Book(
    ISBN VARCHAR(15),
    Title VARCHAR(225),
    Author VARCHAR(225),
    Publisher VARCHAR(225),
    Price money,
    PRIMARY KEY(ISBN)
);

CREATE TABLE Review(
    ID SERIAL,
    Author VARCHAR(225),
    Book VARCHAR(225),
    Content text,
    PRIMARY KEY(ID),
    CONSTRAINT fk_author
        FOREIGN KEY(Author) 
        REFERENCES Customer(Username)
        ON DELETE CASCADE,
    CONSTRAINT fk_book
        FOREIGN KEY(Book) 
        REFERENCES Book(ISBN)
        ON DELETE CASCADE
);

INSERT INTO Customer(
    Username, 
    First_Name, 
    Last_Name, 
    PIN, 
    Address, 
    City,
    State,
    Zip,
    CCtype,
    CCnum,
    ExpDate
    )
VALUES (
    'Test', 
    'Tom', 
    'Tester', 
    '123', 
    '223 street', 
    'Ypsilanti',
    'Michigan',
    '48197',
    'VISA',
    '49483020483',
    '10/23'); 