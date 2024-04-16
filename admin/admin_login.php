<?php

include '../components/connect.php';

session_start();

if(isset($_POST['submit'])){

   $name = $_POST['name'];
   $pass = sha1($_POST['pass']);

   $select_admin = $conn->prepare("SELECT * FROM `admins` WHERE name = ? AND password = ?");
   $select_admin->execute([$name, $pass]);
   $row = $select_admin->fetch(PDO::FETCH_ASSOC);

   if($select_admin->rowCount() > 0){
      $_SESSION['admin_id'] = $row['id'];
      header('location:dashboard.php');
   }else{
      $warning_msg[] = 'Tên đăng nhập hoặc mật khẩu không chính xác!';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>đăng nhập</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>



<section class="form-container">

   <form action="" method="post">
      <h3>đăng nhập</h3>
      <!-- <p>mặc định tên người dùng = <span>admin</span> & mật khẩu = <span>111</span></p> -->
      <input type="text" name="name" required placeholder="nhập tài khoản" maxlength="20"  class="box" >
      <input type="password" name="pass" required placeholder="nhập mật khẩu" maxlength="20"  class="box" >
      <input type="submit" value="đăng nhập" class="btn" name="submit">
   </form>

</section>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<?php include '../components/alers.php'; ?>   
</body>
</html>