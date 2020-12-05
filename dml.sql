INSERT INTO Book(ISBN, Title, Author, Publisher, Price)
VALUES ('10247184712349', '1984', 'George Orwell', 'Penguin', '19', 'Fiction');

INSERT INTO Book(ISBN, Title, Author, Publisher, Price)   
VALUES ('10247184712342', 'Animal Farm', 'George Orwell', 'Penguin', '20', 'Fiction');

INSERT INTO Customer( Username, First_Name, Last_Name, PIN, Address, City, State, Zip, CCtype, CCnum, ExpDate, Admin)
VALUES ('Test', 'Tom', 'Tester', '123', '223 street', 'Ypsilanti','Michigan','48197','VISA','49483020483','10/23', 'false'); 

INSERT INTO Customer( Username, First_Name, Last_Name, PIN, Address, City, State, Zip, CCtype, CCnum, ExpDate, Admin)
VALUES ('dummy', 'dummy', 'dummy', '123', '223 street', 'Ypsilanti','Michigan','48197','VISA','49483020483','10/23', 'false'); 

INSERT INTO Customer( Username, First_Name, Last_Name, PIN, Address, City, State, Zip, CCtype, CCnum, ExpDate, Admin)
VALUES ('admin', 'admin', 'admin', '5', '223 street', 'Port Huron','Michigan','48060','VISA','49483020483','10/23', 'true'); 

INSERT INTO Review(Author, Book, Content)
VALUES ('Test', '10247184712349', 'Amazing book, must read for anyone.');

INSERT INTO Review(Author, Book, Content)
VALUES ('nfishel', '10247184712349', 'Hated it don’t waste your time.');

INSERT INTO Review(Author, Book, Content)
VALUES ('Test', '10247184712349', 'Amazing book, must read for anyone.');

INSERT INTO Order_t(number, Customer_id, placed)
VALUES('1', '1', 'f');

INSERT INTO Sales(Month, Ammount)
VALUES('January', '0');

INSERT INTO Sales(Month, Ammount)
VALUES('Febuary', '0');

INSERT INTO Sales(Month, Ammount)
VALUES('March', '0');

INSERT INTO Sales(Month, Ammount)
VALUES('April', '0');

INSERT INTO Sales(Month, Ammount)
VALUES('May', '0');

INSERT INTO Sales(Month, Ammount)
VALUES('June', '0');

INSERT INTO Sales(Month, Ammount)
VALUES('July', '0');

INSERT INTO Sales(Month, Ammount)
VALUES('August', '0');

INSERT INTO Sales(Month, Ammount)
VALUES('September', '0');

INSERT INTO Sales(Month, Ammount)
VALUES('October', '0');

INSERT INTO Sales(Month, Ammount)
VALUES('November', '0');

INSERT INTO Sales(Month, Ammount)
VALUES('December', '0');