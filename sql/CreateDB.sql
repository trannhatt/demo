CREATE DATABASE e_bookstore;
-- drop database E_BookStore;
USE e_bookstore;

CREATE TABLE Categories
(
	ID INT AUTO_INCREMENT PRIMARY KEY,
	C_Name VARCHAR(30)
);

CREATE TABLE Dis_program
(
	ID INT AUTO_INCREMENT PRIMARY KEY,
	D_Name VARCHAR(30),
	Descriptions TEXT,
	Percents FLOAT
);

CREATE TABLE Book
(
	BookID VARCHAR(10) PRIMARY KEY,
	Title VARCHAR(50),
	Author VARCHAR(30),
	Year_publication INT,
	Publisher VARCHAR(30),
	List_price INT,
	cover VARCHAR(255),
	des TEXT
);

CREATE TABLE Customer
(
	CustomerID INT AUTO_INCREMENT PRIMARY KEY,
	CustomerName VARCHAR(30),
	Username VARCHAR(30),
	Pass_word VARCHAR(30),
	Membership VARCHAR(20), 
	Score INT DEFAULT 0 ,
	dateofBirth DATE,
	CHECK (Membership IN ('BRONZE', 'SILVER', 'GOLDEN', 'DIAMOND')) ,
    CHECK (Score >=0)
);

CREATE TABLE Staff
(
	ID INT AUTO_INCREMENT PRIMARY KEY,
	StaffName VARCHAR(30),
	Username VARCHAR(30),
	Pass_word VARCHAR(30),
	Gender VARCHAR(10),
	Salary INT
);

CREATE TABLE Warehouse_Staff
(
	ID INT PRIMARY KEY,
	FOREIGN KEY (ID) REFERENCES Staff(ID)
);

CREATE TABLE PageAdmin
(
	ID INT PRIMARY KEY,
	FOREIGN KEY (ID) REFERENCES Staff(ID)
);

CREATE TABLE Client_care
(
	ID INT PRIMARY KEY,
	FOREIGN KEY (ID) REFERENCES Staff(ID)
);

CREATE TABLE Ware_house
(
	WhID INT PRIMARY KEY,
	City VARCHAR(20),
	District VARCHAR(20),
	Commune VARCHAR(20),
	Number VARCHAR(20),
	Staff_ID INT NOT NULL UNIQUE,
	FOREIGN KEY (Staff_ID) REFERENCES Warehouse_Staff(ID) ON UPDATE CASCADE
);

CREATE TABLE Supplier
(
	ID INT AUTO_INCREMENT PRIMARY KEY,
	SupName VARCHAR(20)
);

