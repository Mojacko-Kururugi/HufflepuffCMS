DROP DATABASE CMS;

CREATE DATABASE CMS;

USE CMS;


CREATE TABLE tblBranch(
	intBranchID int NOT NULL AUTO_INCREMENT,
	strBranchName VARCHAR(100),
    strBranchAddress VARCHAR(150),
    strBContactNumb VARCHAR(15),
    intBStatus INT(2),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    
    PRIMARY KEY(intBranchID)
)Engine=InnoDb;

CREATE TABLE tblUserType(
	intUTID INT(3),
    strUTDesc VARCHAR(20),
    
    PRIMARY KEY(intUTID)
)Engine=InnoDb;

CREATE TABLE tblProdType(
	intPTID int NOT NULL AUTO_INCREMENT,
    strPTDesc VARCHAR(20),
    intPTStatus INT,
	dtPTDateCreated TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    
    PRIMARY KEY(intPTID)
)Engine=InnoDb;

CREATE TABLE tblInvStatus(
	intISID INT(3),
    strISDesc VARCHAR(20),
    
    PRIMARY KEY(intISID)
)Engine=InnoDb;

CREATE TABLE tblOrdStatus(
	intOSID INT(3),
    strOSDesc VARCHAR(20),
    
    PRIMARY KEY(intOSID)
)Engine=InnoDb;

CREATE TABLE tblSchedStatus(
	intSSID INT(3),
    strSSDesc VARCHAR(20),
    
    PRIMARY KEY(intSSID)
)Engine=InnoDb;

CREATE TABLE tblSalesStatus(
	intSaleSID INT(3),
    strSaleSDesc VARCHAR(20),
    
    PRIMARY KEY(intSaleSID)
)Engine=InnoDb;

CREATE TABLE tblServiceStatus(
	intServStatID INT(3),
    strServStatDesc VARCHAR(20),
    
    PRIMARY KEY(intServStatID)
)Engine=InnoDb;

CREATE TABLE tblPayType(
	intPayTID INT(3),
    strPayTDesc VARCHAR(50),
    
    PRIMARY KEY(intPayTID)
)Engine=InnoDb;

CREATE TABLE tblWarranty(
	intWID INT(3),
    strWDesc VARCHAR(20),
    
    PRIMARY KEY(intWID)
)Engine=InnoDb;

CREATE TABLE tblUserAccounts(
	intUID int NOT NULL AUTO_INCREMENT,
    strUEmail VARCHAR(25),
    strUPassword VARCHAR(20),
    intUType INT(3),
    
    PRIMARY KEY(intUID,strUEmail),
	FOREIGN KEY(intUType)
    REFERENCES tblUserType(intUTID)
)Engine=InnoDb;

CREATE TABLE tblDocInfo(
	intDocID int NOT NULL AUTO_INCREMENT,
    strDocLicNumb VARCHAR(20),
    strDocLast VARCHAR(20),
    strDocFirst VARCHAR(20),
    strDocMiddle VARCHAR(20),
    intDocGender INT(2), 	
    strDocContactNumb VARCHAR(15),
    intDocBranch INT,
    strDocImagePath VARCHAR(200),
	strDocEmail VARCHAR(25),
    intDocStatus INT(2),
	created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    
    PRIMARY KEY(intDocID,strDocLicNumb),
    FOREIGN KEY(intDocBranch)
    REFERENCES tblBranch(intBranchID)
)Engine=InnoDb;

CREATE TABLE tblPatientInfo(
	intPatID int NOT NULL AUTO_INCREMENT,
	strPatLast VARCHAR(20),
    strPatFirst VARCHAR(20),
    strPatMiddle VARCHAR(20),
    intPatGender INT(2),
	strPatAddress VARCHAR(250),
	strPatContactNumb VARCHAR(15),
	strPatCompany VARCHAR(50),
    dPatBirthdate	DATE,
    strPatHistory VARCHAR(7),
	strPatImagePath VARCHAR(200),
	strPatEmail VARCHAR(25),
    intPatStatus INT(2),
	created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    
    PRIMARY KEY(intPatID)
)Engine=InnoDb;

