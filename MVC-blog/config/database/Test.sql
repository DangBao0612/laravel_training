USE thuvien;

CREATE TABLE IF NOT EXISTS sach (
	ma_sach CHAR(5) PRIMARY KEY,
	tieu_de VARCHAR(200) NOT NULL,
	tac_gia VARCHAR(200),
	nam_xuat_ban YEAR,
	gia DECIMAL(65,2) -- Tối đa 100 chữ số, có 2 số sau dấu thập phân
);

INSERT INTO sach VALUES
	('S001','Doraemon','Nguyen Van A',2018,15000),
	('S002','Dragon Ball','Tran Van B',2020,20000);
	
SELECT * FROM sach; -- truy vấn tất cả dữ liệu
	