<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
}

if(isset($_POST['submit'])){

   $name = $_POST['name'];
   $pass = sha1($_POST['pass']);
   $cpass = sha1($_POST['cpass']);

   $select_admin = $conn->prepare("SELECT * FROM `admins` WHERE name = ?");
   $select_admin->execute([$name]);

   if($select_admin->rowCount() > 0){
      $error_msg[] = 'tên admin đã tồn tại!';
   }else{
      if($pass != $cpass){
         $warning_msg[] = ' xác nhận mật khẩu không khớp!';
      }else{
         $insert_admin = $conn->prepare("INSERT INTO `admins`(name, password) VALUES(?,?)");
         $insert_admin->execute([$name, $cpass]);
         $success_msg[] = 'đăng ký thành công!';
      }
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>thêm nhân sự</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   

   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>

<?php include '../components/admin_header.php'; ?>

<section class="form-container">

   <form action="" method="post">
      <h3>thêm nhân sự</h3>
      <input type="text" name="name" required placeholder="nhập tên admin" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" name="pass" required placeholder="nhập mật khẩu admin" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" name="cpass" required placeholder="nhập lại mật khẩu admin" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="submit" value="thêm" class="btn" name="submit">
   </form>

</section>










<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<?php include '../components/alers.php'; ?> 

<script src="../js/admin_script.js"></script>
   
</body>
</html>