CREATE TABLE tblPatientRX(
	intRXID int NOT NULL AUTO_INCREMENT,
	intRXPatID int,
    strPatComplaints VARCHAR(7),
    strPatOldRX VARCHAR(200),
    intRXPatStatus INT(2),
	created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    
    PRIMARY KEY(intRXID),
	FOREIGN KEY(intRXPatID)
    REFERENCES tblPatientInfo(intPatID)
)Engine=InnoDb;

CREATE TABLE tblEmployeeInfo(
	intEmpID int NOT NULL AUTO_INCREMENT,
	strEmpLast VARCHAR(20),
    strEmpFirst VARCHAR(20),
    strEmpMiddle VARCHAR(20),
    intEmpBranch INT,
    strEmpImagePath VARCHAR(200),
	strEmpEmail VARCHAR(25),
    intEmpStatus INT(2),
	created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    
    PRIMARY KEY(intEmpID),
	FOREIGN KEY(intEmpBranch)
    REFERENCES tblBranch(intBranchID)
)Engine=InnoDb;

CREATE TABLE tblServices(
	intServID int NOT NULL AUTO_INCREMENT,
    strServName VARCHAR(50),
    strServDesc VARCHAR(250),
    intServStatus INT(2),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    
    PRIMARY KEY(intServID)
)Engine=InnoDb;

CREATE TABLE tblProducts(
	intProdID int NOT NULL AUTO_INCREMENT,
    strProdName VARCHAR(50),
    strProdModel VARCHAR(50),
    strProdBrand VARCHAR(50),
    intProdType INT(3),
	dcInvPPrice DECIMAL(18,2),
    intProdStatus INT(2),
    
    PRIMARY KEY (intProdID),
	FOREIGN KEY(intProdType)
    REFERENCES tblProdType(intPTID)
)Engine=InnoDb;

CREATE TABLE tblInventory(
	intInvID int NOT NULL AUTO_INCREMENT,
    strInvCode VARCHAR(25),
	intInvPID INT,
    intInvQty INT(100),
    dtInvExpiry DATE,
    intInvStatus INT(3),
	intInvBranch INT,
    
    PRIMARY KEY(intInvID),
    FOREIGN KEY(intInvPID)
    REFERENCES tblProducts(intProdID),
	FOREIGN KEY(intInvBranch)
    REFERENCES tblBranch(intBranchID),
    FOREIGN KEY(intInvStatus)
    REFERENCES tblInvStatus(intISID)
)Engine=InnoDb;

CREATE TABLE tblAdjustments(
	intAdjID int NOT NULL AUTO_INCREMENT,
	strAdjCode VARCHAR(25),
    intAdjInvID INT,
    intAdjQty INT,
    strAdjReason TEXT,
    intAdjStatus INT,
    dtAdjDate TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    intAdjBranch INT,	
    
    PRIMARY KEY (intAdjID),
    FOREIGN KEY(intAdjInvID)
    REFERENCES tblInventory(intInvID),
	FOREIGN KEY(intAdjBranch)
    REFERENCES tblBranch(intBranchID)
)Engine=InnoDb;

CREATE TABLE tblDiscount(
	intDisID int NOT NULL AUTO_INCREMENT,
    intDisInvID INT,
    dcmDiscount DECIMAL(18,2),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    
    PRIMARY KEY (intDisID),
    FOREIGN KEY(intDisInvID)
    REFERENCES tblInventory(intInvPID)
)Engine=InnoDb;

CREATE TABLE tblOrders(
	intOID int NOT NULL AUTO_INCREMENT,
	strOCode VARCHAR(25),
	intOBranch INT,
	created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    dtOReceived DATE,
    intStatus INT,
    
    
    PRIMARY KEY (intOID),
	FOREIGN KEY(intOBranch)
    REFERENCES tblBranch(intBranchID),
    FOREIGN KEY(intStatus)
    REFERENCES tblOrdStatus(intOSID)
)Engine=InnoDb;

