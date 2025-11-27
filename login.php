<?php
session_start();
include 'db.php';

$username = $_POST['username'];
$password = $_POST['password'];

$sql = "SELECT * FROM sinhvien WHERE (mssv='$username' OR email='$username') AND matkhau='$password'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) == 1) {
  $data = mysqli_fetch_assoc($result);
  $_SESSION['sinhvien'] = $data;
  header("Location: dashboard.php");
} else {
  echo "Sai tài khoản hoặc mật khẩu!";
}
?>
