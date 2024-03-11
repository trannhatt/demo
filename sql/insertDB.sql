Use e_bookstore;

INSERT INTO Customer
VALUES (101,'Trần Văn Nam','namtran0301','123456','SILVER',1901,'1996-01-03');
INSERT INTO Customer
VALUES (102,'Nguyễn Anh' ,'anhnguyen123','spear456','BRONZE',342,'1998-07-28');
INSERT INTO Customer
VALUES (103,'Lê Văn Anh','levananh','ray2802','SILVER',640,'2001-02-28');
INSERT INTO Customer
VALUES (104,'Trần An','tranan2803','Bella2002','GOLDEN',2504,'2005-02-20');
INSERT INTO Customer
VALUES (105,'Thanh Xuân','xuan0104','mike0123','DIAMOND',5032,'1999-04-01');
INSERT INTO Customer
VALUES (106,'Phạm Thị Thuỷ','thuypham369','tomyum246','SILVER',1102,'2000-12-25');

INSERT INTO Staff
VALUES (201,'Trần Nam','admin1','201000','MALE','20000000');
INSERT INTO Staff
VALUES (202,'Đạt Lê','admin2','202001','FEMALE','25000000');
INSERT INTO Staff
VALUES (203,'Kate Will','admin3','203001','FEMALE','10000000');
INSERT INTO Staff
VALUES (211,'Tuấn Anh','admin4','204000','MALE','15000000');
INSERT INTO Staff
VALUES (212,'Lê Minh','admin5','205001','FEMALE','28000000');
INSERT INTO Staff
VALUES (221,'Anh Thư','admin6','206000','MALE','21000000');
INSERT INTO Staff
VALUES (222,'Tiến Dũng','admin7','207000','MALE','17000000');
INSERT INTO Staff
VALUES (223,'Ngọc Thắng','admin8','208000','MALE','25000000');

INSERT INTO Warehouse_Staff
VALUES (201);
INSERT INTO Warehouse_Staff
VALUES (202);
INSERT INTO Warehouse_Staff
VALUES (203);

INSERT INTO PageAdmin
VALUES (211);
INSERT INTO PageAdmin
VALUES (212);

INSERT INTO Client_care
VALUES (221);
INSERT INTO Client_care
VALUES (222);
INSERT INTO Client_care
VALUES (223);

INSERT INTO Categories (C_Name)
VALUES ('Tâm lý học');
INSERT INTO Categories (C_Name)
VALUES ('Giả tưởng');
INSERT INTO Categories (C_Name)
VALUES ('Nấu ăn');
INSERT INTO Categories (C_Name)
VALUES ('Lịch sử');
INSERT INTO Categories (C_Name)
VALUES ('Bí ẩn');
INSERT INTO Categories (C_Name)
VALUES ('Lãng mạn');
INSERT INTO Categories (C_Name)
VALUES ('Khoa học');
INSERT INTO Categories (C_Name)
VALUES ('Sách giáo khoa');
INSERT INTO Categories (C_Name)
VALUES ('Tâm lý - Triết học');
INSERT INTO Categories (C_Name)
VALUES ('Truyện');
INSERT INTO Categories (C_Name)
VALUES ('Nhật ký');
INSERT INTO Categories (C_Name)
VALUES ('Học thuật');
INSERT INTO Categories (C_Name)
VALUES ('Kỹ năng sống');
INSERT INTO Categories (C_Name)
VALUES ('Ngôn tình');
INSERT INTO Categories (C_Name)
VALUES ('Chính trị');
INSERT INTO Categories (C_Name)
VALUES ('Ngoại ngữ');
INSERT INTO Categories (C_Name)
VALUES ('Kinh tế');
INSERT INTO Categories (C_Name)
VALUES ('Quản trị - Lãnh đạo');
INSERT INTO Categories (C_Name)
VALUES ('Marketing');