CREATE TABLE tblOrderDetails(
	intODCode INT,
    intOProdID INT,
    intOQty INT(100),
    
    FOREIGN KEY(intOProdID)
    REFERENCES tblProducts(intProdID),
	FOREIGN KEY(intODCode)
    REFERENCES tblOrders(intOID)
)Engine=InnoDb;

CREATE TABLE tblServiceHeader(
	intSHID int NOT NULL AUTO_INCREMENT,
	strSHCode VARCHAR(25),
    intSHPatID INT,
    intSHDocID INT,
    intSHServiceID INT,
    intSHPaymentType INT,
    intSHStatus INT,
	intSHDateTime TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    PRIMARY KEY(intSHID,strSHCode),
	FOREIGN KEY(intSHPatID)
    REFERENCES tblPatientInfo(intPatID),
    FOREIGN KEY(intSHDocID)
    REFERENCES tblDocInfo(intDocID),
    FOREIGN KEY(intSHServiceID)
    REFERENCES tblServices(intServID),
    FOREIGN KEY(intSHPaymentType)
    REFERENCES tblPayType(intPayTID),
    FOREIGN KEY(intSHStatus)
    REFERENCES tblServiceStatus(intServStatID)
)Engine=InnoDb;

CREATE TABLE tblServiceDetails(
	strHeaderCode VARCHAR(25),
    intHInvID INT,
    intQty INT,
    intClaimStatus INT,
    intHWarranty INT,

	FOREIGN KEY(intHInvID)
    REFERENCES tblInventory(intInvID),
    FOREIGN KEY(intHWarranty)
    REFERENCES tblWarranty(intWID)
)Engine=InnoDb;

CREATE TABLE tblConsultationRecords(
	strCRHeaderCode VARCHAR(25),
    strCRDesc TEXT

)Engine=InnoDb;

CREATE TABLE tblSales(
	intSaleID int NOT NULL AUTO_INCREMENT,
    strSServCode VARCHAR(25),
    dcmSBalance DECIMAL(18,2),
    intSStatus INT(3),
    
    PRIMARY KEY(intSaleID),
    FOREIGN KEY(intSStatus)
    REFERENCES tblSalesStatus(intSaleSID)
)Engine=InnoDb;

CREATE TABLE tblPayment(
	intPymID int NOT NULL AUTO_INCREMENT,
    intPymServID INT,
    dcmPymPayment DECIMAL(18,2),
    dtmPymDateRec TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    
    PRIMARY KEY(intPymID),
    FOREIGN KEY(intPymServID)
    REFERENCES tblSales(intSaleID)
)Engine=InnoDb;

CREATE TABLE tblFrequencyType(
	intFID INT(3),
    strFDesc VARCHAR(20),
    
    PRIMARY KEY(intFID)
)Engine=InnoDb;

CREATE TABLE tblSchedules(
	intSchedID int NOT NULL AUTO_INCREMENT,
    dtSchedDate DATE,
    tmSchedTime TIME,
    strSchedHeader TEXT,
    strSchedDetails TEXT,
    intSchedPatient INT,
    intSchedDoctor INT,
    intSchedFrequencyType INT,
    intSchedType INT,
    intSchedStatus INT,
    
    PRIMARY KEY(intSchedID),
	FOREIGN KEY(intSchedPatient)
    REFERENCES tblPatientInfo(intPatID),
    FOREIGN KEY(intSchedDoctor)
    REFERENCES tblDocInfo(intDocID),
    FOREIGN KEY(intSchedFrequencyType)
    REFERENCES tblFrequencyType(intFID),
    FOREIGN KEY(intSchedStatus)
    REFERENCES tblSchedStatus(intSSID)
)Engine=InnoDb;


