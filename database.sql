CREATE DATABASE student_system;
USE student_system;

CREATE TABLE sinhvien (
  mssv VARCHAR(10) PRIMARY KEY,
  hoten VARCHAR(100),
  nganh VARCHAR(100),
  email VARCHAR(100),
  matkhau VARCHAR(50)
);

CREATE TABLE monhoc (
  mamon VARCHAR(10) PRIMARY KEY,
  tenmon VARCHAR(100)
);

CREATE TABLE dangky (
  mssv VARCHAR(10),
  mamon VARCHAR(10),
  FOREIGN KEY (mssv) REFERENCES sinhvien(mssv),
  FOREIGN KEY (mamon) REFERENCES monhoc(mamon)
);

CREATE TABLE kythi (
  makythi INT AUTO_INCREMENT PRIMARY KEY,
  mamon VARCHAR(10),
  ngaythi DATE,
  giothi TIME,
  phongthi VARCHAR(20),
  FOREIGN KEY (mamon) REFERENCES monhoc(mamon)
);

CREATE TABLE diem (
  mssv VARCHAR(10),
  mamon VARCHAR(10),
  diemqt FLOAT,
  diemthi FLOAT,
  diemtongket FLOAT,
  FOREIGN KEY (mssv) REFERENCES sinhvien(mssv),
  FOREIGN KEY (mamon) REFERENCES monhoc(mamon)
);

-- Dữ liệu mẫu:
INSERT INTO sinhvien VALUES ('SV001', 'Nguyễn Văn A', 'CNTT', 'a.nguyen@student.edu.vn', '123456');
INSERT INTO monhoc VALUES ('MH01', 'Cơ sở dữ liệu'), ('MH02', 'Lập trình C');
INSERT INTO dangky VALUES ('SV001', 'MH01'), ('SV001', 'MH02');
INSERT INTO kythi(mamon, ngaythi, giothi, phongthi) VALUES 
('MH01', '2025-08-10', '07:30:00', 'A102'),
('MH02', '2025-08-14', '09:00:00', 'B201');
INSERT INTO diem VALUES ('SV001', 'MH01', 7.5, 8.0, 7.8), ('SV001', 'MH02', 6.0, 7.5, 6.9);