CREATE TABLE Cart
(
	Code INT AUTO_INCREMENT PRIMARY KEY,
	CustomerID INT NOT NULL,
	FOREIGN KEY (CustomerID) REFERENCES Customer(CustomerID) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE Bill
(
	Code INT AUTO_INCREMENT PRIMARY KEY,
	Date_Bill DATE, 
	Times TIME, 
	Note TEXT, 
	StatusBill VARCHAR(50) , 
	Destination TEXT,
	CHECK (StatusBill IN ('CHO XAC NHAN', 'DANG GIAO HANG', 'GH THANH CONG', 'DON HANG DA HUY'))
);

CREATE TABLE Shipping_unit
(
	Code INT AUTO_INCREMENT PRIMARY KEY,
	SU_Name VARCHAR(50) , 
	Price INT CHECK (PRICE >=0),
	Email VARCHAR(100)
);

CREATE TABLE L_Services
(
	Ser_Name VARCHAR(30) PRIMARY KEY,
	CHECK (Ser_Name IN ('DOI TRA HOAN TIEN', 'TUYEN DUNG', 'THEO DOI DON HANG', 'GIAO HANG NHANH'))
);

-- RELATION
CREATE TABLE Belong
(
	ID INT	, 
	BookID VARCHAR(10),
	PRIMARY KEY (ID, BookID),
	FOREIGN KEY (ID) REFERENCES Categories(ID) ON UPDATE CASCADE ON DELETE CASCADE ,
	FOREIGN KEY (BookID) REFERENCES Book(BookID) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE Applies
(
	ID INT	, 
	BookID VARCHAR(10),
	StartDate DATE NOT NULL, 
	EndDate DATE NOT NULL,
	PRIMARY KEY (ID, BookID),
	FOREIGN KEY (ID) REFERENCES Dis_program(ID) ON UPDATE CASCADE ON DELETE CASCADE,
	FOREIGN KEY (BookID) REFERENCES Book(BookID) ON UPDATE CASCADE ON DELETE CASCADE,
	CHECK (StartDate <= EndDate)
);

CREATE TABLE IsIn
(
	WhID INT,
	BookID VARCHAR(10),
	Number INT NOT NULL, 
	PRIMARY KEY (WhID, BookID),
	FOREIGN KEY (WhID) REFERENCES Ware_house(WhID) ON UPDATE CASCADE ON DELETE CASCADE,
	FOREIGN KEY (BookID) REFERENCES Book(BookID) ON UPDATE CASCADE ON DELETE CASCADE,
    CHECK (NUMBER>=0)
);

CREATE TABLE Supply
(
	ID INT, 
	BookID VARCHAR(10), 
	Quantity INT NOT NULL , 
	Price INT NOT NULL,
	PRIMARY KEY (ID, BookID),
	FOREIGN KEY (ID) REFERENCES Supplier(ID) ON UPDATE CASCADE ON DELETE CASCADE,
	FOREIGN KEY (BookID) REFERENCES Book(BookID) ON UPDATE CASCADE ON DELETE CASCADE,
    CHECK (Quantity >0),
	CHECK (Price >0) 
);

CREATE TABLE Contain
(
	Code INT, 
	BookID VARCHAR(10), 
	Number INT NOT NULL , 
	PRIMARY KEY (Code, BookID) ,
	FOREIGN KEY (Code) REFERENCES Cart(Code) ON UPDATE CASCADE ON DELETE CASCADE,
	FOREIGN KEY (BookID) REFERENCES Book(BookID) ON UPDATE CASCADE ON DELETE CASCADE,
    CHECK (Number >0)
);

CREATE TABLE Overview
(
	ID INT, 
	BookID VARCHAR(10), 
	PRIMARY KEY (ID, BookID) ,
	FOREIGN KEY (ID) REFERENCES PageAdmin(ID) ON UPDATE CASCADE ON DELETE CASCADE,
	FOREIGN KEY (BookID) REFERENCES Book(BookID) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE Sends
(
	ID INT, 
	Code INT, 
	Dates DATE,
	PRIMARY KEY (ID, Code) ,
	FOREIGN KEY (ID) REFERENCES Warehouse_Staff(ID) ON UPDATE CASCADE ON DELETE CASCADE,
	FOREIGN KEY (Code) REFERENCES Shipping_unit(Code) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE Forward
(
	AID INT , 
	Code INT , 
	WsID  INT NOT NULL ,
	PRIMARY KEY (AID, Code) ,
	FOREIGN KEY (AID) REFERENCES PageAdmin(ID) ON UPDATE CASCADE ON DELETE CASCADE,
	FOREIGN KEY (Code) REFERENCES Bill(Code) ON UPDATE CASCADE ON DELETE CASCADE,
	FOREIGN KEY (WsID) REFERENCES Warehouse_Staff(ID) ON UPDATE CASCADE ON DELETE CASCADE
);

ALTER TABLE Forward
ADD CONSTRAINT SK_FORWARD UNIQUE (Code, WsID);


CREATE TABLE Chooses
(
	CustomerID INT, 
	Code INT, 
	SCode  INT NOT NULL,
	PRIMARY KEY (CustomerID, Code) ,
	FOREIGN KEY (CustomerID) REFERENCES Customer(CustomerID) ON UPDATE CASCADE ON DELETE CASCADE,
	FOREIGN KEY (Code) REFERENCES Bill(Code) ON UPDATE CASCADE ON DELETE CASCADE,
	FOREIGN KEY (SCode) REFERENCES Shipping_unit(Code) ON UPDATE CASCADE ON DELETE CASCADE
);

ALTER TABLE Chooses
ADD CONSTRAINT SK_Chooses UNIQUE (Code, SCode);


CREATE TABLE Evaluate
(
	CustomerID INT, 
	BookID VARCHAR(10), 
	Rating  INT  ,
	PRIMARY KEY (CustomerID, BookID) ,
	FOREIGN KEY (CustomerID) REFERENCES Customer(CustomerID) ON UPDATE CASCADE ON DELETE CASCADE,
	FOREIGN KEY (BookID) REFERENCES Book(BookID) ON UPDATE CASCADE ON DELETE CASCADE,
	CHECK (Rating >=1 AND Rating <=5)
);

CREATE TABLE Pay
(
	CustomerID INT, 
	BookID VARCHAR(10), 
	Code INT, 
	Quanity  INT CHECK (Quanity >=0) ,
	Method VARCHAR(20),
	PRIMARY KEY (CustomerID, BookID) ,
	FOREIGN KEY (CustomerID) REFERENCES Customer(CustomerID) ON UPDATE CASCADE ON DELETE CASCADE,
	FOREIGN KEY (BookID) REFERENCES Book(BookID) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE Q_A
(
	CustomerID INT ,
	BookID VARCHAR(10), 
	ID INT, 
	PRIMARY KEY (CustomerID, BookID, ID) ,
	FOREIGN KEY (CustomerID) REFERENCES Customer(CustomerID) ON UPDATE CASCADE ON DELETE CASCADE,
	FOREIGN KEY (BookID) REFERENCES Book(BookID) ON UPDATE CASCADE ON DELETE CASCADE,
	FOREIGN KEY (ID) REFERENCES PageAdmin(ID) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE Serve
(
	Ser_Name VARCHAR(30), 
	BookID VARCHAR(10), 
	ID INT, 
	PRIMARY KEY (Ser_Name, BookID, ID) ,
	FOREIGN KEY (Ser_Name) REFERENCES L_Services(Ser_Name) ON UPDATE CASCADE ON DELETE CASCADE,
	FOREIGN KEY (BookID) REFERENCES Book(BookID) ON UPDATE CASCADE ON DELETE CASCADE,
	FOREIGN KEY (ID) REFERENCES Client_care(ID) ON UPDATE CASCADE ON DELETE CASCADE
);
-- MULTIVALUES
CREATE TABLE Feedback
(
	CustomerID INT, 
	BookID VARCHAR(10), 
	FeedbackID VARCHAR(10), 
	Time_stamp DATE,
	Comment TEXT,
	Images TEXT, 
	Video TEXT,
	PRIMARY KEY (CustomerID, BookID, FeedbackID) ,
	FOREIGN KEY (CustomerID) REFERENCES Customer(CustomerID) ON UPDATE CASCADE ON DELETE CASCADE,
	FOREIGN KEY (BookID) REFERENCES Book(BookID) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE Phone
(
	CustomerID INT, 
	PhoneID VARCHAR(10), 
	PRIMARY KEY (CustomerID, PhoneID) ,
	FOREIGN KEY (CustomerID) REFERENCES Customer(CustomerID) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE s_phone
(
	ID INT, 
	PhoneID VARCHAR(15), 
	PRIMARY KEY (ID, PhoneID) ,
	FOREIGN KEY (ID) REFERENCES Staff(ID) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE address
(
	CustomerID INT, 
	emailID VARCHAR(30), 
	PRIMARY KEY (CustomerID, emailID) ,
	FOREIGN KEY (CustomerID) REFERENCES Customer(CustomerID) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE email
(
	CustomerID INT, 
	emailID VARCHAR(30), 
	PRIMARY KEY (CustomerID, emailID) ,
	FOREIGN KEY (CustomerID) REFERENCES Customer(CustomerID) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE Promotion
(
	Code INT, 
	PromotionID VARCHAR(10), 
	Con VARCHAR(30),
	Percents FLOAT,
	EXP_DATE DATE,
	PRIMARY KEY (Code, PromotionID) ,
	FOREIGN KEY (Code) REFERENCES Shipping_unit(Code) ON UPDATE CASCADE ON DELETE CASCADE,
	CHECK (Percents > 0 AND Percents <=1)
);