INSERT INTO Book
VALUES ('1501','Muôn Kiếp Nhân Sinh','John Vu',2023,'NXB Tổng Hợp TPHCM',190000,'search1.jpg','Thông điệp quan trọng nhất của tác phẩm Muôn kiếp nhân sinh (Many times – Many lives) là nguồn gốc và cách thức vận hành của luật nhân quả và luân hồi của vũ trụ.');
INSERT INTO Book
VALUES ('1502','Giải Tích 12','Bộ Giáo Dục Và Đào Tạo',2020,'Nhà Xuất Bản Giáo Dục',39000,'search2.jpg','Sách giáo khoa Giải tích 12 cơ bản (SGK GT 12 CB) gồm 164 trang do nhà xuất bản Giáo dục Việt Nam phát hành, đây là cuốn SGK Giải tích 12 chính thống được dành cho học sinh khối 12.');
INSERT INTO Book
VALUES ('1503','Cây Cam Ngọt Của Tôi','José Mauro de Vasconcelos',2020,'Nhã Nam',75000,'search3.jpg','Một cách nhìn cuộc sống gần như hoàn chỉnh từ con mắt trẻ thơ… có sức mạnh sưởi ấm và làm tan nát cõi lòng, dù người đọc ở lứa tuổi nào.');
INSERT INTO Book
VALUES ('1504','Thỏ 7 Màu','HUỲNH THÁI NGỌC',2023,'Công Ty Cổ Phần Time Books',99000,'search4.jpg','Thỏ Bảy Màu đơn giản chỉ là một con thỏ trắng với sự dở hơi, ngang ngược nhưng đáng yêu vô cùng tận.');
INSERT INTO Book
VALUES ('1505','Nhật Ký Targot','Brigit Esselmont',2021,'NXB Thế Giới',179000,'search5.jpg','Tarot không phải một trò chơi dự đoán tương lai, mà là một công cụ tạo ra tương lai. Cuốn sách “Nhật ký Tarot” sẽ giúp bạn đặt chân qua ngưỡng cửa của bộ môn khoa học huyền bí, đầy mê hoặc này.');
INSERT INTO Book
VALUES ('1506','Thay Đổi Cuộc Sống Với Thần Số Học','Lê Đỗ Quỳnh Hương',2020,'NXB Tổng Hợp TPHCM',76000,'search6.jpg','Cuốn sách Thay đổi cuộc sống với Nhân số học là tác phẩm được chị Lê Đỗ Quỳnh Hương phát triển từ tác phẩm gốc “The Complete Book of Numerology” của tiến sỹ David A. Phillips.');
INSERT INTO Book
VALUES ('1507','Cambridge IELTS 18 Academic','Nhiều Tác Giả',2023,'Cambridge',161000,'search7.jpeg','Liệu bạn có đang học tiếng Anh để thi IELTS đúng phương pháp??? Tất cả sẽ được giải quyết khi bạn chọn được cho mình bộ sách IELTS đích thực.');
INSERT INTO Book
VALUES ('1508','Bí mật - Traffic - Bìa Cứng','Nguyễn Quang Ngọc',2023,'Thế Giới',241000,'search20.jpeg','Bí Mật Traffic được viết ra để giúp bạn đưa thông điệp về sản phẩm và dịch vụ của bạn đến được với thế giới.');
INSERT INTO Book
VALUES ('1509','Sức Mạnh Của Ngôn Từ','Don Gabor',2022,'NXB Tổng Hợp TPHCM',84600,'search12.jpeg','Quyển sách Sức mạnh của Ngôn từ được chia làm ba phần gồm 20 chương với các nội dung áp dụng trong công việc, quan hệ khách hàng - nhà cung cấp và trong giao tiếp xã hội với hàng trăm gợi ý, tình huống cùng các ví dụ thực tế.');
INSERT INTO Book
VALUES ('1510','Rèn Luyện Tư Duy Phản Biện','Albert Rutherford',2020,'NXB Phụ Nữ Việt Nam',69000,'search13.jpeg','Như bạn có thể thấy, chìa khoá để trở thành một người có tư duy phản biện tốt chính là sự nhận thức.');
INSERT INTO Book
VALUES ('1511','25 Chuyên Đề Ngữ Pháp Tiếng Anh Trọng Tâm','Trang Anh',2018,'NXB Đại học sư phạm',80000,'search8.jpeg','Các chuyên đề ngữ pháp trọng tâm được trình bày đơn giản, dễ hiểu cùng với hệ thống bài tập và từ vựng phong phú.');
INSERT INTO Book
VALUES ('1512','Hồi Ký Lý Quang Diệu','Lý Quang Diệu',2023,'Thế Giới',100000,'search16.jpeg','Sau khi lãnh đạo đất nước Singapore độc lập ở cương vị Thủ tướng trong vòng 3 thập kỷ, năm 1990, Lý Quang Diệu lui về làm cố vấn và dành nhiều tâm sức thu thập tài liệu để viết nên bộ hồi ký này, nhìn lại toàn bộ cuộc đời ông.');
INSERT INTO Book
VALUES ('1513','Tiếp Thị 5.0: Công Nghệ Vị Nhân Sinh','Philip Kotler, Hermawan Kartajaya, Iwan Setiawan',2021,'NXB Trẻ',180000,'search21.jpeg','Trong Tiếp thị 5.0, cha đẻ của tiếp thị hiện đại, Philip Kotler giải thích cách các nhà tiếp thị có thể ứng dụng công nghệ để giải quyết nhu cầu của khách hàng và tạo nên khác biệt.');
INSERT INTO Book
VALUES ('1514','The Big Four - 4 Đại Gia Kiểm Toán','Ian D Gow, Stuart Kells',2020,'NXB Tài Chính',92000,'search25.jpeg','“Big Four” hình thành thế nào?');
INSERT INTO Book
VALUES ('1515','Người Mở Khóa Lãng Du','Lê Xuân Khoa, Xuân Chi, Thanh Huyền',2020,'NXB Thế Giới',82000,'search15.jpeg','Cánh cửa thời gian trở về lịch sử của dân tộc như được mở ra bởi câu chuyện về cuộc đời của một nhân vật gắn liền với sự đổi thay, chuyển mình của đất nước.');
INSERT INTO Book
VALUES ('1516','Điềm Tĩnh Và Nóng Giận','Tạ Quốc Kế',2021,'NXB Thanh Niên',67000,'search14.jpeg','Trong cuộc sống thường ngày, chúng ta thường nổi giận vì nhiều nguyên do: công việc không suôn sẻ, chúng ta tức giận; bị người khác hiểu nhầm, chúng ta tức giận.');
INSERT INTO Book
VALUES ('1517','Bill Gates: Tham Vọng Lớn Lao','James Wallace, Jim Erickson',2017,'NXB Thế Giới',194000,'search24.jpeg','Cuốn sách này mở ra một câu chuyện sinh động và chân thực nhất về sự nổi lên của một thiên tài độc đoán, cách thức ông làm thay đổi cả một nền công nghiệp máy tính, và lý do tại sao mọi người quyết tâm tìm hiểu ông bằng được.');