INSERT INTO tblFrequencyType(intFID,strFDesc) VALUES ('1','Every 30 mins');
INSERT INTO tblFrequencyType(intFID,strFDesc) VALUES ('2','Every 1 hour');
INSERT INTO tblFrequencyType(intFID,strFDesc) VALUES ('3','Every 4 hours');
INSERT INTO tblFrequencyType(intFID,strFDesc) VALUES ('4','Day before');
INSERT INTO tblFrequencyType(intFID,strFDesc) VALUES ('5','Week before');

INSERT INTO tblWarranty(intWID,strWDesc) VALUES ('1','Active');
INSERT INTO tblWarranty(intWID,strWDesc) VALUES ('2','Inactive');
INSERT INTO tblWarranty(intWID,strWDesc) VALUES ('3','Replaced');

INSERT INTO tblPayType(intPayTID,strPayTDesc) VALUES ('1','Full Payment');
INSERT INTO tblPayType(intPayTID,strPayTDesc) VALUES ('2','2 Gives - every 15 days');
INSERT INTO tblPayType(intPayTID,strPayTDesc) VALUES ('3','Quarterly - every 7 days');

INSERT INTO tblServiceStatus(intServStatID,strServStatDesc) VALUES ('1','DONE');
INSERT INTO tblServiceStatus(intServStatID,strServStatDesc) VALUES ('2','WITH FOLLOW UP');

INSERT INTO tblSalesStatus(intSaleSID,strSaleSDesc) VALUES ('1','PAID');
INSERT INTO tblSalesStatus(intSaleSID,strSaleSDesc) VALUES	 ('2','ONGOING');
INSERT INTO tblSalesStatus(intSaleSID,strSaleSDesc) VALUES ('3','OVERDUE');

INSERT INTO tblSchedStatus(intSSID,strSSDesc) VALUES ('1','CONFIRMED');
INSERT INTO tblSchedStatus(intSSID,strSSDesc) VALUES ('2','PENDING');
INSERT INTO tblSchedStatus(intSSID,strSSDesc) VALUES ('3','CANCELLED');
INSERT INTO tblSchedStatus(intSSID,strSSDesc) VALUES ('4','DONE');

INSERT INTO tblOrdStatus(intOSID,strOSDesc) VALUES ('1','RECEIVED');
INSERT INTO tblOrdStatus(intOSID,strOSDesc) VALUES ('2','PENDING');
INSERT INTO tblOrdStatus(intOSID,strOSDesc) VALUES ('3','CANCELLED');

INSERT INTO tblInvStatus(intISID,strISDesc) VALUES ('1','GOOD');
INSERT INTO tblInvStatus(intISID,strISDesc) VALUES ('2','DISCOUNTED');
INSERT INTO tblInvStatus(intISID,strISDesc) VALUES ('3','EXPIRED');

INSERT INTO tblProdType(strPTDesc,intPTStatus) VALUES ('Glasses','1');
INSERT INTO tblProdType(strPTDesc,intPTStatus) VALUES ('Contact Lens','1');
INSERT INTO tblProdType(strPTDesc,intPTStatus) VALUES ('Solution','1');

INSERT INTO tblUserType(intUTID,strUTDesc) VALUES ('1','Admin');
INSERT INTO tblUserType(intUTID,strUTDesc) VALUES ('2','Optometrist');
INSERT INTO tblUserType(intUTID,strUTDesc) VALUES ('3','Secretary');
INSERT INTO tblUserType(intUTID,strUTDesc) VALUES ('4','Patient');

INSERT INTO tblServices(strServName,strServDesc,intServStatus) VALUES ('Eye Refraction','refraction for the eye','1');
INSERT INTO tblServices(strServName,strServDesc,intServStatus) VALUES ('Eye Check Up','check up for the eye','1');
INSERT INTO tblServices(strServName,strServDesc,intServStatus) VALUES ('Glass/Lens Assign','assigning of lens or glasses','1');

INSERT INTO tblUserAccounts (strUEmail,strUPassword,intUID,intUType) VALUES ('admin@hufflepuff','admin123','0','1');

INSERT INTO tblBranch(strBranchName,strBranchAddress,strBContactNumb,intBStatus) VALUES ('ARG Main','Quezon City','123-4567','1');