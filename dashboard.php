<?php
session_start();
if (!isset($_SESSION['sinhvien'])) {
  header("Location: index.html");
  exit();
}
$sv = $_SESSION['sinhvien'];
include 'db.php';
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Thông tin sinh viên</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="dashboard">
  <h2>Chào mừng, <?= $sv['hoten'] ?> (MSSV: <?= $sv['mssv'] ?>)</h2>

  <h3>Thông tin sinh viên</h3>
  <p><strong>Ngành:</strong> <?= $sv['nganh'] ?></p>
  <p><strong>Email:</strong> <?= $sv['email'] ?></p>

  <h3>Môn học đã đăng ký</h3>
  <ul>
    <?php
    $sql = "SELECT tenmon FROM dangky JOIN monhoc ON dangky.mamon = monhoc.mamon WHERE mssv='{$sv['mssv']}'";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
      echo "<li>{$row['tenmon']}</li>";
    }
    ?>
  </ul>

  <h3>Kỳ thi sắp tới</h3>
  <ul>
    <?php
    $sql = "SELECT tenmon, ngaythi, giothi, phongthi FROM kythi JOIN monhoc ON kythi.mamon = monhoc.mamon WHERE mamon IN (SELECT mamon FROM dangky WHERE mssv='{$sv['mssv']}')";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
      echo "<li>{$row['ngaythi']} - {$row['tenmon']} - {$row['phongthi']} - {$row['giothi']}</li>";
    }
    ?>
  </ul>

  <h3>Điểm môn học</h3>
  <table border="1" cellpadding="10">
    <tr><th>Môn</th><th>QT</th><th>Thi</th><th>Tổng</th></tr>
    <?php
    $sql = "SELECT tenmon, diemqt, diemthi, diemtongket FROM diem JOIN monhoc ON diem.mamon = monhoc.mamon WHERE mssv='{$sv['mssv']}'";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
      echo "<tr><td>{$row['tenmon']}</td><td>{$row['diemqt']}</td><td>{$row['diemthi']}</td><td>{$row['diemtongket']}</td></tr>";
    }
    ?>
  </table>
</div>
</body>
</html>
