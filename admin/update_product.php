<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
}

if(isset($_POST['update'])){

   $sp = $_POST['sp'];
   $name = $_POST['name'];
   $key_word = $_POST['key_word'];
   $price = $_POST['price'];
   $details = $_POST['details'];
   $details1 = $_POST['details1'];
   $details2 = $_POST['details2'];
   $details3 = $_POST['details3'];
   $details4 = $_POST['details4'];
   $details5 = $_POST['details5'];
   $discount = $_POST['discount'];
   $import_price = $_POST['import_price'];
   $quantity_sp = $_POST['quantity_sp'];
   $brand = $_POST['brand'];
   $details_1 = $_POST['details_1'];
   $details_2 = $_POST['details_2'];
   $details_3 = $_POST['details_3'];
   $details_4 = $_POST['details_4'];
   $details_5 = $_POST['details_5'];
   $details_6 = $_POST['details_6'];
   $details_7 = $_POST['details_7'];
   $details_8 = $_POST['details_8'];
   $details_9 = $_POST['details_9'];
   $details_10 = $_POST['details_10'];
   $details_11 = $_POST['details_11'];

   $update_product = $conn->prepare("UPDATE `products` SET name = ?, key_word = ?, brand = ?, quantity_sp = ?, import_price = ?, price = ?, details = ? , details1 = ? , details2 = ? , details3 = ? , details4 = ? , details5 = ? , discount = ? , details_1 = ? , details_2 = ? , details_3 = ? , details_4 = ? , details_5 = ? , details_6 = ? , details_7 = ? , details_8 = ? , details_9 = ? , details_10 = ? , details_11 = ? WHERE id = ?");
   $update_product->execute([$name, $key_word, $brand, $quantity_sp,$import_price, $price, $details, $details1, $details2, $details3, $details4, $details5, $discount, $details_1, $details_2, $details_3, $details_4, $details_5, $details_6, $details_7, $details_8, $details_9, $details_10, $details_11, $sp]);

   $success_msg[] = 'cập nhật sản phẩm thành công!';

   $old_image_01 = $_POST['old_image_01'];
   $image_01 = $_FILES['image_01']['name'];
   $image_size_01 = $_FILES['image_01']['size'];
   $image_tmp_name_01 = $_FILES['image_01']['tmp_name'];
   $image_folder_01 = '../kho_ảnh/'.$image_01;

   if(!empty($image_01)){
      if($image_size_01 > 2000000){
         $warning_msg[] = 'kích thước hình ảnh quá lớn!';
      }else{
         $update_image_01 = $conn->prepare("UPDATE `products` SET image_01 = ? WHERE id = ?");
         $update_image_01->execute([$image_01, $sp]);
         move_uploaded_file($image_tmp_name_01, $image_folder_01);
         unlink('../kho_ảnh/'.$old_image_01);
         $success_msg[] = 'hình ảnh 01 được cập nhật thành công!';
      }
   }

   $old_image_02 = $_POST['old_image_02'];
   $image_02 = $_FILES['image_02']['name'];
   $image_size_02 = $_FILES['image_02']['size'];
   $image_tmp_name_02 = $_FILES['image_02']['tmp_name'];
   $image_folder_02 = '../kho_ảnh/'.$image_02;

   if(!empty($image_02)){
      if($image_size_02 > 2000000){
         $warning_msg[] = 'kích thước hình ảnh là quá lớn!';
      }else{
         $update_image_02 = $conn->prepare("UPDATE `products` SET image_02 = ? WHERE id = ?");
         $update_image_02->execute([$image_02, $sp]);
         move_uploaded_file($image_tmp_name_02, $image_folder_02);
         unlink('../kho_ảnh/'.$old_image_02);
         $success_msg[] = 'hình ảnh 02 được cập nhật thành công!';
      }
   }

   $old_image_03 = $_POST['old_image_03'];
   $image_03 = $_FILES['image_03']['name'];
   $image_size_03 = $_FILES['image_03']['size'];
   $image_tmp_name_03 = $_FILES['image_03']['tmp_name'];
   $image_folder_03 = '../kho_ảnh/'.$image_03;

   if(!empty($image_03)){
      if($image_size_03 > 2000000){
         $warning_msg[] = 'kích thước hình ảnh là quá lớn!';
      }else{
         $update_image_03 = $conn->prepare("UPDATE `products` SET image_03 = ? WHERE id = ?");
         $update_image_03->execute([$image_03, $sp]);
         move_uploaded_file($image_tmp_name_03, $image_folder_03);
         unlink('../kho_ảnh/'.$old_image_03);
         $success_msg[] = 'hình ảnh 03 được cập nhật thành công';
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
   <title>cập nhật sản phẩm</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>

<?php include '../components/admin_header.php'; ?>

<section class="update-product">

   <h1 class="heading">cập nhật sản phẩm</h1>

   <?php
      $update_id = $_GET['update'];
      $select_products = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
      $select_products->execute([$update_id]);
      if($select_products->rowCount() > 0){
         while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){ 
   ?>
   <form action="" method="post" enctype="multipart/form-data">
      <input type="hidden" name="sp" value="<?= $fetch_products['id']; ?>">
      <input type="hidden" name="old_image_01" value="<?= $fetch_products['image_01']; ?>">
      <input type="hidden" name="old_image_02" value="<?= $fetch_products['image_02']; ?>">
      <input type="hidden" name="old_image_03" value="<?= $fetch_products['image_03']; ?>">
      <div class="image-container">
         <div class="main-image">
            <img src="../kho_ảnh/<?= $fetch_products['image_01']; ?>" alt="">
         </div>
         <div class="sub-image">
            <img src="../kho_ảnh/<?= $fetch_products['image_01']; ?>" alt="">
            <img src="../kho_ảnh/<?= $fetch_products['image_02']; ?>" alt="">
            <img src="../kho_ảnh/<?= $fetch_products['image_03']; ?>" alt="">
         </div>
      </div>
      
      <span>cập nhật tên</span>
      <input type="text" name="name" required class="box" maxlength="100" placeholder="cập nhật tên sản phẩm" value="<?= $fetch_products['name']; ?>">
      <span>từ khóa</span>
      <select name="key_word" class="select">
            <option value="<?= $fetch_products['key_word']; ?>"><?= $fetch_products['key_word']; ?></option>
            <option value="dtdd">điện thoại di động</option>
            <option value="laptop">laptop</option>
            <option value="banphim">bàn phím</option>
            <option value="chuot">chuột</option>
            <option value="loa_bluetooth">loa bluetooth</option>
            <option value="cap-dien-thoai">cáp điện thoại</option>
            <option value="sac-dien-thoai">sạc điện thoại</option>
      </select>
      <span>thương hiệu</span>
      <input type="text" name="brand"  class="box" maxlength="200" placeholder="" value="<?= $fetch_products['brand']; ?>">
      <span>cập nhật số lượng</span>
      <input type="number" name="quantity_sp" required class="box" min="0" max="9999999999" placeholder="nhập số lượng" onkeypress="if(this.value.length == 10) return false;" value="<?= $fetch_products['quantity_sp']; ?>">
      <span>cập nhật giá nhập</span>
      <input type="number" name="import_price" required class="box" min="0" max="9999999999" placeholder="giá nhập vào" onkeypress="if(this.value.length == 10) return false;" value="<?= $fetch_products['import_price']; ?>">
      <span>cập nhật giá bán</span>
      <input type="number" name="price" required class="box" min="0" max="9999999999" placeholder="giá bán" onkeypress="if(this.value.length == 10) return false;" value="<?= $fetch_products['price']; ?>">
      <span>cập nhật giảm giá</span>
      <input type="number" name="discount" required class="box" min="0" max="9999999999" placeholder="nhập giá đã giảm" onkeypress="if(this.value.length == 10) return false;" value="<?= $fetch_products['discount']; ?>">
      <span>chi tiết 1</span>
      <input type="text" name="details_1"  class="box" maxlength="200" placeholder="" value="<?= $fetch_products['details_1']; ?>">
      <span>chi tiết 2</span>
      <input type="text" name="details_2"  class="box" maxlength="200" placeholder="" value="<?= $fetch_products['details_2']; ?>">
      <span>chi tiết 3</span>
      <input type="text" name="details_3"  class="box" maxlength="200" placeholder="" value="<?= $fetch_products['details_3']; ?>">
      <span>chi tiết 4</span>
      <input type="text" name="details_4"  class="box" maxlength="200" placeholder="" value="<?= $fetch_products['details_4']; ?>">
      <span>chi tiết 5</span>
      <input type="text" name="details_5"  class="box" maxlength="200" placeholder="" value="<?= $fetch_products['details_5']; ?>">
      <span>chi tiết 6</span>
      <input type="text" name="details_6"  class="box" maxlength="200" placeholder="" value="<?= $fetch_products['details_6']; ?>">
      <span>chi tiết 7</span>
      <input type="text" name="details_7"  class="box" maxlength="200" placeholder="" value="<?= $fetch_products['details_7']; ?>">
      <span>chi tiết 8</span>
      <input type="text" name="details_8"  class="box" maxlength="200" placeholder="" value="<?= $fetch_products['details_8']; ?>">
      <span>chi tiết 9</span>
      <input type="text" name="details_9"  class="box" maxlength="200" placeholder="" value="<?= $fetch_products['details_9']; ?>">
      <span>chi tiết 10</span>
      <input type="text" name="details_10"  class="box" maxlength="200" placeholder="" value="<?= $fetch_products['details_10']; ?>">
      <span>chi tiết 11</span>
      <input type="text" name="details_11"  class="box" maxlength="200" placeholder="" value="<?= $fetch_products['details_11']; ?>">
      <span>cập nhật ảnh 01</span>
      <input type="file" name="image_01" accept="image/jpg, image/jpeg, image/png, image/webp" class="box">
      <span>cập nhật ảnh 02</span>
      <input type="file" name="image_02" accept="image/jpg, image/jpeg, image/png, image/webp" class="box">
      <span>cập nhật ảnh 03</span>
      <input type="file" name="image_03" accept="image/jpg, image/jpeg, image/png, image/webp" class="box">
      <span>cập nhật chi tiết</span>
      <textarea name="details" class="box" required cols="30" rows="10"><?= $fetch_products['details']; ?></textarea>
      <span>cập nhật chi tiết 1</span>
      <textarea name="details1" class="box"  cols="30" rows="10"><?= $fetch_products['details1']; ?></textarea>
      <span>cập nhật chi tiết 2</span>
      <textarea name="details2" class="box"  cols="30" rows="10"><?= $fetch_products['details2']; ?></textarea>
      <span>cập nhật chi tiết 3</span>
      <textarea name="details3" class="box"  cols="30" rows="10"><?= $fetch_products['details3']; ?></textarea>
      <span>cập nhật chi tiết 4</span>
      <textarea name="details4" class="box"  cols="30" rows="10"><?= $fetch_products['details4']; ?></textarea>
      <span>cập nhật chi tiết 5</span>
      <textarea name="details5" class="box"  cols="30" rows="10"><?= $fetch_products['details5']; ?></textarea>
      <div class="flex-btn">
         <input type="submit" name="update" class="btn" value="cập nhật">
         <a href="products.php" class="option-btn">quay lại</a>
      </div>
   </form>
   
   <?php
         }
      }else{
         echo '<p class="empty">không tìm thấy sản phẩm!</p>';
      }
   ?>

</section>










<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<?php include '../components/alers.php'; ?>  

<script src="../js/admin_script.js"></script>

</body>
</html>