-- INSERT INTO category (name, status) VALUES
--     ('Sách giáo khoa', 1),
--     ('Tâm lý - Triết học', 1),
--     ('Truyện', 1),
--     ('Nhật ký', 1),
--     ('Học thuật', 1),
--     ('Kỹ năng sống', 1),
--     ('Ngôn tình', 1),
--     ('Chính trị', 1),
--     ('Ngoại ngữ', 1),
--     ('Kinh tế', 1),
--     ('Quản trị - Lãnh đạo', 1),
--     ('Marketing', 1);

-- INSERT INTO book (name, price, image, description, status, category_id) VALUES
--     ('Giải Tích 12', 39000, 'search2.jpg', 'Mô tả sách:...', 1, 1),
--     ('Muôn Kiếp Nhân Sinh', 117000, 'search1.jpg', 'Mô tả sách:...', 1, 2),
--     ('Cây Cam Ngọt Của Tôi', 75000, 'search3.jpg', 'Mô tả sách:...', 1, 3),
--     ('Thỏ 7 Màu', 79000, 'search4.jpg', 'Mô tả sách:...', 1, 3),
--     ('Nhật Ký Targot', 179000, 'search5.jpg', 'Mô tả sách:...', 1, 4),
--     ('Thay Đổi Cuộc Sống Với Thần Số Học', 173000, 'search6.jpg', 'Mô tả sách:...', 1, 2),
--     ('Cambridge IELTS 18 Academic', 161000, 'search7.jpeg', 'Mô tả sách:...', 1, 9),
--     ('Bí mật - Traffic - Bìa Cứng', 221000, 'search20.jpeg', 'Mô tả sách:...', 1, 12),
--     ('Sức Mạnh Của Ngôn Từ', 73000, 'search12.jpeg', 'Mô tả sách:...', 1, 6),
--     ('Rèn Luyện Tư Duy Phản Biện', 63000, 'search13.jpeg', 'Mô tả sách:...', 1, 6),
--     ('25 Chuyên Đề Ngữ Pháp Tiếng Anh Trọng Tâm', 73000, 'search8.jpeg', 'Mô tả sách:...', 1, 9),
--     ('Hồi Ký Lý Quang Diệu', 100000, 'search16.jpeg', 'Mô tả sách:...', 1, 8),
--     ('Người Bán Hàng Vĩ Đại Nhất Thế Giới', 180000, 'search19.jpeg', 'Mô tả sách:...', 1, 12),
--     ('Bến Xe', 22000, 'search22.jpeg', 'Mô tả sách:...', 1, 7),
--     ('Tiếng Anh Qua Sơ Đồ Tư Duy', 112500, 'search11.jpeg', 'Mô tả sách:...', 1, 9),
--     ('Tự Truyện Benjamin Franklin', 92000, 'search17.jpeg', 'Mô tả sách:...', 1, 8),
--     ('Sói Và Dương Cầm', 75000, 'search23.jpeg', 'Mô tả sách:...', 1, 7),
--     ('Tiếng Anh Cho NgườI Bắt Đầu', 140000, 'search10.jpeg', 'Mô tả sách:...', 1, 9),
--     ('Tiếp Thị 5.0: Công Nghệ Vị Nhân Sinh', 96000, 'search21.jpeg', 'Mô tả sách:...', 1, 12),
--     ('Bill Gates: Tham Vọng Lớn Lao', 194000, 'search24.jpeg', 'Mô tả sách:...', 1, 10),
--     ('Con Tàu Ma Của Thế Chiến II', 194000, 'search18.jpeg', 'Mô tả sách:...', 1, 8),
--     ('The Big Four - 4 Đại Gia Kiểm Toán', 92000, 'search25.jpeg', 'Mô tả sách:...', 1, 10),
--     ('Người Mở Khóa Lãng Du', 82000, 'search15.jpeg', 'Mô tả sách:...', 1, 8),
--     ('Điềm Tĩnh Và Nóng Giận', 67000, 'search14.jpeg', 'Mô tả sách:...', 1, 6);


INSERT INTO Belong
VALUES ('9','1501');
INSERT INTO Belong
VALUES ('8','1502');
INSERT INTO Belong
VALUES ('10','1503');
INSERT INTO Belong
VALUES ('10','1504');
INSERT INTO Belong
VALUES ('11','1505');
INSERT INTO Belong
VALUES ('9','1506');
INSERT INTO Belong
VALUES ('16','1507');
INSERT INTO Belong
VALUES ('19','1508');
INSERT INTO Belong
VALUES ('13','1509');
INSERT INTO Belong
VALUES ('13','1510');
INSERT INTO Belong
VALUES ('16','1511');
INSERT INTO Belong
VALUES ('15','1512');
INSERT INTO Belong
VALUES ('19','1513');
INSERT INTO Belong
VALUES ('17','1514');
INSERT INTO Belong
VALUES ('15','1515');
INSERT INTO Belong
VALUES ('13','1516');
INSERT INTO Belong
VALUES ('17','1517');
