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

CREATE TABLE Order (
    number serial, 
    customer_id int, 
    placed boolean default(false), 
    primary key(number), 
    foreign key(customer_id) references customer(id));

CREATE TABLE Order_book (
    order_number int, 
    book_isbn varchar(15), 
    quantity int, 
    primary key(order_number, book_isbn), 
    foreign key(order_number) 
    references Order(number), 
    foreign key(book_isbn) 
    references Book(isbn));


