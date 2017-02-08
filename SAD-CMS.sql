DROP DATABASE CMS;

CREATE DATABASE CMS;

USE CMS;

CREATE TABLE tblBranch(
	strBranchCode VARCHAR(15),
    strBranchAddress TEXT,
    strContactNumb VARCHAR(15),
    strBanchName VARCHAR(100),
    
    PRIMARY KEY(strBranchCode)
)Engine=InnoDb;
/*
CREATE TABLE tblUser(
	strUCode VARCHAR(25),
    strUPassword VARCHAR(20),
    
    PRIMARY KEY(strUCode)
)Engine=InnoDb;
*/
CREATE TABLE tblUserInfo(
	strUCode VARCHAR(15),
    strULast VARCHAR(20),
    strUFirst VARCHAR(20),
    strUMiddle VARCHAR(20),
    strUAddress TEXT,
    strUContactNumb VARCHAR(15),
    strUBranch VARCHAR(15),
    strUImagePath TEXT,
    intUType INT(4),
    intUStatus INT(2),
    
    PRIMARY KEY(strUCode),
    FOREIGN KEY(strUBranch)
    REFERENCES tblBranch(strBranchCode)
)Engine=InnoDb;

CREATE TABLE tblPatientRecord(
	strPCode VARCHAR(15),
    strPHistory TEXT,
    strPEtcetera TEXT,
    
    FOREIGN KEY(strPCode)
    REFERENCES tblUserInfo(strPCode)
)Engine=InnoDb;
/*
CREATE TABLE tblPatientInfo(
	strPCode VARCHAR(15),
	strPLast VARCHAR(20),
    strPFirst VARCHAR(20),
    strPMiddle VARCHAR(20),
    strContactNumb VARCHAR(15),
    strPImagePath TEXT,
    intPStatus INT(2),
    
    FOREIGN KEY(strPCode)
    REFERENCES tblUser(strUCode)
)Engine=InnoDb;
*/

CREATE TABLE tblAppointment(
	strACode VARCHAR(15),
    dtADate DATE,
    tmATime TIME,
    strAHeader TEXT,
    strADetails TEXT,
    strAPatient VARCHAR(15),
    strADoctor VARCHAR(15),
    intFrequencyType INT(4),
    intAType INT(3),
    intAStatus INT(3),
    
    PRIMARY KEY(strACode),
	FOREIGN KEY(strAPatient)
    REFERENCES tblUserInfo(strUCode),
    FOREIGN KEY(strADoctor)
    REFERENCES tblUserInfo(strUCode)
)Engine=InnoDb;

/*
CREATE TABLE tblEvents(
	strECode VARCHAR(15),
    strEDoctor VARCHAR(15),
    strEName TEXT,
    dtEDate DATE,
    tmETime TIME,
    intEStatus INT(3),
    
    PRIMARY KEY(strECode),
    FOREIGN KEY(strEDoctor)
    REFERENCES tblDoctorInfo(strDCode)
)Engine=InnoDb;
*/
CREATE TABLE tblServiceDetails(
	strCUCode VARCHAR(15),
    strCUPatient VARCHAR(15),
    strCUDoctor VARCHAR(15),
    strCUDetails TEXT,
    dtmCUDateTime DATETIME,
    intCUType INT(3),
    intCUStatus INT(2),
    
    PRIMARY KEY(strCUCode),
    FOREIGN KEY(strCUPatient)
    REFERENCES tblUserInfo(strUCode),
    FOREIGN KEY(strCUDoctor)
    REFERENCES tblUserInfo(strUCode)
)Engine=InnoDb;

CREATE TABLE tblProducts(
	strPCode VARCHAR(15),
    strPName VARCHAR(50),
    strPModel VARCHAR(50),
    dcmPPrice DECIMAL(18,4),
    
    PRIMARY KEY (strPCode)
)Engine=InnoDb;

CREATE TABLE tblInventory(
	strIPCode VARCHAR(15),
    intIQty INT(100),
    intIStatus INT(3),
    
    PRIMARY KEY (strIPCode),
    FOREIGN KEY(strIPCode)
    REFERENCES tblProducts(strPCode)
)Engine=InnoDb;

CREATE TABLE tblOrders(
	strOCode VARCHAR(15),
    strOPName VARCHAR(15),
    intOQty INT(100),
    dtOReceived DATE,
    strReceivedBy VARCHAR(15),
    
    PRIMARY KEY (strOCode),
    FOREIGN KEY(strOPName)
    REFERENCES tblProducts(strPCode),
	FOREIGN KEY(strReceivedBy)
    REFERENCES tblUserInfo(strUCode)
)Engine=InnoDb;


CREATE TABLE tblDiscount(
	strDisPCode VARCHAR(15),
    dcmDiscount DECIMAL(18,4),
    
    PRIMARY KEY (strDisPCode),
    FOREIGN KEY(strDisPCode)
    REFERENCES tblProducts(strPCode)
)Engine=InnoDb;

CREATE TABLE tblSales(
	strSCode VARCHAR(15),
    strSCUDetails VARCHAR(15),
    strSInventory VARCHAR(15),
    intSQty INT,
    dcmSBalance DECIMAL(18,4),
    intSPaymentType INT(4),
    intSStatus INT(3),
    
    PRIMARY KEY(strSCode),
    FOREIGN KEY(strSCUDetails)
    REFERENCES tblServiceDetails(strCUCode),
    FOREIGN KEY(strSInventory)
    REFERENCES tblInventory(strIPCode)
)Engine=InnoDb;

CREATE TABLE tblPayment(
	strPymCode VARCHAR(15),
    strPymSDetails VARCHAR(15),
    dcmPymPayment DECIMAL(18,4),
    dtmPymDateRec DATETIME,
    
    PRIMARY KEY(strPymCode),
    FOREIGN KEY(strPymSDetails)
    REFERENCES tblSales(strSCode)
)Engine=InnoDb;

