INSERT INTO Book(ISBN, Title, Author, Publisher, Price)
VALUES ('10247184712349', '1984', 'George Orwell', 'Penguin', '19.99');

INSERT INTO Customer( Username, First_Name, Last_Name, PIN, Address, City, State, Zip, CCtype, CCnum, ExpDate)
VALUES ('Test', 'Tom', 'Tester', '123', '223 street', 'Ypsilanti','Michigan','48197','VISA','49483020483','10/23'); 

INSERT INTO Review(Author, Book, Content)
VALUES ('Test', '10247184712349', 'Amazing book, must read for anyone.');